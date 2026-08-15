<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article class="entry" id="post-<?php the_ID(); ?>">

    <header class="entry-header">
      <div class="post-meta">
        <span class="category"><?php the_category( ', ' ); ?></span>
        <time datetime="<?php the_date( 'c' ); ?>"><?php the_date(); ?></time>
        <span>por <?php the_author(); ?></span>
      </div>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="featured-image">
          <?php the_post_thumbnail( 'volinga-featured', [ 'alt' => get_the_title() ] ); ?>
        </div>
      <?php endif; ?>
    </header>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

  </article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
