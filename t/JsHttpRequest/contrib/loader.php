<?php
//
// ВНИМАНИЕ! До подключения библиотеки в браузер не должно быть выведено
// ни одного символа. В противном случае функция header(), используемая
// библиотекой, не сработает (см. документацию), и возникнет ошибка.
//

// Turn on all errors.
error_reporting(E_ALL);
ini_set('log_errors', true);
ini_set('display_errors', defined("DISPLAY_ERRORS")? DISPLAY_ERRORS : 1);
// Стартуем сессию.
session_start();
// Подключаем библиотеку поддержки.
require_once "../../../lib/JsHttpRequest/JsHttpRequest.php";
// Создаем главный объект библиотеки.
// Указываем кодировку страницы (обязательно!).
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Получаем запрос.
$q = @$_REQUEST['q'];
// Test when no $_RESULT is assigned, only stdout exists.
if (@strpos($q, 'just_stdout') !== false) {
  echo "some stdout";
  exit;
}
if (@strpos($q, 'empty_stdout') !== false) {
  exit;
}
if (@strpos($q, 'null_result') !== false) {
  $_RESULT = null;
  exit;
}
// Формируем результат прямо в виде PHP-массива!
$_RESULT = array(
  "q"      => JsHttpRequest::php2js($q),
  "md5"    => md5(is_array($q)? serialize($q) : $q),
  "hello"  => isset($_SESSION['hello'])? $_SESSION['hello'] : null,
  "upload" => print_r($_FILES, 1),
);
if ($q == "session-set") {
    $_SESSION['test'] = "test_value";
} 
// Демонстрация отладочных сообщений.
if (@strpos($q, 'warning_and_error') !== false) {
  file_get_contents("non-existent");
  callUndefinedFunction();
}
if (@strpos($q, 'warning_in_result') !== false) {
  ob_start();
  echo "Test";
  file_get_contents("non-existent");
  $_RESULT['custom'] = ob_get_clean();
}
if (@strpos($q, 'error') !== false) {
  callUndefinedFunction();
}
if (@strpos($q, 'notice') !== false) {
  echo $undefinedVariable;
}
if (@strpos($q, 'object') !== false) {
  $obj = (object)array('a' => 1, 'b' => 2);
  $_RESULT['obj'] = $obj;
}
if (@strpos($q, 'obj_cyr') !== false) {
  class C { var $a, $b; }
  $obj = new C();
  $obj->a = 'english';
  $obj->b = 'кирилица';
  $_RESULT['obj'] = $obj;
}
if (@strpos($q, 'memory_limit') !== false) {
  while (1) $buf[] = str_repeat('a', 10000);
}
if (@$_REQUEST['dt']) {
  sleep($_REQUEST['dt']);
}
// Do NOT write Content-type here: IE ommits it for ActiveX!
?>
<?if (!$JsHttpRequest->ID) {?>Zero loading ID: yes<? echo "\n"; }?>
QUERY_STRING: <?=$_SERVER['QUERY_STRING'] . "\n"?>
Request method: <?=$_SERVER['REQUEST_METHOD'] . "\n"?>
Loader used: <?=$JsHttpRequest->LOADER . "\n"?>
Uploaded file size: <?=@$_FILES['file']['size'] . "\n"?>
_GET: <?=print_r($_GET, 1)?>
_POST: <?=print_r($_POST, 1)?>
_FILES: <?=preg_replace('/(\[(name|size|tmp_name|type)\].*?)(\S+)$/m', '$1***', print_r($_FILES, 1))?>
<?if ($q == "session-get") {?>_SESSION[test]: <?=@$_SESSION['test']?><?}?>
