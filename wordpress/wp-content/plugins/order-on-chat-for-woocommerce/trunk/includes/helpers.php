<?php


if (!function_exists('mvvwo_generate_whatsapp_link')) {

    function mvvwo_generate_whatsapp_link($mobile, $text = '')
    {

        $mobile = preg_replace('/[^0-9]/', '', $mobile);
        return 'https://api.whatsapp.com/send?phone=' . $mobile . '&text=' . urlencode($text);
    }
}

if (!function_exists('mvvwo_getTempProfil')) {
    function mvvwo_getTempProfil()
    {
        return esc_url(trailingslashit(plugins_url('../assets/', __FILE__))) . 'profile.png';
    }
}
if (!function_exists('oww_price')) {
    function oww_price($price)
    {


        extract(array(
            'ex_tax_label' => false,
            'currency' => '',
            'decimal_separator' => wc_get_price_decimal_separator(),
            'thousand_separator' => wc_get_price_thousand_separator(),
            'decimals' => wc_get_price_decimals(),
            'price_format' => get_woocommerce_price_format()));
        if ($decimal_separator) {
            $decimal_separator = trim($decimal_separator);
            $price = str_replace($decimal_separator, '.', $price);
        }

        //$unformatted_price = $price;
        $negative = $price < 0;
        $price = floatval($negative ? $price * -1 : $price);
//
        $price = number_format($price, $decimals, $decimal_separator, $thousand_separator);
        $return = html_entity_decode(($negative ? '-' : '') . sprintf($price_format, get_woocommerce_currency_symbol($currency), $price));

        return $return;
    }

}
if (!function_exists('mvvwo_translate')) {

    function mvvwo_translate($value, $name = '')
    {

        if (function_exists('pll__')) {
            return pll__($value);
        } else {
            return apply_filters('wpml_translate_single_string', $value, MVVWO_TEXT_DOMAIN, $name);
            //return __($value, MVVWO_TEXT_DOMAIN);
        }
    }
}

