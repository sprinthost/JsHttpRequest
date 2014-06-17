<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: PHP session support
</div>

<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    if (hasCookies()) {
        setTimeout(function() {
            doQuery('script', 'get', 'session-set', null, true, null, true);
        }, 10);
        setTimeout(function() {
            doQuery('form', 'post', 'session-get', null, true, null, true);
        }, 3000);
    } else {
        JsTest.skip();
    }
    </script>
</div>


<pre id="EXPECT">
MD5("session-set") = "11554d0f24a2f96e5dc64a958ca6c516"
QUERY_STRING: q=session-set
Request method: GET
Loader used: script
Uploaded file size: 
_GET: Array
(
    [q] => session-set
)
_POST: Array
(
)
_FILES: Array
(
)

MD5("session-get") = "291245484ff158bc7ff2528eb31e9d91"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [q] => session-get
)
_FILES: Array
(
)
_SESSION[test]: test_value
</pre>
