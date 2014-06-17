<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: POST form without enctype (errorous)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <!-- 
        Do not skip enctype here: if skipped, FF returned "", 
        IE - "application/x-www-form-urlencoded". This breaks
        all the tests.
    -->
    <form enctype="application/x-www-form-urlencoded">
        <input type="hidden" id="elem" name="elem" value="101" />
    </form>
    <script>
    doQuery('form', 'post', '', document.getElementById('elem'));
    </script>
</div>


<pre id="EXPECT">
JsHttpRequest: Attribute "enctype" of the form must be "multipart/form-data" (for IE), "application/x-www-form-urlencoded" given.
</pre>