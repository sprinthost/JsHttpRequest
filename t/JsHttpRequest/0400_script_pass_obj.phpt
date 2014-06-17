<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: pass an object from PHP
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', 'get', 'object', null, null, function(req) {
        if (req.readyState == 4) {
            JsTest.write(typeof req.responseJS.obj == 'object'? 'Object returned' : '');
            JsTest.analyze();
        }
    });
    </script>
</div>


<pre id="EXPECT">
Object returned
</pre>
