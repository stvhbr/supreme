<?php
/**
 * Template: Single Brand (/brands/[slug]/)
 */
get_header();
the_post();

$logo          = get_field( 'brand_logo' );
$hero_bg       = get_field( 'brand_hero_bg' );
$tagline       = get_field( 'brand_tagline' );
$intro         = get_field( 'intro_paragraph' );
$product_cards = get_field( 'product_type_cards' );
$standards     = get_field( 'standards_list' );
$applications  = get_field( 'applications' );
$related       = get_field( 'related_brands' );
$body          = get_field( 'body_content' );

$breadcrumbs = [
    [ 'name' => 'Home',   'url' => home_url( '/' ) ],
    [ 'name' => 'Brands', 'url' => home_url( '/brands/' ) ],
    [ 'name' => get_the_title() ],
];

$all_brands = get_posts( [
    'post_type'      => 'brand',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>
<main class="site-main" id="main">
<article class="single-brand">

  <section class="brand-hero"
    <?php if ( $hero_bg ) echo 'style="background-image:url(\'' . esc_url( $hero_bg['url'] ) . '\');"'; ?>>
    <div class="brand-hero-inner hero-inner">
      <?php if ( $logo ) : ?>
        <img src="<?php echo esc_url( $logo['url'] ); ?>"
             alt="<?php echo esc_attr( get_the_title() ); ?> logo"
             class="brand-hero-logo" loading="eager">
      <?php else : ?>
        <h1 class="brand-hero-title"><?php the_title(); ?></h1>
      <?php endif; ?>
    </div>
  </section>

  <div class="brand-layout">
    <div class="brand-layout-inner">

      <aside class="brand-sidebar" aria-label="Browse brands">
        <p class="sidebar-label">Brands</p>
        <nav>
          <?php foreach ( $all_brands as $b ) : ?>
          <a href="<?php echo esc_url( get_permalink( $b ) ); ?>"
             class="sidebar-link<?php echo ( $b->ID === get_the_ID() ) ? ' sidebar-link--active' : ''; ?>">
            <?php echo esc_html( $b->post_title ); ?>
          </a>
          <?php endforeach; ?>
        </nav>
      </aside>

      <div class="brand-main-content">

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

        <h1 class="brand-page-title"><?php the_title(); ?></h1>

        <?php if ( $intro ) : ?>
        <div class="brand-intro"><?php echo wp_kses_post( $intro ); ?></div>
        <?php endif; ?>

        <?php if ( ! empty( $body ) ) :
          foreach ( $body as $block ) :
            if ( $block['acf_fc_layout'] === 'text_block' ) : ?>
              <div class="brand-content-block">
                <?php if ( $block['heading'] ) : ?>
                  <h2 class="brand-section-title"><?php echo esc_html( $block['heading'] ); ?></h2>
                <?php endif; ?>
                <?php echo wp_kses_post( $block['content'] ); ?>
              </div>
            <?php endif;
          endforeach;
        endif; ?>

        <?php if ( ! empty( $product_cards ) ) : ?>
        <div class="brand-product-types">
          <h2 class="brand-section-title">Product Type</h2>
          <?php foreach ( $product_cards as $card ) :
            $product_url = ! empty( $card['cta_product'] ) ? get_permalink( $card['cta_product'] ) : '#';
          ?>
          <div class="product-type-card">
            <?php if ( ! empty( $card['image'] ) ) : ?>
            <img src="<?php echo esc_url( $card['image']['url'] ); ?>"
                 alt="<?php echo esc_attr( $card['image_alt'] ?: ( $card['image']['alt'] ?? '' ) ); ?>"
                 loading="lazy" class="product-type-card-img">
            <?php endif; ?>
            <div class="product-type-card-body">
              <div class="product-type-card-header">
                <strong><?php echo esc_html( $card['name'] ); ?></strong>
                <?php if ( $card['subtitle'] ) : ?>
                  <span class="product-type-subtitle"><?php echo esc_html( $card['subtitle'] ); ?></span>
                <?php endif; ?>
              </div>
              <?php if ( ! empty( $card['specs'] ) ) : ?>
              <dl class="product-type-specs">
                <?php foreach ( $card['specs'] as $spec ) : ?>
                  <div class="spec-row">
                    <dt><?php echo esc_html( $spec['label'] ); ?></dt>
                    <dd><?php echo esc_html( $spec['value'] ); ?></dd>
                  </div>
                <?php endforeach; ?>
              </dl>
              <?php endif; ?>
              <a href="<?php echo esc_url( $product_url ); ?>" class="btn btn-red-sm">
                <?php echo esc_html( $card['cta_label'] ?: 'View Product →' ); ?>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $applications ) ) : ?>
        <div class="brand-applications">
          <h2 class="brand-section-title">Applications</h2>
          <p><?php echo esc_html( get_the_title() ); ?> pipes are commonly used in:</p>
          <div class="related-grid">
            <?php foreach ( $applications as $app ) :
              $icon = get_field( 'icon_svg', $app->ID );
            ?>
            <a href="<?php echo esc_url( get_permalink( $app ) ); ?>" class="related-card">
              <?php if ( $icon ) : ?>
                <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="" width="24" height="24" loading="lazy">
              <?php endif; ?>
              <span><?php echo esc_html( $app->post_title ); ?></span>
              <span aria-hidden="true">→</span>
            </a>
            <?php endforeach; ?>
          </div>
          <a href="<?php echo esc_url( home_url( '/applications/' ) ); ?>" class="link-more">View all applications →</a>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $standards ) ) : ?>
        <div class="brand-standards">
          <h2 class="brand-section-title">Standards &amp; Compliance</h2>
          <p><?php echo esc_html( get_the_title() ); ?> pipes comply with:</p>
          <ul class="standards-list">
            <?php foreach ( $standards as $std ) : ?>
            <li>
              <?php if ( ! empty( $std['resource_page'] ) ) : ?>
                <a href="<?php echo esc_url( get_permalink( $std['resource_page'] ) ); ?>"><?php echo esc_html( $std['code'] ); ?></a>
              <?php else : ?>
                <?php echo esc_html( $std['code'] ); ?>
              <?php endif; ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>" class="link-more">Learn more about standards →</a>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $related ) ) : ?>
        <div class="brand-related">
          <h2 class="brand-section-title">Related Brands</h2>
          <div class="brands-grid brands-grid--small">
            <?php foreach ( $related as $rb ) :
              $rb_logo = get_field( 'brand_logo', $rb->ID );
              $rb_hero = get_field( 'brand_hero_bg', $rb->ID );
            ?>
            <a href="<?php echo esc_url( get_permalink( $rb ) ); ?>" class="brand-card brand-card--small"
              <?php if ( $rb_hero ) echo 'style="background-image:url(\'' . esc_url( $rb_hero['url'] ) . '\');"'; ?>>
              <?php if ( $rb_logo ) : ?>
                <img src="<?php echo esc_url( $rb_logo['url'] ); ?>" alt="<?php echo esc_attr( $rb->post_title ); ?>" loading="lazy">
              <?php else : ?>
                <span><?php echo esc_html( $rb->post_title ); ?></span>
              <?php endif; ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

</article>

<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
