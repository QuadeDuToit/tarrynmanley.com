<?php
// Simple test to verify gallery loading works
require_once 'includes/gallery-helper.php';

echo "=== Gallery Helper Test ===\n";
echo "Featured items count: " . count(GalleryHelper::getFeaturedItems()) . "\n";
echo "All items count: " . count(GalleryHelper::getAllItems()) . "\n";

echo "\nFirst featured item:\n";
$featured = GalleryHelper::getFeaturedItems();
if (!empty($featured)) {
	print_r($featured[0]);
}

echo "\nRendering first featured item HTML:\n";
if (!empty($featured)) {
	echo GalleryHelper::renderGalleryCard($featured[0]);
}
