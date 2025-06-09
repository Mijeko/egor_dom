import Inputmask from "maskedinput";

export default class initMask {

	constructor(){

		let russsianPhone = document.querySelectorAll(".js-mask-ru");

		if(russsianPhone)
		{
			russsianPhone.forEach(el => {
				let im = new Inputmask("+7 (999) 999 99-99", {placeholder: "+7 (___) ___ __ __"});
				im.mask(el);
			});
		}
	}

}
