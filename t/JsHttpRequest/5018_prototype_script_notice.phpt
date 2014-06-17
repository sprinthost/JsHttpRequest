<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: prototype integration (notices)
</div>

<?include "contrib/init.php"?>
<script language="JavaScript" src="contrib/prototype.js"></script>
<script type="text/javascript" language="JavaScript" src="../../lib/JsHttpRequest/JsHttpRequest-prototype.js?<?=time()?>"></script>

<div id="FILE">
    <script>
    new Ajax.Request('xml.GET contrib/loader.php', {
        parameters: { q: 'notice'},
        onFailure: function(transport) {
        },
        onSuccess: function(transport) {
            JsTest.write(transport.responseText.match(/(Notice)/)? 'Notice happened' : '');
            JsTest.analyze();
        }
    });    
    </script>
</div>

<pre id="EXPECT">
Notice happened
</pre>