<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: UTF-8 support
</div>


<?include "contrib/init.php"?>

<?header('Content-type: text/html; charset=utf-8')?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">

<div id="FILE">
    <script>
    setTimeout(
        function() {
            JsHttpRequest.query('script.GET contrib/loader_utf8.php', { q: 'Строка запроса' }, function(reqJs, reqText) {
                JsTest.write(reqJs.q + "\n");
                JsTest.write(reqJs.hello + "\n");
                JsTest.analyze();
            })
        },
        100
    );

    </script>
</div>


<pre id="EXPECT">
"Строка запроса" 
Это строка в UTF-8 
</pre>
