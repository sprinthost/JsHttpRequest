<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: orphaned form element (errorous)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <input type="hidden" id="elem" name="elem" value="101" />
    <script>
    doQuery('form', 'get', '', document.getElementById('elem'));
    </script>
</div>


<pre id="EXPECT">
JsHttpRequest: Element "elem" does not belong to any form!
</pre>