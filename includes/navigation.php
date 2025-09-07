<?php
// Get current page to determine active menu item
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>

<!-- Navigation Menu -->
<nav id="main-nav" class="main-navigation">
	<button id="nav-toggle" class="nav-toggle" aria-label="Toggle navigation menu">
		<span class="nav-icon"></span>
		<span class="nav-icon"></span>
		<span class="nav-icon"></span>
	</button>
	<div id="nav-menu" class="nav-menu">
		<ul class="nav-list">
			<li><a href="<?php echo ($current_page === 'index') ? '#home-banner' : 'index.php#home-banner'; ?>" class="nav-link <?php echo ($current_page === 'index') ? 'current-page' : ''; ?>">Home</a></li>
			<li><a href="<?php echo ($current_page === 'index') ? '#my-canvas' : 'index.php#my-canvas'; ?>" class="nav-link">My Canvas</a></li>
			<li><a href="<?php echo ($current_page === 'index') ? '#gallery' : 'index.php#gallery'; ?>" class="nav-link">Featured Gallery</a></li>
			<li><a href="gallery.php" class="nav-link <?php echo ($current_page === 'gallery') ? 'current-page' : ''; ?>">Full Gallery</a></li>
			<li><a href="<?php echo ($current_page === 'index') ? '#SITU' : 'index.php#SITU'; ?>" class="nav-link">See In Situ</a></li>
			<li><a href="<?php echo ($current_page === 'index') ? '#contact' : 'index.php#contact'; ?>" class="nav-link">Contact</a></li>
		</ul>
	</div>
</nav>