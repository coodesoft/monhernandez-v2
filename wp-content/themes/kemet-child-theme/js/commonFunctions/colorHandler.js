//Retorna un Gradiente con los colores y coordenadas dados, con 3 pasos: inicio medio y fin
export function $createGradient($ctx, $count, $x1Pos, $y1Pos, $x2Pos, $y2Pos, $middlePoint, $colorIn, $colorMiddle, $colorOut) {
    let $gradientStroke = $ctx.createLinearGradient($x1Pos, $y1Pos, $x2Pos, $y2Pos);
    $gradientStroke.addColorStop(0, $colorIn[$count]);
    $gradientStroke.addColorStop($middlePoint, $colorMiddle[$count]);
    $gradientStroke.addColorStop(1, $colorOut[$count]);
    return $gradientStroke;
}

//Genera un color intermedio entre dos dados en formato rgb
export function $getMiddleColor($colorIn, $colorOut) {
    let $arrMiddle = [];
    for (let $j = 0; $j < $colorIn.length; $j++) {
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
    }
    return $arrMiddle;
}