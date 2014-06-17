<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: whole form sending 
</div>

<?include "contrib/init.php"?>

<div id="FILE">
</div>

<script>
var t = 0;

setTimeout(function() {
    for (var i = 0; i < form().elements.length; i++) {
        if ((form().elements[i].type||'').toLowerCase() == 'button') continue;
        JsTest.write('element: "' + form().elements[i].name + '"\n');
    }
    JsTest.write("\n");
}, t += 10);

setTimeout(function() {
    doQuery('form', 'post', '12', form().t, true, null, true);
}, t += 100);

setTimeout(function() {
    doQuery('form', 'post', '12', form().t, true, null, true);
}, t += 3000);

setTimeout(function() {
    doQuery('form', 'post', '12', form().t, true, null, true);
}, t += 3000);

setTimeout(function() {
    JsTest.write("\n");
    for (var i = 0; i < form().elements.length; i++) {
        if ((form().elements[i].type||'').toLowerCase() == 'button') continue;
        JsTest.write('element: "' + form().elements[i].name + '"\n');
    }
    setTimeout(function() { JsTest.analyze() }, 500);
}, t += 3000);
</script>


<pre id="EXPECT">
element: "f"
element: "t"

MD5("12") = "c20ad4d76fe97759aa27a0c99bff6710"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [e] => abcd
    [q] => 12
)
_FILES: Array
(
)

MD5("12") = "c20ad4d76fe97759aa27a0c99bff6710"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [e] => abcd
    [q] => 12
)
_FILES: Array
(
)

MD5("12") = "c20ad4d76fe97759aa27a0c99bff6710"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [e] => abcd
    [q] => 12
)
_FILES: Array
(
)


element: "f"
element: "t"
</pre>
