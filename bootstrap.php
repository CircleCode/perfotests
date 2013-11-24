<?php

$options = getopt("i:l:");
$run = $options['i'];
$length = $options['l'];

$string = "";
$tokens = array('foo', 'bar', 'baz', 'qux', 'gordon', 'freeman', '✔', '✘');
$_      = count($tokens) - 1;

for($i = 0; $i < $length; ++$i)
    $string .= $tokens[mt_rand(0, $_)];

$tokens_ = var_export($tokens, true);
$string_ = var_export($string, true);

$str = <<<PHP
<?php

mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

\$tokens = $tokens_;
\$string = $string_;
\$run = $run;
PHP;

file_put_contents('vars.php', $str);
