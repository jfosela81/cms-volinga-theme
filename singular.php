<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php
  // Reading time estimado: ~200 palabras/min
  $content     = get_the_content();
  $word_count  = str_word_count( wp_strip_all_tags( $content ) );
  $read_time   = max( 1, (int) ceil( $word_count / 200 ) );
  $categories  = get_the_category();
?>

<article class="post-layout" id="post-<?php the_ID(); ?>">

  <!-- ── Post header (1248px) ───────────────────────────────── -->
  <div class="post-header-wrap">
    <div class="post-container">

      <?php if ( $categories ) : ?>
        <div class="post-category">
          <?php foreach ( $categories as $cat ) : ?>
            <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
              <?php echo esc_html( $cat->name ); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <h1 class="post-title"><?php the_title(); ?></h1>

      <div class="post-meta">
        <time class="post-meta-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
          <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
        </time>
        <span class="post-meta-sep">·</span>
        <span class="author"><?php echo esc_html( get_the_author() ); ?></span>
        <span class="post-meta-sep">·</span>
        <span><?php echo esc_html( $read_time ); ?> min read</span>
      </div>

      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-featured-image">
          <?php the_post_thumbnail( 'volinga-featured', [ 'alt' => get_the_title() ] ); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>

  <!-- ── Post body (760px centrado) ─────────────────────────── -->
  <div class="post-body-wrap">
    <div class="post-body">
      <?php the_content(); ?>
    </div>
  </div>

</article>

<!-- ── Explore other articles ─────────────────────────────────── -->
<?php if ( $categories ) :
  $category_ids = wp_list_pluck( $categories, 'term_id' );
  $related = new WP_Query( [
    'category__in'        => $category_ids,
    'post__not_in'        => [ get_the_ID() ],
    'posts_per_page'      => 3,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
  ] );
?>
<?php if ( $related->have_posts() ) : ?>
<section class="explore-section">
  <div class="post-container">

    <h2 class="explore-title">Explore other articles</h2>

    <div class="explore-grid">
      <?php while ( $related->have_posts() ) : $related->the_post(); ?>
      <article class="explore-card">

        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" class="explore-card-image" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail( 'volinga-card', [ 'alt' => '' ] ); ?>
          </a>
        <?php endif; ?>

        <div class="explore-card-body">
          <?php $card_cats = get_the_category(); if ( $card_cats ) : ?>
            <div class="explore-card-category">
              <a href="<?php echo esc_url( get_category_link( $card_cats[0]->term_id ) ); ?>">
                <?php echo esc_html( $card_cats[0]->name ); ?>
              </a>
            </div>
          <?php endif; ?>

          <h3 class="explore-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>

          <div class="explore-card-meta">
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
              <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
            </time>
          </div>
        </div>

      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

  </div>
</section>
<?php endif; endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
