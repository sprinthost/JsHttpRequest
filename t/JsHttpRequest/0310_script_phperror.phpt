<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: PHP fatal error handling
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    setTimeout(
        function() {
            JsHttpRequest.query('script.GET contrib/loader.php', { q: 'error' }, function(reqJs, reqText) {
                if ((""+reqText).match(/(Fatal error)/)) {
                    JsTest.write("Error handled successfully: " + RegExp.$1 + "!");
                } else {
                    JsTest.write("Error not handled: " + reqText);
                }
                JsTest.analyze();
            })
        },
        100
    );

    </script>
</div>


<pre id="EXPECT">
Error handled successfully: Fatal error!
</pre>
