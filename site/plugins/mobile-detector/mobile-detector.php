<?php

require_once __DIR__.'/libs/Mobile_Detector.php';

function isMobile() {
    return (new Mobile_Detect)->isMobile();
}