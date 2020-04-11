<?php
function variacaoPercentualPositiva($maior, $menor){
    /**fórmula:
    * variação percentual = (maior - menor)*100/menor
    */
    $variacaoPercentual = $maior - $menor;
    $variacaoPercentual = $variacaoPercentual * 100;
    $variacaoPercentual = $variacaoPercentual / $menor;
    $variacaoPercentual = number_format($variacaoPercentual, 0, '.', '');
    return $variacaoPercentual;
}

function variacaoPercentualNegativa($maior, $menor){
    /**fórmula:
     * variação percentual = (maior - menor)*100/maior
     */
    $variacaoPercentual = $maior - $menor;
    $variacaoPercentual = $variacaoPercentual * 100;
    $variacaoPercentual = $variacaoPercentual / $maior;
    $variacaoPercentual = number_format($variacaoPercentual, 0, '.', '');
    return $variacaoPercentual;
}

function variacaoPercentualSemDadoAnterior($n1){
    $variacaoPercentual = $n1 * 100;
    $variacaoPercentual = number_format($variacaoPercentual, 0, '.', '');
    return $variacaoPercentual;
}