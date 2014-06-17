<script type="text/javascript" language="JavaScript" 
  src="../../lib/JsHttpRequest/debug/JsHttpRequest.js"></script>
<script type="text/javascript" language="JavaScript">
function doLoad(value) {
    // Create new JsHttpRequest object.
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            // Write result to page element ($_RESULT become responseJS). 
            document.getElementById('result').innerHTML = 
                '<b>filesize("'+req.responseJS.name+'")</b> = ' +
                '"' + req.responseJS.size + '"<br> ';
            // Write debug information too (output become responseText).
            document.getElementById('debug').innerHTML = req.responseText;
        }
    }
    // Prepare request object (automatically choose GET or POST).
    req.open(null, 'load.php', true);
    // Send data to backend.
    req.send( { 'file': value } );
}
</script>

<form enctype="multipart/form-data">
    File: <input type="file" name="f">
    <input type="button" value="Upload the file" 
      onclick="doLoad(this.form.f)">
</form>

<div id="result" style="border:1px solid #000; padding:2px">
    Structured results
</div>
<div id="debug" style="border:1px dashed red; padding:2px">
    Debug info
</div>

<hr><?show_source(__FILE__)?>
