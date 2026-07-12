<?php
/**
 * Template: Homepage (front-page.php)
 * Pulls all content from ACF Options → Homepage
 * Section order mirrors the Figma design exactly.
 */
get_header();

// Homepage options
$hero_headline  = get_field( 'hero_headline', 'option' ) ?: 'Philippine Manufacturer of Black Iron &amp; Galvanized Steel Pipes Since 1991';
$hero_subline   = get_field( 'hero_subline', 'option' ) ?: 'Compliant to PNS 26:2018 and ASTM A53 standards.';
$hero_bg        = get_field( 'hero_bg_image', 'option' );
$hero_bg_alt    = get_field( 'hero_bg_image_alt', 'option' ) ?: 'Supreme Steel Pipe manufacturing';
$stats          = get_field( 'stats', 'option' ) ?: [];
$who_headline   = get_field( 'who_headline', 'option' ) ?: 'WHO WE ARE';
$who_content    = get_field( 'who_content', 'option' );
$certifications = get_field( 'certifications', 'option' ) ?: [];
$where_headline = get_field( 'where_headline', 'option' ) ?: "WHEREVER YOU BUILD, WE'RE ALREADY THERE.";

// Brands for homepage strip
$brands = get_posts( [ 'post_type' => 'brand', 'posts_per_page' => -1, 'orderby' => 'menu_order' ] );

// Products for homepage grid
$products = get_posts( [ 'post_type' => 'product', 'posts_per_page' => 7, 'orderby' => 'menu_order' ] );

// Applications for homepage
$applications = get_posts( [ 'post_type' => 'application', 'posts_per_page' => -1, 'orderby' => 'menu_order' ] );

// Locations for "Where We Are"
$locations = get_posts( [
    'post_type'      => 'location',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value_num',
    'meta_key'       => 'sort_order',
] );
?>
<main class="site-main" id="main">

  <!-- ── HERO ────────────────────────────────── -->
  <section class="site-hero" aria-label="Hero">
    <?php if ( $hero_bg ) : ?>
    <div class="hero-bg" aria-hidden="true">
      <img src="<?php echo esc_url( $hero_bg['url'] ); ?>"
           alt="<?php echo esc_attr( $hero_bg_alt ); ?>"
           loading="eager" fetchpriority="high"
           width="1280" height="600"
           sizes="100vw">
    </div>
    <?php endif; ?>
    <div class="hero-inner">
      <div class="hero-content">
        <h1 class="hero-title"><?php echo wp_kses_post( $hero_headline ); ?></h1>
        <?php if ( $hero_subline ) : ?>
          <p class="hero-subtitle"><?php echo esc_html( $hero_subline ); ?></p>
        <?php endif; ?>
        <div class="hero-actions">
          <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="btn btn-red">Explore Products</a>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline-white">Request a Quote</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ── STATS BAR ────────────────────────────── -->
  <?php if ( ! empty( $stats ) ) : ?>
  <section class="stats-section" aria-label="Key statistics">
    <div class="stats-inner">
      <?php foreach ( $stats as $stat ) : ?>
      <div class="stat-item">
        <span class="stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
        <span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- ── WHO WE ARE ───────────────────────────── -->
  <section class="who-section" aria-labelledby="who-headline">
    <div class="who-inner">
      <h2 class="who-headline section-label" id="who-headline"><?php echo esc_html( $who_headline ); ?></h2>
      <?php if ( $who_content ) : ?>
        <div class="who-content"><?php echo wp_kses_post( $who_content ); ?></div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ── CERTIFICATIONS ───────────────────────── -->
  <?php if ( ! empty( $certifications ) ) : ?>
  <section class="cert-section" aria-label="Certifications">
    <div class="cert-inner">
      <?php foreach ( $certifications as $cert ) :
        if ( empty( $cert['logo'] ) ) continue;
      ?>
      <div class="cert-item">
        <img src="<?php echo esc_url( $cert['logo']['url'] ); ?>"
             alt="<?php echo esc_attr( $cert['alt'] ?: $cert['name'] ); ?>"
             loading="lazy" width="120" height="60">
      </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- ── BRANDS ───────────────────────────────── -->
  <?php if ( ! empty( $brands ) ) : ?>
  <section class="brands-section" aria-labelledby="brands-headline">
    <div class="brands-inner">
      <div class="section-header">
        <h2 class="section-title" id="brands-headline">Our Brands</h2>
        <a href="<?php echo esc_url( home_url( '/brands/' ) ); ?>" class="link-more">View all brands →</a>
      </div>
      <div class="brands-strip">
        <?php foreach ( $brands as $brand ) :
          $logo = get_field( 'brand_logo', $brand->ID );
          $hero_bg_brand = get_field( 'brand_hero_bg', $brand->ID );
        ?>
        <a href="<?php echo esc_url( get_permalink( $brand ) ); ?>" class="brand-strip-item"
          <?php if ( $hero_bg_brand ) echo 'style="background-image:url(\'' . esc_url( $hero_bg_brand['url'] ) . '\');"'; ?>>
          <?php if ( $logo ) : ?>
            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $brand->post_title ); ?>" loading="lazy">
          <?php else : ?>
            <span><?php echo esc_html( $brand->post_title ); ?></span>
          <?php endif; ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ── PRODUCTS ─────────────────────────────── -->
  <?php if ( ! empty( $products ) ) : ?>
  <section class="products-section products-section--home" aria-labelledby="products-headline">
    <div class="products-inner">
      <div class="section-header">
        <h2 class="section-title" id="products-headline">Our Products</h2>
        <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="link-more">View all products →</a>
      </div>
      <ul class="product-list">
        <?php foreach ( $products as $product ) :
          $thumb   = get_the_post_thumbnail_url( $product->ID, 'supreme-thumb' );
          $eyebrow = get_field( 'eyebrow_label', $product->ID );
          $size    = get_field( 'nominal_size_range', $product->ID );
        ?>
        <li class="product-list-item">
          <?php if ( $thumb ) : ?>
            <img src="<?php echo esc_url( $thumb ); ?>"
                 alt="<?php echo esc_attr( get_field( 'hero_image_alt', $product->ID ) ?: $product->post_title ); ?>"
                 width="64" height="64" loading="lazy" class="product-list-thumb">
          <?php endif; ?>
          <div class="product-list-text">
            <?php if ( $eyebrow ) : ?>
              <span class="product-item-sub"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>
            <a href="<?php echo esc_url( get_permalink( $product ) ); ?>" class="product-item-name">
              <?php echo esc_html( $product->post_title ); ?>
            </a>
            <?php if ( $size ) : ?>
              <span class="product-item-size"><?php echo esc_html( $size ); ?></span>
            <?php endif; ?>
          </div>
          <span class="product-list-arrow" aria-hidden="true">→</span>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <?php endif; ?>

  <!-- ── APPLICATIONS ─────────────────────────── -->
  <?php if ( ! empty( $applications ) ) : ?>
  <section class="applications-section applications-section--home" aria-labelledby="apps-headline">
    <div class="applications-inner">
      <div class="section-header">
        <h2 class="section-title" id="apps-headline">Applications</h2>
        <a href="<?php echo esc_url( home_url( '/applications/' ) ); ?>" class="link-more">View all →</a>
      </div>
      <div class="applications-strip">
        <?php foreach ( $applications as $app ) :
          $icon = get_field( 'icon_svg', $app->ID );
        ?>
        <a href="<?php echo esc_url( get_permalink( $app ) ); ?>" class="application-strip-item">
          <?php if ( $icon ) : ?>
            <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="" width="32" height="32" loading="lazy" aria-hidden="true">
          <?php endif; ?>
          <span><?php echo esc_html( $app->post_title ); ?></span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ── WHERE WE ARE ─────────────────────────── -->
  <?php if ( ! empty( $locations ) ) : ?>
  <section class="where-section" aria-labelledby="where-headline">
    <div class="where-inner">
      <h2 class="where-headline" id="where-headline"><?php echo esc_html( $where_headline ); ?></h2>
      <div class="where-locations">
        <?php foreach ( $locations as $loc ) :
          $address = get_field( 'address', $loc->ID );
          $city    = get_field( 'city_region', $loc->ID );
          $phone   = get_field( 'phone', $loc->ID );
          $email   = get_field( 'email', $loc->ID );
          $maps    = get_field( 'google_maps_url', $loc->ID );
        ?>
        <div class="location-row-card">
          <h3 class="location-card-name"><?php echo esc_html( $loc->post_title ); ?></h3>
          <?php if ( $address || $city ) : ?>
            <p class="location-row-val"><?php echo esc_html( $address ); ?><?php if ( $city ) echo ', ' . esc_html( $city ); ?></p>
          <?php endif; ?>
          <?php if ( $phone ) : ?>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>" class="location-row-val">
              <?php echo esc_html( $phone ); ?>
            </a>
          <?php endif; ?>
          <?php if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="location-row-val">
              <?php echo esc_html( $email ); ?>
            </a>
          <?php endif; ?>
          <?php if ( $maps ) : ?>
            <a href="<?php echo esc_url( $maps ); ?>" class="link-more" target="_blank" rel="noopener noreferrer">
              Get Directions →
            </a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ── GLOBAL CTA ───────────────────────────── -->
  <?php get_template_part( 'template-parts/cta' ); ?>

</main>
<?php get_footer();
