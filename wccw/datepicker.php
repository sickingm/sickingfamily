<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>jQuery Datepicker</title>
	<link href="/common/datepicker/css/jquery.datepick.css" rel="stylesheet">
	<script src="/common/js/jquery.min.js"></script>
	<script src="/common/datepicker/js/jquery.plugin.min.js"></script>
	<script src="/common/datepicker/js/jquery.datepick.js"></script>
	<script>
		$(function() {
			$('#multi999Picker').datepick({
				multiSelect: 999,
				minDate: 0,
				showTrigger: '#calImg',
			});
		});
	</script>
</head>

<body>


	<?php
	echo 'ABC<pre>';
	print_r($_REQUEST);
	echo '</pre>';
	?>


	<h1>jQuery Datepicker</h1>
	<form method="get">
		<textarea id="multi999Picker" name='dates' style='width:25em; height: 8em;'></textarea>
		<input type="submit">
	</form>
</body>

</html>