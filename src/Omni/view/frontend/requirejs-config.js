
var config = {
    map: {
       '*': {
           'lsomni/map-loader' : 'Ls_Omni/js/map-loader',
           'lsomni/stores-provider' : 'Ls_Omni/js/model/stores-provider',
           'lsomni/map' : 'Ls_Omni/js/view/map',
           'Magento_Checkout/js/model/shipping-save-processor/default': 'Ls_Omni/js/model/shipping-save-processor/default',
           'ui/template/form/element/input': 'Ls_Omni/templates/form/element/input-overwrite'
       }
    },
    config: {
    	mixins: {
            'Magento_Checkout/js/view/shipping': {
                'Ls_Omni/js/view/plugin/shipping': true
            }
        }
    }
};
