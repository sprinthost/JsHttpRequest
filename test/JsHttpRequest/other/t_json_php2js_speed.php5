<?php
// Load JsHttpRequest backend.
require_once "../../lib/JsHttpRequest/JsHttpRequest.php";


// Fill the array with large data block.
$a = array();
for ($i = 0; $i < 200; $i++) {
    $a[$i] = array(
        'id'    => $i,
        'key'   => md5($i),
        'text'  => "Это длинная русская строка. Может хранить, например, какое-то название.",
        'order' => $i,
    );
}

// CPU warming (for notebooks).
echo "Warming up the CPU...<br>\n"; flush();
$t0 = time();
while (time() - $t0 < 4);

$nItr = 100;

// Test iconv() + json_encode().
$t0 = array_sum(explode(" ", microtime()));
for ($i = 0; $i < $nItr; $i++) {
    $s = var_export($a, true);
    $s = iconv('windows-1251', 'UTF-8', $s);
    $unp = eval("return $s;");
    $s = json_encode($unp);
}
$t1 = array_sum(explode(" ", microtime()));
echo sprintf("iconv + var_export + eval + json_encode(): %.4f s/itr<br>\n", $k1 = ($t1 - $t0) / $nItr);


// Test php2js().
$t0 = array_sum(explode(" ", microtime()));
for ($i = 0; $i < $nItr; $i++) {
    $s = JsHttpRequest::php2js($a);
}
$t1 = array_sum(explode(" ", microtime()));
echo sprintf("php2js(): %.4f s/itr<br>\n", $k2 = ($t1 - $t0) / $nItr);


// Test array_walk_recursive().
$BRK = '';
for ($i = 128; $i < 256; $i++) $BRK .= chr($i);
function toUtf(&$v, $k, $fromEnc) {
    //if (strpbrk($k, $GLOBALS['BRK']) !== false) return;
    //if (@iconv($fromEnc, 'UTF-8', $k) !== $k) return;    
    $v = iconv($fromEnc, 'UTF-8', $v);
}
$t0 = array_sum(explode(" ", microtime()));
for ($i = 0; $i < $nItr; $i++) {
    $s = $a;
    array_walk_recursive($s, 'toUtf', 'windows-1251');
    $s = json_encode($s);
}
$t1 = array_sum(explode(" ", microtime()));
echo sprintf("array_walk_recursive(): %.4f s/itr<br>\n", $k3 = ($t1 - $t0) / $nItr);


echo sprintf("php2js/eval = %.2f<br>\n", $k2 / $k1);
echo sprintf("php2js/awr = %.2f<br>\n", $k2 / $k3);
?>