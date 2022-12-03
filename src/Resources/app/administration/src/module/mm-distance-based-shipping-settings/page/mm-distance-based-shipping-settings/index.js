import template from './mm-distance-based-shipping-settings.html.twig';

/**
 * @private
 */
Shopware.Component.register('mm-distance-based-shipping-settings', {
    template,

    inject: ['repositoryFactory'],

    data() {
        return {};
    },

    metaInfo() {
        return {
            title: this.$createTitle(),
        };
    },

    methods: {
        onChangeLanguage() {
            if (this.$refs.tabContent.reloadContent) {
                this.$refs.tabContent.reloadContent();
            }
        },
    },
});
