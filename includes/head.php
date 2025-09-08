<?php
// Default values - can be overridden before including this file
$page_title = $page_title ?? 'Tarryn Manley - Visual Artist | Abstract Paintings & Commissioned Art | Cape Town';
$page_description = $page_description ?? 'Tarryn Manley - South African visual artist specializing in bold abstract paintings using acrylic, ink, pastels, and spray paint. Commission artwork available. Cape Town based.';
$page_keywords = $page_keywords ?? 'Tarryn Manley, South African artist, abstract art, visual artist, Cape Town artist, acrylic paintings, commissioned artwork, contemporary art';
$og_image = $og_image ?? 'https://tarrynmanley.com/assets/images/profile.webp';
$canonical_url = $canonical_url ?? 'https://tarrynmanley.com/' . basename($_SERVER['PHP_SELF']);
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
<meta name="author" content="Tarryn Manley">
<meta name="robots" content="index,follow">
<title><?php echo htmlspecialchars($page_title); ?></title>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
<meta property="og:site_name" content="Tarryn Manley Art">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
<meta property="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
<meta property="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
<meta property="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">

<link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>" />
<link rel="sitemap" type="application/xml" href="/sitemap.xml" />
<link rel="stylesheet" href="assets/styles/main.css?5">