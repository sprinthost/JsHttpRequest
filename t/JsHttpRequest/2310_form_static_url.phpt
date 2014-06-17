<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: pass static variable via GET in URL
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    setTimeout(
        function() {
            JsHttpRequest.query('form.POST contrib/loader.php?static=123', { q: "abc" }, function(reqJs, reqText) {
                JsTest.write(reqText);
                JsTest.analyze();
            })
        },
        100
    );

    </script>
</div>


<pre id="EXPECT">
QUERY_STRING: static=123
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
    [static] => 123
)
_POST: Array
(
    [q] => abc
)
_FILES: Array
(
)
</pre>
