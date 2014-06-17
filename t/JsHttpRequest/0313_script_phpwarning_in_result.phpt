<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: PHP fatal error handling prepended by a warning
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    setTimeout(
        function() {
            JsHttpRequest.query('script.GET contrib/loader_no_display_errors.php', { q: 'warning_in_result' }, function(reqJs, reqText) {
                JsTest.write(reqJs.custom);
                JsTest.analyze();
            })
        },
        100
    );

    </script>
</div>


<pre id="EXPECT">
Test
</pre>
