<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: too long url (errorous)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    var s = '';
    for (var i = 0; i < 1000; i++) s += i + '-';
    doQuery('form', 'get', s);
    </script>
</div>


<pre id="EXPECT">
JsHttpRequest: Cannot use so long query with GET request (URL is larger than 2000 bytes)
</pre>