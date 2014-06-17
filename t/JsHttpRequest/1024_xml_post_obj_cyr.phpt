<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: POST method & stdObj with cyrillic
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', 'get', 'obj_cyr', null, null, function(req) {
        if (req.readyState == 4) {
            JsTest.write(req.responseJS.obj.a + "\n");
            JsTest.write(req.responseJS.obj.b + "\n");
            JsTest.analyze();
        }
    });
    </script>
</div>


<pre id="EXPECT">
english 
кирилица
</pre>