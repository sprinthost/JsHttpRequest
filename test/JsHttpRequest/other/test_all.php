<html>
<head></head>
<body>
<script language="JavaScript" 
 src="../../lib/JsHttpRequest/JsHttpRequest.js"></script>
<script>
    // Called on button press.
    function request(loader, method, data, data2) {
        // Create new JsHttpRequest object.
        var req = new JsHttpRequest();
        // Code automatically called on load finishing.
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.responseJS) {
                    // Write result to page element. 
                    document.getElementById('result').innerHTML = 
                        '<b>MD5("'+(req.responseJS.q||'')+'")</b> = ' +
                        '"' + (req.responseJS.md5||'') + '"<br> ' +
                        '<b>Session data:</b> ' + 
                        '"' + (req.responseJS.hello || 'unknown') + '"<br>';
                }
                // Write debug information too.
                document.getElementById('debug').innerHTML = req.responseText;
            }
        }
        // Allow caching (to avoid different server queries for 
        // identical input data). Caching is always disabled if
        // we are uploading a file.
        req.caching = false;
        // Prepare request object.
        req.loader = loader;
        req.open(method, 'load.php?static=abc', true);
        // Send data (random JavaScript hash).
        var data = { 
            q: data, 
            test: { 
                'time': new Date().getTime(), 
                'data2': data2 
            }
        };
        if (data2 == null) delete data.test.data2;
        req.send(data);
    }
</script>

<table width="100%" border="1">
<tr valign="top">
<td>
    <form style="padding:2px">
        <h3>Simple sending</h3>
        Text: <input type="text" name="text" value="<?=time()?>">
        <i>Type "error" to show debug capabilities.</i><br>
        <table>
        <?foreach (array('', 'get', 'post') as $method) {?>
            <tr>
            <td><?=$method? strtoupper($method) : 'AUTO'?>:</td>
            <td>
                <?foreach (array('', 'xml', 'script', 'form') as $loader) {?>
                    <input type="button" 
                        onclick="request('<?=$loader?>', '<?=$method?>', this.form.text.value)" 
                        value="<?=$loader? $loader : 'AUTO'?>"
                    >
                <?}?>
            </td>
            </tr>
        <?}?>
        </table>    
    </form>
</td>
<td>
    <form style="padding:2px" enctype="multipart/form-data">
        <h3>Enhanced sending (with file)</h3>
        <input type="hidden" name="no_send" value="!!!">
        Text: <input type="text" name="text" value="<?=microtime()?>">
        <i>Type "error" to show debug capabilities.</i><br>
        File: <input type="file" name="file"><br>
        <table>
        <?foreach (array('', 'get', 'post') as $method) {?>
            <tr>
            <td><?=$method? strtoupper($method) : 'AUTO'?>:</td>
            <td>
                <?foreach (array('', 'xml', 'script', 'form') as $loader) {?>
                    <input type="button" 
                        onclick="request('<?=$loader?>', '<?=$method?>', this.form.text.value, this.form.file)" 
                        value="<?=$loader? $loader : 'AUTO'?>"
                    >
                <?}?>
            </td>
            </tr>
        <?}?>
        </table>    
    </form>
</td>
</tr>
<tr valign="top">
<td>
    <form style="padding:2px" enctype="multipart/form-data">
        <h3>Whole form sending</h3>
        Text: <input type="text" name="text" value="<?=microtime()?>">
        <i>Type "error" to show debug capabilities.</i><br>
        File: <input type="file" name="file"><br>
        <table>
        <?foreach (array('', 'get', 'post') as $method) {?>
            <tr>
            <td><?=$method? strtoupper($method) : 'AUTO'?>:</td>
            <td>
                <?foreach (array('', 'xml', 'script', 'form') as $loader) {?>
                    <input type="button" 
                        onclick="request('<?=$loader?>', '<?=$method?>', this.form, 'custom data!')" 
                        value="<?=$loader? $loader : 'AUTO'?>"
                    >
                <?}?>
            </td>
            </tr>
        <?}?>
        </table>    
    </form>
</td>
<td>
    <div id="dyn"></div>
    <script>
    setTimeout(function() {
        document.getElementById('dyn').innerHTML = 
        '   <form style="padding:2px" enctype="multipart/form-data">'+
        '       <h3>InnerHTML assigned form</h3>' +
        '       <input type="hidden" name="no_send" value="!!!">'+
        '       Text: <input type="text" name="text" value="<?=microtime()?>">'+
        '       <i>Type "error" to show debug capabilities.</i><br>'+
        '       File: <input type="file" name="file"><br>'+
        '       <input type="button" '+
        '           onclick="request(null, null, this.form.text.value, this.form.file)" '+
        '           value="FORM POST"'+
        '       >'+
        '   </form>'
    }, 200);
    </script>
</td>
</tr>
</table>

<!-- Use only DIV. Do not use P - IE do not allow to insert XMP inside P! -->
<div id="result" style="border:1px solid #000; padding:2px">
    Structured results
</div>
<div id="debug" style="border:1px dashed red; padding:2px">
    Debug info
</div>

</body>
</html>
<br><br><br><br><br><br><br><br><br>
<hr><?show_source(__FILE__)?>