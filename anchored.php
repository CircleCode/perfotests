<?php

$XHPROF_ROOT = dirname(__FILE__) . '/xhprof';

require_once 'vars.php';

// début du profilage
xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);

while(0 < strlen($string)) {

    foreach($tokens as $token) {

        if(0 === preg_match('#^(?:' . $token . ')#u', $string, $matches))
            continue;

        $string = mb_substr($string, mb_strlen($matches[0]));
        break;
    }
}

// fin du profilage
$xhprof_data = xhprof_disable();

//
// Sauvegarde du run XHProf
// en utilisant l’implementation par défaut de iXHProfRuns.
//
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();
$xhprof_runs->save_run($xhprof_data, "anchored", $run);