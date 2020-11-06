import { $noColor } from "../constants.js";
//Setea y retorna los datos del grafico de barras
export function $getBarData($arrDat) {
    return {
        labels: [
            ['consultores de', 'emprendimientos'],
            ['docentes', 'universitarios'],
            ['empresarios en', 'diferentes sectores'],
            ['lanzando productos', 'al mercado'],
            ['gerenciando', 'marcas'],
            ['viajando y creando', 'alianzas a nivel global']
        ],
        datasets: [{
            data: $arrDat,
            backgroundColor: [$noColor, $noColor, $noColor, $noColor, $noColor, $noColor]
        }]
    }
};