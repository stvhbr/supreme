<?php
/**
 * Template: FAQs Archive (/faqs/)
 * Grouped by faq_group taxonomy, accordion UI, FAQPage schema
 */
get_header();

$faq_groups = get_terms( [
    'taxonomy'   => 'faq_group',
    'hide_empty' => true,
    'orderby'    => 'menu_order',
] );

// Collect all FAQs for schema
$all_faq_schema = [];
?>
<main class="site-main" id="main">

  <section class="page-hero page-hero--light">
    <div class="hero-inner">
      <p class="eyebrow">Got Questions?</p>
      <h1 class="page-hero-title">Frequently Asked Questions</h1>
      <p class="page-hero-desc">Find answers about our steel pipe products, standards, ordering, and delivery across the Philippines.</p>
    </div>
  </section>

  <section class="faqs-section">
    <div class="who-inner">

      <?php if ( ! empty( $faq_groups ) ) : ?>
        <?php foreach ( $faq_groups as $group ) :
          $faqs = get_posts( [
              'post_type'      => 'faq',
              'posts_per_page' => -1,
              'tax_query'      => [ [ 'taxonomy' => 'faq_group', 'terms' => $group->term_id ] ],
              'orderby'        => 'meta_value_num',
              'meta_key'       => 'sort_order',
              'order'          => 'ASC',
          ] );
          if ( empty( $faqs ) ) continue;
        ?>
        <div class="faq-group">
          <h2 class="faq-group-title"><?php echo esc_html( $group->name ); ?></h2>
          <div class="faq-accordion">
            <?php foreach ( $faqs as $faq ) :
              $answer = get_field( 'faq_answer', $faq->ID );
              $all_faq_schema[] = [ 'question' => $faq->post_title, 'answer' => $answer ];
            ?>
            <details class="faq-item">
              <summary class="faq-question">
                <?php echo esc_html( $faq->post_title ); ?>
              </summary>
              <div class="faq-answer">
                <?php echo wp_kses_post( $answer ); ?>
              </div>
            </details>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>

      <?php else :
        // No groups — show all FAQs flat
        $all_faqs = get_posts( [
            'post_type'      => 'faq',
            'posts_per_page' => -1,
            'orderby'        => 'meta_value_num',
            'meta_key'       => 'sort_order',
            'order'          => 'ASC',
        ] );
        if ( ! empty( $all_faqs ) ) : ?>
          <div class="faq-accordion">
            <?php foreach ( $all_faqs as $faq ) :
              $answer = get_field( 'faq_answer', $faq->ID );
              $all_faq_schema[] = [ 'question' => $faq->post_title, 'answer' => $answer ];
            ?>
            <details class="faq-item">
              <summary class="faq-question"><?php echo esc_html( $faq->post_title ); ?></summary>
              <div class="faq-answer"><?php echo wp_kses_post( $answer ); ?></div>
            </details>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <p>No FAQs found yet. Check back soon!</p>
        <?php endif; ?>
      <?php endif; ?>

      <!-- Still have questions? -->
      <div class="faq-contact-prompt">
        <p>Still have a question?</p>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-red">Contact Us</a>
      </div>

    </div>
  </section>

  <?php get_template_part( 'template-parts/cta' ); ?>
</main>

<?php
// FAQPage schema — all FAQs on this page
if ( ! empty( $all_faq_schema ) ) {
    supreme_faq_schema( $all_faq_schema );
}
get_footer();
