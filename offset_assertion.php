<?php

$XHPROF_ROOT = dirname(__FILE__) . '/xhprof';

require_once 'vars.php';

// début du profilage
xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);

$offset           = 0;
$maxoffset        = mb_strlen($string);

while($offset < $maxoffset) {

    foreach($tokens as $token) {

        if(0 === preg_match('#\G(?|' . $token . ')#u', $string, $matches, 0, $offset))
            continue;

        $offset += mb_strlen($matches[0]);
        break;
    }
}

// fin du profilage
$xhprof_data = xhprof_disable();

include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();
$xhprof_runs->save_run($xhprof_data, "offset_asertion", $run);