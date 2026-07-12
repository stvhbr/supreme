<?php
/**
 * Site Footer
 */
$tagline   = get_field( 'footer_tagline', 'option' ) ?: 'Philippine manufacturer of black iron and galvanized iron steel pipes since 1991.';
$copyright = get_field( 'copyright_text', 'option' ) ?: '&copy; ' . date( 'Y' ) . ' Supreme Steel Pipe Corporation. All rights reserved.';
$footer_links = get_field( 'footer_company_links', 'option' ) ?: [];
$facebook  = get_field( 'facebook_url', 'option' );
$tiktok    = get_field( 'tiktok_url', 'option' );
$instagram = get_field( 'instagram_url', 'option' );
$linkedin  = get_field( 'linkedin_url', 'option' );

$brands = get_posts( [ 'post_type' => 'brand', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
$products = get_posts( [ 'post_type' => 'product', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
$applications = get_posts( [ 'post_type' => 'application', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ] );
?>
<footer class="site-footer">
  <div class="footer-main">

    <div class="footer-brand">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/supreme-logo-white.svg' ); ?>"
             alt="Supreme Steel Pipe Corp"
             width="200" height="60" loading="lazy">
      </a>
      <p class="footer-tagline"><?php echo nl2br( esc_html( $tagline ) ); ?></p>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-red-sm">Request a quote</a>

      <div class="footer-social">
        <?php if ( $facebook ) : ?>
          <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-facebook.svg' ); ?>" alt="" width="20" height="20" loading="lazy">
          </a>
        <?php endif; ?>
        <?php if ( $tiktok ) : ?>
          <a href="<?php echo esc_url( $tiktok ); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-tiktok.svg' ); ?>" alt="" width="20" height="20" loading="lazy">
          </a>
        <?php endif; ?>
        <?php if ( $instagram ) : ?>
          <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-instagram.svg' ); ?>" alt="" width="20" height="20" loading="lazy">
          </a>
        <?php endif; ?>
        <?php if ( $linkedin ) : ?>
          <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icon-linkedin.svg' ); ?>" alt="" width="20" height="20" loading="lazy">
          </a>
        <?php endif; ?>
      </div>
    </div>

    <nav class="footer-col" aria-label="Company links">
      <h3 class="footer-col-title">Company</h3>
      <ul>
        <?php if ( ! empty( $footer_links ) ) : ?>
          <?php foreach ( $footer_links as $link ) : ?>
            <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
          <?php endforeach; ?>
        <?php else : ?>
          <li><a href="<?php echo esc_url( home_url( '/about/our-story/' ) ); ?>">About</a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/erw-process/' ) ); ?>">Our Process</a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/certifications/' ) ); ?>">Certifications</a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/locations/' ) ); ?>">Location</a></li>
          <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
          <li><a href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>">FAQs</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <?php if ( ! empty( $brands ) ) : ?>
    <nav class="footer-col" aria-label="Brands">
      <h3 class="footer-col-title">Brands</h3>
      <ul>
        <?php foreach ( $brands as $brand ) : ?>
          <li><a href="<?php echo esc_url( get_permalink( $brand ) ); ?>"><?php echo esc_html( $brand->post_title ); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php endif; ?>

    <?php if ( ! empty( $products ) ) : ?>
    <nav class="footer-col" aria-label="Products">
      <h3 class="footer-col-title">Products</h3>
      <ul>
        <?php foreach ( $products as $product ) : ?>
          <li><a href="<?php echo esc_url( get_permalink( $product ) ); ?>"><?php echo esc_html( $product->post_title ); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php endif; ?>

    <?php if ( ! empty( $applications ) ) : ?>
    <nav class="footer-col" aria-label="Applications">
      <h3 class="footer-col-title">Applications</h3>
      <ul>
        <?php foreach ( $applications as $app ) : ?>
          <li><a href="<?php echo esc_url( get_permalink( $app ) ); ?>"><?php echo esc_html( $app->post_title ); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php endif; ?>

  </div>

  <div class="footer-bottom">
    <div class="footer-bottom-inner">
      <p><?php echo wp_kses_post( $copyright ); ?></p>
      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
    </div>
  </div>
</footer>
