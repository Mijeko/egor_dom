import {DotLottie} from '@lottiefiles/dotlottie-web';
import $ from 'jquery';


$(document).ready(function () {
    $('[data-animate]').each(function (_, el) {
        let $this = $(el);
        let $canvasElement = $this.find('canvas');
        let src = $this.data('src');


        if (!$canvasElement.length || !src) {
            return;
        }

        let dotLottie = new DotLottie({
            canvas: $canvasElement[0],
            src: src,
        });

        el.addEventListener('mouseover', () => {
            dotLottie.play()
        })
    });
});
