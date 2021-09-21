<div id="main">
		<div class="container">
			<?php if(isset($_SESSION['is_logged_in'])) { ?>
			<div class="row">
				<h2>Your Images</h2>
				<p><a class="btn btn-primary text-center float-right" href="/image/add">Upload an Image Now</a></p>
			</div>
			<div class="row">
				<?php BIT703\Classes\Messages::displayMessage(); ?>
			</div>
			<div class="row">
				<div id="my-images" class="grid">
					<?php 
					foreach($model['user_images'] as $user_image) {
					?>
					<div class="grid-item">
						<picture id="image<?php echo $user_image['id'] ?>">
							<img src="<?php echo $user_image['url'] ?>" class="<?php echo $user_image['filter'] ?>" alt="<?php echo $user_image['description'] ?>">
						</picture>
						<h5><?php echo $user_image['title'] ?></h5>
						<p><?php echo $user_image['description'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<div class="row">
				<h2>Latest Images</h2>
				<p class="tags"> Tags: <?php foreach ($model['tags'] as $tag) { ?>
					<a href="/image/tag/<?php echo $tag['tag']; ?>" class="btn btn-primary btn-sm"><?php echo (ucfirst($tag['tag'])); ?> (<?php echo $tag['count'] ?>)</a>
				<?php } ?>
				</p>
			</div>
			<div class="row">
				<div id="others-images" class="grid">
					<?php 
					$count = 0;
					$limit = count($model['others_images']) < 8 ? count($model['others_images']) : 8;
					for ($count = 0; $count < $limit; $count++) {
						if (isset($model['others_images'][$count])) {
						$image = $model['others_images'][$count];
					?>
						<div class="grid-item">
							<picture id="image<?php echo $image['id'] ?>">
								<img src="<?php echo $image['url'] ?>" class="<?php echo $image['filter'] ?>" alt="<?php echo $image['description'] ?>">
							</picture>
							<h5><?php echo $image['title'] ?></h5>
							<p><?php echo $image['description'] ?></p>
						</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div><!-- /.container -->
	</div>
	<div id="image-modal" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
				</div>
			</div>
		</div>
	</div>