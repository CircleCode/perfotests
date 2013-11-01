<?php

$options = getopt("n:");
$runs = $options['n'];

echo("aggregating $runs runs…\n");

$XHPROF_ROOT = dirname(__FILE__) . '/xhprof';

include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();

$xhprof_data = xhprof_aggregate_runs($xhprof_runs, range(1,$runs), array_fill(0, 10, 1), 'offset');
$xhprof_runs->save_run($xhprof_data['raw'], "offset_aggregate_$runs");

$xhprof_data = xhprof_aggregate_runs($xhprof_runs, range(1,$runs), array_fill(0, 10, 1), 'anchored');
$xhprof_runs->save_run($xhprof_data['raw'], "anchored_aggregate_$runs");

$xhprof_data = xhprof_aggregate_runs($xhprof_runs, range(1,$runs), array_fill(0, 10, 1), 'offset_assertion');
$xhprof_runs->save_run($xhprof_data['raw'], "offset_assertion_$runs");