<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: readyState changes
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('form', null, 123, null, null, function(req) {
        JsTest.write("readyState = " + req.readyState + "\n");
        if (req.readyState == 4) {
            setTimeout(function() { JsTest.analyze() }, 500);
        }
    });
    </script>
</div>


<pre id="EXPECT">
readyState = 1
readyState = 2
readyState = 3
readyState = 4
</pre>
