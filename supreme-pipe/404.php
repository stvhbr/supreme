<?php
/**
 * Template: 404 Not Found
 */
get_header();
?>
<main class="site-main" id="main">
  <section class="page-hero page-hero--light">
    <div class="hero-inner" style="text-align:center;">
      <p class="eyebrow">404 Error</p>
      <h1 class="page-hero-title">Page Not Found</h1>
      <p class="page-hero-desc">The page you're looking for doesn't exist or has been moved.</p>
      <div style="display:flex;gap:16px;justify-content:center;margin-top:32px;flex-wrap:wrap;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-red">Back to Homepage</a>
        <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="btn btn-outline">Browse Products</a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline">Contact Us</a>
      </div>
    </div>
  </section>
</main>
<?php get_footer();
