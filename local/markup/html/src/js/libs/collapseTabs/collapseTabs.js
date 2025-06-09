import $ from 'jquery';

(function ($) {
    $.fn.collapseTabs = function (params) {

        return $(this).each(function (_, el) {
            let $this = $(el);


            $this.find('[data-toggle]').click(function (event) {
                event.preventDefault();

                $this.toggleClass('active');

                let {events} = params;
                if (events) {
                    let {afterClick} = events;

                    if (afterClick && typeof afterClick === "function") {
                        afterClick($this);
                    }
                }
            });


        });
    };

})($);