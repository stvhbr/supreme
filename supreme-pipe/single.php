<?php
/**
 * Template: Single Blog Post
 */
get_header();
the_post();

$breadcrumbs = [
    [ 'name' => 'Home', 'url' => home_url( '/' ) ],
    [ 'name' => 'Blog', 'url' => home_url( '/blog/' ) ],
    [ 'name' => get_the_title() ],
];

// Article schema
$article_schema = [
    '@context'         => 'https://schema.org',
    '@type'            => 'Article',
    'headline'         => get_the_title(),
    'datePublished'    => get_the_date( 'c' ),
    'dateModified'     => get_the_modified_date( 'c' ),
    'author'           => [
        '@type' => 'Person',
        'name'  => get_the_author(),
    ],
    'publisher'        => [
        '@type' => 'Organization',
        'name'  => get_field( 'company_name', 'option' ) ?: 'Supreme Steel Pipe Corporation',
        'logo'  => [
            '@type' => 'ImageObject',
            'url'   => wp_get_attachment_url( get_field( 'schema_logo', 'option' )['ID'] ?? 0 ),
        ],
    ],
    'description'      => get_the_excerpt(),
    'mainEntityOfPage' => [ '@type' => 'WebPage', '@id' => get_permalink() ],
];
if ( has_post_thumbnail() ) {
    $article_schema['image'] = get_the_post_thumbnail_url( null, 'supreme-hero' );
}
?>
<main class="site-main" id="main">
<article class="single-post" <?php post_class(); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="post-hero">
    <?php the_post_thumbnail( 'supreme-hero', [ 'loading' => 'eager', 'fetchpriority' => 'high' ] ); ?>
  </div>
  <?php endif; ?>

  <div class="post-layout">
    <div class="who-inner">

      <!-- Breadcrumb -->
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

      <header class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
        <p class="post-meta">
          <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
          · By <?php the_author(); ?>
        </p>
      </header>

      <div class="post-content entry-content">
        <?php the_content(); ?>
      </div>

      <!-- Related products (from ACF if set, or by category) -->
      <?php
      $related_products = get_field( 'related_products' );
      if ( ! empty( $related_products ) ) : ?>
      <div class="post-related-products">
        <h2 class="brand-section-title">Related Products</h2>
        <div class="related-grid">
          <?php foreach ( $related_products as $product ) : ?>
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

<script type="application/ld+json"><?php echo wp_json_encode( $article_schema, JSON_UNESCAPED_SLASHES ); ?></script>

<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
