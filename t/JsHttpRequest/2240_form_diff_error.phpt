<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: different form elements (errorous)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <form>
        <input type="hidden" id="elem" name="elem" value="101" />
    </form>
    <script>
    doQuery('form', 'get', form().e_text, document.getElementById('elem'));
    </script>
</div>


<pre id="EXPECT">
JsHttpRequest: Element *** belongs to a different form. All elements must belong to the same form!
</pre>