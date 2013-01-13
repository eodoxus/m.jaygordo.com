<div class="post <?php echo $post->type ?>">
	<h1><?php echo $post->title ?></h1>

	<?php echo Module::render('tags')->set('terms', $post->terms->find_all()) ?>
	
	<div class="body">
		<?php echo $post->body() ?>
	</div>
	
	<?php echo Module::render('thumbs')->set('images', $post->images->find_all()) ?>
</div>