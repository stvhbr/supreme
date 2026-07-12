<?php
/**
 * Template: Single Resource (/resources/[slug]/)
 */
get_header();
the_post();

$std_code      = get_field( 'standard_code' );
$issuing_body  = get_field( 'issuing_body' );
$version_year  = get_field( 'version_year' );
$body          = get_field( 'body_content' );
$download      = get_field( 'download_file' );
$optin         = get_field( 'optin_required' );
$rel_products  = get_field( 'related_products' );

$breadcrumbs = [
    [ 'name' => 'Home',      'url' => home_url( '/' ) ],
    [ 'name' => 'Resources', 'url' => home_url( '/resources/' ) ],
    [ 'name' => $std_code ?: get_the_title() ],
];
?>
<main class="site-main" id="main">
<article class="single-resource">

  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <?php if ( $std_code ) : ?>
        <p class="eyebrow"><?php echo esc_html( $std_code ); ?></p>
      <?php endif; ?>
      <h1 class="page-hero-title"><?php the_title(); ?></h1>
      <?php if ( $issuing_body || $version_year ) : ?>
        <p class="page-hero-meta">
          <?php if ( $issuing_body ) echo esc_html( $issuing_body ); ?>
          <?php if ( $issuing_body && $version_year ) echo ' · '; ?>
          <?php if ( $version_year ) echo esc_html( $version_year ); ?>
        </p>
      <?php endif; ?>
    </div>
  </section>

  <div class="resource-layout">
    <div class="who-inner">

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

      <?php if ( $download ) : ?>
      <div class="resource-download-box">
        <p class="resource-download-label">
          <?php echo $optin ? 'Enter your email to download this resource:' : 'Download this resource:'; ?>
        </p>
        <?php if ( $optin ) : ?>
          <?php
          $form_id = get_field( 'form_id', 'option' );
          if ( $form_id && function_exists( 'gravity_form' ) ) {
              gravity_form( $form_id, false, false, false, null, true );
          } elseif ( function_exists( 'wpforms' ) ) {
              echo do_shortcode( '[wpforms id="' . intval( $form_id ) . '"]' );
          } else {
              echo '<a href="' . esc_url( $download['url'] ) . '" class="btn btn-red" download>Download PDF</a>';
          }
          ?>
        <?php else : ?>
          <a href="<?php echo esc_url( $download['url'] ); ?>" class="btn btn-red" download>
            Download PDF
          </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( $body ) : ?>
      <div class="resource-body entry-content"><?php echo wp_kses_post( $body ); ?></div>
      <?php endif; ?>

      <?php if ( ! empty( $rel_products ) ) : ?>
      <div class="resource-related-products">
        <h2 class="brand-section-title">Products That Comply With This Standard</h2>
        <div class="related-grid">
          <?php foreach ( $rel_products as $product ) : ?>
          <a href="<?php echo esc_url( get_permalink( $product ) ); ?>" class="related-card">
            <span><?php echo esc_html( $product->post_title ); ?></span>
            <span aria-hidden="true">→</span>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>

</article>
<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
