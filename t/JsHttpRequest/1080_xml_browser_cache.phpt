<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: native browser caching support
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('xml', 'get', 123, null, false);
    </script>
</div>


<pre id="EXPECT">
MD5("123") = "202cb962ac59075b964b07152d234b70" 
Zero loading ID: yes 
QUERY_STRING: q=123 
Request method: GET 
Loader used: xml 
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


<pre id="EXPECT_noxml" style="display:none">
JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported
</pre>
