<?php require_once __DIR__ . '/../gallery-helper.php'; ?>
<section id="gallery" class="container">
	<div class="row">
		<div class="col-5">
			<h2 class="clr-primary text-shadow   text-center">
				GALLERY
			</h2>
		</div>
	</div>

	<!-- Featured Gallery Items (loaded from JSON via PHP) -->
	<div id="galleryFeatured" class="row">
		<?php echo GalleryHelper::renderFeaturedItems(); ?>
	</div>