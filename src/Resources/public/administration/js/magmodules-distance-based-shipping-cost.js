!function(e){var n={};function i(t){if(n[t])return n[t].exports;var s=n[t]={i:t,l:!1,exports:{}};return e[t].call(s.exports,s,s.exports,i),s.l=!0,s.exports}i.m=e,i.c=n,i.d=function(e,n,t){i.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:t})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,n){if(1&n&&(e=i(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(i.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var s in e)i.d(t,s,function(n){return e[n]}.bind(null,s));return t},i.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(n,"a",n),n},i.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},i.p="/bundles/magmodulesdistancebasedshippingcost/",i(i.s="Shgc")}({"5EX2":function(e,n,i){},"9m8d":function(e,n,i){},Fm8w:function(e,n,i){},SH1F:function(e,n,i){var t=i("9m8d");t.__esModule&&(t=t.default),"string"==typeof t&&(t=[[e.i,t,""]]),t.locals&&(e.exports=t.locals);(0,i("SZ7m").default)("8a87a94e",t,!0,{})},SZ7m:function(e,n,i){"use strict";function t(e,n){for(var i=[],t={},s=0;s<n.length;s++){var a=n[s],r=a[0],o={id:e+":"+s,css:a[1],media:a[2],sourceMap:a[3]};t[r]?t[r].parts.push(o):i.push(t[r]={id:r,parts:[o]})}return i}i.r(n),i.d(n,"default",(function(){return u}));var s="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!s)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var a={},r=s&&(document.head||document.getElementsByTagName("head")[0]),o=null,c=0,p=!1,d=function(){},l=null,g="data-vue-ssr-id",m="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function u(e,n,i,s){p=i,l=s||{};var r=t(e,n);return h(r),function(n){for(var i=[],s=0;s<r.length;s++){var o=r[s];(c=a[o.id]).refs--,i.push(c)}n?h(r=t(e,n)):r=[];for(s=0;s<i.length;s++){var c;if(0===(c=i[s]).refs){for(var p=0;p<c.parts.length;p++)c.parts[p]();delete a[c.id]}}}}function h(e){for(var n=0;n<e.length;n++){var i=e[n],t=a[i.id];if(t){t.refs++;for(var s=0;s<t.parts.length;s++)t.parts[s](i.parts[s]);for(;s<i.parts.length;s++)t.parts.push(b(i.parts[s]));t.parts.length>i.parts.length&&(t.parts.length=i.parts.length)}else{var r=[];for(s=0;s<i.parts.length;s++)r.push(b(i.parts[s]));a[i.id]={id:i.id,refs:1,parts:r}}}}function f(){var e=document.createElement("style");return e.type="text/css",r.appendChild(e),e}function b(e){var n,i,t=document.querySelector("style["+g+'~="'+e.id+'"]');if(t){if(p)return d;t.parentNode.removeChild(t)}if(m){var s=c++;t=o||(o=f()),n=w.bind(null,t,s,!1),i=w.bind(null,t,s,!0)}else t=f(),n=y.bind(null,t),i=function(){t.parentNode.removeChild(t)};return n(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap)return;n(e=t)}else i()}}var v,_=(v=[],function(e,n){return v[e]=n,v.filter(Boolean).join("\n")});function w(e,n,i,t){var s=i?"":t.css;if(e.styleSheet)e.styleSheet.cssText=_(n,s);else{var a=document.createTextNode(s),r=e.childNodes;r[n]&&e.removeChild(r[n]),r.length?e.insertBefore(a,r[n]):e.appendChild(a)}}function y(e,n){var i=n.css,t=n.media,s=n.sourceMap;if(t&&e.setAttribute("media",t),l.ssrId&&e.setAttribute(g,n.id),s&&(i+="\n/*# sourceURL="+s.sources[0]+" */",i+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(s))))+" */"),e.styleSheet)e.styleSheet.cssText=i;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(i))}}},Shgc:function(e,n,i){"use strict";i.r(n);Shopware.Component.register("mm-distance-based-shipping-settings",{template:'{% block mm_distance_based_shipping_settings_page %}\n    <sw-page class="mm-distance-based-shipping-settings">\n\n        <template slot="search-bar">\n            <sw-search-bar/>\n        </template>\n\n        <template #language-switch>\n            <sw-language-switch @on-change="onChangeLanguage"/>\n        </template>\n\n        <template slot="smart-bar-header">\n            {% block mm_distance_based_shipping_settings_page_smart_bar_header_title %}\n                <h2>\n                    {% block mm_distance_based_shipping_settings_page_smart_bar_header_title_text %}\n                        {{ $tc(\'sw-settings.index.title\') }}\n                        <sw-icon\n                            name="small-arrow-medium-right"\n                            small\n                        />\n                        {{ $tc(\'mm-distance-based-shipping-settings.general.textHeadline\') }}\n                    {% endblock %}\n\n                    {% block mm_distance_based_shipping_settings_page_smart_bar_header_amount %}\n                        <span\n                            v-if="false"\n                            class="sw-page__smart-bar-amount">\n                            ({{ total }})\n                        </span>\n                    {% endblock %}\n                </h2>\n            {% endblock %}\n        </template>\n\n        \n        <template slot="content">\n            {% block googlereview_configuration_content_card_channel_config_sales_channel %}\n                <template #select="{ onInput, selectedSalesChannelId }">\n                    <sw-card :title="$tc(\'global.entities.sales_channel\', 2)">\n                        {% block biller_configuration_content_card_channel_config_sales_channel_card_title %}\n                            <sw-single-select v-model="selectedSalesChannelId"\n                                              labelProperty="translated.name"\n                                              valueProperty="id"\n                                              :isLoading="isLoading"\n                                              :options="salesChannels"\n                                              @change="onInput">\n                            </sw-single-select>\n                        {% endblock %}\n                    </sw-card>\n                </template>\n            {% endblock %}\n\n            {% block mm_distance_based_shipping_settings_tabs %}\n                <sw-tabs position-identifier="mm-distance-based-shipping-settings">\n                    <sw-tabs-item :route="{ name: \'mm.distance.based.shipping.settings.index.general\' }">\n                        {{ $tc(\'mm-distance-based-shipping-settings.page.general.tabLabel\') }}\n                    </sw-tabs-item>\n\n                    <sw-tabs-item :route="{ name: \'mm.distance.based.shipping.settings.index.shipping\' }">\n                        {{ $tc(\'mm-distance-based-shipping-settings.page.shipping.tabLabel\') }}\n                    </sw-tabs-item>\n                </sw-tabs>\n            {% endblock %}\n\n            <router-view ref="tabContent"/>\n\n        </template>\n    </sw-page>\n{% endblock %}\n',inject:["repositoryFactory"],data:function(){return{}},metaInfo:function(){return{title:this.$createTitle()}},methods:{onChangeLanguage:function(){this.$refs.tabContent.reloadContent&&this.$refs.tabContent.reloadContent()}}});function t(e,n,i,t,s,a,r){try{var o=e[a](r),c=o.value}catch(e){return void i(e)}o.done?n(c):Promise.resolve(c).then(t,s)}function s(e){return function(){var n=this,i=arguments;return new Promise((function(s,a){var r=e.apply(n,i);function o(e){t(r,s,a,o,c,"next",e)}function c(e){t(r,s,a,o,c,"throw",e)}o(void 0)}))}}var a=Shopware,r=a.Component,o=a.Mixin,c=Shopware.Data.Criteria;r.register("mm-distance-based-shipping-settings-view-general",{template:'{% block mm_distance_based_shipping_settings_view_general %}\n\n    <div class="mm-distance-based-shipping-settings-view-general">\n\n        <sw-card v-if="config !== null">\n\n                <sw-switch-field\n                    v-model="config.enabled"\n                    class="mm-distance-based-shipping-settings-enabled__input"\n                    :label="$tc(\'mm-distance-based-shipping-settings.page.general.labelEnabled\')"\n                    size="default"\n                />\n\n                <sw-text-field\n                    v-model="config.googleMapsApiKey"\n                    class="mm-distance-based-shipping-settings-google-maps-api-key__input"\n                    :label="$tc(\'mm-distance-based-shipping-settings.page.general.labelGmapsApiKey\')"\n                    size="default"\n                />\n\n                <sw-text-field\n                    v-model="config.storeAddress"\n                    class="mm-distance-based-shipping-settings-store-address__input"\n                    :label="$tc(\'mm-distance-based-shipping-settings.page.general.labelStoreAddress\')"\n                    size="default"\n                />\n\n                <div class="mm-distance-based-shipping-settings_view_general__save-action_container">\n                    <sw-button-process\n                        class="mm-distance-based-shipping-settings_view_general__save-action"\n                        :is-loading="isLoading"\n                        :process-success="isSaveSuccessful"\n                        :disabled="isLoading"\n                        variant="primary"\n                        @process-finish="saveFinish"\n                        @click="onSave"\n                    >\n                        {{ $tc(\'mm-distance-based-shipping-settings.common.buttonSave\') }}\n                    </sw-button-process>\n                </div>\n\n        </sw-card>\n    </div>\n{% endblock %}\n',inject:["repositoryFactory"],mixins:[o.getByName("notification")],metaInfo:function(){return{title:this.$createTitle()}},data:function(){return{isLoading:!1,isSaveSuccessful:!1,enabled:{value:!0},config:null,configCollection:[]}},created:function(){this.createdComponent()},computed:{configRepository:function(){return this.repositoryFactory.create("mm_distance_based_shipping_cost")}},methods:{createdComponent:function(){var e=this;console.log("created component, performing fetch"),this.getConfigData().then((function(n){e.config=n,e.config||e.createInitialConfig().then((function(){}))}))},getConfigData:function(){var e=this;return s(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return console.log("getConfigData"),n.abrupt("return",e.configRepository.search(new c).then((function(e){return e.first()})));case 2:case"end":return n.stop()}}),n)})))()},createInitialConfig:function(){var e=this;return s(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:console.log("configRepository",e.configRepository),e.config=e.configRepository.create(),e.config.enabled=!1,e.onSave().then((function(){e.createdComponent()}));case 4:case"end":return n.stop()}}),n)})))()},saveFinish:function(){this.isSaveSuccessful=!1},onSave:function(){var e=this;return s(regeneratorRuntime.mark((function n(){var i;return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return e.isSaveSuccessful=!1,e.isLoading=!0,i=e.config,n.abrupt("return",e.configRepository.save(i).then((function(){e.isLoading=!1,e.isSaveSuccessful=!0,e.createdComponent()})).catch((function(n){e.isLoading=!1,e.createNotificationError({message:n})})));case 4:case"end":return n.stop()}}),n)})))()}}});i("Tqo8");function p(e,n,i,t,s,a,r){try{var o=e[a](r),c=o.value}catch(e){return void i(e)}o.done?n(c):Promise.resolve(c).then(t,s)}function d(e){return function(){var n=this,i=arguments;return new Promise((function(t,s){var a=e.apply(n,i);function r(e){p(a,t,s,r,o,"next",e)}function o(e){p(a,t,s,r,o,"throw",e)}r(void 0)}))}}var l=Shopware,g=l.Component,m=l.Mixin,u=Shopware.Data.Criteria;g.register("mm-distance-based-shipping-settings-view-shipping",{template:'{% block mm_distance_based_shipping_settings_view_shipping %}\n\n    <div class="mm-distance-based-shipping-settings-view-shipping">\n        <sw-card v-if="shippingConfig !== null">\n            <sw-entity-single-select\n                v-model="shippingConfig.shippingMethodId"\n                entity="shipping_method"\n                size="default"\n                :label="$tc(\'mm-distance-based-shipping-settings.page.shipping.labelShippingMethod\')"\n                show-clearable-button\n            />\n\n            <sw-select-field\n                v-model="shippingConfig.metric"\n                class="mm-distance-based-shipping-settings-metric__input"\n                :label="$tc(\'mm-distance-based-shipping-settings.page.shipping.labelMetric\')"\n                size="default"\n            >\n                <option\n                    v-for="metricOption in metricOptions"\n                    :key="metricOption.value"\n                    :value="metricOption.value"\n                >\n                    {{ metricOption.name }}\n                </option>\n            </sw-select-field>\n\n            <div class="mm-distance-based-shipping-settings_view_shipping__save-action_container">\n                <sw-button-process\n                    class="mm-distance-based-shipping-settings_view_shipping__save-action"\n                    :is-loading="isLoading"\n                    :process-success="isSaveSuccessful"\n                    :disabled="isLoading"\n                    variant="primary"\n                    @process-finish="saveFinish"\n                    @click="onSave"\n                >\n                    {{ $tc(\'mm-distance-based-shipping-settings.common.buttonSave\') }}\n                </sw-button-process>\n            </div>\n        </sw-card>\n\n        <sw-card>\n            <label>{{ $tc(\'mm-distance-based-shipping-settings.page.shipping.labelShippingPrice\') }}</label>\n            <mm-distance-based-shipping-settings-view-shipping-price/>\n        </sw-card>\n\n    </div>\n{% endblock %}\n',inject:["repositoryFactory"],mixins:[m.getByName("notification")],metaInfo:function(){return{title:this.$createTitle()}},data:function(){return{isLoading:!1,isSaveSuccessful:!1,shippingConfig:null}},created:function(){this.createdComponent()},computed:{configRepository:function(){return this.repositoryFactory.create("mm_distance_based_shipping_cost")},metricOptions:function(){return[{value:1,name:this.$tc("mm-distance-based-shipping-settings.page.general.metricOption__Km")},{value:2,name:this.$tc("mm-distance-based-shipping-settings.page.general.metricOption__Mi")}]}},methods:{createdComponent:function(){var e=this;console.log("created component, performing fetch view shipping"),this.isLoading=!0,this.getConfigData().then((function(n){console.log("config",n),e.shippingConfig=n,e.isLoading=!1}))},getConfigData:function(){var e=this;return d(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.abrupt("return",e.configRepository.search(new u).then((function(e){return e.first()})));case 1:case"end":return n.stop()}}),n)})))()},saveFinish:function(){this.isSaveSuccessful=!1},onSave:function(){var e=this;return d(regeneratorRuntime.mark((function n(){var i;return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return e.isSaveSuccessful=!1,e.isLoading=!0,null!==(i=e.shippingConfig).metric&&(i.metric=Number(i.metric)),n.abrupt("return",e.configRepository.save(i).then((function(){e.isLoading=!1,e.isSaveSuccessful=!0,e.createdComponent()})).catch((function(n){e.isLoading=!1,e.createNotificationError({message:n})})));case 5:case"end":return n.stop()}}),n)})))()}}});i("uXJ4");function h(e,n,i,t,s,a,r){try{var o=e[a](r),c=o.value}catch(e){return void i(e)}o.done?n(c):Promise.resolve(c).then(t,s)}var f=Shopware,b=f.Component,v=f.Mixin,_=Shopware.Data.Criteria;b.register("mm-distance-based-shipping-settings-view-shipping-price",{template:'{% block mm_distance_based_shipping_settings_view_shipping_price %}\n\n<div class="mm-distance-based-shipping-settings-view-shipping-price">\n\n    <div class="mm-distance-based-shipping-settings-view-shipping-price__toolbar">\n\n        <sw-button\n            :router-link="{ name: \'mm.distance.based.shipping.settings.shippingPriceCreate\' }"\n            class="mm-distance-based-shipping-settings-view-shipping-price__create-action"\n            variant="ghost"\n            :disabled="isLoading"\n            size="small"\n        >\n            {{ $tc(\'mm-distance-based-shipping-settings.shipping-price.list.buttonCreate\') }}\n        </sw-button>\n    </div>\n\n    <sw-entity-listing\n        class="mm-distance-based-shipping-settings-shipping-price-list-grid"\n        :items="priceMatrix"\n        :columns="priceMatrixColumns()"\n        :repository="priceMatrixRepository"\n        detail-route="mm.distance.based.shipping.settings.shippingPriceDetail"\n        :allow-column-edit="false"\n        :show-settings="false"\n        :is-loading="isLoading"\n        :full-page="false"\n        :disable-data-fetching="true"\n        @column-sort="onSortColumn"\n        @page-change="onPageChange"\n    >\n\n        <template #column-type="{ item }">\n            {{ $tc(`mm-distance-based-shipping-settings.shipping-price.list.columnType__${item.type}`) }}\n        </template>\n    </sw-entity-listing>\n\n</div>\n{% endblock %}\n',inject:["repositoryFactory"],mixins:[v.getByName("notification"),v.getByName("listing"),v.getByName("placeholder")],metaInfo:function(){return{title:this.$createTitle()}},data:function(){return{isLoading:!1,priceMatrix:null}},created:function(){this.createdComponent()},computed:{priceMatrixRepository:function(){return this.repositoryFactory.create("mm_distance_based_shipping_price_matrix")}},methods:{createdComponent:function(){var e=this;console.log("created component, performing fetch shipping prices"),this.isLoading=!0,this.getPriceMatrixData().then((function(n){e.priceMatrix=n,e.isLoading=!1}))},getPriceMatrixData:function(){var e,n=this;return(e=regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return n.isLoading=!0,e.abrupt("return",n.priceMatrixRepository.search(new _).then((function(e){return n.total=e.total,n.priceMatrix=e,n.isLoading=!1,e})).catch((function(e){return n.createNotificationError({message:n.$tc("mm-distance-based-shipping-settings.shipping-price.list.errorLoad")}),n.isLoading=!1,e})));case 2:case"end":return e.stop()}}),e)})),function(){var n=this,i=arguments;return new Promise((function(t,s){var a=e.apply(n,i);function r(e){h(a,t,s,r,o,"next",e)}function o(e){h(a,t,s,r,o,"throw",e)}r(void 0)}))})()},priceMatrixColumns:function(){return[{property:"from",label:"mm-distance-based-shipping-settings.shipping-price.list.columnFrom",routerLink:"mm.distance.based.shipping.settings.shippingPriceDetail"},{property:"to",label:"mm-distance-based-shipping-settings.shipping-price.list.columnTo",routerLink:"mm.distance.based.shipping.settings.shippingPriceDetail"},{property:"price",label:"mm-distance-based-shipping-settings.shipping-price.list.columnPrice",routerLink:"mm.distance.based.shipping.settings.shippingPriceDetail"},{property:"type",label:"mm-distance-based-shipping-settings.shipping-price.list.columnType",routerLink:"mm.distance.based.shipping.settings.shippingPriceDetail"}]}}});function w(e,n){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(e);n&&(t=t.filter((function(n){return Object.getOwnPropertyDescriptor(e,n).enumerable}))),i.push.apply(i,t)}return i}function y(e){for(var n=1;n<arguments.length;n++){var i=null!=arguments[n]?arguments[n]:{};n%2?w(Object(i),!0).forEach((function(n){x(e,n,i[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):w(Object(i)).forEach((function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(i,n))}))}return e}function x(e,n,i){return n in e?Object.defineProperty(e,n,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[n]=i,e}var S=Shopware,C=S.Component,P=S.Mixin,k=C.getComponentHelper().mapPropertyErrors;C.register("mm-distance-based-shipping-settings-shipping-price-detail",{template:'{% block mm_distance_based_shipping_settings_shipping_price_detail %}\n    <sw-page class="mm-distance-based-shipping-settings-shipping-price-detail">\n\n        <template #smart-bar-header>\n            <h2>{{ displayName }}</h2>\n        </template>\n\n        <template #language-switch>\n            <sw-language-switch @on-change="onChangeLanguage"/>\n        </template>\n\n        <template #smart-bar-actions>\n            <sw-button\n                v-tooltip.bottom="tooltipCancel"\n                @click="onCancel"\n            >\n                {{ $tc(\'mm-distance-based-shipping-settings.common.buttonCancel\') }}\n            </sw-button>\n\n            <sw-button-process\n                v-tooltip.bottom="tooltipSave"\n                class="mm-distance-based-shipping-settings-shipping-price-detail__save"\n                :is-loading="isLoading"\n                :process-success="isSaveSuccessful"\n                :disabled="false"\n                variant="primary"\n                @process-finish="saveFinish"\n                @click.prevent="onSave"\n            >\n                {{ $tc(\'mm-distance-based-shipping-settings.common.buttonSave\') }}\n            </sw-button-process>\n        </template>\n\n        <template #content>\n            <sw-card-view>\n\n                <sw-card\n                    :is-loading="isLoading"\n                    position-identifier="mm-distance-based-shipping-settings-shipping-price-detail-form"\n                >\n                    <template v-if="shippingPrice">\n\n                        <sw-number-field\n                            v-model="shippingPrice.from"\n                            :label="$tc(\'mm-distance-based-shipping-settings.shipping-price.detail.labelFrom\')"\n                            :error="shippingPriceFromError || invalidFromError"\n                            required\n                        />\n\n                        <sw-number-field\n                            v-model="shippingPrice.to"\n                            :label="$tc(\'mm-distance-based-shipping-settings.shipping-price.detail.labelTo\')"\n                            :error="shippingPriceToError"\n                            required\n                        />\n\n                        <sw-number-field\n                            v-model="shippingPrice.price"\n                            :label="$tc(\'mm-distance-based-shipping-settings.shipping-price.detail.labelPrice\')"\n                            :error="shippingPricePriceError"\n                            required\n                        />\n\n                        <sw-single-select\n                            v-model="shippingPrice.type"\n                            class="mm-distance-based-shipping-settings-shipping-price-detail__field-type"\n                            :options="shippingPriceTypes"\n                            :error="shippingPriceTypeError"\n                            :label="$tc(\'mm-distance-based-shipping-settings.shipping-price.detail.labelType\')"\n                            required\n                            show-clearable-button\n                        />\n\n                    </template>\n                </sw-card>\n            </sw-card-view>\n        </template>\n    </sw-page>\n{% endblock %}\n',inject:["repositoryFactory"],mixins:[P.getByName("notification")],shortcuts:{"SYSTEMKEY+S":{active:function(){return!0},method:"onSave"},ESCAPE:"onCancel"},data:function(){return{shippingPrice:null,isLoading:!1,isSaveSuccessful:!1}},metaInfo:function(){return{title:this.$createTitle()}},computed:y(y({},k("shippingPrice",["from","to","price","type"])),{},{displayName:function(){return this.$tc("mm-distance-based-shipping-settings.shipping-price.detail.textHeadlineEdit")},shippingPriceRepository:function(){return this.repositoryFactory.create("mm_distance_based_shipping_price_matrix")},shippingPriceTypes:function(){return[{value:1,label:this.$tc("mm-distance-based-shipping-settings.shipping-price.detail.selectionType__Fixed")},{value:2,label:this.$tc("mm-distance-based-shipping-settings.shipping-price.detail.selectionType__PerMetric")}]},isInvalidFromField:function(){return this.shippingPrice.from>this.shippingPrice.to},invalidFromError:function(){return this.isInvalidFromField&&this.createNotificationError({message:"Invalid From field value"}),null},tooltipSave:function(){var e=this.$device.getSystemKey();return{message:"".concat(e," + S"),appearance:"light"}},tooltipCancel:function(){return{message:"ESC",appearance:"light"}},showCustomFields:function(){return this.shippingPrice&&this.customFieldSets&&this.customFieldSets.length>0}}),created:function(){this.createdComponent()},methods:{createdComponent:function(){var e=this;this.isLoading=!0,this.shippingPriceRepository.get(this.$route.params.id).then((function(n){e.shippingPrice=n,e.isLoading=!1})).catch((function(n){throw e.createNotificationError({message:e.$tc("mm-distance-based-shipping-settings.shipping-price.detail.errorLoad")}),e.isLoading=!1,n}))},onSave:function(){var e=this;return this.isLoading=!0,this.isSaveSuccessful=!1,this.shippingPriceRepository.save(this.shippingPrice,Shopware.Context.api).then((function(){e.isLoading=!1,e.isSaveSuccessful=!0})).catch((function(n){throw e.createNotificationError({message:e.$tc("mm-distance-based-shipping-settings.shipping-price.detail.errorSave")}),e.isLoading=!1,n}))},onChangeLanguage:function(){this.createdComponent()},saveFinish:function(){this.isSaveSuccessful=!1,this.$router.push({name:"mm.distance.based.shipping.settings.index.shipping"})},onCancel:function(){this.$router.push({name:"mm.distance.based.shipping.settings.index.shipping"})}}});i("do3M");Shopware.Module.register("mm-distance-based-shipping-settings",{type:"plugin",name:"Distance Based Shipping Cost",title:"mm-distance-based-shipping-settings.general.mainMenuItemGeneral",description:"mm-distance-based-shipping-settings.general.description",version:"1.0.0",targetVersion:"1.0.0",color:"#9AA8B5",icon:"default-action-settings",favicon:"icon-module-settings.png",routePrefixPath:"mm/distance-based-shipping",routes:{index:{component:"mm-distance-based-shipping-settings",path:"index",meta:{parentPath:"sw.settings.index"},redirect:{name:"mm.distance.based.shipping.settings.index.general"},children:{general:{component:"mm-distance-based-shipping-settings-view-general",path:"general",meta:{parentPath:"sw.settings.index"}},shipping:{component:"mm-distance-based-shipping-settings-view-shipping",path:"shipping",meta:{parentPath:"sw.settings.index"}}}},shippingPriceDetail:{component:"mm-distance-based-shipping-settings-shipping-price-detail",path:"shipping-price/detail/:id",meta:{parentPath:"mm.distance.based.shipping.settings.index.shipping"}},shippingPriceCreate:{component:"mm-distance-based-shipping-settings-shipping-price-create",path:"shipping-price/create",meta:{parentPath:"mm.distance.based.shipping.settings.index.shipping"}}},settingsItem:{group:"plugins",to:"mm.distance.based.shipping.settings.index",icon:"default-location-marker"}});i("SH1F");function L(e,n){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(e);n&&(t=t.filter((function(n){return Object.getOwnPropertyDescriptor(e,n).enumerable}))),i.push.apply(i,t)}return i}function $(e){for(var n=1;n<arguments.length;n++){var i=null!=arguments[n]?arguments[n]:{};n%2?L(Object(i),!0).forEach((function(n){O(e,n,i[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):L(Object(i)).forEach((function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(i,n))}))}return e}function O(e,n,i){return n in e?Object.defineProperty(e,n,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[n]=i,e}function j(e,n,i,t,s,a,r){try{var o=e[a](r),c=o.value}catch(e){return void i(e)}o.done?n(c):Promise.resolve(c).then(t,s)}var E="bundles/magmodulesdistancebasedshippingcost/img/";Shopware.Component.override("sw-dashboard-index",{template:'{% block sw_dashboard_index_content_info_grid %}\n\n    {% parent %}\n\n    <div class="mm-dashboard-card__grid-container">\n\n        <sw-card>\n            <sw-container columns="2fr 1fr">\n                <sw-card-section class="plugin-info" divider="right" slim>\n\n                    <sw-container\n                        v-if="!extension.label"\n                        justify="center"\n                        align="center"\n                    >\n                        <sw-loader size="30px"/>\n                    </sw-container>\n\n                    <div v-else>\n                        <sw-container\n                            columns="80px 1fr max-content"\n                            gap="0px 30px">\n                            <img class="sw-dashboard-index__card-img"\n                                 :src="extension.logo"\n                                 alt="plugin logo">\n                            <div>\n                                <h2 class="sw-dashboard-index__card-title">{{ extension.label }}</h2>\n                                <p>{{ extension.description }}</p>\n                            </div>\n                        </sw-container>\n\n                        <div class="sw-dashboard-index__card-meta-container">\n                            <sw-card-section class="sw-dashboard-index__card-meta" divider="right" slim>\n                                <b>Plugin state:</b> {{ $tc(`mm-dashboard.plugin.active__${isInstalled}`) }}\n                            </sw-card-section>\n                            <sw-card-section class="sw-dashboard-index__card-meta" divider="right" slim>\n                                <b>Plugin version:</b> {{ extension.version }}\n                            </sw-card-section>\n                            <sw-card-section class="sw-dashboard-index__card-meta" slim>\n                                <b>Supports:</b> {{ extension.minSupport }}\n                            </sw-card-section>\n                        </div>\n                    </div>\n                </sw-card-section>\n\n                <sw-card-section\n                    slim secondary>\n                    <div class="company-info">\n                        <div>developed by</div>\n                        <h1 class="sw-dashboard-index__card-company-name">Magmodules</h1>\n                        <div>www.magmodules.com</div>\n                        <div>Copyright &copy; 2022</div>\n                    </div>\n                </sw-card-section>\n\n            </sw-container>\n        </sw-card>\n\n        <div class="mm-dashboard-card__grid">\n            <div class="mm-dashboard-card__card"\n                 v-for="card in cards"\n            >\n                <img class="mm-dashboard-card__cover-image"\n                     :src="card.imageSrc"\n                     alt="Magmodules Distance Based image"\n                />\n                <h3 class="mm-dashboard-card__title">\n                    {{ card.title }}\n                </h3>\n                <p class="mm-dashboard-card__description">\n                    {{ card.description }}\n                </p>\n                <sw-button class="mm-dashboard-card__button"\n                           variant="default"\n                           :routerLink="card.button.routerLink"\n                           :link="card.button.link">\n                    {{ card.button.label }}\n                </sw-button>\n            </div>\n        </div>\n    </div>\n\n{% endblock %}\n',inject:["shopwareExtensionService"],data:function(){return{extension:{name:"MagmodulesDistanceBasedShippingCost",minSupport:">= 6.4.0",logo:""},cards:[{imageSrc:E+"dashboard_img_general.jpg",title:this.$tc("mm-dashboard.cards.general.title"),description:this.$tc("mm-dashboard.cards.general.description"),button:{routerLink:{name:"mm.distance.based.shipping.settings.index.general"},label:this.$tc("mm-dashboard.cards.general.button-label")}},{imageSrc:E+"dashboard_img_shipping.jpg",title:this.$tc("mm-dashboard.cards.shipping.title"),description:this.$tc("mm-dashboard.cards.shipping.description"),button:{routerLink:{name:"mm.distance.based.shipping.settings.index.shipping"},label:this.$tc("mm-dashboard.cards.shipping.button-label")}},{imageSrc:E+"dashboard_img_support.jpg",title:this.$tc("mm-dashboard.cards.support.title"),description:this.$tc("mm-dashboard.cards.support.description"),button:{link:"https://magmodules.eu/help",label:this.$tc("mm-dashboard.cards.support.button-label")}}]}},computed:{myExtensions:function(){return Shopware.State.get("shopwareExtensions").myExtensions.data},isInstalled:function(){var e=this;return!!Shopware.State.get("shopwareExtensions").myExtensions.data.some((function(n){return n.installedAt&&n.name===e.extension.name}))}},created:function(){this.createdComponent()},methods:{createdComponent:function(){var e,n=this;return(e=regeneratorRuntime.mark((function e(){var i;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(n.myExtensions.length){e.next=3;break}return e.next=3,n.shopwareExtensionService.updateExtensionData();case 3:(i=n.myExtensions.find((function(e){return e.name===n.extension.name}))).logo="data:image/png;base64,".concat(i.iconRaw),n.extension=$($({},n.extension),i),console.log("this.extension",n.extension);case 7:case"end":return e.stop()}}),e)})),function(){var n=this,i=arguments;return new Promise((function(t,s){var a=e.apply(n,i);function r(e){j(a,t,s,r,o,"next",e)}function o(e){j(a,t,s,r,o,"throw",e)}r(void 0)}))})()}}})},Tqo8:function(e,n,i){var t=i("Fm8w");t.__esModule&&(t=t.default),"string"==typeof t&&(t=[[e.i,t,""]]),t.locals&&(e.exports=t.locals);(0,i("SZ7m").default)("03172984",t,!0,{})},do3M:function(e,n){Shopware.Component.extend("mm-distance-based-shipping-settings-shipping-price-create","mm-distance-based-shipping-settings-shipping-price-detail",{computed:{displayName:function(){return this.$tc("mm-distance-based-shipping-settings.shipping-price.detail.textHeadlineNew")}},methods:{createdComponent:function(){Shopware.State.commit("context/resetLanguageToDefault"),this.shippingPrice=this.shippingPriceRepository.create()}}})},uXJ4:function(e,n,i){var t=i("5EX2");t.__esModule&&(t=t.default),"string"==typeof t&&(t=[[e.i,t,""]]),t.locals&&(e.exports=t.locals);(0,i("SZ7m").default)("7647eddb",t,!0,{})}});