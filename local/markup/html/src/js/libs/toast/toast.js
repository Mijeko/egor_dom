import $ from 'jquery';

(function($){

	let $toast;
	let $container;
	let messageText;

	let options = {};
	let defaultOptions = {
		header: {
			title: 'Уведомление',
		},
		type: 'success'
	};

	$.fn.toastDev = function(message, _options){

		messageText = message;
		options = $.extend(defaultOptions, _options);

		$.toastDev.Show();

	};

	$.toastDev = function(message, _options){

		messageText = message;
		options = $.extend(defaultOptions, _options);


		$.toastDev.Show();
	}

	$.toastDev.Show = function(){

		$.toastDev.Init();
		$.toastDev.Create();

		let $header = $('[data-toast-header-title]', $toast);
		let $body = $('[data-toast-body]', $toast);


		$header.html(options.header.title);
		$body.html(messageText);

		$('[data-toast-close]', $toast).click(function(event){
			event.preventDefault();

			$toast.remove();
		});


		setTimeout(function(){
			$toast.remove();
		}, 5500);

	}

	$.toastDev.Init = function init(){

		$container = $('[data-toast-container]');

		if(!$container.length)
		{
			$container = $('<div class="toast-dev-container" data-toast-container></div>');
			$('body').append($container);
		}
	}

	$.toastDev.Create = function(){
		$toast = $('<div class="toast-dev ' + options.type + '" data-toast>' +
			'<div class="toast-dev-header" data-toast-header>' +
			'<div class="toast-dev-header-indicator"></div>' +
			'<div class="toast-dev-header__title" data-toast-header-title></div>' +
			'<div data-toast-close class="toast-dev-header__close"><img class="toast-dev-header__close-icon" src="/assets/images/close.svg"></div>' +
			'</div>' +
			'<div class="toast-dev-body" data-toast-body>' +
			'</div>' +
			'</div>'
		);

		$container.append($toast);
	};

})($);