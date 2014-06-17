<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: GET method, null $_RESULT and null STDOUT are okay
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', 'get', "empty_stdout", null, null, function(req) {
        if (req.readyState == 4) {
            JsTest.write("Status: " + req.status);
            JsTest.analyze();
        }
    });
    </script>
</div>


<pre id="EXPECT">
Status: 200
</pre>


<pre id="EXPECT_noxml" style="display:none">
JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported
</pre>