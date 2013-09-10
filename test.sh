#!/bin/bash
WORK_DIR="/tmp/xhprof"
RUNS=$1
LENGTH=$2
if [ -z $RUNS ]; then
	RUNS=10
fi
if [ -z $LENGTH ]; then
	LENGTH=10000
fi

rm -rf $WORK_DIR
mkdir -p $WORK_DIR

for run in $(seq 1 $RUNS)
do
	echo "run $run of $RUNS"
    php bootstrap.php -i=$run -l=$LENGTH
    php -d xhprof.output_dir=$WORK_DIR anchored.php
    php -d xhprof.output_dir=$WORK_DIR offset.php
done

sleep 1

php -d xhprof.output_dir=$WORK_DIR ./aggregate.php -n=$RUNS

php -d xhprof.output_dir=$WORK_DIR -S 0.0.0.0:8000 -t xhprof/xhprof_html/