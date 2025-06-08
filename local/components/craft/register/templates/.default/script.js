let CraftRegisterForm = function () {

    init();

    function init() {
        $(document).on('submit', '[data-register-form]', function (event) {
            event.preventDefault();

            let api = new CraftUserApi({
                events: {
                    success: function (response) {
                        let {status, data, errors} = response;
                        let {template} = data;

                        switch (status) {
                            case 'success':
                                let $template = $(template);
                                let $replaceMe = $('[data-register-form]');
                                if ($replaceMe.length > 0) {
                                    $replaceMe.replaceWith($template);
                                }
                                break;
                        }
                    },
                    error: function (response) {
                        let {status, data, errors} = response;
                        let {template} = data;


                        switch (status) {
                            case 'error':
                                let $template = $(template);
                                let $replaceMe = $('[data-register-form]');
                                if ($replaceMe.length > 0) {
                                    $replaceMe.replaceWith($template);
                                }
                                break;
                        }
                    },
                }
            });


            api.request(
                new FormData(event.target)
            );
        });
    }
}