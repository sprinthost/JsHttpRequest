<script type="text/javascript" language="JavaScript" 
  src="../../lib/JsHttpRequest/JsHttpRequest.js"></script>
<script type="text/javascript" language="JavaScript">
function doLoad() {
    // Create new JsHttpRequest object.
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            // Write result to page element ($_RESULT become responseJS). 
            document.getElementById('result').innerHTML = 
                '<b>MD5("'+req.responseJS.q+'")</b> = ' +
                '"' + req.responseJS.md5 + '"<br> ';
            // Write debug information too (output become responseText).
            document.getElementById('debug').innerHTML = req.responseText;
        }
    }
    // Prepare request object (automatically choose GET or POST).
    req.open(null, 'load.php', true);
    // Send whole form data to backend.
    req.send( { 'a': 123, 'form': document.getElementById('frm') } );
}
</script>

<form id="frm" enctype="multipart/form-data">
    Text: <input type="text" name="q">
    <input type="text" name="action" value="test">
    <input type="button" value="Send!" onclick="doLoad()">
</form>

<div id="result" style="border:1px solid #000; padding:2px">
    Structured results
</div>
<div id="debug" style="border:1px dashed red; padding:2px">
    Debug info
</div>

<hr><?show_source(__FILE__)?>
