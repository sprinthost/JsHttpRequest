<?php
require_once "../../lib/JsHttpRequest/JsHttpRequest.php";
// Init JsHttpRequest and specify the encoding. It's important!
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Fetch request parameters.
$str = $_REQUEST['str'];
$upl = @$_FILES['upl'];
// Create the resulting array.
if (@$upl['tmp_name']) {
    // The file was successfully uploaded.
    $GLOBALS['_RESULT'] = array(
      "str"   => 'file ' . $upl['name'],
      "md5"   => md5(file_get_contents($upl['tmp_name'])),
    );
} else {
    // No file is uploaded, use the plain string.
    $GLOBALS['_RESULT'] = array(
      "str"   => $str,
      "md5"   => md5($str),
    );
}
// Everything we print will go to 'errors' parameter.
echo "<pre>";
?>
<b>QUERY_STRING:</b> <?=$_SERVER['QUERY_STRING'] . "\n"?>
<b>Uploaded files:</b> <?=print_r($_FILES, 1)?>
<?php
echo "</pre>";
// This includes a PHP fatal error! It will go to the debug stream,
// frontend may intercept this and act a reaction.
if ($_REQUEST['str'] == 'error') {
  error_demonstration__make_a_mistake_calling_undefined_function();
}
?>
