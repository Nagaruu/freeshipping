/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

 define([
    'uiComponent',
    'Magento_Customer/js/customer-data',
    'jquery',
    'ko',
    'underscore',
    'sidebar',
    'mage/translate',
    'mage/dropdown'
], function (Component, customerData, $, ko, _) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'AHT_Checkout/minicart/content_message',
        },
        freeShippingSub: window.checkout.freeShippingSubtotal,
        sym_bol: window.checkout.symbol,
        messs: window.checkout.mess,
        mess_freee: window.checkout.mess_free,
        messfree: function () {
            var subtotalAmount= customerData.get('cart')().subtotalAmount;
            var freeShippingSub =this.freeShippingSub;
            var sym_bol =this.sym_bol;
            var mess_freee =this.mess_freee;
            var message = "You are "+ sym_bol + (freeShippingSub-subtotalAmount) + " away from free shipping";

            if(Number(subtotalAmount) < Number(freeShippingSub) && subtotalAmount!=0 ){
                return message;
            }else if(Number(subtotalAmount) >= Number(freeShippingSub)){
                return mess_freee;
            }else {
                return null;
            }
        }
    });
});
