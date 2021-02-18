<?php

namespace App\Services;

use GeoIp2\Database\Reader;

class GeoIp2
{
    public function __construct() {
        $this->reader = new Reader(dirname(__FILE__, 3).'/db/GeoLite2-City.mmdb');
    }

    public function getGeo($ip_address) {
        $record = $this->reader->city($ip_address);
        return [
            $record->country->name,
            $record->mostSpecificSubdivision->name
        ];
    }
}
