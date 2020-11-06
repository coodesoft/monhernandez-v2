import {
    $getBarData
} from "../chartConfigObjects/barChartDataObject.js";
import {
    $getBarOptions
} from "../chartConfigObjects/barChartOptionsObject.js";
import {
    $createGradient,
    $getMiddleColor
} from "../commonFunctions/colorHandler.js";

import {
    $,
    $colorPurple,
    $colorRed,
    $colorCyan,
    $colorYellow
} from "../constants.js";

//Constantes para creacion de graficos
export const $colorIn = [$colorPurple, $colorRed, $colorCyan, $colorPurple, $colorRed, $colorCyan];
export const $colorOut = [$colorRed, $colorCyan, $colorYellow, $colorRed, $colorCyan, $colorYellow];
export const $colorMiddle = $getMiddleColor($colorIn, $colorOut);
//Controla que se haya terminado la carga de las barras
export let $barLoad = false;
export function $experienceSec() {
    //Se obtiene el contexto del canvas
    let $ctx = $('#bar-chart').get(0).getContext('2d');
    //Se extraen los valores de las barras del atributo del elemento y se pasan a int
    let $values = $('.bar-chart-container').attr('values').split(' ');
    let $arrDat = $values.map(el => parseInt(el));
    let $maxValue = Math.max(...$arrDat);

    //Grafico de barras
    let $data = $getBarData($arrDat);
    let $options = $getBarOptions($maxValue);
    let $barChart = new Chart($ctx, {
        type: 'bar',
        data: $data,
        options: $options
    });
    progressiveBarLoad($barChart, $data);

    //Carga en orden las barras cada 1seg
    function progressiveBarLoad($chartInstance, $data) {
        //Se guardan en arreglos las coordenadas de base y alto de las barras relativo al canvas
        let $y1 = [],
            $y2 = [];
        let $count = 0;
        for (let $i = 0; $i < 6; $i++) {
            $y1[$i] = $data.datasets[0]._meta[0].data[$i]._model.base;
            $y2[$i] = $data.datasets[0]._meta[0].data[$i]._model.y;
        }
        //Se resetean los datos para reiniciar las animaciones
        $data.datasets[0].data = [0, 0, 0, 0, 0, 0];
        $chartInstance.update({
            duration: 0,
        });

        let $intervalhId = setInterval(function () {
            //Definicion del valor de la barra con indice $count
            $data.datasets[0].data[$count] = $arrDat[$count];
            //Obtencion de posiciones en eje Y de inicio y fin de la barra para generar gradiente exacto
            let $y1Pos = $y1[$count];
            let $y2Pos = $y2[$count];
            $data.datasets[0].backgroundColor[$count] = $createGradient($ctx, $count, 0, $y1Pos, 0, $y2Pos, 0.5, $colorIn, $colorMiddle, $colorOut);
            $count++;
            if ($count > 5) {
                $barLoad = true;
                clearInterval($intervalhId);
            }
            $chartInstance.update({
                duration: 1000,
                easing: 'easeInOutQuart'
            });
        }, 1000);
    }
}
//Retorna un Gradiente con los colores y coordenadas dados, con 3 pasos: inicio medio y fin
function createGradient($ctx, $count, $y1Pos, $y2Pos, $middlePoint) {
    let $gradientStroke = $ctx.createLinearGradient(0, $y1Pos, 0, $y2Pos);
    $gradientStroke.addColorStop(0, $colorIn[$count]);
    $gradientStroke.addColorStop($middlePoint, $colorMiddle[$count]);
    $gradientStroke.addColorStop(1, $colorOut[$count]);
    return $gradientStroke;
}

//calcula el color medio entre dos dados a partir de su valor hex
function getMiddleColor($colorIn, $colorOut) {
    let $arrMiddle = [];
    for (let $j = 0; $j < 3; $j++) {
        let c = "#";
        for (let $i = 0; $i < 3; $i++) {
            let sub1 = $colorIn[$j].substring(1 + 2 * $i, 3 + 2 * $i);
            let sub2 = $colorOut[$j].substring(1 + 2 * $i, 3 + 2 * $i);
            let v1 = parseInt(sub1, 16);
            let v2 = parseInt(sub2, 16);
            let v = Math.floor((v1 + v2) / 2);
            let sub = v.toString(16).toUpperCase();
            let padsub = ('0' + sub).slice(-2);
            c += padsub;
        }
        $arrMiddle[$j] = c;
        $arrMiddle[$j + 3] = c;
    }
    return $arrMiddle;
}
// export {
//     $barLoad,
// };