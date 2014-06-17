<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: complex data passing
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', null, { a: 123, b: 456 });
    </script>
</div>


<pre id="EXPECT">
MD5({ "a": "123", "b": "456" }) = "43836ae3365c71ee8a8c3e004c139cd2" 
QUERY_STRING: q[a]=123&q[b]=456 
Request method: GET 
Loader used: script 
Uploaded file size:  
_GET: Array 
( 
    [q] => Array 
        ( 
            [a] => 123 
            [b] => 456 
        ) 
 
) 
_POST: Array 
( 
) 
_FILES: Array 
( 
) 
</pre>