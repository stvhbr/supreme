<?php
/**
 * Template: Applications Archive (/applications/)
 */
get_header();

$applications = get_posts( [
    'post_type'      => 'application',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>
<main class="site-main" id="main">

  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <p class="eyebrow">Use Cases</p>
      <h1 class="page-hero-title">Applications</h1>
      <p class="page-hero-desc">Supreme Steel Pipe products are trusted across construction, industrial, and infrastructure projects throughout the Philippines.</p>
    </div>
  </section>

  <section class="applications-section">
    <div class="applications-inner">
      <div class="applications-grid">
        <?php foreach ( $applications as $app ) :
          $hero = get_the_post_thumbnail_url( $app->ID, 'supreme-card' );
          $icon = get_field( 'icon_svg', $app->ID );
          $intro = get_field( 'intro_text', $app->ID );
        ?>
        <a href="<?php echo esc_url( get_permalink( $app ) ); ?>" class="application-card">
          <?php if ( $hero ) : ?>
            <div class="application-card-img">
              <img src="<?php echo esc_url( $hero ); ?>"
                   alt="<?php echo esc_attr( $app->post_title ); ?>"
                   loading="lazy" width="400" height="260">
            </div>
          <?php endif; ?>
          <div class="application-card-body">
            <?php if ( $icon ) : ?>
              <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="" width="32" height="32" class="application-card-icon" loading="lazy" aria-hidden="true">
            <?php endif; ?>
            <h2 class="application-card-name"><?php echo esc_html( $app->post_title ); ?></h2>
            <?php if ( $intro ) : ?>
              <p class="application-card-desc"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $intro ), 20 ) ); ?></p>
            <?php endif; ?>
            <span class="link-more">Learn more →</span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
