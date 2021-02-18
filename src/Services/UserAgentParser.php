<?php

namespace App\Services;

use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\WhichBrowser;

class UserAgentParser
{
    public function __construct() {
        $this->provider = new WhichBrowser();
    }

    public function parse($user_agent) {
        $browser = null;
        $device = null;
        try {
            $result = $this->provider->parse($user_agent);
            $browser = $result->getBrowser()->getName();
            $device = $result->getDevice()->getType();
        } catch (NoResultFoundException $ex){
            //nothing found
        }
        return [$browser, $device];
    }
}
