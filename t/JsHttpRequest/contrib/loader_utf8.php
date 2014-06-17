<?php
// Turn on all errors.
error_reporting(E_ALL);
ini_set('log_errors', true);
session_start();
require_once "../../../lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest =& new JsHttpRequest("utf-8");
$q = @$_REQUEST['q'];
$_RESULT = array(
  "q"      => JsHttpRequest::php2js($q),
  "hello"  => 'Это строка в UTF-8',
);
