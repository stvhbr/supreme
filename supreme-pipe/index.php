<?php
/**
 * Fallback template — WordPress requires index.php in every theme.
 * All real templates live in their own files. This is only used
 * when no other template matches.
 */
get_header();
?>
<main class="site-main" id="main">
  <div class="header-inner" style="padding-block: 64px;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article>
        <h1><?php the_title(); ?></h1>
        <div class="entry-content"><?php the_content(); ?></div>
      </article>
    <?php endwhile; else : ?>
      <p>No content found.</p>
    <?php endif; ?>
  </div>
</main>
<?php get_footer();
