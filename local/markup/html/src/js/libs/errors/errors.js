import $ from 'jquery';

(function($){

	let errors;
	let options;

	$.errors = function(_errors, _options){
		errors = _errors;
		options = _options;
		handle();
	}


	function handle(){

		let emptyErrors = [];

		for(let key in Object.keys(errors))
		{
			let message = errors[key].message;

			let $el = $('.site-form-input[name="' + key + '"]');
			if($el.length)
			{
				$el.addClass('has-class');

				let $label = $el.next('.site-form-error');
				if($label)
				{
					$label.html(message);
				}
			} else
			{
				emptyErrors.push(message);
			}


			if(emptyErrors.length)
			{
				$.toastDev(emptyErrors.join('<br>'), {type: 'error'});
			}

		}

	}

})($);