import './page/mm-distance-based-shipping-settings';
import './view/mm-distance-based-shipping-settings-view-general';
import './view/mm-distance-based-shipping-settings-view-shipping';
import './module/mm-distance-based-shipping-settings-view-shipping-price';

import './page/mm-distance-based-shipping-settings-shipping-price-detail';
import './page/mm-distance-based-shipping-settings-shipping-price-create';

const { Module } = Shopware;

Module.register('mm-distance-based-shipping-settings', {
    type: 'plugin',
    name: 'Distance Based Shipping Cost',
    title: 'mm-distance-based-shipping-settings.general.mainMenuItemGeneral',
    description: 'mm-distance-based-shipping-settings.general.description',
    version: '1.0.0',
    targetVersion: '1.0.0',
    color: '#9AA8B5',
    icon: 'default-action-settings',
    favicon: 'icon-module-settings.png',
    routePrefixPath: 'mm/distance-based-shipping',

    routes: {
        index: {
            component: 'mm-distance-based-shipping-settings',
            path: 'index',
            meta: {
                parentPath: 'sw.settings.index',
            },
            redirect: {
                name: 'mm.distance.based.shipping.settings.index.general',
            },
            children: {
                general: {
                    component: 'mm-distance-based-shipping-settings-view-general',
                    path: 'general',
                    meta: {
                        parentPath: 'sw.settings.index',
                    },
                },
                shipping: {
                    component: 'mm-distance-based-shipping-settings-view-shipping',
                    path: 'shipping',
                    meta: {
                        parentPath: 'sw.settings.index',
                    },
                },
            }
        },
        shippingPriceDetail: {
            component: 'mm-distance-based-shipping-settings-shipping-price-detail',
            path: 'shipping-price/detail/:id',
            meta: {
                parentPath: 'mm.distance.based.shipping.settings.index.shipping',
            },
        },
        shippingPriceCreate: {
            component: 'mm-distance-based-shipping-settings-shipping-price-create',
            path: 'shipping-price/create',
            meta: {
                parentPath: 'mm.distance.based.shipping.settings.index.shipping',
            },
        },
    },

    settingsItem: {
        group: 'plugins',
        to: 'mm.distance.based.shipping.settings.index',
        icon: 'default-location-marker',
    },
});
