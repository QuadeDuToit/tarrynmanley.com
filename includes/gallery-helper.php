<?php

/**
 * Gallery Helper Functions
 * Handles loading and rendering gallery items from JSON data
 */

class GalleryHelper
{
	private static $gallery_data = null;

	/**
	 * Load gallery data from JSON file
	 */
	private static function loadGalleryData()
	{
		if (self::$gallery_data === null) {
			$json_path = __DIR__ . '/../assets/js/gallery.json';
			if (file_exists($json_path)) {
				$json_content = file_get_contents($json_path);
				self::$gallery_data = json_decode($json_content, true);

				if (json_last_error() !== JSON_ERROR_NONE) {
					error_log('Gallery JSON decode error: ' . json_last_error_msg());
					self::$gallery_data = [];
				}
			} else {
				error_log('Gallery JSON file not found: ' . $json_path);
				self::$gallery_data = [];
			}
		}
		return self::$gallery_data;
	}

	/**
	 * Get all gallery items
	 */
	public static function getAllItems()
	{
		return self::loadGalleryData();
	}

	/**
	 * Get featured gallery items (limit 3)
	 */
	public static function getFeaturedItems($limit = 3)
	{
		$all_items = self::loadGalleryData();
		$featured = array_filter($all_items, function ($item) {
			return isset($item['featured']) && $item['featured'] === true;
		});
		return array_slice($featured, 0, $limit);
	}

	/**
	 * Get random gallery items (excluding a specific item if provided)
	 */
	public static function getRandomItems($limit = 3, $excludeIdentifier = null)
	{
		$all_items = self::loadGalleryData();

		// Remove the excluded item if specified
		if ($excludeIdentifier) {
			$all_items = array_filter($all_items, function ($item) use ($excludeIdentifier) {
				if (isset($item['fileName'])) {
					$fileNameWithoutExt = pathinfo($item['fileName'], PATHINFO_FILENAME);
					if ($fileNameWithoutExt === $excludeIdentifier) {
						return false;
					}
				}
				if (isset($item['title']) && self::createSlug($item['title']) === self::createSlug($excludeIdentifier)) {
					return false;
				}
				return true;
			});
		}

		// Shuffle the array and return the requested number of items
		shuffle($all_items);
		return array_slice($all_items, 0, $limit);
	}

	/**
	 * Get a specific artwork by filename or title
	 */
	public static function getArtworkByIdentifier($identifier)
	{
		$all_items = self::loadGalleryData();

		// First try to find by exact filename match (without extension)
		foreach ($all_items as $item) {
			if (isset($item['fileName'])) {
				$fileNameWithoutExt = pathinfo($item['fileName'], PATHINFO_FILENAME);
				if ($fileNameWithoutExt === $identifier) {
					return $item;
				}
			}
		}

		// Then try to find by title slug (normalized)
		$normalizedIdentifier = self::createSlug($identifier);
		foreach ($all_items as $item) {
			if (isset($item['title']) && self::createSlug($item['title']) === $normalizedIdentifier) {
				return $item;
			}
		}

		return null;
	}

	/**
	 * Get the first available artwork (fallback)
	 */
	public static function getFirstArtwork()
	{
		$all_items = self::loadGalleryData();
		return !empty($all_items) ? $all_items[0] : null;
	}

	/**
	 * Create a URL-friendly slug from a title
	 */
	public static function createSlug($text)
	{
		$text = strtolower($text);
		$text = preg_replace('/[^a-z0-9\s-]/', '', $text);
		$text = preg_replace('/[\s-]+/', '-', $text);
		return trim($text, '-');
	}

	/**
	 * Generate URL for artwork detail page
	 */
	public static function getArtworkUrl($item)
	{
		if (isset($item['fileName'])) {
			$slug = pathinfo($item['fileName'], PATHINFO_FILENAME);
			return "artwork.php?id=" . urlencode($slug);
		}
		return "artwork.php";
	}

	/**
	 * Render a single gallery card
	 */
	public static function renderGalleryCard($item, $linkToDetail = true)
	{
		$title = htmlspecialchars($item['title'] ?? 'Untitled');
		$fileName = htmlspecialchars($item['fileName'] ?? 'placeholder.webp');
		$dimensions = htmlspecialchars($item['dimensions'] ?? 'N/A');
		$concept = $item['concept'] ?? 'N/A';
		$year = htmlspecialchars($item['year'] ?? 'N/A');
		$artworkUrl = $linkToDetail ? self::getArtworkUrl($item) : '#';

		// Create artwork ID for modal lookup
		$artworkId = isset($item['fileName']) ? pathinfo($item['fileName'], PATHINFO_FILENAME) : self::createSlug($title);

		// Create concept display with modal functionality
		$conceptDisplay = self::createConceptDisplay($title, $concept, 100, $artworkId);

		$cardContent = '
            <div class="img">
                <img src="./assets/images/gallery/' . $fileName . '" alt="Abstract artwork: ' . $title . '" />
            </div>
            <p class="title">' . strtoupper($title) . '</p>
            <hr />
            <p>Dimensions: ' . $dimensions . '</p>
            <hr />
            <p>Concept: ' . $conceptDisplay . '</p>
            <hr />
            <p>Year: ' . $year . '</p>';

		if ($linkToDetail) {
			return '
        <div class="col-4 gallery-card">
            <a href="' . $artworkUrl . '" style="text-decoration: none; color: inherit;">
                ' . $cardContent . '
            </a>
        </div>';
		} else {
			return '
        <div class="col-4 gallery-card">
            ' . $cardContent . '
        </div>';
		}
	}

	/**
	 * Create concept display with modal functionality
	 */
	public static function createConceptDisplay($title, $concept, $truncateLength = 100, $artworkId = null)
	{
		if (!$concept || trim($concept) === '' || $concept === 'N/A') {
			return 'No concept available';
		}

		$shouldTruncate = strlen($concept) > $truncateLength;
		$truncated = $shouldTruncate ? substr($concept, 0, $truncateLength) . '...' : $concept;

		$displayHtml = '<span class="concept-preview">' . htmlspecialchars($truncated) . '</span>';

		if ($shouldTruncate && $artworkId) {
			$displayHtml .= ' <button class="read-more-btn" onclick="event.preventDefault(); event.stopPropagation(); showConceptModalById(\'' .
				htmlspecialchars($artworkId) . '\')">
				<span>Read More</span> <i class="arrow-icon">→</i>
			</button>';
		}

		return $displayHtml;
	}

	/**
	 * Render featured gallery items
	 */
	public static function renderFeaturedItems()
	{
		$featured_items = self::getFeaturedItems();
		$output = '';
		foreach ($featured_items as $item) {
			$output .= self::renderGalleryCard($item);
		}
		return $output;
	}

	/**
	 * Render all gallery items
	 */
	public static function renderAllItems()
	{
		$all_items = self::getAllItems();
		$output = '';
		foreach ($all_items as $item) {
			$output .= self::renderGalleryCard($item);
		}
		return $output;
	}
}
