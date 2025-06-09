import $ from 'jquery';
import {Fancybox} from "@fancyapps/ui";
import InitDatepicker from "./include/init-datepicker";
import './include/jquery-code';
import './include/init-sliders';
import './libs/ymap';
import './libs/animation';
import './libs/chosen/chosen.jquery.min';

window.$ = window.jQuery = $;
window.$ = window.jQuery = $.noConflict();

window.InitDatepicker = InitDatepicker;
window.Fancybox = Fancybox;

new InitDatepicker();

Fancybox.bind("[data-fancybox]", {});


window.showDefaultModal = function (template) {
    new Fancybox(
        [
            {
                src: template,
                type: "html",
            },
        ],
        {
            trapFocus: false,
            autoFocus: false,
            tpl: {
                closeButton: false,
            },
        }
    );
}

window.closeModal = function () {
    window.Fancybox.close();
}