$(function() {
	// Корзина - Изменение кол-ва товара
	$('body').on('click', '#msCart .amount .minus, #msCart .amount .plus', function(e) {
		const parent = $(this).closest('.amount')
		const input  = parent.find('.input')
	});

	// Заказ - Отгрузить частями
	$('#cart_need_parts').change(function(){
		if ($(this).prop('checked')) {
			$('#delivery_need_parts').prop('checked', true).change();
		} else {
			$('#delivery_need_parts').prop('checked', false).change();
		}
	});

	$('#delivery_need_parts').change(function(){
		if ($(this).prop('checked')) {
			$('#cart_need_parts').prop('checked', true);
			miniShop2.Order.add('delivery_need_parts', 'Да');
		} else {
			$('#cart_need_parts').prop('checked', false);
			miniShop2.Order.add('delivery_need_parts', 'Нет');
		}
		return false;
	});
	// end Заказ - Отгрузить частями
	
	// Табы - Отключение полей
	$('.checkout_form .block .methods label').click(function(){
		let methodInfo = $(this).data('content')
		let parent     = $(this).closest('.block')

		parent.find('.method_info input, .method_info select, .method_info textarea').attr('disabled', 'disabled').removeClass('error');
		parent.find(methodInfo + ' input, ' + methodInfo + ' select, ' + methodInfo + ' textarea').removeAttr('disabled');

		// Фиксация label в поле
		$('.input, textarea', parent).each(function(){
			if($(this).val().length) $(this).addClass('active');
		});
	});


	// Доставка - Обновление данных доставки
	function deliveryDynamic(response) { 
		let job_long  = ['рабочий день', 'рабочих дня', 'рабочих дней'],
			job_short = ['раб. день', 'раб. дня', 'раб. дней'],
			today 	  = 'Сегодня',
			free	  = 'Бесплатно';

		// FULL - order
		$('.checkout_form .delivery_methods .shipment .part.full .time b').text(units(response['time']['full'], job_long, true, today));
		$('.checkout_form .delivery_methods .shipment .part.full input[name="delivery_parts_full"]').val(units(response['time']['full'], job_long, true, today));
		if (response['total']['price'] != 0) $('.checkout_form .delivery_methods .shipment .price').text(miniShop2.Utils.formatPrice(response['total']['price']) + ' руб');
		else $('.checkout_form .delivery_methods .shipment .price').text(free);

		// FULL - total
		$('.checkout_total .delivery_time .val.full').text(units(response['time']['full'], job_short, true, today));
		
		// PARTS - order
		$('.checkout_form .delivery_methods .shipment .part.part_1 .time b').text(units(response['time']['parts']['part_1'], job_long, true, today));
		$('.checkout_form .delivery_methods .shipment .part.part_2 .time b').text(units(response['time']['parts']['part_2'], job_long, true));
		$('.checkout_form .delivery_methods .shipment .part.part_1 input[name="delivery_parts_part_1"]').val(units(response['time']['parts']['part_1'], job_long, true, today));
		$('.checkout_form .delivery_methods .shipment .part.part_2 input[name="delivery_parts_part_2"]').val(units(response['time']['parts']['part_2'], job_long, true));

		// PARTS - total
		$('.checkout_total .delivery_time .parts .val.part_1').text(units(response['time']['parts']['part_1'], job_short, true, today));
		$('.checkout_total .delivery_time .parts .val.part_2').text(units(response['time']['parts']['part_2'], job_short, true));

		// PICKUP
		if (typeof(response['time']['pickup']) != "undefined") {
			$('.checkout_form .delivery_methods .pickup .pickup_time_nsk').text(units(response['time']['pickup']['nsk'], job_long, true, today));
			$('.checkout_form .delivery_methods .pickup .pickup_time_msk').text(units(response['time']['pickup']['msk'], job_long, true, today));
		}

		// TOTAL
		$('.checkout_total .outer_dimensions .val .ms2_total_weight').text(miniShop2.Utils.formatWeight(response['total']['weight']));
		if(response['total']['volume'] >= 0.001) {
			$('.checkout_total .outer_dimensions .val .ms2_total_volume').text(miniShop2.Utils.formatWeight(response['total']['volume']));
		} else {
			$('.checkout_total .outer_dimensions .val .ms2_total_volume').text('< 0.001');
		}
		
		if (response['total']['price'] != 0) $('.checkout_total .delivery_price .val').text(miniShop2.Utils.formatPrice(response['total']['price']) + ' руб');
		else $('.checkout_total .delivery_price .val').text(free);

		// Отображаем/скрываем
		//if ($('.checkout_form .delivery_methods input[name="delivery"]:checked').val() == 2 && response['total']['price'] == 0){
		//	$('.checkout_form .delivery_methods .shipment .text').show();
		//	$('.checkout_form .delivery_methods .shipment .delivery_data, .checkout_total .delivery_price, .checkout_total .delivery_time').hide();
		//}else{
		//	$('.checkout_form .delivery_methods .shipment .text').hide();
		//	$('.checkout_form .delivery_methods .shipment .delivery_data, .checkout_total .delivery_price, .checkout_total .delivery_time').show();
		//}
        
        let cart_need_parts 	= response['cart_need_parts'], 					// в корзине есть товар под заказ
        	cart_no_volume 		= response['cart_no_volume'], 					// в корзине есть товар без веса/ширины/высоты/глубины
        	delivery_need_parts = $('#delivery_need_parts').prop('checked'); 	// поставлена галочка "Отгрузить заказ частями"

		if (cart_need_parts && delivery_need_parts) {
            $('.cart_info .need_parts, .checkout_form .delivery_methods .shipment .need_parts').show();
            $('.checkout_form .delivery_methods .shipment .part, .checkout_form .delivery_methods .shipment .icons .icon.mini, .checkout_total .delivery_time .parts').show();
            $('.checkout_form .delivery_methods .shipment .part.full, .checkout_total .delivery_time .val.full').hide();
            $('.checkout_form .delivery_methods .shipment .icons .icon:not(.mini)').css('fill','#eee');
            $('.checkout_form .delivery_methods .shipment .part.full input[name="delivery_parts_full"]').attr('disabled','disabled');
            $('.checkout_form .delivery_methods .shipment .part.part_1 input[name="delivery_parts_part_1"]').removeAttr('disabled');
			$('.checkout_form .delivery_methods .shipment .part.part_2 input[name="delivery_parts_part_2"]').removeAttr('disabled');
        } else {
            if (!cart_need_parts) $('.cart_info .need_parts, .checkout_form .delivery_methods .shipment .need_parts').hide();
            $('.checkout_form .delivery_methods .shipment .part, .checkout_form .delivery_methods .shipment .icons .icon.mini, .checkout_total .delivery_time .parts').hide();
            $('.checkout_form .delivery_methods .shipment .part.full, .checkout_total .delivery_time .val.full').show();
            $('.checkout_form .delivery_methods .shipment .icons .icon:not(.mini)').css('fill','#00abdf');
            $('.checkout_form .delivery_methods .shipment .part.full input[name="delivery_parts_full"]').removeAttr('disabled');
            $('.checkout_form .delivery_methods .shipment .part.part_1 input[name="delivery_parts_part_1"]').attr('disabled','disabled');
			$('.checkout_form .delivery_methods .shipment .part.part_2 input[name="delivery_parts_part_2"]').attr('disabled','disabled');
        }

        $('.checkout_form input[name="cart_need_parts"]').val(cart_need_parts);
        $('.checkout_form input[name="cart_no_volume"]').val(cart_no_volume);
	}


	// Контакты - Выбор типа клиента
	$('.checkout_form .block .methods input[name="person"]').change(function() {
		let payment_label  = $('.checkout_form .block .methods label[for="payment_1"]');
		let payment_parent = payment_label.closest('.line');

		if ($(this).val() == 'Компания') {
			payment_parent.show();
		} else {
			payment_parent.hide();
		}
	});


	// Callback - Получение текущей стоимости заказа
	miniShop2.Callbacks.add('Order.getcost.before', 'order_getcost_before', function() {
    	$('#msCart, #msOrder, .checkout_total').addClass('load');
	});
	
	miniShop2.Callbacks.add('Order.getcost.response.success', 'order_getcost_success', function(response) {
		// Проверяем нет ли элементов в состоянии загрузки
		if (!$('#msCart, #msOrder').find('.load').length) {
			$('#msCart, #msOrder, .checkout_total').removeClass('load');
		}
		$(miniShop2.Order.orderCost).text(miniShop2.Utils.formatPrice(response.data['cost']));
		if (response['data']['delivery']) deliveryDynamic(response['data']['delivery']);
	});

	miniShop2.Callbacks.add('Order.getcost.response.error', 'order_getcost_error', function(response) {
		// Проверяем нет ли элементов в состоянии загрузки
		if (!$('#msCart, #msOrder').find('.load').length) {
			$('#msCart, #msOrder, .checkout_total').removeClass('load');
		}
		miniShop2.Message.error('Произошла ошибка при обновлении данных');
	});

	// Callback - Добавление поля в заказ (имя, email, адрес и т.д.)
	miniShop2.Callbacks.add('Order.add.before', 'order_add_before', function() {
    	$('#msCart, #msOrder, .checkout_total').addClass('load');
	});

	miniShop2.Callbacks.add('Order.add.response.error', 'order_add_error', function(response) {
		// Проверяем нет ли элементов в состоянии загрузки
		if (!$('#msCart, #msOrder').find('.load').length) {
			$('#msCart, #msOrder, .checkout_total').removeClass('load');
		}
	});

	miniShop2.Callbacks.add('Order.add.response.success', 'order_add_response_success', function(response) {
    	// Переключаем способ оплаты на №3 при выборе клиента "Частное лицо"
    	if($('input[name="payment"]:checked').val() == '1' && response['data']['person'] == 'Частное лицо') {
    		let payment_label = $('.checkout_form .block .methods label[for="payment_3"]');

    		payment_label.click();
    	}
    	
    	// Заказ - Чекбокс отгрузить частями
    	if (typeof(response['data']['delivery_need_parts']) != "undefined") { 
    		msMiniCartDynamic.changeDynamic();

    	// Доставка - Выбор пункта самовывоза
    	} else if (typeof(response['data']['delivery_pickup_address']) != "undefined") { 
    		miniShop2.Order.getcost();

    	// Доставка - Выбор способа доставки
    	} else if (typeof(response['data']['delivery']) != "undefined") { 

    	// В остальных случаях
    	} else {
    		// Проверяем нет ли элементов в состоянии загрузки
			if (!$('#msCart, #msOrder').find('.load').length) {
    			$('#msCart, #msOrder, .checkout_total').removeClass('load');
    		}
    	}
	});


	// Callback - Отправка заказа на обработку
	miniShop2.Callbacks.add('Order.submit.before', 'order_submit_before', function() {
    	$('#msCart, #msOrder, .checkout_total').addClass('load');
	});

	miniShop2.Callbacks.add('Order.submit.response.error', 'order_submit_error', function(response) {
		$('#msCart, #msOrder, .checkout_total').removeClass('load');

		if($('#msOrder input, #msOrder select').hasClass('error')){
			$('html,body').animate({scrollTop: $('#msOrder input.error, #msOrder select.error').closest('.block').offset().top - $('.header_wrap .fixed').innerHeight()}, 500);
		}
	});

	miniShop2.Callbacks.add('Order.submit.response.success', 'order_submit_success', function() {
		document.cookie = "site_cart_widget=; path=/; max-age=-1";
	});

});//<< function