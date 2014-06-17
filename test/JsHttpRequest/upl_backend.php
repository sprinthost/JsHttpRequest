<?php
// Load JsHttpRequest backend.
require_once "../../lib/JsHttpRequest/JsHttpRequest.php";
// Create main library object. You MUST specify page encoding!
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Store resulting data in $_RESULT array (will appear in req.responseJs).
$GLOBALS['_RESULT'] = array(
  "q"     => 'file ' . $_FILES['q']['name'],
  "md5"   => md5(@file_get_contents($_FILES['q']['tmp_name'])),
); 
// Below is unparsed stream data (will appear in req.responseText).
?>
<pre>
<b>Uploaded files:</b> <?=print_r($_FILES, 1)?>
</pre>
