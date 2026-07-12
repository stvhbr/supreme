<?php
/**
 * Template: Brands Archive (/brands/)
 */
get_header();

$brands = get_posts( [
    'post_type'      => 'brand',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>
<main class="site-main" id="main">

  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <p class="eyebrow">Our Brand Family</p>
      <h1 class="page-hero-title">Our Brands</h1>
      <p class="page-hero-desc">Six trusted brands — each engineered for a specific application, all manufactured to Philippine and international standards.</p>
    </div>
  </section>

  <section class="brands-archive-section">
    <div class="brands-inner">
      <div class="brands-grid">
        <?php foreach ( $brands as $brand ) :
          $logo  = get_field( 'brand_logo', $brand->ID );
          $hero  = get_field( 'brand_hero_bg', $brand->ID );
          $badge = get_field( 'gauge_badge', $brand->ID );
          $tag   = get_field( 'brand_tagline', $brand->ID );
          $badge_labels = [
              'heavy'      => 'Heavy Gauge',
              'light'      => 'Light Gauge',
              'fire'       => 'Fire Sprinkler',
              'structural' => 'Structural',
              'spiral'     => 'Spiral / LSAW',
              'fittings'   => 'Fittings',
          ];
        ?>
        <a href="<?php echo esc_url( get_permalink( $brand ) ); ?>" class="brand-card">
          <?php if ( $hero ) : ?>
            <div class="brand-card-bg" style="background-image:url('<?php echo esc_url( $hero['url'] ); ?>');" aria-hidden="true"></div>
          <?php endif; ?>
          <div class="brand-card-inner">
            <?php if ( $badge && isset( $badge_labels[ $badge ] ) ) : ?>
              <span class="brand-badge"><?php echo esc_html( $badge_labels[ $badge ] ); ?></span>
            <?php endif; ?>
            <?php if ( $logo ) : ?>
              <img src="<?php echo esc_url( $logo['url'] ); ?>"
                   alt="<?php echo esc_attr( $brand->post_title ); ?> logo"
                   loading="lazy" class="brand-card-logo">
            <?php else : ?>
              <h2 class="brand-card-name"><?php echo esc_html( $brand->post_title ); ?></h2>
            <?php endif; ?>
            <?php if ( $tag ) : ?>
              <p class="brand-card-tag"><?php echo esc_html( $tag ); ?></p>
            <?php endif; ?>
            <span class="brand-card-cta">Explore Brand →</span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
