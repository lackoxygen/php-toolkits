<?php

namespace Lackoxygen\Toolkits;

if (!function_exists('collect')) {
    /**
     * Create a collection.
     *
     * @param mixed $items
     * @return Collection
     */
    function collect($items = []): Collection
    {
        return Collection::make($items);
    }
}


if (!function_exists('sum_distance')) {
    /**
     * Calculate distance between latitude and longitude.
     *
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @return float|int
     */
    function sum_distance($lat1, $lon1, $lat2, $lon2): string
    {
        $earthRadius = 6371;

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $diff_lat = $lat2 - $lat1;
        $diff_lon = $lon2 - $lon1;

        $a = sin($diff_lat / 2) * sin($diff_lat / 2) + cos($lat1) * cos($lat2) * sin($diff_lon / 2) * sin($diff_lon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return (string)$earthRadius * $c;
    }
}
