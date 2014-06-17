<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: POST method (errorous)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', 'post', 123);
    </script>
</div>


<pre id="EXPECT">
JsHttpRequest: Cannot use SCRIPT loader: it supports only GET method
</pre>
