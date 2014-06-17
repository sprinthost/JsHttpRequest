<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: AUTO method (must be GET)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', null, 123);
    </script>
</div>


<pre id="EXPECT">
MD5("123") = "202cb962ac59075b964b07152d234b70"
QUERY_STRING: q=123
Request method: GET
Loader used: script
Uploaded file size: 
_GET: Array
(
    [q] => 123
)
_POST: Array
(
)
_FILES: Array
(
)
</pre>