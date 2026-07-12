<?php
/**
 * Template: Single Product (/products/[slug]/)
 */
get_header();
the_post();

$eyebrow     = get_field( 'eyebrow_label' );
$hero        = get_field( 'hero_image' );
$hero_alt    = get_field( 'hero_image_alt' ) ?: get_the_title();
$intro       = get_field( 'intro_text' );
$size_range  = get_field( 'nominal_size_range' );
$standards   = get_field( 'standards' );
$size_table  = get_field( 'size_table' );
$catalogue   = get_field( 'catalogue_file' );
$rel_apps    = get_field( 'related_applications' );
$rel_brands  = get_field( 'related_brands' );
$blocks      = get_field( 'content_blocks' );
$cta_label   = get_field( 'cta_label' ) ?: get_field( 'cta_primary_label', 'option' ) ?: 'Request a Free Quote';

// Breadcrumbs
$breadcrumbs = [
    [ 'name' => 'Home',     'url' => home_url( '/' ) ],
    [ 'name' => 'Products', 'url' => home_url( '/products/' ) ],
    [ 'name' => get_the_title() ],
];

// Product schema
$product_schema = [
    '@context'     => 'https://schema.org',
    '@type'        => 'Product',
    'name'         => get_the_title(),
    'description'  => wp_strip_all_tags( $intro ),
    'brand'        => [
        '@type' => 'Brand',
        'name'  => get_field( 'company_name', 'option' ) ?: 'Supreme Steel Pipe Corporation',
    ],
    'manufacturer' => [
        '@type' => 'Organization',
        'name'  => 'Supreme Steel Pipe Corporation',
    ],
];
if ( $hero ) {
    $product_schema['image'] = $hero['url'];
}
if ( $size_range ) {
    $product_schema['additionalProperty'][] = [
        '@type' => 'PropertyValue',
        'name'  => 'Nominal Size Range',
        'value' => $size_range,
    ];
}

// Fetch FAQs related to this product
$faqs_query = new WP_Query( [
    'post_type'      => 'faq',
    'posts_per_page' => 5,
    'meta_query'     => [
        [
            'key'     => 'related_products',
            'value'   => get_the_ID(),
            'compare' => 'LIKE',
        ],
    ],
    'orderby'        => 'meta_value_num',
    'meta_key'       => 'sort_order',
] );
?>
<main class="site-main" id="main">
<article class="single-product">

  <!-- Hero -->
  <section class="product-hero">
    <?php if ( $hero ) : ?>
    <div class="product-hero-bg">
      <img src="<?php echo esc_url( $hero['url'] ); ?>"
           alt="<?php echo esc_attr( $hero_alt ); ?>"
           width="1280" height="500"
           loading="eager" fetchpriority="high"
           sizes="100vw">
    </div>
    <?php endif; ?>
    <div class="product-hero-inner hero-inner">
      <?php if ( $eyebrow ) : ?>
        <p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
      <?php endif; ?>
      <h1 class="product-title"><?php the_title(); ?></h1>
    </div>
  </section>

  <!-- Breadcrumb + content -->
  <div class="product-layout">
    <div class="product-layout-inner">

      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol class="breadcrumb-list">
          <?php foreach ( $breadcrumbs as $i => $crumb ) :
            $is_last = ( $i === count( $breadcrumbs ) - 1 );
          ?>
          <li class="breadcrumb-item<?php echo $is_last ? ' breadcrumb-item--current' : ''; ?>">
            <?php if ( ! $is_last && ! empty( $crumb['url'] ) ) : ?>
              <a href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['name'] ); ?></a>
              <span class="breadcrumb-sep" aria-hidden="true">/</span>
            <?php else : ?>
              <span aria-current="page"><?php echo esc_html( $crumb['name'] ); ?></span>
            <?php endif; ?>
          </li>
          <?php endforeach; ?>
        </ol>
      </nav>
      <?php supreme_breadcrumb_schema( $breadcrumbs ); ?>

      <?php if ( $intro ) : ?>
      <div class="product-intro">
        <?php echo wp_kses_post( $intro ); ?>
      </div>
      <?php endif; ?>

      <?php if ( $size_range || ! empty( $standards ) ) : ?>
      <div class="product-specs">
        <h2 class="product-section-title">Specifications</h2>
        <div class="specs-table">
          <?php if ( $size_range ) : ?>
          <div class="spec-row">
            <span class="spec-label">Nominal Size</span>
            <span class="spec-value"><?php echo esc_html( $size_range ); ?></span>
          </div>
          <?php endif; ?>
          <?php if ( ! empty( $standards ) ) : foreach ( $standards as $std ) : ?>
          <div class="spec-row">
            <span class="spec-label">Standard</span>
            <span class="spec-value">
              <?php if ( ! empty( $std['resource_page'] ) ) : ?>
                <a href="<?php echo esc_url( get_permalink( $std['resource_page'] ) ); ?>"><?php echo esc_html( $std['code'] ); ?></a>
              <?php else : ?>
                <?php echo esc_html( $std['code'] ); ?>
              <?php endif; ?>
              <?php if ( $std['description'] ) : ?>
                <span class="spec-note"><?php echo esc_html( $std['description'] ); ?></span>
              <?php endif; ?>
            </span>
          </div>
          <?php endforeach; endif; ?>
        </div>

        <?php if ( $size_table || $catalogue ) : ?>
        <div class="product-downloads">
          <?php if ( $size_table ) : ?>
            <a href="<?php echo esc_url( $size_table['url'] ); ?>" class="btn btn-outline" download>
              Download Size Chart
            </a>
          <?php endif; ?>
          <?php if ( $catalogue ) : ?>
            <a href="<?php echo esc_url( $catalogue['url'] ); ?>" class="btn btn-outline" download>
              Download Product Catalogue
            </a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( ! empty( $blocks ) ) :
        foreach ( $blocks as $block ) :
          switch ( $block['acf_fc_layout'] ) :
            case 'text_block' : ?>
              <div class="product-content-block">
                <?php if ( $block['heading'] ) : ?>
                  <h2 class="product-section-title"><?php echo esc_html( $block['heading'] ); ?></h2>
                <?php endif; ?>
                <?php echo wp_kses_post( $block['content'] ); ?>
              </div>
            <?php break;
            case 'image_text' : ?>
              <div class="product-content-block product-image-text product-image-text--<?php echo esc_attr( $block['layout'] ?? 'left' ); ?>">
                <?php if ( ! empty( $block['image'] ) ) : ?>
                  <img src="<?php echo esc_url( $block['image']['url'] ); ?>"
                       alt="<?php echo esc_attr( $block['image_alt'] ?: ( $block['image']['alt'] ?? '' ) ); ?>"
                       loading="lazy">
                <?php endif; ?>
                <div class="product-image-text-body">
                  <?php if ( $block['heading'] ) : ?>
                    <h2 class="product-section-title"><?php echo esc_html( $block['heading'] ); ?></h2>
                  <?php endif; ?>
                  <?php echo wp_kses_post( $block['content'] ); ?>
                </div>
              </div>
            <?php break;
          endswitch;
        endforeach;
      endif; ?>

      <?php if ( ! empty( $rel_apps ) ) : ?>
      <div class="product-related-apps">
        <h2 class="product-section-title">Applications</h2>
        <div class="related-grid">
          <?php foreach ( $rel_apps as $app ) :
            $icon = get_field( 'icon_svg', $app->ID );
          ?>
          <a href="<?php echo esc_url( get_permalink( $app ) ); ?>" class="related-card">
            <?php if ( $icon ) : ?>
              <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="" width="32" height="32" loading="lazy" class="related-card-icon">
            <?php endif; ?>
            <span class="related-card-name"><?php echo esc_html( $app->post_title ); ?></span>
            <span aria-hidden="true">→</span>
          </a>
          <?php endforeach; ?>
        </div>
        <a href="<?php echo esc_url( home_url( '/applications/' ) ); ?>" class="link-more">View all applications →</a>
      </div>
      <?php endif; ?>

      <?php if ( ! empty( $rel_brands ) ) : ?>
      <div class="product-related-brands">
        <h2 class="product-section-title">Available Under These Brands</h2>
        <div class="related-grid">
          <?php foreach ( $rel_brands as $brand ) :
            $logo = get_field( 'brand_logo', $brand->ID );
          ?>
          <a href="<?php echo esc_url( get_permalink( $brand ) ); ?>" class="related-card related-card--brand">
            <?php if ( $logo ) : ?>
              <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $brand->post_title ); ?>" loading="lazy" class="related-brand-logo">
            <?php else : ?>
              <span class="related-card-name"><?php echo esc_html( $brand->post_title ); ?></span>
            <?php endif; ?>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if ( $faqs_query->have_posts() ) :
        $faq_schema_data = [];
        while ( $faqs_query->have_posts() ) : $faqs_query->the_post();
          $answer = get_field( 'faq_answer' );
          $faq_schema_data[] = [ 'question' => get_the_title(), 'answer' => $answer ];
        endwhile;
        wp_reset_postdata();
        supreme_faq_schema( $faq_schema_data );
      ?>
      <div class="product-faqs">
        <h2 class="product-section-title">Frequently Asked Questions</h2>
        <div class="faq-accordion">
          <?php foreach ( $faq_schema_data as $faq ) : ?>
          <details class="faq-item">
            <summary class="faq-question"><?php echo esc_html( $faq['question'] ); ?></summary>
            <div class="faq-answer"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
          </details>
          <?php endforeach; ?>
        </div>
        <a href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>" class="link-more">View all FAQs →</a>
      </div>
      <?php endif; ?>

    </div>
  </div>

  <script type="application/ld+json"><?php echo wp_json_encode( $product_schema, JSON_UNESCAPED_SLASHES ); ?></script>

</article>

<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
