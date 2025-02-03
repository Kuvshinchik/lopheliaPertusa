var msMiniCartDynamic = {

    config : {
            action : '/assets/components/msminicartdynamic/connector.php',
            selectorResult : '#mc-dynamic'
    },

    changeDynamic : function(checkbox = false) {
        var isPageOrder = $(miniShop2.Order.orderCost).length;
        var resource_id = $(msMiniCartDynamic.config.selectorResult).data('resource');

        $.ajax({
            type: 'POST',
            url: this.config.action,
            data: {action : true, resource_id: resource_id},
            cache: false,
            success: function(data) {

                try { var status = $.parseJSON(data); }
                catch (e) { var status = false; }

                if (status) {
                    if (status['success'] == true ) {
                        $(msMiniCartDynamic.config.selectorResult).html(status['data']['tplCart']);

                        // Загрузка изображений
                        observer.observe();

                        // Каталог - Категория - Зум превью
                        if ($(".zoom_prev").length) {
                            $(".zoom_prev").each(function() {
                                $(this).mouseover( function(event) { 
                                    $('.zoomContainer').hide();
                                    $(this).elevateZoom({
                                        scrollZoom : true,
                                        zoomLevel: 1.9
                                    });
                                });
                            });
                        }

                        if (isPageOrder) {
                            miniShop2.Order.getcost();
                            return false;
                        }
                    }
                } else {
                    miniShop2.Message.error('Произошла ошибка при обновлении корзины');
                }

                $('#msMiniCart, #msCart, #msOrder').removeClass('load');
            },
            error: function() {
            	$('#msMiniCart, #msCart, #msOrder').removeClass('load');
                setTimeout(function(){miniShop2.Message.error('Произошла ошибка при обновлении корзины');},500);
            }
        });
    }
};