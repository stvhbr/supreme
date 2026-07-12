<?php
/**
 * Template: Resources Archive (/resources/)
 * Grouped by resource_type taxonomy
 */
get_header();

$resource_types = get_terms( [
    'taxonomy'   => 'resource_type',
    'hide_empty' => true,
    'orderby'    => 'menu_order',
] );
?>
<main class="site-main" id="main">

  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <p class="eyebrow">Technical Library</p>
      <h1 class="page-hero-title">Resources</h1>
      <p class="page-hero-desc">Pipe standards, size guides, product catalogues, and test reports — everything you need to specify the right pipe for your project.</p>
    </div>
  </section>

  <section class="resources-section">
    <div class="who-inner">
      <?php if ( ! empty( $resource_types ) ) : ?>
        <?php foreach ( $resource_types as $type ) :
          $resources = get_posts( [
              'post_type'   => 'resource',
              'posts_per_page' => -1,
              'tax_query'   => [ [ 'taxonomy' => 'resource_type', 'terms' => $type->term_id ] ],
              'orderby'     => 'menu_order',
          ] );
          if ( empty( $resources ) ) continue;
        ?>
        <div class="resource-group">
          <h2 class="resource-group-title"><?php echo esc_html( $type->name ); ?></h2>
          <div class="resource-list">
            <?php foreach ( $resources as $res ) :
              $res_type   = get_field( 'resource_type_select', $res->ID );
              $std_code   = get_field( 'standard_code', $res->ID );
              $download   = get_field( 'download_file', $res->ID );
              $optin      = get_field( 'optin_required', $res->ID );
              $excerpt    = get_the_excerpt( $res );
            ?>
            <div class="resource-item">
              <div class="resource-item-text">
                <?php if ( $std_code ) : ?>
                  <span class="resource-code"><?php echo esc_html( $std_code ); ?></span>
                <?php endif; ?>
                <h3 class="resource-name">
                  <a href="<?php echo esc_url( get_permalink( $res ) ); ?>"><?php echo esc_html( $res->post_title ); ?></a>
                </h3>
                <?php if ( $excerpt ) : ?>
                  <p class="resource-excerpt"><?php echo esc_html( $excerpt ); ?></p>
                <?php endif; ?>
              </div>
              <div class="resource-item-action">
                <?php if ( $download ) : ?>
                  <?php if ( $optin ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $res ) ); ?>" class="btn btn-outline">
                      Get Download →
                    </a>
                  <?php else : ?>
                    <a href="<?php echo esc_url( $download['url'] ); ?>" class="btn btn-outline" download>
                      Download PDF
                    </a>
                  <?php endif; ?>
                <?php else : ?>
                  <a href="<?php echo esc_url( get_permalink( $res ) ); ?>" class="btn btn-outline">
                    View →
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else : ?>
        <p>No resources found. Please check back soon.</p>
      <?php endif; ?>
    </div>
  </section>

  <?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer();
