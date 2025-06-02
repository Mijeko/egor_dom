/**
 * @param params {{ajaxUrl:string, ajaxHead: string, sign:string}}
 */
function DevelopForm(params) {

    init();

    function init() {

        $(document).on('submit', '[data-feedback-form]', function (event) {
            event.preventDefault();

            let $this = $(this);
            let formData = new FormData(event.target);

            let developFormApi = new DevelopFormApi();
            developFormApi.request(
                params.ajaxUrl,
                formData,
                params.ajaxHead,
                {
                    afterSend: function (code, message) {
                        switch (code) {
                            case 200:
                                $this[0].reset();
                                $.toastDev(message);
                                break;
                            case 400:	// bad request
                                $.toastDevError(message);
                                break;
                        }

                    }
                }
            );
        });

    }

}


