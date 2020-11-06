import {
    $
} from "../constants.js";
export function $horParallax($mouseout, $parent, $child, $single) {
    //Ancho del elemento con fondo
    let $width = $($mouseout).width();
    //Parseo de la posicion en X del fondo
    const $backgroundPosX = parseInt($($parent).find($child).eq(0).css('background-position-x'), 10);

    $($mouseout).on("mousemove", function (evt) {
        //Captura de la posicion en X del mouse respecto a el elemento donde esta
        let $mousePosX = evt.pageX - $($mouseout).offset().left;
        //Calculo de la posicion del mouse respecto al centro del elemento con fondo
        let $pageX = $mousePosX - ($width / 2);
        //Conversion a porcentaje, se divide para disminuir el movimiento
        let $pagePersentage = ((($pageX * 100) / $width) / 5);
        let $newX = $backgroundPosX + $pagePersentage + '%';
        if ($single) {
            ($($parent).find($child).eq(0)).get(0).style.backgroundPositionX = $newX;
        } else {
            $.each($($parent).find($child), function (key, value) {
                value.style.backgroundPositionX = $newX;
            });
        }
    });

    $($mouseout).on("mouseleave", function () {
        //Restablece la imagen a su posicion original
        if ($single) {
            ($($parent).find($child).eq(0)).get(0).style.backgroundPositionX = $backgroundPosX + "%";
        } else {
            $.each($($parent).find($child), function (key, value) {
                value.style.backgroundPositionX = $backgroundPosX + "%";
            });
        }
    });
}