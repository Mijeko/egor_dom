import $ from 'jquery';

$.fn.customSelect = function(options = null){
	this.each(function(){

		let $instance = $(this);

		$instance.click(function(event){
			event.stopPropagation();
			let $this = $(this);
			$this.toggleClass('active');
		});

		$('.js-option', $instance).click(function(){

			let $currentOption = $(this);

			if($currentOption.is('[disabled]'))
			{
				return;
			}

			let val = $currentOption.data('value');

			$('.js-input', $instance).val(val).trigger('change');

			$('.js-option-check', $instance).removeClass('active');

			let $check = $('.js-option-check', $currentOption);

			$check.addClass('active');


			if(typeof options.callback.afterSelect === 'function')
			{
				options.callback.afterSelect($instance, $currentOption);
			}
		});
	});
}