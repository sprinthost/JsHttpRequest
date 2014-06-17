<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: whole form sending 
</div>

<?include "contrib/init.php"?>

<div id="FILE">
</div>

<script>
var origTm = null;
runAllTests = function() {
    JsTest.initialize();
    JsTest.setMaxTimeout(origTm);
    JsTest.getDiv('FILE').innerHTML = '';
    
    var t = 0;

    var c1 = function() {
        for (var i = 0; i < form().elements.length; i++) {
            if ((form().elements[i].type||'').toLowerCase() == 'button') continue;
            JsTest.write('element: "' + form().elements[i].name + '"\n');
        }
        JsTest.write("\n");
    };
    setTimeout(c1, t += 10);

    var c2 = function() {
        doQuery('form', 'post', 'abc', form(), true, null, true);
    };
    setTimeout(c2, t += 10);

    var c3 = function() {
        doQuery('form', 'post', 'abc', form(), true, null, true);
    };
    setTimeout(c3, t += 3000);
    
    var c4 = function() {
        doQuery('form', 'post', 'abc', form(), true, null, true);
    };
    setTimeout(c4, t += 3000);
    
    var c5 = function() {
        JsTest.write("\n");
        for (var i = 0; i < form().elements.length; i++) {
            if ((form().elements[i].type||'').toLowerCase() == 'button') continue;
            JsTest.write('element: "' + form().elements[i].name + '"\n');
        }
        setTimeout("JsTest.analyze()", 500);
    };
    setTimeout(c5, t += 3000);

    return t;
}
origTm = JsTest.setMaxTimeout(100000000);
if (parent.JsTestIterator) runAllTests();
</script>


<pre id="EXPECT">
element: "f"
element: "t"

MD5("abc") = "900150983cd24fb0d6963f7d28e17f72"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [t] => abcd
    [q] => abc
)
_FILES: Array
(
    [f] => Array
        (
            [name] => ***
            [type] => ***
            [tmp_name] => ***
            [error] => 0
            [size] => ***
        )

)

MD5("abc") = "900150983cd24fb0d6963f7d28e17f72"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [t] => abcd
    [q] => abc
)
_FILES: Array
(
    [f] => Array
        (
            [name] => ***
            [type] => ***
            [tmp_name] => ***
            [error] => 0
            [size] => ***
        )

)

MD5("abc") = "900150983cd24fb0d6963f7d28e17f72"
QUERY_STRING: 
Request method: POST
Loader used: form
Uploaded file size: 
_GET: Array
(
)
_POST: Array
(
    [t] => abcd
    [q] => abc
)
_FILES: Array
(
    [f] => Array
        (
            [name] => ***
            [type] => ***
            [tmp_name] => ***
            [error] => 0
            [size] => ***
        )

)


element: "f"
element: "t"
</pre>
