/**
 * @param params {{slides: []}}
 */
let DevelopSlider = function (params) {

    let {slides} = params;

    let _images = [];
    let swiper;

    init();

    function init() {

        console.log(slides);

        collectImages();
        renderSlider(_images);
    }

    window.addEventListener('resize', function () {
        collectImages();
        renderSlider(_images);
    });

    function renderSlider(images) {

        if (swiper) {
            swiper.destroy();
        }

        let $el = $('[data-develop-slier]');
        let $wrapper = $el.find('[data-develop-slier-wrapper]');

        $wrapper.html('');

        for (let index in images) {
            let url = images[index];
            $wrapper.append('<div class="swiper-slide"><img src="' + url + '"></div>');
        }

        swiper = new Swiper(".mySwiper", {});
    }

    function collectImages() {

        _images = [];
        let windowWidth = window.innerWidth;

        for (let slideIndex in slides) {
            
            let slide = slides[slideIndex];
            let {image: defaultImage, sizes} = slide;
            let sourceImage = null;

            sourceImage = defaultImage;
            if (sizes) {

                for (let sizeIndex in sizes) {
                    let size = sizes[sizeIndex];
                    let {type, point, start, end, image} = size;

                    console.log(type, point);
                    if (!image) {
                        continue;
                    }

                    switch (type) {
                        case 'min-width':

                            if (!point) {
                                break;
                            }

                            if (windowWidth > point) {
                                sourceImage = image;
                            }

                            break;
                        case 'max-width':

                            if (!point) {
                                break;
                            }

                            if (windowWidth <= point) {
                                sourceImage = image;
                            }
                            break;
                        case 'between':

                            if (!start || !end) {
                                break;
                            }

                            if (windowWidth > start && windowWidth < end) {
                                sourceImage = image;
                            }

                            break;
                    }
                }
            }

            _images.push(sourceImage);
        }
    }

}