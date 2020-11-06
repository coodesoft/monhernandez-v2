import {
    $fontFamily,
    $colorPurple,
    $noColor
} from "../constants.js";
import {
    $colorIn,
    $colorOut,
    $colorMiddle,
    $barLoad
} from "../sections/experienceSection.js";
import {
    $createGradient
} from "../commonFunctions/colorHandler.js";
//Setea y retorna las opciones de configuracion del grafico de barras
export function $getBarOptions($maxValue) {
    let $lastElement, $instance;
    return {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            duration: 0
        },
        legend: {
            display: false
        },
        onHover: function (evt, elements) {
            if (elements.length && $barLoad) {
                $lastElement = elements[0];
                $instance = this;
                //calcula centro de barra
                let $middle = ($lastElement._model.base + $lastElement._model.y) / 2
                //obtiene una posicion relativa al centro de la barra
                let $y2 = ((evt.layerY * 50) / $middle) / 100;
                //cambia la ubicacion del punto del color medio - valor entre 0 y 1
                this.data.datasets[0].backgroundColor[$lastElement._index] = $createGradient(this.canvas.getContext('2d'), $lastElement._index, 0, $lastElement._model.base, 0, $lastElement._model.y, $y2, $colorIn, $colorMiddle, $colorOut);
                //actualiza instancia de grafico
                this.update({
                    duration: 1000
                });
            }
        },
        tooltips: {
            // Hide the tooltips
            backgroundColor: $noColor,
            titleFontColor: $noColor,
            displayColors: false,
            callbacks: {
                labelTextColor: function () {
                    return $noColor;
                },
                labelColor: function () {
                    return {
                        borderColor: $noColor,
                        backgroundColor: $noColor
                    }
                }
            },
            custom: function (tooltipModel) {

                if (tooltipModel.body === undefined) {
                    //cambia la ubicacion del punto del color medio - valor entre 0 y 1
                    $instance.data.datasets[0].backgroundColor[$lastElement._index] = $createGradient($instance.canvas.getContext('2d'), $lastElement._index, 0, $lastElement._model.base, 0, $lastElement._model.y, 0.5, $colorIn, $colorMiddle, $colorOut);
                    //actualiza instancia de grafico
                    $instance.update({
                        duration: 500
                    });
                }
            }
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    fontFamily: $fontFamily,
                    fontColor: $colorPurple,
                    fontSize: 14,
                    labelString: 'años de experiencia'
                },
                ticks: {
                    min: 0,
                    max: $maxValue,
                    stepSize: 2,
                    labelOffset: 15,
                    fontFamily: $fontFamily,
                    fontColor: $colorPurple,
                    fontStyle: "bold",
                    fontSize: 24
                },
                gridLines: {
                    zeroLineColor: $colorPurple,
                    zeroLineWidth: 1.25,
                    color: $colorPurple,
                    lineWidth: 1.25,
                    z: 1,
                    drawBorder: false
                }
            }],
            xAxes: [{
                ticks: {
                    padding: 5,
                    fontFamily: $fontFamily,
                    fontColor: $colorPurple,
                    fontSize: 14,
                    beginAtZero: true
                },
                gridLines: {
                    display: false,
                    drawBorder: true
                }
            }]
        }
    }
}