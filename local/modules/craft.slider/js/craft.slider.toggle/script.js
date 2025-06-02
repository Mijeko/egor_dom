(function ($) {
    /**
     * @param params {{
     *     events: Object
     * }}
     */
    $.fn.devToggle = function (params) {

        this.each(function () {

            let $this = $(this);

            const RELATED_KEY = $this.data('dev-toggle');
            const KEY_SELECTOR_TARGET = 'data-dev-toggle-target';


            const $TARGETS = $this.siblings('[' + KEY_SELECTOR_TARGET + '="' + RELATED_KEY + '"]');


            hideTargets();

            $this.find('[data-dev-toggle-switch]').each(function (_, el) {
                let $el = $(el);

                if ($el.is(':checked')) {
                    $($TARGETS[_]).show();
                }

                $el.change(function () {

                    runEvent('beforeShow', $this);

                    hideTargets();
                    $($TARGETS[_]).show();

                    runEvent('afterShow', $this);
                });
            });


            function hideTargets() {
                $TARGETS.each(function (_, el) {
                    let $el = $(el);

                    $el.hide();
                });
            }

        });

        function runEvent(event, instance) {
            if (typeof params.events[event] === 'function') {
                params.events[event](instance);
            }
        }

    };
})(jQuery);