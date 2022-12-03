import template from './sw-dashboard-index.html.twig';
import './sw-dashboard-index.scss';

const BUNDLE_IMG_BASE_PATH = 'bundles/magmodulesdistancebasedshippingcost/img/';

Shopware.Component.override('sw-dashboard-index', {
    template,

    inject: ['shopwareExtensionService'],

    data() {
        return {
            extension: {
                name: 'MagmodulesDistanceBasedShippingCost',
                minSupport: '>= 6.4.0',
                logo: '',
            },
            cards: [
                {
                    imageSrc:
                        BUNDLE_IMG_BASE_PATH + 'dashboard_img_general.jpg',
                    title: this.$tc('mm-dashboard.cards.general.title'),
                    description: this.$tc(
                        'mm-dashboard.cards.general.description',
                    ),
                    button: {
                        routerLink: {
                            name:
                                'mm.distance.based.shipping.settings.index.general',
                        },
                        label: this.$tc(
                            'mm-dashboard.cards.general.button-label',
                        ),
                    },
                },
                {
                    imageSrc:
                    BUNDLE_IMG_BASE_PATH + 'dashboard_img_shipping.jpg',
                    title: this.$tc('mm-dashboard.cards.shipping.title'),
                    description: this.$tc(
                        'mm-dashboard.cards.shipping.description',
                    ),
                    button: {
                        routerLink: {
                            name:
                                'mm.distance.based.shipping.settings.index.shipping',
                        },
                        label: this.$tc(
                            'mm-dashboard.cards.shipping.button-label',
                        ),
                    },
                },
                {
                    imageSrc:
                        BUNDLE_IMG_BASE_PATH + 'dashboard_img_support.jpg',
                    title: this.$tc('mm-dashboard.cards.support.title'),
                    description: this.$tc(
                        'mm-dashboard.cards.support.description',
                    ),
                    button: {
                        link: 'https://magmodules.eu/help', //TODO update once direct link to plugin help page is available
                        label: this.$tc(
                            'mm-dashboard.cards.support.button-label',
                        ),
                    },
                },
            ],
        };
    },

    computed: {
        myExtensions() {
            return Shopware.State.get('shopwareExtensions').myExtensions.data;
        },

        isInstalled() {
            return !!Shopware.State.get(
                'shopwareExtensions',
            ).myExtensions.data.some((installedExtension) => {
                return (
                    installedExtension.installedAt &&
                    installedExtension.name === this.extension.name
                );
            });
        },
    },
    created() {
        this.createdComponent();
    },

    methods: {
        async createdComponent() {
            if (!this.myExtensions.length) {
                await this.shopwareExtensionService.updateExtensionData();
            }
            const extensionData = this.myExtensions.find((ext) => {
                return ext.name === this.extension.name;
            });

            extensionData.logo = `data:image/png;base64,${extensionData.iconRaw}`;
            this.extension = { ...this.extension, ...extensionData };

            console.log('this.extension',this.extension);
        },
    },
});
