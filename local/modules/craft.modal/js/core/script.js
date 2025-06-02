/**
 * @param params {{template: string, fancybox: Object}}
 */
let CraftShowModal = function (params = {template: '.default', fancybox: {}}) {

    let defaultFancyboxParams = {
        trapFocus: false,
        autoFocus: false,
        tpl: {
            closeButton: false,
        },
    }

    let {template, fancybox: fancyboxParams} = params;

    init();

    function init() {

        let requestBody = new FormData();

        requestBody.append('template', template);
        requestBody.append('craftModal', '-');

        fetch('/local/modules/craft.modal/tool/handle.php', {
            method: 'POST',
            body: requestBody
        })
            .then(response => response.json())
            .then(data => {
                let {modal} = data;
                if (modal) {

                    if (typeof Fancybox !== 'undefined') {
                        new Fancybox(
                            [
                                {
                                    src: modal,
                                    type: "html",
                                },
                            ],
                            $.extend({}, defaultFancyboxParams, fancyboxParams)
                        );
                    }
                }
            });
    }
};