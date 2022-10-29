<?php
use Jenssegers\Agent\Agent;

function getMobile() {

    $agent = new Agent();
    return $agent->isMobile();
}

?>
