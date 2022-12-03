import template from './mm-distance-based-shipping-settings-shipping-price-detail.html.twig';

const { Component, Mixin } = Shopware;
const { mapPropertyErrors } = Component.getComponentHelper();

Component.register('mm-distance-based-shipping-settings-shipping-price-detail', {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('notification'),
    ],

    shortcuts: {
        'SYSTEMKEY+S': {
            active() {
                return true;
            },
            method: 'onSave',
        },

        ESCAPE: 'onCancel',
    },

    data() {
        return {
            shippingPrice: null,
            isLoading: false,
            isSaveSuccessful: false,
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle(),
        };
    },

    computed: {
        ...mapPropertyErrors('shippingPrice', [
            'from',
            'to',
            'price',
            'type'
        ]),

        displayName() {
            return this.$tc('mm-distance-based-shipping-settings.shipping-price.detail.textHeadlineEdit');
        },

        shippingPriceRepository() {
            return this.repositoryFactory.create('mm_distance_based_shipping_price_matrix');
        },

        shippingPriceTypes() {
            return [{
                value: 1,
                label: this.$tc('mm-distance-based-shipping-settings.shipping-price.detail.selectionType__Fixed'),
            }, {
                value: 2,
                label: this.$tc('mm-distance-based-shipping-settings.shipping-price.detail.selectionType__PerMetric'),
            }];
        },

        isInvalidFromField() {
            return this.shippingPrice.from > this.shippingPrice.to;
        },

        invalidFromError() {
            if (this.isInvalidFromField) {
                this.createNotificationError({
                    message: 'Invalid From field value', //TODO use translations
                });
            }
            return null;
        },

        tooltipSave() {
            const systemKey = this.$device.getSystemKey();

            return {
                message: `${systemKey} + S`,
                appearance: 'light',
            };
        },

        tooltipCancel() {
            return {
                message: 'ESC',
                appearance: 'light',
            };
        },

        showCustomFields() {
            return this.shippingPrice && this.customFieldSets && this.customFieldSets.length > 0;
        },
    },

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.isLoading = true;

            this.shippingPriceRepository
                .get(this.$route.params.id)
                .then((shippingPrice) => {
                    this.shippingPrice = shippingPrice;
                    this.isLoading = false;
                })
                .catch((exception) => {
                    this.createNotificationError({
                        message: this.$tc('mm-distance-based-shipping-settings.shipping-price.detail.errorLoad'),
                    });

                    this.isLoading = false;
                    throw exception;
                });
        },

        onSave() {
            this.isLoading = true;
            this.isSaveSuccessful = false;

            return this.shippingPriceRepository
                .save(this.shippingPrice, Shopware.Context.api)
                .then(() => {
                    this.isLoading = false;
                    this.isSaveSuccessful = true;
                })
                .catch((exception) => {
                    this.createNotificationError({
                        message: this.$tc('mm-distance-based-shipping-settings.shipping-price.detail.errorSave'),
                    });

                    this.isLoading = false;
                    throw exception;
                });
        },

        onChangeLanguage() {
            this.createdComponent();
        },

        saveFinish() {
            this.isSaveSuccessful = false;
            this.$router.push({
                name: 'mm.distance.based.shipping.settings.index.shipping'
            });
        },

        onCancel() {
            this.$router.push({ name: 'mm.distance.based.shipping.settings.index.shipping' });
        },
    },
});
