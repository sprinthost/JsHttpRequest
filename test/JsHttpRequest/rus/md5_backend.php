<?php
require_once "../../../lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest =& new JsHttpRequest("windows-1251");
$str = $_REQUEST['str'];
$upl = $_FILES['upl'];
if (@$upl['tmp_name']) {
    $GLOBALS['_RESULT'] = array(
      "str"   => 'file ' . $upl['name'],
      "md5"   => md5(file_get_contents($upl['tmp_name'])),
    );
} else {
    $GLOBALS['_RESULT'] = array(
      "str"   => $str,
      "md5"   => md5($str),
    );
}
echo "Печатаем произвольное отладочное сообщение. Не страшна даже фатальная ошибка!";
