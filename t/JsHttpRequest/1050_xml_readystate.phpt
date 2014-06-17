<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: readyState changes
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('xml', null, 123, null, null, function(req) {
        JsTest.write("readyState = " + req.readyState + "\n");
        if (req.readyState == 4) {
            setTimeout("JsTest.analyze()", 500);
        }
    });
    </script>
</div>


<pre id="EXPECT">
readyState = 1
readyState = 2
readyState = 3
readyState = 4
</pre>


<pre id="EXPECT_noxml" style="display:none">
readyState = 1 
JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported
</pre>