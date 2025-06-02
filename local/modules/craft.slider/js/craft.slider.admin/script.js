/**
 * @param params {{specifications:[], controlName: string, ajaxPath: string}}
 */
function JediSpecification(params) {

    let {ajaxPath, controlName, templates} = params;

    let ADM_ADAPTIVE_CREATE_BTN = '[data-adm-adaptive-create]';
    let ADM_ADAPTIVE_LIST = '[data-adm-adaptive-list]';
    let ADM_ADAPTIVE_ITEM = '[data-adm-adaptive-item]';
    let ADM_ADAPTIVE_ITEM_REMOVE = '[data-adm-adaptive-item-remove]';

    let $document = $(document);

    let $admAdaptiveList = $(ADM_ADAPTIVE_LIST);

    init();

    function init() {

        $document.on('click', ADM_ADAPTIVE_ITEM_REMOVE, function (event) {
            event.preventDefault();
            let $this = $(this);

            let $parent = $this.parents(ADM_ADAPTIVE_ITEM);

            if (!$parent.length) {
                return;
            }

            $parent.remove();
        })

        $document.on('click', ADM_ADAPTIVE_CREATE_BTN, function (event) {
            event.preventDefault();


            let formData = new FormData();
            formData.append('controlName', controlName);
            formData.append('countItem', ($(ADM_ADAPTIVE_ITEM).length));

            fetch(
                ajaxPath,
                {
                    method: 'POST',
                    body: formData
                }
            )
                .then(response => response.json())
                .then(data => {
                    let {html} = data;

                    if (html) {
                        $admAdaptiveList.append($(html));
                    }
                });
        });
    }
}