<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: PHP fatal error handling prepended by a warning
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    setTimeout(
        function() {
            JsHttpRequest.query('script.GET contrib/loader_no_display_errors.php', { q: 'warning_and_error' }, function(reqJs, reqText) {
                if (reqText == "") {
                    JsTest.write("Error handled successfully, no warnings is in the text");
                } else {
                    JsTest.write("Error not handled: " + reqText);
                	JsTest.write("\nOutput (must be empty):\n" + reqText);
                }
                JsTest.analyze();
            })
        },
        100
    );

    </script>
</div>


<pre id="EXPECT">
Error handled successfully, no warnings is in the text
</pre>
