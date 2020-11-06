import {
    $noColor
} from "../constants.js";
//Setea y retorna los datos del grafico de torta
export function $getPieData($percentage) {
    return {
        datasets: [{
            data: [100 - $percentage, 0],
            backgroundColor: [$noColor, $noColor]
        }]
    }
};