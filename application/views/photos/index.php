<?php if (count($photos) <= 0) return ?>
<ul data-role="listview" data-inset="true">
	<?php foreach ($photos as $photo): ?>
	<li>
		<a href="<?php echo URL::site('photos/view/'.$photo->file->fid) ?>">
			<?php echo ImageCache::thumb($photo->file->filepath, "100x100") ?>
			<p><?php echo $photo->field_images_fid ?> - <?php echo $photo->file->fid ?>: <?php echo $photo->file->filename ?></p>
		</a>
		<a href="<?php echo URL::site('photos/view/'.$photo->file->fid) ?>" data-theme="c">Expand</a>
	</li>
	<?php endforeach ?>
</ul>

<?php echo $pagination ?>