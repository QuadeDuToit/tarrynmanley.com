<?php
require_once 'includes/gallery-helper.php';

// Get the artwork ID from URL parameter
$artwork_id = $_GET['id'] ?? '';
$artwork = null;

echo $artwork_id;

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

	<style>
		html,
		body {
			width: 1200px;
			margin: 0 auto;
		}

		.artwork-detail {
			padding: 40px 0;
		}

		.artwork-image {
			text-align: center;
			margin-bottom: 40px;
		}

		.artwork-image img {
			max-width: 100%;
			max-height: 70vh;
			object-fit: contain;
			border-radius: 8px;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
		}

		.artwork-info {
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(10px);
			border-radius: 15px;
			padding: 30px;
			margin: 20px 0;
		}

		.artwork-info h1 {
			color: #fbff00;
			font-size: 48px;
			text-align: center;
			margin-bottom: 30px;
			text-transform: uppercase;
		}

		.artwork-details {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 20px;
			margin-top: 20px;
		}

		.detail-item {
			background: rgba(0, 0, 0, 0.1);
			padding: 15px;
			border-radius: 8px;
		}

		.detail-item h3 {
			color: #fbff00;
			margin-bottom: 10px;
			text-transform: uppercase;
		}

		.detail-item p {
			color: #fff;
			margin: 0;
		}

		.back-to-gallery {
			text-align: center;
			margin: 40px 0;
		}

		.back-to-gallery a {
			background: #fbff00;
			color: #000;
			padding: 15px 30px;
			text-decoration: none;
			border-radius: 8px;
			font-weight: bold;
			text-transform: uppercase;
			transition: all 0.3s ease;
		}

		.back-to-gallery a:hover {
			background: #eb1d36;
			color: #fff;
		}

		.related-artworks {
			margin-top: 60px;
		}

		.related-artworks h2 {
			color: #fbff00;
			text-align: center;
			margin-bottom: 40px;
		}
	</style>
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
				<div class="col-6">
					<div class="portrait-lg">
						<img src="./assets/images/gallery/lg/<?php echo htmlspecialchars($artwork['fileName']); ?>" />
					</div>
				</div>
				<div class="col-4 offset-1 gallery-card">
					<div class="portrait">
						<img src="./assets/images/gallery/<?php echo htmlspecialchars($artwork['fileName']); ?>" />
					</div>
					<p class="title"><?php echo htmlspecialchars($artwork['title'] ?? 'Untitled'); ?></p>
					<hr />
					<p>
						Dimensions: <?php echo htmlspecialchars($artwork['dimensions'] ?? 'N/A'); ?>
					</p>
					<hr />
					<p>
						Concept: <?php echo htmlspecialchars($artwork['concept']); ?>
					</p>
					<hr />
					<p>
						Year: <?php echo htmlspecialchars($artwork['year'] ?? 'N/A'); ?>
					</p>
				</div>
			</div>
		</section>

		<div class="row related-artworks">
			<div class="col-12">
				<h2 class="clr-primary text-shadow text-center">
					MORE ARTWORKS
				</h2>
			</div>
		</div>

		<div class="row">
			<?php
			// Show 3 featured artworks as "related"
			$featured_items = GalleryHelper::getFeaturedItems(3);
			foreach ($featured_items as $featured_item) {
				echo GalleryHelper::renderGalleryCard($featured_item, true);
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