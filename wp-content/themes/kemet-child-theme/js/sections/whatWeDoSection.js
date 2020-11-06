import {
    $
} from "../constants.js";
export function $whatWeDoSect() {
    //Instanciacion del objeto Swiper, propio de la libreria SwiperJs, encargada del carousel de fondo
    let $swiperWWD = $('#wwd-slideshare .swiper-container').get(0).swiper;
    $('.moving-bar').removeClass('moving-bar-down');
    $('.wwd-clickable-image').removeClass('wwd-clickable-image-down');
    $('.wwd-title.index-0').addClass("visible-element");

    //Evento que se dispara cuando comienza una transicion entre imagenes
    $swiperWWD.on('slideChangeTransitionStart', function () {
        let $index = this.realIndex;
        let $prevIndex;
        if ($index == 0) {
            $prevIndex = 4;
        } else {
            $prevIndex = $index - 1;
        }
        $('.wwd-title.index-' + $index).addClass("visible-element");
        $('.wwd-title:not(.index-' + $index + ')').removeClass("visible-element");
        $('.slideshare-bars').removeClass('bar-color-' + $prevIndex);
        $('.slideshare-bars').addClass('bar-color-' + $index);
    });
    //Detiene el autoplay del carousel mientras el mouse este sobre la imagen descubierta
    $('.wwd-clickable-image').on('mouseenter', function () {
        $swiperWWD.autoplay.stop();
    });
    //Reestablece el autoplay al quitar el mouse de la imagen
    $('.wwd-clickable-image').on('mouseleave', function () {
        $swiperWWD.autoplay.start();
    });

    //Define la ruta de redireccion de acuerdo al indice de la imagen de fondo
    $('.wwd-clickable-image').on('click', function () {
        let $url;
        if ($swiperWWD.realIndex == 1) {
            $url = "/#";
        } else if ($swiperWWD.realIndex == 2) {
            $url = "/#";
        } else if ($swiperWWD.realIndex == 3) {
            $url = "/#";
        }
        $(this).attr('href', $url);
        window.location.href = $url;
        return false;
    });
}