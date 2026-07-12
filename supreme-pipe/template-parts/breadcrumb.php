<?php
/**
 * Breadcrumb
 * Expects $breadcrumbs array to be set before calling.
 */
if ( empty( $breadcrumbs ) ) return;
?>
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
<?php
$schema_crumbs = array_map( fn( $c ) => [ 'name' => $c['name'], 'url' => $c['url'] ?? '' ], $breadcrumbs );
supreme_breadcrumb_schema( $schema_crumbs );
