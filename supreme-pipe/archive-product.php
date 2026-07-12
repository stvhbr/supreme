<?php
/**
 * Template: Products Archive (/products/)
 * Two-column layout: By Category | By Material
 */
get_header();

// Get all product categories
$categories = get_terms( [
    'taxonomy'   => 'product_category',
    'hide_empty' => false,
    'orderby'    => 'menu_order',
] );

// Get all material types
$materials = get_terms( [
    'taxonomy'   => 'material_type',
    'hide_empty' => false,
    'orderby'    => 'menu_order',
] );

// All products
$all_products = get_posts( [
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>
<main class="site-main" id="main">

  <!-- Page Hero -->
  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <div class="page-hero-content">
        <p class="eyebrow">What We Offer</p>
        <h1 class="page-hero-title">Our Products</h1>
        <p class="page-hero-desc">From heavy gauge black iron pipes to fire sprinkler systems — Philippine-manufactured, standards-compliant steel pipes for every project need.</p>
      </div>
    </div>
  </section>

  <!-- Products listing: two-column -->
  <section class="products-section">
    <div class="products-inner">

      <!-- Column 1: By Category -->
      <div class="products-col">
        <h2 class="products-col-title">By Product Category</h2>
        <ul class="product-list">
          <?php foreach ( $all_products as $product ) :
            $thumb = get_the_post_thumbnail_url( $product->ID, 'supreme-thumb' );
            $eyebrow = get_field( 'eyebrow_label', $product->ID );
            $size = get_field( 'nominal_size_range', $product->ID );
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

      <!-- Column 2: By Material -->
      <div class="products-col">
        <h2 class="products-col-title">By Material</h2>
        <?php foreach ( $materials as $material ) :
          $material_products = get_posts( [
              'post_type'   => 'product',
              'posts_per_page' => -1,
              'tax_query'   => [ [ 'taxonomy' => 'material_type', 'terms' => $material->term_id ] ],
              'orderby'     => 'menu_order',
          ] );
          if ( empty( $material_products ) ) continue;
        ?>
        <div class="material-group">
          <h3 class="material-group-title"><?php echo esc_html( $material->name ); ?></h3>
          <ul class="product-list">
            <?php foreach ( $material_products as $p ) : ?>
            <li class="product-list-item material-item">
              <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="product-item-name">
                <?php echo esc_html( $p->post_title ); ?>
              </a>
              <span class="product-list-arrow" aria-hidden="true">→</span>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endforeach; ?>

        <!-- Tools & Specs sidebar box -->
        <div class="products-tools-box">
          <h3 class="tools-box-title">Tools &amp; Specs</h3>
          <ul class="tools-list">
            <li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">Pipe Size Guide →</a></li>
            <li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">Product Standards →</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request a Quote →</a></li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <?php get_template_part( 'template-parts/cta' ); ?>

</main>
<?php get_footer();
