<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: GET method, converting null in $_RESULT to false
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', 'get', "null_result", null, null, function(req) {
        if (req.readyState == 4) {
            JsTest.write("Result is false: " + (req.responseJS === false? "yes" : "no"));
            JsTest.analyze();
        }
    });
    </script>
</div>


<pre id="EXPECT">
Result is false: yes
</pre>


<pre id="EXPECT_noxml" style="display:none">
JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported
</pre>