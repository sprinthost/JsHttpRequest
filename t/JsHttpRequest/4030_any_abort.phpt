<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: abort() method and readyState sequences
</div>


<?include "contrib/init.php"?>

<pre style="border:1px solid; background: yellow" class="file">
<b>Damn! Browsers work with abort() and onreadystatechange() differently!</b>

<b>FireFox 2.0:</b>
neve->abort, native: 0->open->1 1->send->1->2->3->4
star->abort, native: 0->abort 0->open 1->send
open->abort, native: 0->open->1 1->abort->4 0->send
send->abort, native: 0->open->1 1->send->1 1->abort->4

<b>Internet Explorer 7.0:</b>
neve->abort, native: 0->open->1 1->send->1->2->3->4
star->abort, native: 0->abort 0->open->1 1->send->1->2->3->4
open->abort, native: 0->open->1 1->abort 0->send
send->abort, native: 0->open->1 1->send->1 1->abort->4

<b>Opera 9.10:</b>
neve->abort, native: 0->open->1 1->send->3->4
star->abort, native: 0->abort 0->open->1 1->send->3->4
open->abort, native: 0->open->1 1->abort 0->send
send->abort, native: 0->open->1 1->send 1->abort
</pre>
<div style="clear:both"></div>


<div id="FILE">
    <script>
    // This function takes 2500 ms MINIMUM!
    // 1000 ms delay is always produced by loader.php?dt=1.
    function doQueryWithAbort(loader, method, after) {
        var req = null;
        var t = 0;
        var lName = loader + ':';
        for (var i = lName.length; i < 7; i++) lName += ' ';
        JsTest.write("\n" + after.substring(0, 4) + "->abort, " + lName);
        
        function abort() {
            JsTest.write(' ' + req.readyState + '->abort'); 
            req.abort();
        }
        
        if (loader == "native") {
            req = window.XMLHttpRequest? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            req = new JsHttpRequest();
        }
        req.caching = false;
        req.loader = loader;
        req.onreadystatechange = function() {
            JsTest.write('->' + req.readyState);
        }
        
        setTimeout(function() {
            if (after == "start") abort();
        }, t += 50);
        
        setTimeout(function() {
            JsTest.write(' ' + req.readyState + "->open");  
            req.open("GET", 'contrib/loader.php?dt=1', true);
        }, t += 10);
        
        setTimeout(function() {
            if (after == "open") abort();
        }, t += 300);
        
        setTimeout(function() {
            JsTest.write(' ' + req.readyState + "->send");
            try {  
                req.send(null);
            } catch (e) {
                if (e.description && !e.message) e.message = e.description; // for IE5
                var msg = (e.message != null? e.message : e.toString()) . replace(/^Error:\s+/g, '');
                JsTest.write(" " + msg + (!msg.match(/^JsHttpRequest:/) && e.fileName? '\nat ' + e.fileName + ':' + e.lineNumber : ''));
            }
        }, t += 10);
        
        setTimeout(function() {
            if (after == "send") abort();
        }, t += 500);
        
        return t;
    }    
    
    var loaders = [
        //'native', // debug purpose, to get ORIGINAL (native) map
        'script', 
        'xml', 
        'form',
        null  // for better debugging
    ];
    var afters = [
        'never', 
        'start', 
        'open', 
        'send',
        null // for better debugging
    ];
    
    JsTest.setMaxTimeout(7000);
    setTimeout(function() {
        // Copy EXPECT_noxml to EXPECT if needed.
        var e = document.getElementById('EXPECT_noxml');
        if (!hasXml() && e) {
            document.getElementById('EXPECT').innerHTML = e.innerHTML;
        }
        
        // Hack for Opera8+: it does not support async SCRIPT loading.
        // Opera 7.20 supports async SCRIPT creation (it does not have .version property).
        if (window.opera && window.opera.version) {
            e = document.getElementById('EXPECT');
            e.innerHTML = e.innerHTML.replace(/send[^\n]+abort[^\n]+script[^\n]+/, document.getElementById('EXPECT_opera8_hack').innerHTML.replace(/\s+$/, ''));
        }
    
        var dt = 60;
        for (var j = 0; j < afters.length; j++) {
            if (!afters[j]) continue;
            for (var i = 0; i < loaders.length; i++) {
                if (!loaders[i]) continue;
                (function(i, j) {
                    setTimeout(function() {
                        if (!i) JsTest.write('\n');
                        doQueryWithAbort(loaders[i], 'get', afters[j]);
                    }, dt);
                })(i, j);
                dt += 4000;
            }
        }
    }, 300);
    </script>
</div>


<pre id="EXPECT">
neve->abort, script: 0->open->1 1->send->1->2->3->4
neve->abort, xml:    0->open->1 1->send->1->2->3->4
neve->abort, form:   0->open->1 1->send->1->2->3->4

star->abort, script: 0->abort 0->open->1 1->send->1->2->3->4
star->abort, xml:    0->abort 0->open->1 1->send->1->2->3->4
star->abort, form:   0->abort 0->open->1 1->send->1->2->3->4

open->abort, script: 0->open->1 1->abort 0->send
open->abort, xml:    0->open->1 1->abort 0->send
open->abort, form:   0->open->1 1->abort 0->send

send->abort, script: 0->open->1 1->send->1 1->abort->4
send->abort, xml:    0->open->1 1->send->1 1->abort->4
send->abort, form:   0->open->1 1->send->1 1->abort->4
</pre>


<pre id="EXPECT_noxml" style="display:none">
neve->abort, script: 0->open->1 1->send->1->2->3->4 
neve->abort, xml: 0->open->1 1->send->1 JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported 
neve->abort, form: 0->open->1 1->send->1->2->3->4 

star->abort, script: 0->abort 0->open->1 1->send->1->2->3->4 
star->abort, xml: 0->abort 0->open->1 1->send->1 JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported 
star->abort, form: 0->abort 0->open->1 1->send->1->2->3->4 

open->abort, script: 0->open->1 1->abort 0->send 
open->abort, xml: 0->open->1 1->abort 0->send 
open->abort, form: 0->open->1 1->abort 0->send 

send->abort, script: 0->open->1 1->send->1 1->abort->4 
send->abort, xml: 0->open->1 1->send->1 JsHttpRequest: Cannot use XMLHttpRequest or ActiveX loader: not supported 1->abort 
send->abort, form: 0->open->1 1->send->1 1->abort->4
</pre>


<pre id="EXPECT_opera8_hack" style="display:none">
send->abort, script: 0->open->1 1->send->1->2->3->4 4->abort->4
</pre>