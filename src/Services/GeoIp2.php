<?php

namespace App\Services;

use GeoIp2\Database\Reader;

class GeoIp2
{
    public function __construct() {
        $this->reader = new Reader(dirname(__FILE__, 3).'/db/GeoLite2-City.mmdb');
    }

    public function getGeo($ip_address) {
        $country = null;
        $state = null;
        try {
            $record = $this->reader->city($ip_address);
            $country = $record->country->name;
            $state = $record->mostSpecificSubdivision->name;
        } catch (\Throwable $th) {
            //record not found
        }
        return [$country, $state];
    }
}
