<?php
require_once 'includes/gallery-helper.php';

// Get the artwork ID from URL parameter
$artwork_id = $_GET['id'] ?? '';
$artwork = null;

// Try to find the artwork by ID
if (!empty($artwork_id)) {
	$artwork = GalleryHelper::getArtworkByIdentifier($artwork_id);
}

// Fallback to first artwork if none found
if (!$artwork) {
	$artwork = GalleryHelper::getFirstArtwork();
}

// Set up meta data based on the artwork
if ($artwork) {
	$page_title = htmlspecialchars($artwork['title'] ?? 'Artwork') . ' - Tarryn Manley | Abstract Art';
	$page_description = 'View ' . htmlspecialchars($artwork['title'] ?? 'artwork') . ' by South African abstract artist Tarryn Manley. ' . htmlspecialchars($artwork['concept'] ?? 'Original abstract painting.');
	$page_keywords = 'Tarryn Manley, ' . htmlspecialchars($artwork['title'] ?? '') . ', abstract art, South African artist, original painting';
	$og_image = 'https://tarrynmanley.com/assets/images/gallery/' . htmlspecialchars($artwork['fileName'] ?? 'blue_lady.webp');
	$canonical_url = 'https://tarrynmanley.com/artwork.php?id=' . urlencode($artwork_id);
} else {
	// Fallback meta data
	$page_title = 'Artwork Gallery - Tarryn Manley | Abstract Art';
	$page_description = 'Explore abstract artwork by South African visual artist Tarryn Manley';
	$page_keywords = 'Tarryn Manley, abstract art, South African artist, artwork gallery';
	$og_image = 'https://tarrynmanley.com/assets/images/gallery/blue_lady.webp';
	$canonical_url = 'https://tarrynmanley.com/artwork.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'includes/head.php'; ?>
	<?php include 'includes/concept-modal-assets.php'; ?>

	<?php include 'includes/concept-modal-assets.php'; ?>
</head>

<body>
	<?php include 'includes/navigation.php'; ?>
	<div class="back-to-gallery">
		<a href="gallery.php">&larr; Back to Gallery</a>
	</div>
	<?php if ($artwork): ?>


		<section id="gallery" class="container">
			<div class="row">
				<div class="col-5">
					<h2 class="clr-primary text-shadow   text-center">
						GALLERY
					</h2>
				</div>
			</div>

			<div class="row section-portrait">
				<div class="col-12 col-md-12 col-lg-6">
					<div class="portrait-lg ">
						<img id="img-lg" src="./assets/images/gallery/lg/<?php echo htmlspecialchars($artwork['fileName']); ?>" />
					</div>
				</div>
				<div class="col-md-12 col-lg-6 gallery-card">
					<div class="row">
						<div class="portrait col-6 col-md-6 col-lg-12 offset-lg-1">
							<img class="img" id="img-protrait" src="./assets/images/gallery/<?php echo htmlspecialchars($artwork['fileName']); ?>" />
						</div>
						<div class="col-6 col-md-5 col-lg-10 offset-lg-1">
							<p class="title"><?php echo htmlspecialchars($artwork['title'] ?? 'Untitled'); ?></p>
							<hr />
							<p>
								Dimensions: <?php echo htmlspecialchars($artwork['dimensions'] ?? 'N/A'); ?>
							</p>
							<hr />
							<p>
								Concept: <?php
											$artworkId = isset($artwork['fileName']) ? pathinfo($artwork['fileName'], PATHINFO_FILENAME) : GalleryHelper::createSlug($artwork['title'] ?? 'Artwork');
											echo GalleryHelper::createConceptDisplay($artwork['title'] ?? 'Artwork', $artwork['concept'] ?? '', 100, $artworkId);
											?>
							</p>
							<hr />
							<p>
								Year: <?php echo htmlspecialchars($artwork['year'] ?? 'N/A'); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="gallery" class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="clr-primary text-shadow text-center">
						MORE ARTWORKS
					</h2>
				</div>
			</div>
			<div class="row">
				<?php
				// Show 3 random artworks excluding the current one
				$random_items = GalleryHelper::getRandomItems(3, $artwork_id);
				foreach ($random_items as $random_item) {
					echo GalleryHelper::renderGalleryCard($random_item, true);
				}
				?>
			</div>
		</section>

	<?php else: ?>
		<section class="artwork-detail container">
			<div class="row">
				<div class="col-12">
					<div class="back-to-gallery">
						<a href="gallery.php">&larr; Back to Gallery</a>
					</div>
					<div style="text-align: center; padding: 60px 0;">
						<h1 style="color: #fbff00;">Artwork Not Found</h1>
						<p style="color: #fff; margin: 20px 0;">The requested artwork could not be found.</p>
						<a href="gallery.php" style="color: #fbff00;">Browse our full gallery instead</a>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php include 'includes/sections/contact.php'; ?>

	<?php include 'includes/scripts.php'; ?>

</body>

</html>