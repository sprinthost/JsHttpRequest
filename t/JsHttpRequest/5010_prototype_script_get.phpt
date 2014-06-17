<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: prototype integration (script.GET method)
</div>

<?include "contrib/init.php"?>
<script language="JavaScript" src="contrib/prototype.js"></script>
<script type="text/javascript" language="JavaScript" src="../../lib/JsHttpRequest/JsHttpRequest-prototype.js?<?=time()?>"></script>

<div id="FILE">
    <script>
    new Ajax.Request('script.GET contrib/loader.php', {
        method: 'get',
        parameters: { q: 'abc' },
        onSuccess: function(transport) {
            JsTest.write('text:\n' + transport.responseText);
            JsTest.write('md5: ' + transport.responseJS.md5);
            JsTest.analyze();
        }
    });    
    </script>
</div>

<pre id="EXPECT">
text: 
QUERY_STRING: q=abc 
Request method: GET 
Loader used: script 
Uploaded file size:  
_GET: Array 
( 
    [q] => abc 
) 
_POST: Array 
( 
) 
_FILES: Array 
( 
) 
 
md5: 900150983cd24fb0d6963f7d28e17f72
</pre>