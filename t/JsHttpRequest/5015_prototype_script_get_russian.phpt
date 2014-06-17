<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: prototype integration (national encoding)
</div>

<?include "contrib/init.php"?>
<script language="JavaScript" src="contrib/prototype.js"></script>
<script type="text/javascript" language="JavaScript" src="../../lib/JsHttpRequest/JsHttpRequest-prototype.js?<?=time()?>"></script>

<div id="FILE">
    <script>
    new Ajax.Request('script.GET contrib/loader.php', {
        parameters: { q: 'проверка' },
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
QUERY_STRING: q=%u043F%u0440%u043E%u0432%u0435%u0440%u043A%u0430 
Request method: GET 
Loader used: script 
Uploaded file size:  
_GET: Array 
( 
    [q] => проверка 
) 
_POST: Array 
( 
) 
_FILES: Array 
( 
) 
 
md5: ff05c0fd1f49ee9bc5568e7309a5348b
</pre>