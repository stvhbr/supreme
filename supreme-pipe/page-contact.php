<?php
/**
 * Template Name: Contact Page
 * Template: page-contact
 */
get_header();

$form_id = get_field( 'form_id', 'option' );

// Locations
$locations = get_posts( [
    'post_type'      => 'location',
    'posts_per_page' => -1,
    'orderby'        => 'meta_value_num',
    'meta_key'       => 'sort_order',
    'order'          => 'ASC',
] );

// Build LocalBusiness schema for each location
foreach ( $locations as $loc ) :
    $coords = get_field( 'coordinates', $loc->ID );
    $lat = $lng = '';
    if ( $coords ) {
        $parts = array_map( 'trim', explode( ',', $coords ) );
        $lat = $parts[0] ?? '';
        $lng = $parts[1] ?? '';
    }
    $loc_schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'LocalBusiness',
        'name'          => $loc->post_title,
        'address'       => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => get_field( 'address', $loc->ID ),
            'addressLocality' => get_field( 'city_region', $loc->ID ),
            'addressCountry'  => 'PH',
        ],
        'telephone'     => get_field( 'phone', $loc->ID ),
        'email'         => get_field( 'email', $loc->ID ),
        'openingHours'  => get_field( 'operating_hours', $loc->ID ),
        'url'           => home_url(),
    ];
    if ( $lat && $lng ) {
        $loc_schema['geo'] = [
            '@type'     => 'GeoCoordinates',
            'latitude'  => $lat,
            'longitude' => $lng,
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode( $loc_schema, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
endforeach;
?>
<main class="site-main" id="main">

  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <p class="eyebrow">Get In Touch</p>
      <h1 class="page-hero-title">Contact Us</h1>
      <p class="page-hero-desc">Request a quote, ask about our products, or find your nearest distributor.</p>
    </div>
  </section>

  <section class="contact-section">
    <div class="contact-inner who-inner">

      <!-- Quote form -->
      <div class="contact-form-col">
        <h2 class="brand-section-title">Request a Free Quote</h2>
        <?php if ( $form_id && function_exists( 'gravity_form' ) ) : ?>
          <?php gravity_form( $form_id, false, false, false, null, true ); ?>
        <?php elseif ( $form_id && function_exists( 'wpforms' ) ) : ?>
          <?php echo do_shortcode( '[wpforms id="' . intval( $form_id ) . '"]' ); ?>
        <?php else : ?>
          <p>Quote form coming soon. Please <a href="mailto:<?php echo esc_attr( get_field( 'email_main', 'option' ) ); ?>">email us directly</a>.</p>
        <?php endif; ?>
      </div>

      <!-- Locations -->
      <?php if ( ! empty( $locations ) ) : ?>
      <div class="contact-locations-col">
        <h2 class="brand-section-title">Our Locations</h2>
        <div class="locations-list">
          <?php foreach ( $locations as $loc ) :
            $type    = get_field( 'location_type', $loc->ID );
            $address = get_field( 'address', $loc->ID );
            $city    = get_field( 'city_region', $loc->ID );
            $phone   = get_field( 'phone', $loc->ID );
            $email   = get_field( 'email', $loc->ID );
            $hours   = get_field( 'operating_hours', $loc->ID );
            $maps    = get_field( 'google_maps_url', $loc->ID );
            $type_labels = [
                'main_office'  => 'Main Office',
                'warehouse'    => 'Warehouse',
                'dealer'       => 'Authorized Dealer',
                'distributor'  => 'Distributor',
            ];
          ?>
          <div class="location-card">
            <div class="location-card-header">
              <h3 class="location-name"><?php echo esc_html( $loc->post_title ); ?></h3>
              <?php if ( $type && isset( $type_labels[ $type ] ) ) : ?>
                <span class="location-type-badge"><?php echo esc_html( $type_labels[ $type ] ); ?></span>
              <?php endif; ?>
            </div>
            <div class="location-rows">
              <?php if ( $address || $city ) : ?>
              <div class="location-row">
                <span class="location-row-label">Address</span>
                <span class="location-row-val">
                  <?php echo esc_html( $address ); ?>
                  <?php if ( $city ) echo '<br>' . esc_html( $city ); ?>
                </span>
              </div>
              <?php endif; ?>
              <?php if ( $phone ) : ?>
              <div class="location-row">
                <span class="location-row-label">Phone</span>
                <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ); ?>" class="location-row-val">
                  <?php echo esc_html( $phone ); ?>
                </a>
              </div>
              <?php endif; ?>
              <?php if ( $email ) : ?>
              <div class="location-row">
                <span class="location-row-label">Email</span>
                <a href="mailto:<?php echo esc_attr( $email ); ?>" class="location-row-val">
                  <?php echo esc_html( $email ); ?>
                </a>
              </div>
              <?php endif; ?>
              <?php if ( $hours ) : ?>
              <div class="location-row">
                <span class="location-row-label">Hours</span>
                <span class="location-row-val"><?php echo esc_html( $hours ); ?></span>
              </div>
              <?php endif; ?>
            </div>
            <?php if ( $maps ) : ?>
            <a href="<?php echo esc_url( $maps ); ?>" class="location-directions" target="_blank" rel="noopener noreferrer">
              Get Directions →
            </a>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </section>

</main>
<?php get_footer();
