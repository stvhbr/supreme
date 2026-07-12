<?php
/**
 * Template Name: Landing Page (No Nav/Footer)
 * For PPC/optin pages — no header, no footer nav.
 * noindex is set via Rank Math on the page level.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class( 'landing-page' ); ?>>
<?php wp_body_open(); ?>

<header class="landing-header">
  <div class="header-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="Supreme Steel Pipe Corporation">
      <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/supreme-logo.svg' ); ?>"
           alt="Supreme Steel Pipe Corp" width="132" height="44" loading="eager">
    </a>
  </div>
</header>

<main class="site-main landing-main" id="main">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="landing-content">
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>
</main>

<footer class="landing-footer">
  <div class="footer-bottom-inner">
    <p><?php echo esc_html( get_field( 'copyright_text', 'option' ) ?: '© ' . date( 'Y' ) . ' Supreme Steel Pipe Corporation.' ); ?></p>
    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
