<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title">
    <?php bloginfo( 'name' ); ?>
  </a>
  <span class="preview-badge">CMS Preview</span>
</header>

<main class="site-main">
