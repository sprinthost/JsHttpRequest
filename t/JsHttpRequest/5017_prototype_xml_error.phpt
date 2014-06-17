<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: prototype integration (500 error)
</div>

<?include "contrib/init.php"?>
<script language="JavaScript" src="contrib/prototype.js"></script>
<script type="text/javascript" language="JavaScript" src="../../lib/JsHttpRequest/JsHttpRequest-prototype.js?<?=time()?>"></script>

<div id="FILE">
    <script>
    new Ajax.Request('xml.GET contrib/loader.php', {
        parameters: { q: 'error'},
        onFailure: function(transport) {
            JsTest.write('Error code: ' + transport.status + '\n');
            JsTest.analyze();
        },
        onSuccess: function(transport) {
            JsTest.write(transport.responseJS);
            JsTest.analyze();
        }
    });    
    </script>
</div>

<pre id="EXPECT">
Error code: 500 
</pre>