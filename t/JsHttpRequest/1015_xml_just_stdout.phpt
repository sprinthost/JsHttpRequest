<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: GET method, null $_RESULT
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('xml', 'get', "just_stdout", null, null, function(req) {
        if (req.readyState == 4) {
            JsTest.write("Status: " + req.status + "\nResult: " + req.responseText);
            JsTest.analyze();
        }
    });
    </script>
</div>


<pre id="EXPECT">
Status: 200 
Result: some stdout
</pre>

<pre id="EXPECT_noxml" style="display:none">
JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported
</pre>