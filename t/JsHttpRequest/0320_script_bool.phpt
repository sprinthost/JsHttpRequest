<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: JS boolean values
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', null, { t: true, f: false, n: null });
    </script>
</div>


<pre id="EXPECT">
MD5({ "t": "1", "f": "" }) = "341b898d91bc7b21c7d25c901d8ed4e7" 
QUERY_STRING: q[t]=1&q[f]= 
Request method: GET 
Loader used: script 
Uploaded file size:  
_GET: Array 
( 
    [q] => Array 
        ( 
            [t] => 1 
            [f] =>  
        ) 
 
) 
_POST: Array 
( 
) 
_FILES: Array 
( 
)
</pre>
