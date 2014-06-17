<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: pass scalar parameter as QUERY_STRING and query() method
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    setTimeout(
        function() {
            JsHttpRequest.query('script.GET contrib/loader.php', 123, function(reqJs, reqText) {
                JsTest.write(reqText);
                JsTest.analyze();
            })
        },
        100
    );
    </script>
</div>


<pre id="EXPECT">
QUERY_STRING: 123
Request method: GET
Loader used: script
Uploaded file size: 
_GET: Array
(
    [123] => 
)
_POST: Array
(
)
_FILES: Array
(
)
</pre>
