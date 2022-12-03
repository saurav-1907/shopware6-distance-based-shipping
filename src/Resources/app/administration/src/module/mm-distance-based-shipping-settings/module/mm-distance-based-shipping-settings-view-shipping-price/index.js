import template from './mm-distance-based-shipping-settings-view-shipping-price.html.twig';
import './mm-distance-based-shipping-settings-view-shipping-price.scss';

const {Component, Mixin} = Shopware;
const {Criteria} = Shopware.Data;

Component.register('mm-distance-based-shipping-settings-view-shipping-price', {
    template,

    inject: [
        'repositoryFactory',
    ],

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('listing'),
        Mixin.getByName('placeholder'),
    ],

    metaInfo() {
        return {
            title: this.$createTitle(),
        };
    },

    data() {
        return {
            isLoading: false,
            priceMatrix: null,
        };
    },
    created() {
        this.createdComponent();
    },
    computed: {
        priceMatrixRepository() {
            return this.repositoryFactory.create('mm_distance_based_shipping_price_matrix');
        },
    },
    methods: {
        createdComponent() {
            console.log('created component, performing fetch shipping prices');

            this.isLoading = true;
            this.getPriceMatrixData().then((priceMatrix)=>{
                this.priceMatrix = priceMatrix;
                this.isLoading = false;
            });

        },
        async getPriceMatrixData() {
            this.isLoading = true;

            return this.priceMatrixRepository.search(new Criteria())
                .then((matrix) => {
                    this.total = matrix.total;
                    this.priceMatrix = matrix;
                    this.isLoading = false;

                    return matrix;
                })
                .catch((exception) => {
                    this.createNotificationError({
                        message: this.$tc('mm-distance-based-shipping-settings.shipping-price.list.errorLoad'),
                    });

                    this.isLoading = false;
                    return exception;
                });
        },

        priceMatrixColumns() {
            return [{
                property: 'from',
                label: 'mm-distance-based-shipping-settings.shipping-price.list.columnFrom',
                routerLink: 'mm.distance.based.shipping.settings.shippingPriceDetail',
            }, {
                property: 'to',
                label: 'mm-distance-based-shipping-settings.shipping-price.list.columnTo',
                routerLink: 'mm.distance.based.shipping.settings.shippingPriceDetail',
            }, {
                property: 'price',
                label: 'mm-distance-based-shipping-settings.shipping-price.list.columnPrice',
                routerLink: 'mm.distance.based.shipping.settings.shippingPriceDetail',
            }, {
                property: 'type',
                label: 'mm-distance-based-shipping-settings.shipping-price.list.columnType',
                routerLink: 'mm.distance.based.shipping.settings.shippingPriceDetail',
            }];
        },

    },
});
