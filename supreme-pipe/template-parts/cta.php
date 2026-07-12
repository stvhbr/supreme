<?php
/**
 * Global CTA Section
 */
$headline       = get_field( 'cta_headline', 'option' ) ?: 'Ready to Start Your Next Project?';
$primary_label  = get_field( 'cta_primary_label', 'option' ) ?: 'Request a Quote';
$primary_url    = get_field( 'cta_primary_url', 'option' ) ?: home_url( '/contact/' );
$secondary_label = get_field( 'cta_secondary_label', 'option' ) ?: 'Download Brochure';
$brochure       = get_field( 'brochure_file', 'option' );
$bg_image       = get_field( 'cta_bg_image', 'option' );
$bg_style       = $bg_image ? 'style="background-image: url(' . esc_url( $bg_image['url'] ) . ');"' : '';
?>
<section class="cta-section" <?php echo $bg_style; ?> aria-labelledby="cta-headline">
  <div class="cta-inner">
    <h2 class="cta-headline" id="cta-headline"><?php echo esc_html( $headline ); ?></h2>
    <div class="cta-actions">
      <a href="<?php echo esc_url( $primary_url ); ?>" class="btn btn-gold">
        <?php echo esc_html( $primary_label ); ?>
      </a>
      <?php if ( $brochure ) : ?>
        <a href="<?php echo esc_url( $brochure['url'] ); ?>" class="btn btn-text-white" download>
          <?php echo esc_html( $secondary_label ); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
