<div id="TEST">
    <?=basename($_SERVER['REQUEST_URI'])?>: PHP fatal error handling
</div>


<?include "contrib/init.php"?>
<div id="FILE">
    <script>
    setTimeout(
        function() {
			doQuery('xml', 'get', "error", null, null, function(req) {
			    // Note that Opera resets responseText on non-200 Status,
			    // so we chech status, not error text.
				if (req.readyState == 4) {
					JsTest.write("Status: " + req.status);
					JsTest.analyze();
				}
			});
        },
        100
    );

    </script>
</div>


<pre id="EXPECT">
Status: 500
</pre>
