<?php if (count($images) <= 0) return ?>
<ul data-role="listview" data-inset="true">
	<li data-role="list-divider"><?php echo isset($title) ? $title : 'Images' ?></li>
	<?php foreach ($images as $image): ?>
	<li>
		<a href="<?php echo ImageCache::raw_path($image->filepath) ?>">
			<?php echo ImageCache::thumb($image->filepath, "100x100") ?>
		</a>
	</li>
	<?php endforeach ?>
</ul>