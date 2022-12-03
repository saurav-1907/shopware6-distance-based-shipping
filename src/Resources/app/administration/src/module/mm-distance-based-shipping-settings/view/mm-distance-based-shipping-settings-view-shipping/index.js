import template from './mm-distance-based-shipping-settings-view-shipping.html.twig';
import './mm-distance-based-shipping-settings-view-shipping.scss';

const {Component, Mixin} = Shopware;
const {Criteria} = Shopware.Data;

Component.register('mm-distance-based-shipping-settings-view-shipping', {
    template,

    inject: [
        'repositoryFactory',
    ],

    mixins: [
        Mixin.getByName('notification'),
    ],

    metaInfo() {
        return {
            title: this.$createTitle(),
        };
    },

    data() {
        return {
            isLoading: false,
            isSaveSuccessful: false,
            shippingConfig: null,
        };
    },

    created() {
        this.createdComponent();
    },

    computed: {
        configRepository() {
            return this.repositoryFactory.create('mm_distance_based_shipping_cost');
        },
        metricOptions() {
            return [
                {value: 1, name: this.$tc('mm-distance-based-shipping-settings.page.general.metricOption__Km')},
                {value: 2, name: this.$tc('mm-distance-based-shipping-settings.page.general.metricOption__Mi')},
            ];
        }
    },

    methods: {
        createdComponent() {
            console.log('created component, performing fetch view shipping');

            this.isLoading = true;
            this.getConfigData().then((config) => {
                console.log('config', config);

                this.shippingConfig = config;
                this.isLoading = false;
            });

        },

        async getConfigData() {
            return this.configRepository.search(new Criteria()).then(response => {
                return response.first();
            });
        },

        saveFinish() {
            this.isSaveSuccessful = false;
        },

        async onSave() {
            this.isSaveSuccessful = false;
            this.isLoading = true;

            let postData = this.shippingConfig;
            if (postData.metric !== null) {
                postData.metric = Number(postData.metric)
            }

            return this.configRepository.save(postData).then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;

                this.createdComponent();
            }).catch((err) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: err,
                });
            });
        },
    },
});
