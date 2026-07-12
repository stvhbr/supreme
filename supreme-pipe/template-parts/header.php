<?php
/**
 * Site Header
 */
$logo_url = get_stylesheet_directory_uri() . '/assets/images/supreme-logo.svg';
?>
<header class="site-header">
  <div class="header-inner">

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="<?php echo esc_attr( get_field( 'company_name', 'option' ) ?: 'Supreme Steel Pipe Corporation' ); ?>">
      <img src="<?php echo esc_url( $logo_url ); ?>" alt="Supreme Steel Pipe Corp Logo" width="132" height="44" loading="eager">
    </a>

    <nav class="main-nav" id="main-nav" aria-label="Main navigation">
      <a href="<?php echo esc_url( home_url( '/about/our-story/' ) ); ?>">About <span class="nav-chevron" aria-hidden="true">▾</span></a>
      <a href="<?php echo esc_url( home_url( '/brands/' ) ); ?>">Brands <span class="nav-chevron" aria-hidden="true">▾</span></a>
      <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>">Products <span class="nav-chevron" aria-hidden="true">▾</span></a>
      <a href="<?php echo esc_url( home_url( '/applications/' ) ); ?>">Applications <span class="nav-chevron" aria-hidden="true">▾</span></a>
      <a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">Resources <span class="nav-chevron" aria-hidden="true">▾</span></a>
      <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
    </nav>

    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-red header-cta">
      Request a free quote
    </a>

    <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="main-nav">
      <span></span><span></span><span></span>
    </button>

  </div>
</header>
