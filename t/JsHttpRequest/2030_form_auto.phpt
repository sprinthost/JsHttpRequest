<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: AUTO method
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('form', null, 123);
    </script>
</div>


<pre id="EXPECT">
MD5("123") = "202cb962ac59075b964b07152d234b70"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [q] => 123
)
_FILES: Array
(
)
</pre>
