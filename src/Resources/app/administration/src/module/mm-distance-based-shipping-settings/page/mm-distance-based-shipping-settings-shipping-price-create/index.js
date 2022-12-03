const {Component} = Shopware;

Component.extend('mm-distance-based-shipping-settings-shipping-price-create',
    'mm-distance-based-shipping-settings-shipping-price-detail', {
        computed: {
            displayName() {
                return this.$tc('mm-distance-based-shipping-settings.shipping-price.detail.textHeadlineNew');
            },
        },
        methods: {
            // saveFinish() {
            //     this.isSaveSuccessful = false;
            //     this.$router.push({
            //         name: 'mm.distance.based.shipping.settings.index.shippingPrice'
            //     });
            // },

            createdComponent() {
                Shopware.State.commit('context/resetLanguageToDefault');

                this.shippingPrice = this.shippingPriceRepository.create();
            },
        },
    });
