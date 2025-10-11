<?php
    include_once 'config/config.php';
?>


<!-- META TAGS -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:type" content="website">
<meta property="og:image" content="<?php echo $base_url ?>assets/imagens/site-admin/splash.png">
<meta property="og:image:width" content="310">
<meta property="og:image:height" content="310">
<meta property="og:title" content="<?php echo $title_site ?>">
<meta name="description" content="<?php echo $descri_site ?>">
<meta property="og:description" content="<?php echo $descri_site ?>">
<meta property="og:url" content="<?php echo $base_url ?>">

<!-- FAVICON -->
<link rel="icon" href="<?php echo $base_url ?>assets/imagens/favicon-admin/favicon-admin.png">

<!-- MANIFEST -->
<link rel="manifest" href="<?php echo $base_url ?>/manifest.json">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- TEXT AREA PERSONALIZADO -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<!--FONTAWSOME-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<!--BOOSTRAP-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<!-- GLOBAL CSS -->
<link rel="stylesheet" href="<?php echo $base_url ?>assets/css-global/style.css">

<!-- BASE URL JS -->
<script> 
    var base_url = '<?= $_ENV['BASE_URL']; ?>'
</script>

<!-- GLOBAL JS -->
<script src="<?php echo $base_url ?>assets/js-global/app.js"></script>

<!-- SWIPER CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- SWIPER JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- MODAL PERSONALIZADO -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<title><?php echo $title_site ?></title>