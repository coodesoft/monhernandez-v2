import {
    $getPieData
} from "../chartConfigObjects/pieChartDataObject.js";
import {
    $getPieOptions
} from "../chartConfigObjects/pieChartOptionsObject.js";
import {
    $createGradient,
    $getMiddleColor
} from "../commonFunctions/colorHandler.js";
import {
    $,
    $colorPurple,
    $colorRed,
    $colorCyan,
    $colorYellow,
} from "../constants.js";

export const $colorIn = [$colorPurple, $colorRed, $colorCyan];
export const $colorOut = [$colorRed, $colorCyan, $colorYellow];
export const $colorMiddle = $getMiddleColor($colorIn, $colorOut);
export let $pieLoad = false;
export function $impactSec() {
    //Grafico torta 1
    let $chart1Val = $('#pieChart1').attr('number');
    createPieChart('#chart1', $chart1Val, 0);
    //Grafico torta 2
    let $chart2Val = $('#pieChart2').attr('number');
    createPieChart('#chart2', $chart2Val, 1);
    //Grafico torta 3
    let $chart3Val = $('#pieChart3').attr('number');
    createPieChart('#chart3', $chart3Val, 2);

    $pieLoad = true;
}

function createPieChart($id, $percentage, $count) {
    let $ctx = $($id).get(0).getContext('2d');
    let $data = $getPieData($percentage);
    let $options = $getPieOptions();
    let $pieChart = new Chart($ctx, {
        type: 'pie',
        data: $data,
        options: $options
    });
    let $x2Pos = $data.datasets[0]._meta[$count].data[0]._chart.canvas.clientWidth;
    $data.datasets[0].data[1] = $percentage;
    $data.datasets[0].backgroundColor[1] = $createGradient($ctx, $count, 0, 0, $x2Pos, 0, 0.5, $colorIn, $colorMiddle, $colorOut);
    $pieChart.update({
        duration: 2000
    });
    increaseNumber();
}

function increaseNumber() {
    $('.count').each(function () {
        let $this = $(this);
        $({
            Counter: 0
        }).animate({
            Counter: $this.attr('number')
        }, {
            duration: 2000,
            easing: 'swing',
            step: function () {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
}