import AirDatepicker from 'air-datepicker';

export default class InitDatepicker {


    constructor() {


        document.querySelectorAll('[data-datepicker-icon]').forEach((el, key) => {
            let uniq = el.getAttribute('data-datepicker-icon');
            if (!uniq || !uniq.length) {
                return;
            }

            el.onclick = function (event) {
                event.preventDefault();
                let input = document.querySelector(`[data-datepicker-with-icon="${uniq}"]`);
                if (!input instanceof HTMLElement) {
                    return;
                }

                let _air = new AirDatepicker(input, {
                    autoClose: true,
                    onSelect: function ({date, formattedDate, datepicker}) {
                        datepicker.hide();
                    }
                });

                _air.show();
            }
        })


        document.querySelectorAll('.js-datepicker').forEach(function (element, key, parent) {
            new AirDatepicker(element, {
                autoClose: true,
                onSelect: function ({date, formattedDate, datepicker}) {
                    datepicker.hide();
                }
            });
        });


        new AirDatepicker('[data-range-request-filter]', {
            autoClose: true,
            range: true,
            multipleDatesSeparator: ' - ',
            onSelect: function ({date, formattedDate, datepicker}) {

                if (Array.isArray(date)) {
                    let inputDateList = [
                        $('[data-filter-date-one]'),
                        $('[data-filter-date-two]'),
                    ];


                    for (let index in inputDateList) {
                        if (index in formattedDate) {
                            let $input = inputDateList[index];
                            if ($input.length) {
                                console.log(formattedDate[index]);
                                $input.val(formattedDate[index]);
                            }
                        }
                    }

                }

            }
        });
    }

}
