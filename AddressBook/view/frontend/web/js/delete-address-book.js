define([
    'jquery',
    'Magento_Ui/js/modal/alert'
], function ($, alert) {
    'use strict';
    return function (config) {
        let rootElem = config.rootElem;
        let deleteElem = config.deleteElem;
        $(function () {
            $(rootElem).on('click', deleteElem, function (e) {
                e.preventDefault();
                var self = $(this);
                var fd = new FormData();
                fd.append('form_key', $('input[name=form_key]').val());
                $('body').trigger('processStart');
                fetch(self.attr('href'), {
                    method: 'post',
                    body: fd
                })
                    .then((response) => {
                        if (response.ok) {
                            return response.json();
                        }
                    })
                    .then((resData) => {
                        $('body').trigger('processStop');
                        if (resData.success) {
                            alert({
                                title: $.mage.__('Success'),
                                content: $.mage.__('Address book deleted!'),
                                actions: {
                                    always: function () {
                                    }
                                }
                            });
                            self.parents('tr').remove();
                        }
                    }).catch((error) => {
                    console.log(error.message);
                });
            });
        });

    }
});
