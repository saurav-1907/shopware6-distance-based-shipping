import template from './mm-distance-based-shipping-settings-view-general.html.twig';

const {Component, Mixin} = Shopware;
const {Criteria} = Shopware.Data;

Component.register('mm-distance-based-shipping-settings-view-general', {
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
            enabled: {
                value: true
            },
            config: null,
            configCollection: [],
        };
    },

    created() {
        this.createdComponent();
    },

    computed: {
        configRepository() {
            return this.repositoryFactory.create('mm_distance_based_shipping_cost');
        }
    },

    methods: {
        createdComponent() {
            console.log('created component, performing fetch');

            this.getConfigData().then((config) => {
                this.config = config;

                if (!this.config) {
                    this.createInitialConfig().then(() => {
                        //
                    });
                }
            });

        },

        async getConfigData() {
            console.log('getConfigData');

            return this.configRepository.search(new Criteria()).then(response => {
                return response.first();
            });
        },

        async createInitialConfig() {
            console.log('configRepository', this.configRepository);

            this.config = this.configRepository.create();
            this.config.enabled = false;
            this.onSave().then(() => {
                this.createdComponent();
            });
        },

        saveFinish() {
            this.isSaveSuccessful = false;
        },

        async onSave() {
            this.isSaveSuccessful = false;
            this.isLoading = true;

            let postData = this.config;

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
