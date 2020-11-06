import {
    $colorIn,
    $colorOut,
    $colorMiddle,
    $pieLoad
} from "../sections/impactSection.js";
import {
    $createGradient
} from "../commonFunctions/colorHandler.js";
//Setea y retorna las opciones de configuracion del grafico de torta
export function $getPieOptions() {
    let $lastElement, $instance;
    return {
        responsive: true,
        aspectRatio: 1,
        animation: {
            duration: 0,
            easing: 'easeInOutQuart'
        },
        circumference: Math.PI * 2,
        elements: {
            arc: {
                borderWidth: 0
            }
        },
        legend: {
            display: false
        },
        onHover: function (evt, elements) {
            if (elements.length && $pieLoad) {
                $lastElement = elements[0];
                $instance = this;
                //calcula centro de barra
                let $width = $lastElement._chart.canvas.clientHeight;
                let $middle = ($lastElement._chart.canvas.clientHeight) / 2
                //obtiene una posicion relativa al centro de la barra
                let $x2 = ((evt.layerX * 50) / $middle) / 100;
                //cambia la ubicacion del punto del color medio - valor entre 0 y 1
                this.data.datasets[0].backgroundColor[1] = $createGradient(this.canvas.getContext('2d'), $lastElement._chart.id, 0, 0, $width, 0, (1 - $x2), $colorIn, $colorMiddle, $colorOut);
                //actualiza instancia de grafico
                this.update({
                    duration: 1000
                });
            }
        },
        tooltips: {
            enabled: false,
            custom: function (tooltipModel) {
                if (tooltipModel.body === undefined) {
                    //cambia la ubicacion del punto del color medio - valor entre 0 y 1
                    let $width = $lastElement._chart.canvas.clientHeight;
                    $instance.data.datasets[0].backgroundColor[1] = $createGradient($instance.canvas.getContext('2d'), $lastElement._chart.id, 0, 0, $width, 0, 0.5, $colorIn, $colorMiddle, $colorOut);
                    //actualiza instancia de grafico
                    $instance.update({
                        duration: 500
                    });
                }
            }
        }
    }
}