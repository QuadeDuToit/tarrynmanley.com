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
	 * Render a single gallery card
	 */
	public static function renderGalleryCard($item)
	{
		$title = htmlspecialchars($item['title'] ?? 'Untitled');
		$fileName = htmlspecialchars($item['fileName'] ?? 'placeholder.webp');
		$dimensions = htmlspecialchars($item['dimensions'] ?? 'N/A');
		$concept = htmlspecialchars($item['concept'] ?? 'N/A');
		$year = htmlspecialchars($item['year'] ?? 'N/A');

		return '
        <div class="col-4 gallery-card">
            <div class="img">
                <img src="./assets/images/gallery/' . $fileName . '" alt="Abstract artwork: ' . $title . '" />
            </div>
            <p class="title">' . strtoupper($title) . '</p>
            <hr />
            <p>Dimensions: ' . $dimensions . '</p>
            <hr />
            <p>Concept: ' . $concept . '</p>
            <hr />
            <p>Year: ' . $year . '</p>
        </div>';
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
