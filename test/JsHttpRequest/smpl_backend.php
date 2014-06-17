<?php
// Load JsHttpRequest backend.
require_once "../../lib/JsHttpRequest/JsHttpRequest.php";
// Create main library object. You MUST specify page encoding!
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Store resulting data in $_RESULT array (will appear in req.responseJs).
$GLOBALS['_RESULT'] = array(
  "q"     => @$_REQUEST['q'],
  "md5"   => md5(@$_REQUEST['q']),
); 
// Below is unparsed stream data (will appear in req.responseText).
?>
<pre>
<b>Request method:</b> <?=$_SERVER['REQUEST_METHOD'] . "\n"?>
<b>Loader used:</b> <?=$JsHttpRequest->LOADER . "\n"?>
<b>_REQUEST:</b> <?=print_r($_REQUEST, 1)?>
</pre>
