<style type="text/css">
	div.odd {
		background: #ddd;
	}
	pre {
		display: none;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('div.log h4').click(function() {
			$(this).parent().find('pre').toggle();
		});
		$('a#toggle_all').click(function() {
			$('pre').toggle();
		});
	});
</script>
<h1>Log Helper</h1>
<h3>Viewing <?php echo $file ?></h3>
<p><a href="#" id="toggle_all">Toggle All</a></p>
<?php $cnt = 0; ?>
<?php foreach ($messages as $msg): ?>
<div id="message_<?php echo md5($msg['time'] . $msg['message']) ?>" class="log <?php echo $cnt++ % 2 ? 'even' : 'odd' ?>">
	<h4><span class="date"><?php echo date('Y-m-d H:i:s', $msg['time']) ?></span> <?php echo htmlentities(preg_replace('/\n.*/', '', $msg['message'])) ?></h4>
	<pre><?php echo htmlentities($msg['message']) ?></pre>
</div>
<?php endforeach ?>
