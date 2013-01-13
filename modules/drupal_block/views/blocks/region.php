<ul class="blocks <?php echo $region ?>">
<?php foreach ($blocks as $block): ?>
	<?php $content = $block->render() ?>
	<?php if ( ! empty($content)): ?>
		<li><?php echo $block ?></li>
	<?php endif ?>
<?php endforeach ?>
</ul>