<?php
require_once 'includes/gallery-helper.php';

echo "=== Artwork Detail Test ===\n";

// Test finding artwork by filename
$artwork1 = GalleryHelper::getArtworkByIdentifier('blue_lady');
echo "Finding 'blue_lady': " . ($artwork1 ? $artwork1['title'] : 'Not found') . "\n";

// Test finding by title slug
$artwork2 = GalleryHelper::getArtworkByIdentifier('otherworld');
echo "Finding 'otherworld': " . ($artwork2 ? $artwork2['title'] : 'Not found') . "\n";

// Test fallback
$first = GalleryHelper::getFirstArtwork();
echo "First artwork: " . ($first ? $first['title'] : 'None') . "\n";

// Test URL generation
if ($artwork1) {
	echo "URL for blue_lady: " . GalleryHelper::getArtworkUrl($artwork1) . "\n";
}

// Test slug creation
echo "Slug for 'Blue Lady red dress': " . GalleryHelper::createSlug('Blue Lady red dress') . "\n";
