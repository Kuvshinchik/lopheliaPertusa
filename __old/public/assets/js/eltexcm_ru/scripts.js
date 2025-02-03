// Фото 360 - глобальная переменная
var Magic360Options = {}
Magic360Options = {
    onready: function () {
        $('.product_info .images .big .slider').trigger('refresh.owl.carousel')
    }
}


// Function
$(() => {
	// Открываем модалку по якорю в URL
	if (window.location.hash) {

		let replaceHash = [];

		replaceHash['#GetPrice'] 		= '#get_price_modal';
		replaceHash['#Loadcart'] 		= '#get_price_product_modal';
		replaceHash['#Loadcart-Today'] 	= '#get_price_product_modal';
		replaceHash['#Loadtest'] 		= '#test_product_modal';
		replaceHash['#CourseOrder'] 	= '#course_order_modal';

		let modal = replaceHash[window.location.hash] ? replaceHash[window.location.hash] : window.location.hash;

		if ($(modal+'.modal').length) {
			$.fancybox.open({src: modal});
		}
	}

	// Снег на НГ
	new Snow ({
		iconColor: '#bde0ea',
		iconSize: 10,
		countSnowflake: 70,
		clearSnowBalls: 15000
	});


	// Добавляем класс активному городу
	let city = $('header .location .link span').text();
	$('#location_modal .list .city[data-city="'+city+'"], #contacts_location_modal .list .city[data-city="'+city+'"]').addClass('active');


	// Ставим метку на карте
	contactsMaps($('#page_contacts-map').data('coords'));


	// Кнопка Telegram
	if ($('#msMiniCart #cart_widget').hasClass('hide') || $('#msMiniCart #cart_widget').hasClass('fullhide') || !$('#msMiniCart').hasClass('full')) {
		$('.b24-telegram-bot').addClass('down')
	} else {
		$('.b24-telegram-bot').removeClass('down')
	}


	// Если нет пользовательских фото в карточке товара
	if (!$('.product_info_v2_1 .images .files_user').length) {
		$('.product_info_v2_1 .data').addClass('no_padding')
	}


	// Список городов - клик по городу
	firstClickTooltip = false;
	$('#location_modal .list .city, #contacts_location_modal .list .city').click(function(){
		let city 		= $(this).text(),
			phone 		= $(this).data('phone'),
			email 		= $(this).data('email'),
			coords 		= $(this).data('coords'),
			id 			= $(this).data('id'),
			phoneLink 	= phone.replace(/[^\d+]/g, '');

		// Делаем активным текущий город
		$('#location_modal .list .city, #contacts_location_modal .list .city, .contacts_info .data .info .page_contacts-address').removeClass('active');
		$('#location_modal .list .city[data-city="'+city+'"], #contacts_location_modal .list .city[data-city="'+city+'"]').addClass('active');
		$('.contacts_info .data .info .page_contacts-address[data-id="'+id+'"]').addClass('active');

		// Прописываем текст
		$('header .location .link').attr('data-id', id);
		$('header .location .link > span, .contacts_info .data .city span').text(city);
		$('header .contacts .phone, .mob_header .phone a').text(phone).attr('href','tel:'+phoneLink);
		$('header .contacts .email > span').text(email);
		$('header .contacts .email').attr('data-clipboard-text', email);
		if (city == 'Москва') {
			$('footer .contacts .phone a.city').addClass('hidden')
		} else {
			$('footer .contacts .phone a.city').removeClass('hidden').text(phone).attr('href','tel:'+phoneLink);
		}

		// Показываем подсказку
		if (id == 'other') {
			$('header .location .link.tooltip .text').addClass('active');
			firstClickTooltip = true;
		}

		// Ставим метку на карте
		contactsMaps($(this).data('coords'));

		// Сохранение куки
		document.cookie = "site_city-city="+city+"; path=/; max-age=31536000";
		document.cookie = "site_city-phone="+phone+"; path=/; max-age=31536000";
		document.cookie = "site_city-phoneLink="+phoneLink+"; path=/; max-age=31536000";
		document.cookie = "site_city-email="+email+"; path=/; max-age=31536000";
		document.cookie = "site_city-id="+id+"; path=/; max-age=31536000";
		document.cookie = "site_city-coords="+coords+"; path=/; max-age=31536000";

		//Закрываем всплывашку
		$('.mini_modal, .mini_modal_link').removeClass('active')
		if ($(window).width() > 1023) {
			$('.overlay').fadeOut(200)
		}
		if (is_touch_device()) {
			$('body').css('cursor', 'default')
		}
	});


	// Меняем менеджера в виджете
	$('body').on('click', '#manager_list_modal .item', function(){
		let photo 		= $(this).data('photo'),
			tooltip 	= $(this).find('.data-tooltip .text').html(),
			name 		= $(this).data('name'),
			office		= $(this).data('office'),
			phone 		= $(this).data('phone'),
			tel 		= $(this).data('tel'),
			email 		= $(this).data('email'),
			whatsapp 	= $(this).data('whatsapp'),
			telegram 	= $(this).data('telegram');

		// Делаем активным текущего менеджера
		$('#manager_list_modal .item').removeClass('active');
		$('#manager_list_modal .item[data-name="'+name+'"]').addClass('active');

		// Прописываем текст
		$('.manager_widget .photo img').attr('src', photo);
		$('.manager_widget .photo .text').html(tooltip);
		$('.manager_widget .name').text(name).attr('title', name + ' ('+office+')');
		$('.manager_widget .phone a').text(phone).attr('href', 'tel:' + tel);
		$('.manager_widget .email a').text(email).attr('href', 'mailto:' + email);

		if (!whatsapp) {
			$('.manager_widget .whatsapp').addClass('hidden');
		} else {
			$('.manager_widget .whatsapp').removeClass('hidden');
		}

		$('.manager_widget .whatsapp').attr('href', whatsapp);
		
		if (!telegram) {
			$('.manager_widget .telegram').addClass('hidden');
		} else {
			$('.manager_widget .telegram').removeClass('hidden');
		}

		$('.manager_widget .telegram').attr('href', telegram);

		//Закрываем всплывашку
		$('.mini_modal, .mini_modal_link').removeClass('active')
	});


	$('.tooltip-click-fixed').click(function(){
		let text = $(this).find('.text');

		if (!text.hasClass('active')) {
			text.addClass('active');
			firstClickTooltip = true;
		} else {
			text.removeClass('active')
		}
	})


	// Оборачиваем таблицу в div
	if ($('.text_block table').length) {
		$('.text_block table').each(function(){
			if (!$(this).parent().hasClass('table_wrap')) {
				$(this).wrap('<div class="table_wrap"></div>');
			}
		})
	}


	// Скрываем подсказку при клике
	$(document).click(function (e) {
		if (!firstClickTooltip) {
			$('.tooltip .text').removeClass('active');
		}

		firstClickTooltip = false
	})


	// Основной слайдер на главной
	if ($('.main_slider .slider').length) {
		if ($('.main_slider .slider').data('autoplayspeed')) {
			var mainSilderAutoplay = true,
	        	mainSilderAutoplayTimeout = parseFloat($('.main_slider .slider').data('autoplayspeed'));
	    } else {
	        var mainSilderAutoplay = false,
	        	mainSilderAutoplayTimeout = 0;
	    }
		$('.main_slider .slider').owlCarousel({
			items: 1,
			margin: 0,
			nav: true,
			dots: false,
			loop: mainSilderAutoplay,
			touchDrag: mainSilderAutoplay,
   			mouseDrag: mainSilderAutoplay,
			smartSpeed: 750,
			autoplay: mainSilderAutoplay,
			autoplayTimeout: mainSilderAutoplayTimeout,
			autoplayHoverPause: false,
			autoHeight: true
		})

		$('.main_slider .slider').on('click', function(e) {
		    $('.main_slider .slider').trigger('stop.owl.autoplay');
		})
	}

	// Статьи на главной
	$('body').on('click', '.troubleshooting .knowledge_base .links a', function(e){
		e.preventDefault();

		var grandparent = $(this).closest('.troubleshooting .cont'),
			href		= $(this).attr('href');

		grandparent.addClass('load');

		$.get(href, function(data) {
			var html = $(data).find('.troubleshooting .cont').html();
			grandparent.html(html).removeClass('load');
		})
		.fail(function() {
		    grandparent.removeClass('load');
		    miniShop2.Message.show('Произошла ошибка при обновлении статей', {
	            theme: 'ms2-message-error',
	            sticky: false
	        });
		})
	})


	// Тема сайта - клик по ползунку
	$('header .theme').click(function() {
		if (!$('html').hasClass('theme-black')) {
			var site_theme = 'theme-black';
			$('html').addClass(site_theme);
			document.cookie = "site_theme="+site_theme+"; path=/; max-age=31536000";
		} else {
			$('html').removeClass('theme-black');
			document.cookie = "site_theme=; path=/; max-age=-1";
		}
	});


	//Меню
	$('button[data-modal-id="#catalog_modal"]').click(function() {
		if ($(window).width() > 1023) {
			$('#catalog_modal').height($(window).height() - $('header').height());
		}
	});
	

	if ($(window).width() < 1024) {
		$('header .menu .item > a.sub_link').click(function (e) {
			if (!$(this).hasClass('active'))
			{
				e.preventDefault();
				$(this).next().slideDown(300, function(){
					$(this).prev().addClass('active')
				})
			} else {
				if (e.target.className == 'arr') {
					e.preventDefault()
					$(this).next().slideUp(300, function(){
						$(this).prev().removeClass('active')
					})
				}
			}
		})
	}


	// Моб. меню
	$('.mob_header .mob_menu_link').click(function (e) {
		let catalog_link  = $('header .catalog .link[data-modal-id="#catalog_modal"]'),
			catalog_modal = $('#catalog_modal');

		if (!catalog_link.hasClass('active'))
		{
			setTimeout(function(){
				catalog_link.addClass('active');
				catalog_modal.addClass('active').css('height', 'auto');
			}, 100)
		}
	})


	// Скрыть/Показать блок
	$('.scroll_link.slide').click(function() {
		let href = $(this).data('anchor')
		$(href).slideToggle();
	});


	// Товары
	if ($('.products_block .slider').length) {
		var main_products_width_full = $('.content_flex .content.main_products_width_full').length;
		$('.products_block .slider').owlCarousel({
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 1,
					margin: 10
				},
				480: {
					items: 2,
					margin: 20
				},
				768: {
					items: 3,
					margin: 20
				},
				1023: {
					items: main_products_width_full ? 4 : 3,
					margin: 20
				},
				1280: {
					items: main_products_width_full ? 5 : 4,
					margin: 28
				}
			},
			onInitialized: event => {
				setTimeout(() => {
					productHeight($(event.target), $(event.target).find('.slide').length * 2)
				}, 100)
			},
			onResized: event => {
				setTimeout(() => {
					productHeight($(event.target), $(event.target).find('.slide').length * 2)
				}, 100)
			}
		})
	}


	// Товары
	if ($('.case_equipment .slider').length) {
		$('.case_equipment .slider').owlCarousel({
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 2,
					margin: 10
				},
				0: {
					items: 2,
					margin: 20
				},
				768: {
					items: 3,
					margin: 20
				},
				1024: {
					items: 4,
					margin: 20
				},
				1280: {
					items: 5,
					margin: 28
				}
			},
			onInitialized: event => {
				setTimeout(() => {
					productHeight($(event.target), $(event.target).find('.slide').length)
				}, 100)
			},
			onResized: event => {
				setTimeout(() => {
					productHeight($(event.target), $(event.target).find('.slide').length)
				}, 100)
			}
		})
	}


	// Товар - активная вкладка
	if (!$('.product_tabs .tabs button.active').length) {
		let id = $('.product_tabs .tabs div:first button').addClass('active').data('content');
		$(id).addClass('active');
	}


	// Товар - добавление в корзину
	$('.product_info .info .buy_info .buy_link').click(function(e) {
		e.preventDefault();

		let form = $(this).closest('.ms2_form');
		let input_key = form.find('input[name="key"]');
		let input_submit = form.find('.submit');
		
		$('.product_info .info .buy_info').addClass('load');

		input_key.removeAttr('disabled', 'disabled');
		input_submit.val('cart/add');
		form.submit();
	});

	$('.product_info_v2_1 .info .buy_info .buy_link').click(function(e) {
		if ($(this).hasClass('hidden'))
		{
			window.location = $(this).data('link')
			return false;
		}
	})

	// Товар - уменьшение товара в корзине
	$('body').on('click', '.product_info .amount .minus', function(e) {
		e.preventDefault();

		let form 			= $(this).closest('.ms2_form'),
			formData 		= form.serializeArray(),
			input_key 		= form.find('input[name="key"]'),
			input_submit 	= form.find('.submit'),
			parent   		= $(this).closest('.amount'),
			input    		= parent.find('.input'),
			inputVal		= parseFloat(input.val()),
			minimum  		= parseFloat(input.data('minimum'));
		
		$('.product_info .info .buy_info').addClass('load');

		// Удаляем товар из корзины
		if (inputVal == minimum) {

        	// Отключаем редирект и выводим сообщение
        	miniShop2.Cart.callbacks.remove.response.success = function (response) {
        		$('.product_info .info .buy_info .buy_link').removeClass('hidden');
				parent.removeClass('show');
				productWarranty('remove');
				input.val(1);
				form.find('input[name="key"').val('');

				$('.ms2_total_count_units').text(units(response.data.total_count, ['позиция', 'позиции', 'позиций']));

				// minishop2 - default.js
				var $miniCart = $(miniShop2.Cart.miniCart);
                if (response.data.total_count == 0 && $miniCart.hasClass(miniShop2.Cart.miniCartNotEmptyClass)) {
                    $miniCart.removeClass(miniShop2.Cart.miniCartNotEmptyClass);
                }
				$(miniShop2.Cart.totalCount).text(response.data.total_count);
                $(miniShop2.Cart.totalCost).text(miniShop2.Utils.formatPrice(response.data.total_cost));

                // msminicartdynamic.js
                msMiniCartDynamic.changeDynamic();
        	};

            // Удаляем товар из корзины
	        let action = 'cart/remove';
	        formData.push({name: miniShop2.actionName, value: action});
	        miniShop2.sendData = {
	            form: form,
	            action: action,
	            formData: formData
	        };
	        miniShop2.send(miniShop2.sendData.formData, miniShop2.Cart.callbacks.remove, miniShop2.Callbacks.Cart.remove);

		}else{
			// Меняем кол-во товара
			input_key.removeAttr('disabled');
			input_submit.val('cart/change');
			form.submit();
		}
			
	});


	// Товар - добавление товара в корзину
	$('body').on('click', '.product_info .amount .plus', function(e) {
		e.preventDefault();
		
		let form 			= $(this).closest('.ms2_form');
		let input_key 		= form.find('input[name="key"]');
		let input_submit 	= form.find('.submit');

		$('.product_info .info .buy_info').addClass('load');

		input_key.removeAttr('disabled');
		input_submit.val('cart/change');
		form.submit();
	});


	// Товар - выбор гарантии
	$('body').on('change', '#add_garanti_modal .list input[name="warranty"]', function() {
		productWarranty('set');
	});


	$('body').on('submit', '.ms2_form', function() {
		$(this).find('button.to_cart').attr('disabled', 'disabled')
	})


	// Товар - добавление гарантии в корзину
	$('body').on('click', '#add_garanti_modal .send_link', function() {
		$('.product_info .info .buy_info').addClass('load');
		productWarranty('add');
	});

	if (typeof miniShop2 !== 'undefined') {
		// Callback - добавление товара в корзину
		miniShop2.Callbacks.add('Cart.add.before', 'carts_add_before', function() {
		    $('#msMiniCart').addClass('load');
		});

		miniShop2.Callbacks.add('Cart.add.response.success','carts_add_response_success', function(response) {
			$('.product_info .info .buy_info .buy_links .ms2_form input[name=key]').val(response.data.key);
			$('.product_info .info .buy_info').removeClass('load');
			$('.ms2_total_count_units').text(units(response.data.total_count, ['позиция', 'позиции', 'позиций']));
			$('button.to_cart[data-id="'+response.data.id+'"]').addClass('active').removeAttr('disabled').attr('value', 'cart/remove').closest('.ms2_form').find('input[name="key"]').val(response.data.key);
			$('.prod_services .product_v2 .cart .buy_link[disabled]').removeAttr('disabled').addClass('active')
			msMiniCartDynamic.changeDynamic();
		});

		miniShop2.Callbacks.add('Cart.add.response.error','carts_add_response_error', function(response) {
			location.reload();
		});


		// Callback - удаление товара из корзины
		miniShop2.Callbacks.add('Cart.remove.before', 'carts_widget_remove_before', function() {
		    $('#msMiniCart, #msCart, #msOrder, .checkout_total').addClass('load');
		});

		miniShop2.Callbacks.add('Cart.remove.response.success','carts_widget_remove_response_success', function(response) {
			$('.product_info .info .buy_info').removeClass('load');
			$('.ms2_total_count_units').text(units(response.data.total_count, ['позиция', 'позиции', 'позиций']));
			$('button.to_cart[data-id="'+response.data.id+'"]').removeClass('active').removeAttr('disabled').attr('value', 'cart/add');

			// minishop2 - default.js
			var $miniCart = $(miniShop2.Cart.miniCart);
	        if (response.data.total_count == 0 && $miniCart.hasClass(miniShop2.Cart.miniCartNotEmptyClass)) {
	            $miniCart.removeClass(miniShop2.Cart.miniCartNotEmptyClass);
	        }
			$(miniShop2.Cart.totalCount).text(response.data.total_count);
	        $(miniShop2.Cart.totalCost).text(miniShop2.Utils.formatPrice(response.data.total_cost));
	                
			msMiniCartDynamic.changeDynamic();

			if (!response.data.total_count) document.cookie = "site_cart_widget=; path=/; max-age=-1";

			// Перезагружаем страницу если находимся в корзине
			if (window.location.pathname == '/specifikaciya.html' && response.data.total_count == 0) location.reload();
		});

		miniShop2.Callbacks.add('Cart.remove.response.error','carts_widget_remove_response_error', function(response) {
			location.reload();
		});


		// Callback - изменение количества товара в корзине
		miniShop2.Callbacks.add('Cart.change.before', 'carts_widget_change_before', function() {
		    $('#msMiniCart, #msCart, #msOrder, .checkout_total').addClass('load');
		});

		miniShop2.Callbacks.add('Cart.change.response.success','carts_widget_change_response_success', function(response) {
			$('.product_info .info .buy_info').removeClass('load');
			$('.ms2_total_count_units').text(units(response.data.total_count, ['позиция', 'позиции', 'позиций']));
			$('button.to_cart[data-id="'+response.data.id+'"]').addClass('active').removeAttr('disabled').attr('value', 'cart/remove').closest('.ms2_form').find('input[name="key"]').val(response.data.key);
			msMiniCartDynamic.changeDynamic();

			if (!response.data.total_count) document.cookie = "site_cart_widget=; path=/; max-age=-1";
		});

		miniShop2.Callbacks.add('Cart.change.response.error','carts_widget_change_response_error', function(response) {
			location.reload();
		});
	}

	// >> Изменение количества товара во всплывашке
	$('body').on('click', '.modal .amount .minus', function(e) {
		let modal    = $(this).closest('.modal');
		let parent   = $(this).closest('.amount')
		let input    = parent.find('.input')
		let inputVal = parseFloat(input.val())

		if( $(this).hasClass('update_price') ){
	    	modal.find('.form input[name=product_count]').val(inputVal);
	    }
	});

	$('body').on('click', '.modal .amount .plus', function(e) {
		let modal    = $(this).closest('.modal');
		let parent   = $(this).closest('.amount')
		let input    = parent.find('.input')
		let inputVal = parseFloat(input.val())

		if( $(this).hasClass('update_price') ){
	    	modal.find('.form input[name=product_count]').val(inputVal);
	    }
	});

	$('body').on('keydown', '.modal .amount .input', function() {
		let _self = $(this);
		let modal = $(this).closest('.modal');
		
		setTimeout(function(){
		    if( _self.hasClass('update_price') ){
		    	modal.find('.form input[name=product_count]').val(parseFloat(_self.val()));
		    }
		}, 20)
	})


	// Изменение количества товара во всплывашке
	$('body').on('click', '#cart_widget .amount .minus, #cart_widget .amount .plus', function(e) {
		let parent = $(this).closest('.amount')
		let input  = parent.find('.input')
	    input.closest(miniShop2.form).submit();
	});
    

    // Разрешает ввод только цифры
    $('body').on( 'keypress', '.amount .input', function(b){
        let C = /[0-9\x25\x24\x23\x13]/;
        let a = b.which;
        let c = String.fromCharCode(a);
        if (a == 13) {$(this).blur();return false;}
        return !!(a==0||a==8||a==9||a==13||c.match(C));
    });


    // Возвращает предыдущее значение если в поле пусто
    $('body').on('focus', '.amount .input', function(){
        let _self = $(this)
        _self.attr('data-value', parseInt(_self.val()))
    });

    $('body').on('blur', '.amount .input', function(){
        let _self = $(this)

        setTimeout(function(){
			if(_self.val() == ''){
				_self.val( parseInt(_self.data('value')))
			}
			_self.removeAttr('data-value');
		}, 10)
    });


    // Товар - Услуги - Аккордеон
    $('.prod_services .item .head').click(function (e) {
		e.preventDefault()

		$(this).toggleClass('active').next().slideToggle(300)
	})


	// Проверка существует ли услуга
	$('.prod_services .product_v2 .cart .options .item').each(function(){
		let id  = $(this).data('id')

		if (!$('.prod_services .product .options .option .buy_link[data-id="'+id+'"]').length) {
			$(this).addClass('disabled')
		}
	})

	$('.prod_services .product_v2').each(function(){
		if (!$(this).find('.cart .options .item:not(.disabled)').length) {
			$(this).addClass('hidden')
		}
	})
		

    // Товар - Услуги - Выбор услуги
    $('.prod_services .product_v2 .cart .options .item:not(.disabled)').click(function(){
    	// Если кнопка уже активна
    	if ($(this).hasClass('active'))
    	{
    		$(this).removeClass('active')

    		return false
    	}

    	let id  = $(this).data('id'),
    		btn = $(this).closest('.cart').find('.buy_link')

    	// Проверка существует ли услуга
		if (!$('.prod_services .product .options .option .buy_link[data-id="'+id+'"]').length) {

			$(this).addClass('disabled')

			miniShop2.Message.error('Услуга не предоставляется для данного товара')

			return false
		}

    	// Проверка есть ли услуга в корзине
    	if ($('.prod_services .product .options .option .buy_link[data-id="'+id+'"]').hasClass('active'))
    	{
    		btn.addClass('active')
    	}
    	else
    	{
    		btn.removeClass('active')
    	}

    	//  Делаем кнопку активной
    	$(this).parent().find('.item').removeClass('active')
		$(this).addClass('active')
    })


	// Товар - Услуги - Добавление услуги в корзину
	$('.prod_services .product_v2 .cart .buy_link').click(function(){
		let id = $(this).parent().find('.options .item.active').data('id')

		// Проверяем выбрана ли услуга
		if (typeof id === 'undefined') {
			let items = $(this).parent().find('.options .item')

			items.stop().animate({opacity: 0}, 200, "linear", function(){
				items.stop().animate({opacity: 1}, 200)
			})

			miniShop2.Message.error('Выберите период')

			return false
		}
		

		// Проверяем не добавлена ли услуга в корзину
		if ($(this).hasClass('active')) {
			window.location = '/specifikaciya.html'

			return false
		}

		// Кликаем по кнопки самой услуги тем самым добавив её в корзину
		$(this).attr('disabled', 'disabled')
		$('.prod_services .product .options .option .buy_link[data-id="'+id+'"]').click()
	})


    // Кейсы
	if ($('.main_cases .slider').length) {
		$('.main_cases .slider').owlCarousel({
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 1,
					margin: 20
				},
				768: {
					items: 2,
					margin: 20
				},
				1024: {
					items: 3,
					margin: 20
				},
				1280: {
					items: 4,
					margin: 28
				}
			},
			onInitialized: event => {
				setTimeout(() => {
					productHeight($(event.target), $(event.target).find('.slide').length, '.case')
				}, 100)
			},
			onResized: event => {
				setTimeout(() => {
					productHeight($(event.target), $(event.target).find('.slide').length, '.case')
				}, 100)
			}
		})
	}


	// Видео
	if ($('.videos .slider').length) {
		$('.videos .slider').owlCarousel({
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 1,
					margin: 20
				},
				768: {
					items: 2,
					margin: 20
				},
				1280: {
					items: 3,
					margin: 28
				}
			},
			onTranslate: function (event) {
				$('.youtube_include').find('.icon').show()
				$('.youtube_include').attr('data-loaded', 'false')
				$('.youtube_include').find('iframe').remove()
				$('video').trigger('pause')
			}
		})
	}


	// Каталог товаров
	$('.catalog_info a.sub_link').click(function (e) {
		if (!$(this).hasClass('active')) {
			e.preventDefault()
			$(this).next().slideDown(300, function(){
				$(this).prev().addClass('active')
			})
		} else {
			if (e.target.className == 'arrow') {
				e.preventDefault()
				$(this).next().slideUp(300, function(){
					$(this).prev().removeClass('active')
				})
			}
		}
	})


	// Фильтр
	$('body').on('click', 'aside .mob_filter_link', function (e) {
		e.preventDefault()

		if ($(this).hasClass('active')) {
			$(this).removeClass('active').next().slideUp(300)
		} else {
			$(this).addClass('active').next().slideDown(300)
		}
	})


	// Свернуть фильтр
	$('body').on('click', 'aside .filter .item .name', function (e) {
		e.preventDefault()

		$(this).toggleClass('active')
		$(this).next().slideToggle(300)
	})


	// Свернуть меню в товаре
	$('aside .products_list .item .cat.level2').click(function(e) {
		e.preventDefault();

		let parent = $(this)

		if (!parent.hasClass('active')) {
			parent.next().slideDown(300, function(){
				parent.addClass('active')
			})
		} else {
			parent.next().slideUp(300, function(){
				parent.removeClass('active')
			})
		}
	})


	// Товар
	if ($('.product_info .images .big .slider').length) {
		$('.product_info .images .big .slider').owlCarousel({
			items: 1,
			margin: 20,
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			mouseDrag: false,
			touchDrag: true,
			pullDrag: false,
			freeDrag: false,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			autoHeight: true,
			nav: true,
			onTranslate: function (event) {
				const parent = $(event.target).closest('.images')
				const button = parent.find('.thumbs .slide button:eq(' + event.item.index + ')')
				const photo360 = parent.find('button.view360')

				parent.find('.thumbs .slide button').removeClass('active')

				if (!button.hasClass('btn_add-photo')) {
					button.addClass('active')
				}
				
				if (button.hasClass('isuser') || button.hasClass('isvideo')) {
					photo360.addClass('hidden')
				}
				else {
					photo360.removeClass('hidden')
				}

				$('.youtube_include').find('.icon').show()
				$('.youtube_include').attr('data-loaded', 'false')
				$('.youtube_include').find('iframe').remove()
				$('video').trigger('pause')
			}
		})
	}

	$('.product_info .images .thumbs .slide button, .product_info .images .view360').click(function (e) {
		e.preventDefault()

		const parent = $(this).closest('.images')

		parent.find('.big .slider').trigger('to.owl', $(this).data('slide-index'))
	})


	// Превью товара
	if ($('.product_info .images .thumbs .slider').length) {
		$('.product_info .images .thumbs .slider').owlCarousel({
			items: 1,
			margin: 0,
			nav: true,
			dots: false,
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			autoplay: false,
			autoHeight: true
		})
	}


	// Страница товара v2.1
	if ($('.product_info_v2_1 .images').length) {
		const productThumbs = new Swiper('.product_info_v2_1 .images .thumbs .swiper', {
			loop: false,
			speed: 500,
			watchSlidesProgress: true,
			slideActiveClass: 'active',
			slideVisibleClass: 'visible',
			slidesPerView: 'auto',
			navigation: {
				nextEl: '.product_info_v2_1 .images .thumbs .swiper-button-next',
				prevEl: '.product_info_v2_1 .images .thumbs .swiper-button-prev'
			},
			preloadImages: false,
			lazy: {
				enabled: true,
				checkInView: true,
				loadOnTransitionStart: true,
				loadPrevNext: true
			},
			direction: 'vertical',
			spaceBetween: 5,
			breakpoints: {
				0: {
					spaceBetween: 15,
					direction: 'horizontal'
				},
				480: {
					spaceBetween: 5,
					direction: 'vertical'
				}
			}
		})

		const productSlider = new Swiper('.product_info_v2_1 .images .big .swiper', {
			loop: false,
			speed: 500,
			autoHeight: true,
			watchSlidesProgress: true,
			slideActiveClass: 'active',
			slideVisibleClass: 'visible',
			spaceBetween: 24,
			slidesPerView: 1,
			navigation: {
				nextEl: '.product_info_v2_1 .images .big .swiper-button-next',
				prevEl: '.product_info_v2_1 .images .big .swiper-button-prev'
			},
			preloadImages: false,
			lazy: {
				enabled: true,
				checkInView: true,
				loadOnTransitionStart: true,
				loadPrevNext: true
			},
			thumbs: {
				swiper: productThumbs,
				autoScrollOffset: 1
			},
			on: {
				slideChange: swiper => {
					const parent = $('.product_info_v2_1 .images').closest('.images')
					const button = parent.find('.thumbs .slide button:eq(' + swiper.activeIndex + ')')
					const photo360 = parent.find('button.view360')
					
					if (button.hasClass('isvideo')) {
						photo360.addClass('hidden')
					}
					else {
						photo360.removeClass('hidden')
					}

					if ($(swiper.slides[swiper.activeIndex]).find('#photo360').length) {
						swiper.allowTouchMove = false

						$('#photo360').click(function(){
							setTimeout(function(){
								swiper.updateAutoHeight()
							}, 500)
						})
					} else {
						swiper.allowTouchMove = true
					}

					$('.youtube_include').find('.icon').show()
					$('.youtube_include').attr('data-loaded', 'false')
					$('.youtube_include').find('iframe').remove()
					$('video').trigger('pause')
				}
			}
		})


		$('.product_info .images .view360').click(function (e) {
			productSlider.slideTo($(this).data('slide-index'))
		})


		const productUserPhoto = new Swiper('.product_info_v2_1 .images .files_user .swiper', {
			loop: false,
			speed: 500,
			watchSlidesProgress: true,
			slideActiveClass: 'active',
			slideVisibleClass: 'visible',
			slidesPerView: 'auto',
			navigation: {
				nextEl: '.product_info_v2_1 .images .files_user .swiper-button-next',
				prevEl: '.product_info_v2_1 .images .files_user .swiper-button-prev'
			},
			preloadImages: false,
			lazy: {
				enabled: true,
				checkInView: true,
				loadOnTransitionStart: true,
				loadPrevNext: true
			},
			direction: 'horizontal',
			spaceBetween: 15
		})
	}


	// Товар - Аналогичные устройства
	$('.product_info .info .similar_link').click(function (e) {
		e.preventDefault()

		if ($(this).hasClass('active')) {
			$(this).removeClass('active')
			$('.product_info .similar_products').removeClass('show')
		} else {
			$(this).addClass('active')
			$('.product_info .similar_products').addClass('show')
		}
	})


	// Товар - добавление в корзину
	$('.product_info .info .buy_info .buy_link').click(function (e) {
		e.preventDefault()

		$(this).addClass('hidden')
		$('.product_info .info .buy_info .amount').addClass('show')
	})


	// Копирование кода
	const clipboard = new ClipboardJS('.copy_link')

	clipboard.on('success', (e) => {
		$(e.trigger).addClass('copied')

		setTimeout(() => {
			$(e.trigger).removeClass('copied')
		}, 2000)

		e.clearSelection()
	})


	// Форма во всплывашке
	$('body').on('click', '.form .type label', function (e) {
		let typeInfo = $(this).data('content')
		let parent = $(this).closest('.form')

		parent.find('.for_type').hide()
		parent.find('.for_type .input').attr('disabled','disabled')
		parent.find(typeInfo).fadeIn(300)
		parent.find(typeInfo+' .input').removeAttr('disabled')
	})


	// Фиксация label в поле
	$('.form .input, .form textarea').each(function(){
		if($(this).val().length) $(this).addClass('active');
	})


	// Поле ввода с подсказкой
	$('.form .with_tip .input').focus(function(e) {
		let parent = $(this).closest('.with_tip')
		parent.addClass('open')
	});

	$('.form .with_tip .input').blur(function(e) {
		let parent = $(this).closest('.with_tip')
		parent.removeClass('open')
	});


	// Удаляем error у checkbox | radio
	$('body').on('change', 'input:radio.error', function() {
		let name = $(this).attr('name');
		$('input:radio[name="'+name+'"].error').removeClass('error');
	});

	$('body').on('change', 'input:checkbox.error', function() {
		let name = $(this).attr('name');
		$('input:checkbox[name="'+name+'"].error').removeClass('error');
	});


	// Смена типа лица в форме
	$('body').on('change', '.form input[name="preson"]:checked', function(e) {
		let parent   = $(this).closest('.form')

		if ($(this).val() == 'Частное лицо'){
			parent.find('input[name="company]').val('Частное лицо');
		}
	})


	// Обновление цены товара во всплывашке
	if (typeof miniShop2 !== 'undefined') {
		updateProductPrice($('.modal .product .amount'));
	}


	// Вызов модалки "Формирование счета" - Подстановка данных
	$('body').on('click', '.modal_link.include_data', function(){
		if ($($(this).data('content')).find('form input[name="product_pagetitle"]').val() != $(this).data('pagetitle')) {
			let image 		= $(this).data('image'),
				pagetitle	= $(this).data('pagetitle'),
				desc 		= $(this).data('desc'),
				price 		= $(this).data('price'),
				bitrix24_id = $(this).data('bitrix24_id'),
				id 		    = $(this).data('id'),
				update_price = $(this).data('update_price'),
				modal 	    = $(this).data('content');

			$(modal).find('.product .thumb img').addClass('loaded').attr('data-src', image).attr('src', image).attr('data-loaded', 'true');
			$(modal).find('.product .name').text(pagetitle);
			$(modal).find('.product .desc').text(desc);
			$(modal).find('.product .amount .vals .price').data('price', price);

			$(modal).find('form input[name="product_bitrix24_id"]').val(bitrix24_id);
			$(modal).find('form input[name="product_price"]').val(price);
			$(modal).find('form input[name="product_pagetitle"]').val(pagetitle);
			$(modal).find('form input[name="product_id"]').val(id);

			$(modal).find('.product .amount .box .input, form input[name="product_count"]').val(1);
			if(update_price == 1) updateProductPrice($(modal).find('.product .amount'));
		}
	})


	// Вызов модалки "До заполнение анкеты" - Подстановка данных
	$('body').on('submit', '.get_price_list_2 .form, .page_about_v2 .get_price_list form .submit_btn', function(){
		let phone = $(this).find('input[name="phone"]').val();
		$('#get_price_list_2_update_modal .form input[name="phone"]').val(phone);
	})


	// Оформление заказа
	$('.checkout_form .block .methods label').click(function () {
		let methodInfo = $(this).data('content')
		let parent = $(this).closest('.block')

		parent.find('.method_info').hide()
		parent.find(methodInfo).fadeIn(300)
	})


	// Залипание блока
	if ($('.sticky').length) {
		$('.sticky').stick_in_parent({
			offset_top: 100
		})
	}


	// Виджет корзины
	$('#cart_widget .bottom .cart .toggle_btn').click(function (e) {
		e.preventDefault()

		let parent = $(this).closest('#cart_widget')

		if ($(this).hasClass('active')) {
			$(this).removeClass('active')
			parent.removeClass('show')
			parent.find('.cart_info').slideUp(300)
		} else {
			$(this).addClass('active')
			parent.addClass('show')
			parent.find('.cart_info').slideDown(300)
		}
	})

	// Скрытие таблицы виджета
	$('#cart_widget .data .close').click(function (e) {
		e.preventDefault()

		$('#cart_widget .bottom .cart .toggle_btn').removeClass('active')
		$('#cart_widget').removeClass('show')
		$('#cart_widget .cart_info').slideUp(300)
	})

	// Скрытие всего виджета
	$('#cart_widget .bottom .close').click(function (e) {
		e.preventDefault()

		$('#cart_widget').removeClass('show')
		$('.b24-telegram-bot').addClass('down')
		$('.b24-widget-button-wrapper').removeClass('up')
		$('#cart_widget').slideUp(300, function(){
			$('#cart_widget').addClass('fullhide')
		})

		document.cookie = "site_cart_widget=fullhide; path=/; max-age=31536000";
	})


	// Полный прайс лист
	$('.get_price_list .mob_form_btn').click(function (e) {
		e.preventDefault()

		if ($(this).hasClass('active')) {
			$(this).removeClass('active').next().slideUp(300)
		} else {
			$(this).addClass('active').next().slideDown(300)
		}
	})


	// Наши обучающие программы
	$('.service_training .programs .program .check label').click(function () {
		$(this).closest('.program').toggleClass('checked')
	})


	// Сдать оборудование в ремонт
	$('.service_repair .btns button.add_line').click(function (e) {
		e.preventDefault()

		let html = '<tr>' + $('.repair_order .template').html() + '</tr>',
			trLength = $('.service_repair table tbody tr').size(),
			newCheck = 'replacement_check' + (trLength + 1),
			newName  = 'equipment[' + (trLength) + ']'

		$('.service_repair table tbody').append(html)
		$('.service_repair .btns button.remove_line').addClass('show')

		$('.service_repair table tbody tr:last').find('td input').each(function(i, el){
			var oldName = $(el).attr('name')
			$(el).attr('name', oldName.replace('equipment[0]', newName)).removeAttr('disabled')
		})

		$('.service_repair table tbody tr:last').find('td.replacement input[type="checkbox"]').attr('id', newCheck)
		$('.service_repair table tbody tr:last').find('td.replacement label').attr('for', newCheck)
	})

	$('.service_repair .btns button.remove_line').click(function (e) {
		e.preventDefault()

		$('.service_repair table tbody tr:last').remove()

		let trLength = $('.service_repair table tbody tr').size()

		if (trLength < 2) {
			$('.service_repair .btns button.remove_line').removeClass('show')
		}
	})


	// Сервис
	if ($(window).width() < 1024) {
		$('aside .page_links .title').click(function (e) {
			e.preventDefault()

			if ($(this).hasClass('active')) {
				$(this).removeClass('active').next().slideUp(300)
			} else {
				$(this).addClass('active').next().slideDown(300)
			}
		})
	}


	// Календарь
	if ($('.date_input').length) {
		$('.date_input').datepicker({
			autoClose: true,
			minDate: new Date(),
			onSelect(formattedDate, date, inst) {
				inst.$el.addClass('active').change()
			}
		})
	}


	// Фото 360
	$('.product_info .images .thumbs button, .product_info .images .view360').click(function(e) {
		if ($('#photo360').hasClass('m360-spin-x')) {
			Magic360.spin('photo360')	
		}
	});


	// Сравнение товаров
	if ($('.compare_info .swiper-container').length) {
		var compare_slide = new Swiper('.compare_info .swiper-container', {
			loop: false,
			speed: 500,
			spaceBetween: 0,
			watchSlidesVisibility: true,
			slideActiveClass: 'active',
			slideVisibleClass: 'visible',
			scrollbar: {
				el: '.swiper-scrollbar',
				hide: false,
				draggable: true,
			},
			breakpoints: {
				0: {
					slidesPerView: 2
				},
				480: {
					slidesPerView: 2
				},
				1024: {
					slidesPerView: 3
				},
				1280: {
					slidesPerView: 4
				}
			},
			on: {
				init: swiper => {
					setTimeout(() => {
						productHeight($(swiper.$el), $(swiper.$el).find('.slide').length)

						compareHeight()
					})
				},
				resize: swiper => {
					setTimeout(() => {
						productHeight($(swiper.$el), $(swiper.$el).find('.slide').length)

						compareHeight()
					})
				},
				update: swiper => {
					setTimeout(() => {
						productHeight($(swiper.$el), $(swiper.$el).find('.slide').length)

						compareHeight()

						$(swiper.$el).find('.swiper-slide').each(function(index, el) {
							$(el).find('.del_btn').attr('data-idx', index)
						});
					})
				}
			}
		})
	}

	$('.compare_info .more_features_btn').click(function (e) {
		e.preventDefault()

		if ($(this).hasClass('active')) {
			$('.compare_info .more_features_btn').removeClass('active')

			$('.compare_info .compare_features .list > *.hide').hide()
			$('.compare_info .product_features .list > *.hide').hide()
		} else {
			$('.compare_info .more_features_btn').addClass('active')

			$('.compare_info .compare_features .list > *.hide').fadeIn(300)
			$('.compare_info .product_features .list > *.hide').fadeIn(300)
		}
	})


	$('.compare_info .compare_features .list > *, .compare_info .product_features .list > *').mouseleave(function () {
		$('.compare_info .compare_features .list > *').removeClass('hover')
		$('.compare_info .product_features .list > *').removeClass('hover')
	})

	$('.compare_info .compare_features .list > *, .compare_info .product_features .list > *').mouseover(function () {
		let featureIndex = $(this).index()

		$('.compare_info .compare_features .list > *:eq(' + featureIndex + ')').addClass('hover')
		$('.compare_info .product_features .list').each(function () {
			$(this).find(' > *:eq(' + featureIndex + ')').addClass('hover')
		})
	})


	// Удаление товара из списка сравнения
	$('body').on('click', '.compare_info .products .product .del_btn', function(e) {
		e.preventDefault();

		let slide 			= $(this).closest('.slide'),
			list 			= $(this).data('list'),
			id 				= $(this).data('id'),
			idx 			= $(this).data('idx'),
			action  		= 'remove',
			loading 		= 'load',
			error_update 	= 'Произошла ошибка при обновлении';

		let thisAction = function() {

			slide.addClass(loading);

			$.ajax({
				type: 'POST',
				url: document.location.href, 
				data: {cmp_action: action, list: list, resource: id},
				cache: false,
				dataType: 'json',
				success: function(response) {
					slide.removeClass(loading);

					if (response.success) {
						if (response.data['lists'][list] > 1) {
							compare_slide.removeSlide(idx);
							compare_slide.update();
							$('header .compare_link a .count').text(response.data['total_products'])
							window.history.pushState('', '', response.data['link'])
						} else {
							location.reload();
						}
					}
					else {
						if (typeof miniShop2 != 'undefined') {miniShop2.Message.error(error_update);}
						else {alert(error_update);}
					}
				},
	            error: function() {
	            	slide.removeClass(loading);
	            	if (typeof miniShop2 != 'undefined') {miniShop2.Message.error(error_update);}
					else {alert(error_update);}
	            }
			});
	    }

	    stuffHelper(this, 'Удалить?', thisAction);
	});


	// Удаление списка сравнения
	$('body').on('click', '.compare_info .data .lists .del_btn', function(e) {
		e.preventDefault()

		let $this 			= $(this),
			block 			= '.compare_info .data',
			list 			= $(this).data('list'),
			action  		= 'remove_list',
			loading 		= 'load',
			error_update 	= 'Произошла ошибка при обновлении';

		let thisAction = function() {

			$(block).addClass(loading)

			$.ajax({
				type: 'POST',
				url: document.location.href, 
				data: {cmp_action: action, list: list},
				cache: false,
				dataType: 'json',
				success: function(response) {
					$(block).removeClass(loading)

					if (response.data.lists[list] == 0) {
						$('header .compare_link a .count').text(response.data['total_products'])
						if ($this.prev().hasClass('active')) {
							window.location = response.data.link
						} else {
							$this.parent().remove()
						}
					}
					else {
						if (typeof miniShop2 != 'undefined') {miniShop2.Message.error(error_update)}
						else {alert(error_update)}
					}
				},
	            error: function() {
	            	$(block).removeClass('load')
	            	if (typeof miniShop2 != 'undefined') {miniShop2.Message.error(error_update)}
					else {alert(error_update)}
	            }
			});
	    }

	    stuffHelper(this, 'Удалить?', thisAction)
	});


	// Фильтр параметров в сравнении
	$('.compare_info .filter input[name="compare_filter"]').change(function(e) {

		let url = new URL(document.location)

		if ($(this).prop('checked')) {
			if ($(this).val() == 'unique') {
				$('.compare_info .compare_features .list > *:not(.differ)').addClass('hidden')
				$('.compare_info .product_features .list > *:not(.differ)').addClass('hidden')

				$('.compare_info .compare_features .list > .differ').addClass('active')
				$('.compare_info .product_features .list > .differ').addClass('active')

				if (url.searchParams.get('cmp_filter')) {
					url.searchParams.set('cmp_filter', 'unique')
				} else {
					url.searchParams.append('cmp_filter', 'unique')
				}
				
			} else {
				$('.compare_info .compare_features .list > *').removeClass('hidden')
				$('.compare_info .product_features .list > *').removeClass('hidden')

				$('.compare_info .compare_features .list > .differ').removeClass('active')
				$('.compare_info .product_features .list > .differ').removeClass('active')

				if (url.searchParams.get('cmp_filter')) {
					url.searchParams.set('cmp_filter', 'all')
				} else {
					url.searchParams.append('cmp_filter', 'all')
				}
			}

			window.history.replaceState('', '', url)
			compare_slide.update()
			compareBackground()
		}
	});

	$('.compare_info .filter input[name="compare_filter"]').change();


	// Сравнение товаров - изображения товара
	if ($('.compare_info .img .slider').length) {
		$('.compare_info .img .slider').owlCarousel({
			items: 1,
			margin: 20,
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			mouseDrag: false,
			touchDrag: false,
			pullDrag: false,
			freeDrag: false,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			nav: true,
			onInitialized: function (event) {
				setTimeout(function () {
					setHeight($(event.target).find('.slide'))
				}, 100)
			},
			onResized: function (event) {
				$(event.target).find('.slide').height('auto')

				setTimeout(function () {
					setHeight($(event.target).find('.slide'))
				}, 100)
			},
			onTranslate: (event) => {
				const parent = $(event.target).closest('.images')

				parent.find('.thumbs button').removeClass('active')
				parent.find('.thumbs button:eq(' + event.item.index + ')').addClass('active')
			}
		})
	}




	// Удаление товара из истории просмотра
	$('body').on('click', '.view_history table td.action .delete, .view_history table th .clear_history', function(e){
		e.preventDefault();

		let id 				= $(this).data('id'),
			url 			= document.location.origin + document.location.pathname,
			block 			= '.view_history .list',
			error_update 	= 'Произошла ошибка при обновлении';

		let thisAction = function() {
			$(block).addClass('load');
			
			$.ajax({
	            type: 'POST',
	            url: url,
	            data: {looked_remove : true, looked_id: id},
	            cache: false,
	            success: function(data) {
	                if (data) {
	                	let visited_html 		= $(data).find('header .visited').html();
	                	let visited_mob_html 	= $(data).find('.mob_header .visited').html();
	                    let view_history_html 	= $(data).find('.view_history > .cont > .data').html();

	                    $('header .visited').html(visited_html);
	                    $('.mob_header .visited').html(visited_mob_html);
	                    $('.view_history > .cont > .data').html(view_history_html);
	                    observer.observe();
	                } else {
						if (typeof miniShop2 != 'undefined') {miniShop2.Message.error(error_update);}
						else {alert(error_update);}
					}
				},
	            error: function() {
	            	$(block).removeClass('load');
	            	if (typeof miniShop2 != 'undefined') {miniShop2.Message.error(error_update);}
					else {alert(error_update);}
	            }
	        });
	    }

	    stuffHelper(this, 'Удалить?', thisAction);
	})

	
	// Скрываем кнопку битрикс24
	window.setTimeoutB24 = null;
	$(window).scroll({passive: true }, function(){
		if ($(window).width() < 1565) {
			$('.b24-widget-button-wrapper, .b24-telegram-bot').addClass('hide');

			if(setTimeoutB24)	{
				clearTimeout(setTimeoutB24);
			}

			setTimeoutB24 = window.setTimeout(function()	{
				$('.b24-widget-button-wrapper, .b24-telegram-bot').removeClass('hide');
				if ($('#msMiniCart #cart_widget').hasClass('hide') || $('#msMiniCart #cart_widget').hasClass('fullhide') || !$('#msMiniCart').hasClass('full')) {
					$('.b24-telegram-bot').addClass('down')
					$('.b24-widget-button-wrapper').removeClass('up')
				} else {
					$('.b24-telegram-bot').removeClass('down')
					$('.b24-widget-button-wrapper').addClass('up')
				}
			}, 1500);
		}
	});

	
	// Воспроизведение видео в модалке
	$('.fancy_video').fancybox({
		// thumbs : {
  		// 	autoStart : true
  		// },
		youtube : {
	        controls : 1,
	        showinfo : 0
	    },
	    beforeShow : function() {
		    $('.youtube_include').find('.icon').show()
			$('.youtube_include').attr('data-loaded', 'false')
			$('.youtube_include').find('iframe').remove()
			$('video').trigger('pause')
		}
	})


	// iframe в модалке
	$('.fancy_iframe').fancybox({
		type   :'iframe',
		width  : '100%',
	    height : '100%',
	    beforeShow : function() {
		    $('.youtube_include').find('.icon').show()
			$('.youtube_include').attr('data-loaded', 'false')
			$('.youtube_include').find('iframe').remove()
			$('video').trigger('pause')
		}
	})


	// Вставка и воспроизведение видео в блоке
	$('body').on('click', '.youtube_include', function(){
		if (!$(this).data('loaded')) {

			$('.youtube_include').find('.icon').show()
			$('.youtube_include').attr('data-loaded', 'false')
			$('.youtube_include').find('iframe').remove()
			$('video').trigger('pause')

			let link = $(this).data('link');

			$(this).attr('data-loaded', 'true');
			$(this).find('.icon').hide();

			$(this).append('<iframe src="'+link+'?autoplay=1&controls=1&showinfo=0&enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" ></iframe>');
		}
	});


	// Запоминаем вид категории
	// $('.category_info .head .view a').click(function(event) {
	// 	document.cookie = "site_category_view="+$(this).data('tpl')+"; path=/; max-age=31536000";
	// });


	// Скрыть/показать корзину
	$('body').on('click', '#cart_widget .data_wrap .toggle', function(){
		let parent = $(this).closest('#cart_widget');

		if (!parent.hasClass('hide')) {
			parent.addClass('hide');
			$('.b24-telegram-bot').addClass('down')
			$('.b24-widget-button-wrapper').removeClass('up')
			document.cookie = "site_cart_widget=hide; path=/; max-age=31536000";
		} else {
			parent.removeClass('hide');
			$('.b24-telegram-bot').removeClass('down')
			$('.b24-widget-button-wrapper').addClass('up')
			document.cookie = "site_cart_widget=; path=/; max-age=-1";
		}
	});


	// База знаний
	$('aside .page_cats .title .icon_menu').click(function (e) {
		if ($(window).width() < 1024) {
			e.preventDefault();
			if ($(this).hasClass('active')) {
				$(this).removeClass('active').closest('.title').next().slideUp(300)
			} else {
				$(this).addClass('active').closest('.title').next().slideDown(300)
			}
		}
	})


	// Карусель в тексте
	if ($('.carousel .slider').length) {
		$('.carousel .slider').owlCarousel({
			loop: false,
			smartSpeed: 500,
			fluidSpeed: 100,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 2,
					margin: 20
				},
				768: {
					items: 3,
					margin: 20
				},
				1024: {
					items: 4,
					margin: 20
				},
				1280: {
					items: 5,
					margin: 28
				}
			}
		})
	}


	// Каталог - Категория - Зум превью
	if ($(".zoom_prev").length)	{
		$(".zoom_prev").each(function() {
		  	$(this).mouseover( function(event) { 
      			$('.zoomContainer').remove();
			    $(this).elevateZoom({
					scrollZoom : true,
					zoomLevel: 1.9
				});
		  	});
		});
	}


	// Хлебные крошки
	if ($(window).width() < 767) {
		$('.breadcrumbs .with_dropdown > a').click(function(e) {
			if (!$(this).hasClass('active')) {
				e.preventDefault();
				$('.breadcrumbs .with_dropdown > a').removeClass('active');
				$(this).addClass('active');
			}
		});
	}

	$(document).click((e) => {
		if ($(e.target).closest('.breadcrumbs .with_dropdown').length === 0) {
			$('.breadcrumbs .with_dropdown > a').removeClass('active');
		}
	})


	// Универсальная AJAX загрузка контента
	$('body').on('click', '.ajax_link', function(e) {
		e.preventDefault();

		if (!$(this).hasClass('ajax_loading') && !$(this).hasClass('ajax_loaded')) {

			let wrapper_class = $(this).data('include'),
				href		  = $(this).data('link'),
				class_add 	  = $(this).data('class-add'),
				class_remove  = $(this).data('class-remove'),
				$this 		  = $(this);

			// Устанавливаем/сбрасываем классы загрузки
			$('.ajax_link').addClass('ajax_loading').removeClass('active').removeClass('ajax_loaded');
			$(wrapper_class).addClass('ajax_loading').removeAttr('style');

			// Восстанавливаем ссылки у всех кнопок
			$('.ajax_link').each(function(index, elem) {$(elem).attr('href', href);});

			// AJAX
			$.post(href, {ajax_link: "1"}, function(response) {
				// Получаем HTML
				let include 	= $(response).find(wrapper_class).html(),
					title   	= $(response).filter('title').text(),
					breadcrumbs = $(response).find('.breadcrumbs').html();

				// Вставляем HTML
				$(wrapper_class).html(include).removeClass('ajax_loading');
				$('title').text(title);
				$('.breadcrumbs').html(breadcrumbs);

				// Инициализируем пагинацию pdoPade
				if (typeof(pdoPage) != "undefined") {
					let pdoPage_initialize = $(response).filter('script[data-id="pdoPage_initialize"]').text();
					pdoPage_initialize = pdoPage_initialize.match(/pdoPage.initialize\((.*?)\);/);
					pdoPage_initialize = JSON.parse(pdoPage_initialize[1]);
					pdoPage.configs.page.hash = pdoPage_initialize['hash'];
					pdoPage.configs.page.pageId = pdoPage_initialize['pageId'];
					pdoPage.keys.page = 1;
				}

				// Скрыть / отобразить кнопку "Показать ещё"
				if ($('#pdopage').length && !$('#pdopage .pagination a.active').next('a').length) {
					$('#pdopage .load_more:not(.mode_button)').hide();
				} else {
					$('#pdopage .load_more:not(.mode_button)').show();
				}

				// Меняем класс обёртки
				if (class_add) $(wrapper_class).addClass(class_add);
				if (class_remove) $(wrapper_class).removeClass(class_remove);

				// Атрибуты загрузки
				$('.ajax_link').removeClass('ajax_loading');
				$this.addClass('active').addClass('ajax_loaded').removeAttr('href');

				observer.observe();
			 	window.history.pushState({page: href}, '', href);
			})

			.fail(function() {
			    $(wrapper_class).removeClass('ajax_loading');
			    $('.ajax_link').removeClass('ajax_loading');

			    miniShop2.Message.show('Произошла ошибка попробуйте ещё раз', {
		            theme: 'ms2-message-error',
		            sticky: false
		        });
			})
		}
	})


	// Прикрепление файлов к форме
	$('input[type="file"]').change(function(){attachFormFile(this);});


	// Ссылка на каталог в подвале
	$('footer .menu .catalog_link').click(function (e) {
		e.preventDefault();
		
		if ($(window).width() > 1023) {
			$('header .catalog .link').click();
			firstClick = true;

			window.scrollTo({top: $('header .catalog .link').offset().top, behavior: 'smooth'})
		}
		else {
			$('.mob_header .mob_menu_link').click();
		}
	});


	// Анимация чисел
	if ($('.countUp').length) {
		window.addEventListener('scroll', showVisibleCountUp);
    	showVisibleCountUp();
	}


	// Отключение jgrown
	if(typeof(AjaxForm) != 'undefined') AjaxForm.Message.success = function() {};


	// Спойлер
	$('.spoler_title').click(function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).next().slideToggle();
	});


	// Всплывашка с политикой использования куков
	$('body').on('click', '#policyBlockForFirstVisit .policyBlockForFirstVisitClose', function(e){
		e.preventDefault();
		document.cookie = "site_policyBlockForFirstVisit=1; path=/; max-age=31536000";
		$('#policyBlockForFirstVisit').fadeOut(200);
	});

	if ($('#policyBlockForFirstVisit').length) {
		setTimeout(function(){
			document.cookie = "site_policyBlockForFirstVisit=1; path=/; max-age=31536000";
			$('#policyBlockForFirstVisit').fadeOut(200);
		},15000)
	}


	// YouTube + Chat на главной
	if ($('.main_slider .slide.youtube_chat').length) {
		$(".main_slider .slide.youtube_chat .video").on("load", () => {
		    let iframeHead = $(".main_slider .slide.youtube_chat .video").contents().find("head")[0];
		    let iframeCSS = "<style>.ytp-offline-slate-background{background-size: contain;background-repeat: no-repeat;background-position: center;background-color: #fff;}</style>";
		    $(iframeHead).append(iframeCSS);
		});
	}


	// Одновременное использование стандартной пагинации и подгрузки кнопкой 
	$(document).on('click', '#pdopage .load_more:not(.mode_button)', function() {
	    $('#pdopage .pagination .next_load_more').click();
	});


	// Скрыть / отобразить кнопку "Показать ещё"
	if ($('#pdopage').length && !$('#pdopage .pagination a.active').next('a').length) {
		$('#pdopage .load_more:not(.mode_button)').hide();
	} else {
		$('#pdopage .load_more:not(.mode_button)').show();
	}


	// Кнопка "Больше данных" в модалке
	$('.modal .form .adding_data_desc .btn').click(function(e){
		e.preventDefault();

		let parent = $(this).closest('form');

		if (!parent.find('.adding_data_desc').hasClass('active')) {
			parent.find('.adding_data_desc').addClass('active');
			parent.find('.adding_data_block').slideDown();
		} else {
			parent.find('.adding_data_desc').removeClass('active');
			parent.find('.adding_data_block').slideUp();
		}
	})


	// Раскрыть/скрыть старые файлы в товаре
	$('.prod_files .list .btn_old_files').click(function(e){
		e.preventDefault();

		if (!$(this).hasClass('active')) {
			$(this).addClass('active')
			$(this).next().stop().slideDown()
		} else {
			$(this).removeClass('active')
			$(this).next().stop().slideUp()
		}
	})


	// Полоса баннер над шапкой
	$('.site_header_banner .closed').click(function(e) {
        e.preventDefault();
        document.cookie = "site_header_banner_2=hidden; path=/; max-age=259200";
        $('.site_header_banner').fadeOut(200, function() { $(this).addClass('hidden') });
    });


    // Функция шаринга
	$('.share_widget .navigator').click(function(){
		navigator.share({
	        title: $(this).data('title'), // Заголовок
	        url: $(this).data('url') // Ссылка
	    });
	})


})// end function


$(window).load(() => {
	// Шапка
	// Fix. header
	headerInit = true,
	windowOffsetTop = window.pageYOffset

	$('header').wrap('<div class="header_wrap" style="height: ' + $('header').innerHeight() + 'px; margin-bottom: '+ $('header').css('margin-bottom')+'"></div>');
	
	if ($(window).width() < 1024) {
	    $('.header_wrap').height('auto').css('margin-bottom',0)
    }

	if ($(window).width() > 1023 && $(window).scrollTop() > $('.header_wrap').innerHeight()) {
		$('header').addClass('fixed')
	}else{
		$('header').removeClass('fixed')
	}

	// Выравнивание элементов
	$('.products .flex').each(function () {
		productHeight($(this), parseInt($(this).css('--products_count')))
	})

	//setHeight($('aside .cats').add('.main_slider .slide'))
})



$(window).scroll(() => {
	if ($('.compare_info .product_features').length)
	{
		let top_offset = 0;
		if ($(window).width() > 1023) {top_offset = 65}
		let compare_name_pos = $(window).scrollTop() - $('.compare_info .product_features').offset().top + top_offset;
	  	$('.compare_info .product_features .name.is_stuck').css({
	    	top: compare_name_pos + 'px'
	  	});
	}

	// Шапка
	if ($(window).width() > 1023 && $(window).scrollTop() > $('.header_wrap').innerHeight() ) {
		$('header').addClass('fixed')
	} else {
		$('header').removeClass('fixed')
	}

	if ($(window).width() > 1023) {

		// Fix. header menu
		// typeof headerInit !== 'undefined' && headerInit && window.scrollY > $('.header_wrap').innerHeight() && windowOffsetTop > window.pageYOffset
		// 	? $('header.fixed .bottom .menu, .products table thead').addClass('show')
		// 	: $('header.fixed .bottom .menu, .products table thead').removeClass('show')

		windowOffsetTop = window.pageYOffset

		$('#catalog_modal.active').focus().height($(window).height() - $('header').height());
	}
})



$(window).resize(() => {
	// Шапка
	if( $(window).width() < 1024 ) {
		$('header').removeClass('fixed')
		$('.header_wrap').height('auto').css('margin-bottom',0)
	}

	// Выравнивание элементов
	$('.products .flex').each(function () {
		productHeight($(this), parseInt($(this).css('--products_count')))
	})
})


// Выравнивание решений
function productHeight(context, step, wrap = '.product_wrap') {
	let start = 0
	let finish = step
	let products = context.find(wrap)

	products.height('auto').find('.name, .desc').height('auto')

	for (let i = 0; i < products.length; i++) {
		setHeight(products.slice(start, finish).find('.name'))
		setHeight(products.slice(start, finish).find('.desc'))
		setHeight(products.slice(start, finish))

		start = start + step
		finish = finish + step
	}
}


// Выравнивание в сравнении товаров
function compareHeight() {
	$('.compare_info .compare_features .list > *').height('auto')
	$('.compare_info .product_features .list > *').height('auto')

	let productFeatures = $('.compare_info .product_features .list'),
		compareFeatures = $('.compare_info .compare_features .list'),
		sizes = new Object()

	productFeatures.each(function () {
		$(this).find('> *').each(function () {
			if (sizes[$(this).index()]) {
				if ($(this).outerHeight() > sizes[$(this).index()]) {
					sizes[$(this).index()] = $(this).outerHeight()
				}
			} else {
				sizes[$(this).index()] = $(this).outerHeight()
			}
		})
	})

	compareFeatures.each(function () {
		$(this).find('> *').each(function () {
			if (sizes[$(this).index()]) {
				if ($(this).outerHeight() > sizes[$(this).index()]) {
					sizes[$(this).index()] = $(this).outerHeight()
				}
			} else {
				sizes[$(this).index()] = $(this).outerHeight()
			}
		})
	})

	$.each(sizes, (key, data) => {
		productFeatures.each(function () {
			$(this).find('> *:eq(' + key + ')').innerHeight(data)
		})

		$('.compare_info .compare_features .list > *:eq(' + key + ')').innerHeight(data)
	})

	$('.compare_info .swiper-scrollbar').css('top', $('.compare_info .products .product').outerHeight())
}


// Окрашивание пунктов в сравнении товаров
function compareBackground() {
	let idx = 1;

	$('.compare_info .compare_features .list > *').each(function(index, elem)
	{
		$(elem).css('background', '#fff');

		if ($(elem).hasClass('category_name')) 
		{
			idx = 1;
		}

		if (!$(elem).hasClass('category_name') && !$(elem).hasClass('hidden'))
		{
			if ((idx % 2) === 1)
			{
				$(elem).css('background', '#ebfaff');
			}

			idx++;
		}
	})

	idx = 1;
	$('.compare_info .product_features .list > *').each(function(index, elem)
	{
		$(elem).css('background', '#fff');

		if ($(elem).hasClass('category_name')) 
		{
			idx = 1;
		}

		if (!$(elem).hasClass('category_name') && !$(elem).hasClass('hidden'))
		{
			if ((idx % 2) === 1)
			{
				$(elem).css('background', '#ebfaff');
			}

			idx++;
		}
	})
}


// Сортировка - select
$(document).on('change', '.sort select', function() {
	let selected = $(this).find('option:selected');
	let sort = selected.data('sort');
	sort += mse2Config.method_delimeter + selected.data('value');
	mse2Config.sort = sort;
	mSearch2.submit();
});


// Сортировка - таблица
$(document).on('click', '.products table th[data-sort]', function() {
	let field = $(this).data('sort');
	let dir = $(this).data('dir');
	let sort = field + mse2Config.method_delimeter + dir;
	mse2Config.sort = sort;
	mSearch2.submit();
});


// AjaxForm
$(document).on('af_complete', function(event, response) {
    let form = response.form,
    	form_id = form.attr('id');

    if (response['success'] == true) {
    	$.fancybox.close();
	    if(form.find('input[name=person]').length){form.find('.for_type').show();}
	    form.find('input, textarea').removeClass('active');

    	// Обущающие программы
    	if (form_id == 'page.service_page.training.form') {
    		$(form).find('.programs .program').removeClass('checked');
    	}

    	// Онлайн стенды
    	if (form_id == 'page.online_stand.form') {
    		$(form).find('.online_stand .data .checks input[type=checkbox]').removeClass('checked');
    	}

    	// Всплывающая форма "До заполнение анкеты"
	    if (form_id == 'site.form.get_price.2.form' || form_id == 'page.about.v2.form.get_price.form') {
	    	$.fancybox.open({src:'#get_price_list_2_update_modal'});
	    }

	    // Всплывающее сообщение об успешной отправке формы
	    else {
	        $('#success_modal .modal_title').html(response['message']);
	    	$.fancybox.open({src:'#success_modal'});
	    }

	    // Вызов виджета обратного звонка
	    $('#itlcb-call-btn').click();
    }

    if (response['success'] == false) {
    	// Обущающие программы
    	if (form_id == 'page.service_page.training.form' && response.data['programs']) {
    		$(form).find('input[name="programs[]"]').addClass('error');
    	}

    	// Онлайн стенды
    	if (form_id == 'page.online_stand.form' && response.data['stands']) {
    		$(form).find('input[name="stands[]"]').addClass('error');
    	}

    	// Сдать в ремонт
    	if (form_id == 'page.service_page.repair.form' && response.data['equipment']) {
    		try {
		        let fields = JSON.parse(response.data['equipment']);
		        for(key in fields) {
		        	for (name in fields[key]) {
  						$(form).find('input[name="equipment['+key+']['+name+']"]').addClass('error');
					}
				}
		    } catch (e) {
		        $(form).find('input.equipment').addClass('error');
		    }
    	}

    	// Скролл до элемента с ошибкой
    	if ($(form).find('input.error:not([type="hidden"]):first').length){
			window.scrollTo({top: ($(form).find('input.error:not([type="hidden"]):first').offset().top - $('.header_wrap .fixed').innerHeight() - 70), behavior: 'smooth'})
		}
    }
});


// mFilter2
$(document).on('mse2_load', function(e, data) {
	//Загрузка изображений
	observer.observe()

   	// Выравнивание элементов в сетке
	$('.products .flex').each(function() {
		productHeight($(this), parseInt($(this).css('--products_count')))
	})

	// Каталог - Категория - Зум превью
	if ($(".zoom_prev").length)	{
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
});


// pdoPage
$(document).on('pdopage_load', function(e, config, response) {
    // Загрузка изображений
	observer.observe()

	// Воспроизведение видео в модалке
	$('.fancy_video').fancybox({
		youtube : {
	        controls : 1,
	        showinfo : 0
	    }
	})

	// Скрыть / отобразить кнопку "Показать ещё"
	if (response.page >= response.pages) {
		$('#pdopage .load_more:not(.mode_button)').hide();
	} else {
		$('#pdopage .load_more:not(.mode_button)').show();
	}
});


// Гарантия товара
function productWarranty(type = '') {
	let warranty 			= $('#add_garanti_modal .list input:checked');
	let price    			= warranty.data('price');
	let price_format        = warranty.data('priceformat');
	let period   			= warranty.data('period');
	let name	   			= warranty.data('name');
	let title_short   	    = warranty.data('title_short');

	let add_link			= $('.product_info .info .buy_info .add_link span');
	let price_block    	    = $('.product_info .info .price_block .garanti_price');
	let warranty_block 	    = $('.product_info .info .buy_info .garanti .val span');

	let form 				= $('.product_info .info .buy_info .ms2_form');
	let formData 			= form.serializeArray();
	let warranty_options 	= form.find('input[name="options[warranty][name]"]');
	let input_submit 		= form.find('.submit');
	let input_key			= form.find('input[name="key"]');


	//Изменяем html
	if (name == 'standart' || type == 'remove') {
		//.product_info
		add_link.html(add_link.data('text-default'));
		price_block.html('');
		warranty_block.html('');
		warranty_options.val('').attr('disabled','disabled');
		//.modal
		$('.modal .product .garanti .name').text('');
		$('.modal .product .garanti').removeClass('show');
		$('.modal .form input[name=warranty]').val('standart');
		$('#add_garanti_modal .list input[data-name="standart"]').prop('checked',true);
		$('.modal .product .amount .vals .price').data('warrantyprice', 0);
		updateProductPrice($('.modal .product .amount'));

	} else {
		//.product_info
		add_link.html(add_link.data('text-change'));
		price_block.html('+ '+ price_format + ' <small>руб</small>');
		warranty_block.html(' + '+ period + ' мес.');
		warranty_options.val(name).removeAttr('disabled');
		//.modal
		$('.modal .product .garanti .name').text(title_short);
		$('.modal .product .garanti').addClass('show');
		$('.modal .form input[name=warranty]').val(name);
		$('.modal .product .amount .vals .price').data('warrantyprice', price);
		updateProductPrice($('.modal .product .amount'));
	}


	// Если просто кликнули по гарантии
	if (type == 'set' || type == 'remove') return false;

	// Если товар в корзине
	if (input_key.val()) {

		// Отключаем показ сообщений
		window.defaultSuccessMessage = miniShop2.Message.success;
        miniShop2.Message.success = function(){};
        
        // Отключаем редирект
        window.defaultRemoveCallback = miniShop2.Cart.callbacks.remove.response.success;
        miniShop2.Cart.callbacks.remove.response.success = function () {
            
	        window.defaultAddCartCallback = miniShop2.Cart.callbacks.add.response.success;
            miniShop2.Cart.callbacks.add.response.success = function (response) {
            	// Возварщаем стандартные функции
            	miniShop2.Cart.callbacks.add.response.success = window.defaultAddCartCallback;
            	miniShop2.Message.success = window.defaultSuccessMessage;
            	miniShop2.Cart.callbacks.remove.response.success = window.defaultRemoveCallback;
            	miniShop2.Cart.status(response.data);

            	// Показываем своё сообщение
            	miniShop2.Message.show('Гарантия успешно изменена', {
	                theme: 'ms2-message-success',
	                sticky: false
	            });
            };

            // Добавляем в корзину товар с указанной гарантией
            let action = 'cart/add';
            formData.push({name: miniShop2.actionName, value: action});
            miniShop2.sendData = {
                form: form,
                action: action,
                formData: formData
            };
            miniShop2.send(miniShop2.sendData.formData, miniShop2.Cart.callbacks.add, miniShop2.Callbacks.Cart.add);
        };

        // Удаляем товар из корзины 
        let action = 'cart/remove';
        formData.push({name: miniShop2.actionName, value: action});
        miniShop2.sendData = {
            form: form,
            action: action,
            formData: formData
        };

        // - Нужно чтобы не удалялся преждевременно класс load 
        window.defaultAddCallbackCart = miniShop2.Callbacks.Cart.remove.response.success;
        miniShop2.Callbacks.Cart.remove.response.success = function(response){
        	miniShop2.Callbacks.Cart.remove.response.success = window.defaultAddCallbackCart;
        };
        // - end
        
        miniShop2.send(miniShop2.sendData.formData, miniShop2.Cart.callbacks.remove, miniShop2.Callbacks.Cart.remove);
     
    //Если товара не было в корзине
    } else {
		$('.product_info .info .buy_info .buy_link').addClass('hidden');
		$('.product_info .info .buy_info .amount').addClass('show');
    	input_submit.val('cart/add');
    	form.submit();
    	if (name != 'standart') {
	    	miniShop2.Message.show('Гарантия успешно изменена', {
	            theme: 'ms2-message-success',
	            sticky: false
	        });
	    }
    }
	
} // end productWarranty()


// Склонение слов
// units(number, ['найдена', 'найдено', 'найдены'], 'выводить number', 'текст при number = 0');
function units(number, words, show_number = false, show_zero = false) { 
	if (!number && show_zero) return show_zero;

	let str_number = number;

	if (number.toString().indexOf('-') != -1) {
		number = number.split(' - ');
		number = number[1];
	}

    cases = [2, 0, 1, 1, 1, 2]; 
    return (show_number ? str_number + ' ' : '') + words[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
}


// Карта в контактах
function contactsMaps(coords) {

	if($('#page_contacts-map').length) {
		if(typeof(contactsMap) != "undefined"){
            contactsMap.destroy();
            contactsMap = null;
        }

		ymaps.ready(initMap);
	}
	
	function initMap() {
		let mark = coords.split(',');
		contactsMap = new ymaps.Map('page_contacts-map', {
			center: [mark[0], mark[1]],
			zoom: 17,
			controls: ["zoomControl"]
		});

		let myPlacemark = new ymaps.Placemark([mark[0], mark[1]], {
			iconContent: 'Элтекс Коммуникации'
		}, {
			preset: 'islands#blueStretchyIcon'
		});

		contactsMap.geoObjects.add(myPlacemark);
	}

}


// Закрываем слайдер-капчу при клике за её пределами
$(document).click(function (e) {
	if (!firstClick && $(e.target).closest('#slidercaptcha').length == 0) {
		$('#slidercaptcha').fadeOut(200);
	}
})


// Добавление файла в форму
function attachFormFile(elem) {
	let e 			= $(elem)[0],
		parent  	= $(elem).closest('.files'),
		files_list 	= parent.find('.files_list'),
		errors 		= parent.find('.error_file');

	// Если не выбрали файл и нажали отмену, то ничего не делать
	if (!e.files.length) {return;}

	// Создаем новый массив с нашими файлами
	let files = Object.keys(e.files).map((i) => e.files[i]);

	// Добавляем файлы в список и выводим в блок со списком
	$.map(files, function(file, index){
		files_list.append(
			'<div class="file">' +
				'<span>' + file.name + '</span>' +
				'<input type="file" class="hidden" name="file[]">' +
				'<span class="remove" title="Удалить файл"></span>' +
			'</div>');

		let new_file = new DataTransfer();
		new_file.items.add(file);
		let add_new_file = new_file.files;
		files_list.find('.file:last input[type="file"]')[0].files = add_new_file;
    });

	// Очищаем Input
	$(elem).val('');

    //Удаляем предупреждение
    errors.html('');
}


// Удаление файла из формы
$('body').on('click', 'form .files .files_list .file .remove', function(){
	$(this).closest('.file').remove();
})



/**
 * Проверка видимости элемента (в видимой части страницы)
 * Достаточно, чтобы верхний или нижний край элемента был виден
 */
function isVisibleCountUp(elem) {

	let coords 			= elem.getBoundingClientRect();
	let windowHeight 	= document.documentElement.clientHeight;
	let topVisible 		= coords.top > 0 && coords.top < windowHeight;
	let bottomVisible 	= coords.bottom > 0 && coords.bottom < windowHeight;

	return topVisible || bottomVisible;
}


// Функция проверки видимости числа для запуск анимации
function showVisibleCountUp() {
	$('.countUp').each(function(index, val) {
		let _this = $(this);

		if (_this.hasClass('completed')) return;

		if (isVisibleCountUp(_this[0])) {
			_this.addClass('completed')
			_this.animateNumber(
				{
					number: _this.data('val'),
					numberStep: function(now, tween) {
						let floored_number = Math.floor(now),
							target = $(tween.elem),
							text = _this.data('text') ?? '';

						target.text(miniShop2.Utils.formatPrice(floored_number) + text);
					}
				},
				{
				    easing: 'swing',
				    duration: 1500
				}
		    )
		}
	})
}