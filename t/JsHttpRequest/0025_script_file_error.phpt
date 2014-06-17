<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: passing a file element (errorous)
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    doQuery('script', null, 123, form().e_file);
    </script>
</div>


<pre id="EXPECT">
JsHttpRequest: Cannot use SCRIPT loader: direct form elements using and uploading are not implemented
</pre>