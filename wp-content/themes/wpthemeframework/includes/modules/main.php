<?php

//add mod name to array
$mods = array("gallery-grid","twitter-feed-slider","scrolling-boxes-slider");

for($i = 0 ; $i < sizeof($mods) ; $i++) {
    $mod = $mods[$i];
    get_template_part( "includes/modules/$mod/$mod" );
}