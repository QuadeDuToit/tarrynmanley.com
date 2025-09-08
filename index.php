<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'includes/head.php'; ?>
	<?php include 'includes/concept-modal-assets.php'; ?>

	<!-- Structured Data for SEO -->
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Person",
			"name": "Tarryn Manley",
			"jobTitle": "Visual Artist",
			"description": "South African visual artist specializing in bold abstract paintings using acrylic, ink, pastels, and spray paint.",
			"url": "https://tarrynmanley.com",
			"image": "https://tarrynmanley.com/assets/images/profile.webp",
			"address": {
				"@type": "PostalAddress",
				"streetAddress": "11 Hope Street",
				"addressLocality": "Claremont",
				"addressRegion": "Cape Town",
				"addressCountry": "South Africa"
			},
			"telephone": "+27 073 386 5567",
			"email": "tarryn@tarrynmanley.com",
			"worksFor": {
				"@type": "Organization",
				"name": "Independent Artist"
			},
			"knowsAbout": ["Abstract Art", "Acrylic Painting", "Contemporary Art", "Commissioned Artwork"],
			"sameAs": []
		}
	</script>

</head>

<body>
	<?php include 'includes/navigation.php'; ?>

	<?php include 'includes/sections/home-banner.php'; ?>

	<?php include 'includes/sections/my-canvas.php'; ?>

	<?php include 'includes/sections/gallery.php'; ?>

	<section id="gallery" class="container">
		<div class="row">
			<div class="col-5">
				<h2 class="clr-primary text-shadow text-center">
					GALLERY
				</h2>
			</div>
		</div>

		<div class="row section-portrait">
			<div class="col-6">
				<div class="portrait-lg">
					<img src="./assets/images/gallery/lg/blue_lady.webp" />
				</div>
			</div>
			<div class="col-4 offset-1 gallery-card">
				<div class="portrait">
					<img src="./assets/images/gallery/blue_lady.webp" />
				</div>
				<p class="title">a</p>
				<hr />
				<p>
					Dimensions: b
				</p>
				<hr />
				<p>
					Concept: c
				</p>
				<hr />
				<p>
					Year: d
				</p>
			</div>
		</div>
	</section>

	<?php include 'includes/sections/splash-01.php'; ?>

	<?php include 'includes/sections/splash-02.php'; ?>

	<?php include 'includes/sections/situ.php'; ?>

	<?php include 'includes/sections/contact.php'; ?>

	<?php include 'includes/sections/situ-modal.php'; ?>

	<script>
		// Lazy loading for videos
		document.addEventListener('DOMContentLoaded', function() {
			const lazyVideos = document.querySelectorAll('.lazy-video');

			if ('IntersectionObserver' in window) {
				const videoObserver = new IntersectionObserver(function(entries, observer) {
					entries.forEach(function(entry) {
						if (entry.isIntersecting) {
							const video = entry.target;
							const source = video.querySelector('source');

							// Load the video source
							video.src = video.dataset.src;
							if (source) {
								source.src = source.dataset.src;
							}

							// Load the video and play when ready
							video.load();
							video.addEventListener('loadeddata', function() {
								video.play().catch(function(error) {
									console.log('Auto-play prevented:', error);
								});
							});

							// Remove the lazy class and stop observing
							video.classList.remove('lazy-video');
							videoObserver.unobserve(video);
						}
					});
				}, {
					rootMargin: '50px 0px' // Start loading 50px before it comes into view
				});

				lazyVideos.forEach(function(video) {
					videoObserver.observe(video);
				});
			} else {
				// Fallback for browsers without IntersectionObserver
				lazyVideos.forEach(function(video) {
					const source = video.querySelector('source');
					video.src = video.dataset.src;
					if (source) {
						source.src = source.dataset.src;
					}
					video.load();
				});
			}
		});
	</script>
	<?php include 'includes/scripts.php'; ?>
</body>

</html>