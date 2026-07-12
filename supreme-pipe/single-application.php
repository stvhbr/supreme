<?php
/**
 * Template: Single Application (/applications/[slug]/)
 */
get_header();
the_post();

$hero          = get_field( 'hero_image' );
$hero_alt      = get_field( 'hero_image_alt' ) ?: get_the_title();
$intro         = get_field( 'intro_text' );
$feat_products = get_field( 'featured_products' );
$feat_brands   = get_field( 'featured_brands' );
$examples      = get_field( 'project_examples' );
$body          = get_field( 'body_content' );

$breadcrumbs = [
    [ 'name' => 'Home',         'url' => home_url( '/' ) ],
    [ 'name' => 'Applications', 'url' => home_url( '/applications/' ) ],
    [ 'name' => get_the_title() ],
];
?>
<main class="site-main" id="main">
<article class="single-application">

  <?php if ( $hero ) : ?>
  <section class="page-hero page-hero--image" style="background-image:url('<?php echo esc_url( $hero['url'] ); ?>');">
    <div class="hero-inner">
      <h1 class="page-hero-title"><?php the_title(); ?></h1>
    </div>
  </section>
  <?php else : ?>
  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <h1 class="page-hero-title"><?php the_title(); ?></h1>
    </div>
  </section>
  <?php endif; ?>

  <div class="application-layout">
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

      <?php if ( $intro ) : ?>
      <div class="application-intro"><?php echo wp_kses_post( $intro ); ?></div>
      <?php endif; ?>

      <?php if ( $body ) : ?>
      <div class="application-body"><?php echo wp_kses_post( $body ); ?></div>
      <?php endif; ?>

      <?php if ( ! empty( $feat_products ) ) : ?>
      <div class="application-products">
        <h2 class="brand-section-title">Recommended Products</h2>
        <div class="related-grid">
          <?php foreach ( $feat_products as $product ) :
            $thumb = get_the_post_thumbnail_url( $product->ID, 'supreme-thumb' );
          ?>
          <a href="<?php echo esc_url( get_permalink( $product ) ); ?>" class="related-card related-card--product">
            <?php if ( $thumb ) : ?>
              <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $product->post_title ); ?>" loading="lazy" width="80" height="80">
            <?php endif; ?>
            <span><?php echo esc_html( $product->post_title ); ?></span>
            <span aria-hidden="true">→</span>
          </a>
          <?php endforeach; ?>
        </div>
        <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>" class="link-more">View all products →</a>
      </div>
      <?php endif; ?>

      <?php if ( ! empty( $examples ) ) : ?>
      <div class="application-examples">
        <h2 class="brand-section-title">Project Examples</h2>
        <div class="examples-grid">
          <?php foreach ( $examples as $ex ) :
            if ( empty( $ex['image'] ) ) continue;
          ?>
          <figure class="example-item">
            <img src="<?php echo esc_url( $ex['image']['url'] ); ?>"
                 alt="<?php echo esc_attr( $ex['image_alt'] ?: $ex['project_name'] ); ?>"
                 loading="lazy" width="400" height="300">
            <?php if ( $ex['caption'] || $ex['project_name'] ) : ?>
              <figcaption><?php echo esc_html( $ex['caption'] ?: $ex['project_name'] ); ?></figcaption>
            <?php endif; ?>
          </figure>
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
