<?php


if (!function_exists('format_price_with_tax')) {
    function format_price_with_tax(float $price, float $taxPercent): string
    {
        $priceWithTax = round($price * (1 + $taxPercent / 100), 2);

        return fmod($priceWithTax, 1) == 0
            ? number_format($priceWithTax, 0, ',', '.')
            : number_format($priceWithTax, 2, ',', '.');
    }
}


if (!function_exists('formatear_precio')) {
    function formatear_precio($valor)
    {

        return fmod($valor, 1) == 0
            ? number_format($valor, 0, ',', '.')
            : number_format($valor, 2, ',', '.');
    }
}



