<meta http-equiv="Content-type" content="text/html; charset=windows-1251">

<!-- Include testing suite. -->
<link rel="stylesheet" type="text/css" href="JsTest/JsTest.css?<?=time()?>"/>
<script type="text/javascript" language="JavaScript" src="JsTest/JsTest.js?<?=time()?>"></script>
<script type="text/javascript" language="JavaScript" src="../../lib/JsHttpRequest/<?=isset($_GET['debug'])? 'debug/' : ''?>JsHttpRequest.js?<?=time()?>"></script>

<div style='clear:both; margin-bottom: 13px'>
    <?$_SERVER['REQUEST_URI'] = preg_replace('/([&?]\d+)+$/', '', $_SERVER['REQUEST_URI'])?> 
    <a href="<?=$_SERVER['REQUEST_URI'] . (strpos($_SERVER['REQUEST_URI'], '?')? '&' : '?') . time()?>">Refresh</a> | <a href=".">Index</a>
</div>

<!-- Common code used for all test scripts. -->
<form enctype="multipart/form-data" id="form">
    <table border=0 cellpadding="0" cellspacing="0">
    <tr>
        <td>File:</td>
        <td>&nbsp;<input type="file" id="e_file" name="f" size="40">
            - <font color="red">Attention! Please download the file <a href="contrib/test_file.txt">test_file.txt</a> to a local disc and specify them here!</font>
        </td>
    </tr>
    <tr>
        <td>Text:</td>
        <td>&nbsp;<input type="text" id="e_text" name="t" size="40" value="abcd">
        	- <font color="red">Attention! Do not modify this field!</font>
        </td>
    </tr>
    <tr id="runAllButton"><td colspan="2">
        <input type="button" onclick="if (0 && !this.form.f.value.match(/test_file.txt$/)) alert('You have not selected a proper file to upload! Please select test_file.txt!'); else runAllTests()" value="Run all the tests" style="width:100%">
    </td></tr>
    </table>
</form>

<script>
// Replace standard timeout functions with safe wrappers. This is needed because of 
// IE 5.0 reference counting bug while using of setTimeout(), please note comments
// inside the JsHttpRequest library.
window.setTimeout = JsHttpRequest.setTimeout;
window.clearTimeout = JsHttpRequest.clearTimeout;

function doQuery(loader, method, q, elt, nocache, onchange, skipAnalyze, addInit) {
    var closure = function() {
        // Case when no XML is supported.
        var e = document.getElementById('EXPECT_noxml');
        if (e && !hasXml()) {
            document.getElementById('EXPECT').innerHTML = e.innerHTML;
        }
        
        try {
            var req = new JsHttpRequest();
            req.loader = loader;
            req.caching = !nocache;
            req.open(method, 'contrib/loader.php');
            req.onreadystatechange = function() {
                if (onchange) {
                    onchange(req);
                } else {
                    if (req.readyState != 4) return;
                    // This function is called on data ready (readyState=4).
                    // Write result to page element ($_RESULT become responseJS).
                    var text = 'MD5(' + req.responseJS.q + ') = "' + req.responseJS.md5 + '"\n' + req.responseText + "\n\n";
                    JsTest.write(text);
                    if (!skipAnalyze) {
                        JsTest.analyze();
                    }
                }
            }
            if (addInit) addInit(req);
            req.send({ q: q, e: elt? elt : null });
        } catch (e) {
            if (e.description && !e.message) e.message = e.description; // for IE5 
            var msg = (e.message != null? e.message : e.toString()) . replace(/^Error:\s+/g, '');
            
            // Work-around for similar messages ("for ... in" iterates elements with 
            // different order in different browsers).
            msg = msg.replace(/(Element).*(belongs)/g, '$1 *** $2');
             
            JsTest.write(msg + (!msg.match(/^JsHttpRequest:/) && e.fileName? '\nat ' + e.fileName + ':' + e.lineNumber : ''));
            if (!skipAnalyze) {
                JsTest.analyze();
            }
        }
    };
    setTimeout(closure, 100);
}

function form() {
    return parent.document.getElementById('form');
}

function hasXml() {
    var xr = null;
    if (window.XMLHttpRequest) {
        try { xr = new XMLHttpRequest() } catch(e) {}
    } else if (window.ActiveXObject) {
        try { xr = new ActiveXObject("Microsoft.XMLHTTP") } catch(e) {}
        if (!xr) try { xr = new ActiveXObject("Msxml2.XMLHTTP") } catch (e) {}
    }
    return !!xr;
}

function hasCookies() {
    document.cookie = 'testcookie=1';
    return (document.cookie+'').match(/testcookie=1/); 
}

function runAllTests() {
}

if (parent.window != window) {
    document.getElementById('form').style.display = "none";
    document.getElementById('runAllButton').style.display = "none";
}
JsTest.initialize();
</script>
