import {
    $
} from "../constants.js";
import {
    $horParallax
} from "../commonFunctions/horizontalParallax.js";
export function $clientsSect() {
    //Instanciacion del objeto Swiper, propio de la libreria SwiperJs, encargada del carousel de fondo
    let $mySwiper = $('#clients-section .swiper-container').get(0).swiper;
    $('.selected-client.index-0').addClass("hovered font-weight-bold");
    $('.text-clients.index-0').addClass("visible-element");

    //Evento que se dispara al cliquear uno de los botones de la parte izquierda de la seccion
    $('.selected-client').on('click', function () {
        let $value = $(this).attr('data-target');
        let $index = $(this).attr('index');
        $mySwiper.slideTo($index);
        $('.selected-client.index-' + $index).addClass("hovered font-weight-bold");
        $('.selected-client:not(.index-' + $index + ')').removeClass("hovered font-weight-bold");
        $('.text-clients.' + $value).addClass("visible-element");
        $('.text-clients:not(.' + $value + ')').removeClass("visible-element");
        $mySwiper.autoplay.start();
    });

    //Evento que se dispara cuando cambia una imagen del carousel de fondo
    $mySwiper.on('slideChange', function () {
        let $index = this.realIndex;
        $('.selected-client.index-' + $index).addClass("hovered font-weight-bold");
        $('.selected-client:not(.index-' + $index + ')').removeClass("hovered font-weight-bold");
        $('.text-clients.index-' + $index).addClass("visible-element");
        $('.text-clients:not(.index-' + $index + ')').removeClass("visible-element");
    })
    $horParallax('#clients-hover', '#clients-section', '.elementor-background-slideshow__slide__image', false);
}