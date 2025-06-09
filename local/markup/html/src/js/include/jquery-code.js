import $ from 'jquery';

window.$ = window.jQuery = $;
window.$ = window.jQuery = $.noConflict();


import "../libs/collapseTabs/collapseTabs";
import AirDatepicker from 'air-datepicker';
// $(document).ready(function(){
// 	$('[data-menu-switch]').each((index, element) => {
// 		let $parent = $(element);
//
// 		let $arrow = $parent.find('> .left-side-menu-item-wrap > [data-menu-switch-arrow]');
// 		if($arrow)
// 		{
// 			$arrow.click(function(event){
// 				event.preventDefault();
//
// 				$parent.toggleClass('is-active');
// 			});
// 		}
//
// 	});
// });

if ($('.js-player-start').length) {
    $('.js-player-start').click(function (event) {
        event.preventDefault();
        $(this).parent().remove();
    });
}

$('[data-collapse-tab]').collapseTabs({
    events: {
        afterClick: function (item) {
            let $item = $(item);

            let $iconClose = $item.find('.icon-close');
            if (!$iconClose.length) {
                return;
            }

            $iconClose.toggleClass('active');

        }
    }
});
$(".js-reg__steps").on("click", function () {
    let nexStep = $(this).data('step');

    if (nexStep) {
        $('.reg__step').hide()
        $('.reg__step-' + nexStep).show()
        $('.reg__steps-index span').text('Шаг ' + nexStep)
    }
});
$(".js-pwd-recover__steps").on("click", function () {
    let nexStep = $(this).data('step');

    if (nexStep) {
        $('.pwd-recover__step').hide()
        $('.pwd-recover__step-' + nexStep).show()
        $('.pwd-recover__steps-index span').text('Шаг ' + nexStep)
    }
});


function showResetButton() {
    $(".form-input").each(function () {
        const resetButton = $(this).siblings(".js-profile__input-reset");
        const isError = $(this).closest(".site__form-input-wrapper-icon-reset").hasClass("site__form-input-wrapper-icon-reset--error");

        if ($(this).val()) {
            if (isError) {
                resetButton.addClass("js-profile__input-reset--error").show();
            } else {
                resetButton.removeClass("js-profile__input-reset--error").show();
            }
        } else {
            resetButton.hide();
        }
    });
}

showResetButton();
$(".form-input").on("input", function () {
    showResetButton();
});

$(".js-profile__input-reset").on("click", function () {
    const inputField = $(this).siblings(".form-input");
    inputField.val("").trigger("input");
    showResetButton();
});

$(".profile__menu-mobile-select").change(function () {
    let link = $(this).find("option:selected").data("href");
    window.location.href = link;
});


/**
 * is global
 * */
let DevelopTimer = function () {

    this.play = function () {
        $('[data-timer]').each(function (_, el) {

            let $el = $(el);
            let timer;

            if (!$el.hasClass('active')) {
                $el.addClass('active');
            }

            let $timeSeconds = $el.find('[data-timer-seconds]');
            if ($timeSeconds) {

                let timeSeconds = $timeSeconds.data('timer-seconds');
                if (timeSeconds) {

                    defaultTime(timeSeconds, $timeSeconds);

                    timer = setInterval(function () {

                        renderTime(timeSeconds, $timeSeconds);

                        timeSeconds = timeSeconds - 1;

                        if (timeSeconds < 0) {
                            clearInterval(timer);
                            $el.removeClass('active');
                            $('[data-resend-confirm-code]').removeClass('isDisabled');
                            $timeSeconds.html('');
                        }

                    }, 1000);
                }

            }
        });
    }

    function defaultTime(seconds, selector) {
        renderTime(seconds, selector);
    }

    function renderTime(timeSeconds, selector = null) {

        let $_el;

        let mins = Math.floor(timeSeconds / 60);

        if (selector) {
            $_el = $(selector);
        }

        if (!$_el.length) {
            return;
        }

        $_el.html(`${doubleTime(mins)}:${doubleTime(timeSeconds)}`);
    }

}

window.devTimer = DevelopTimer;


function doubleTime(time) {
    if (time < 10) {
        return `0${time}`;
    }

    return time;
}


// Кастомный селект в Профиле пользователя
$(document).ready(function () {
    $(".form__select_custom .line").on("click", function () {

        $(".form__select_custom .line").removeClass("active").find("svg").html(`
      <circle cx="16" cy="16" r="14.5" stroke="#AFB0B2" stroke-width="3"/>
    `);
        $(this).addClass("active").find("svg").html(`
      <circle cx="16" cy="16" r="14.5" fill="white" stroke="#001F85" stroke-width="3" />
      <circle cx="16" cy="16" r="8.1" fill="#001F85" stroke="#001F85" stroke-width="3" />
    `);
    });

    // $(".login__form-block-button").click(function (e) {
    //     e.preventDefault();
    //     const formTemplate = $(".profile__form-row:first").clone();
    //     const blockInputsTemplate = $(".profile__form-block-inputs:first").clone();
    //     formTemplate.find("input").val("");
    //     blockInputsTemplate.find("input").val("");
    //     $(this).closest(".profile__form-button-block").before(formTemplate, blockInputsTemplate);
    // });

});

// Тут надо подумать куда засунуть пока тут
const inputs = document.querySelectorAll('.form-input');
inputs.forEach((input) => {
    input.addEventListener('focus', () => {
        input.parentNode.classList.add('active');
    });
    input.addEventListener('blur', () => {
        if (!input.value) {
            input.parentNode.classList.remove('active');
        }
    });
});