<?php
/**
 * Standardising units for ease of use.
 */
if (!function_exists('convert_to_base_unit')) {
    function convert_to_base_unit($amount, $unit) {
        $unitConversions = [
            'kg' => 1000,
            'g' => 1,
            'l' => 1000,
            'ml' => 1,
            'pc' => 1,
        ];

        return isset($unitConversions[$unit]) ? $amount * $unitConversions[$unit] : $amount;
    }
}
