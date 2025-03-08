<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Example' ?> | <?= $appName ?></title>
	<meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="<?= $keywords ?>">
    <meta name="robots" content="<?= $robots ?>">
	<meta name="website" content="<?= $baseUrl ?>">
	<meta name="version" content="<?= $version ?>">
	<link rel="icon" href="/images/logo.ico" type="image/x-icon">
	<link rel="icon" href="/images/logo.ico" type="image/png">
	<link rel="icon" sizes="32x32" href="/images/logo.ico">
	<link rel="icon" sizes="16x16" href="/images/logo.ico">
	<?php include __DIR__ . '/../partials/og.php'; ?>
	<?php include __DIR__ . '/../partials/ld-json.php'; ?>
    <link rel="stylesheet" href="/css/style.css">
	
	<link rel="stylesheet" href="/css/tailwind.min.css">
	<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 text-white min-h-screen flex flex-col">
	<?php include __DIR__ . '/../partials/header.php'; ?>
	<main class="flex-grow flex overflow-hidden">
		<?= isset($content) ? $content : '<p>Content not found</p>'; ?>
	</main>
	<?php include __DIR__ . '/../partials/footer.php'; ?>
	<script src="/js/script.js"></script>
</body>
</html>
