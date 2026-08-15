<?php get_header(); ?>

<div class="blog-wrap">

    <!-- ── Cabecera de sección ──────────────────────────────── -->
    <div class="post-container">
      <header class="blog-header">
        <h1 class="blog-header-title">Insights</h1>
        <p class="blog-header-desc">Tutorials, case studies and insights on Gaussian splats in production.</p>
      </header>
    </div>

    <?php if ( have_posts() ) : ?>

      <?php $post_count = 0; ?>

      <!-- ── Post destacado hero (sobre fondo degradado) ──────── -->
      <?php the_post(); $post_count++; ?>
      <?php
        $hero_cats  = get_the_category();
        $hero_words = str_word_count( wp_strip_all_tags( get_the_content() ) );
        $hero_rtime = max( 1, (int) ceil( $hero_words / 200 ) );
      ?>
      <section class="blog-hero-section">
        <div class="post-container">
          <a href="<?php the_permalink(); ?>" class="blog-hero-card">

            <?php if ( has_post_thumbnail() ) : ?>
              <div class="blog-hero-image">
                <?php the_post_thumbnail( 'volinga-featured', [ 'alt' => get_the_title() ] ); ?>
              </div>
            <?php endif; ?>

            <div class="blog-hero-body">
              <?php if ( $hero_cats ) : ?>
                <span class="blog-tag">
                  <?php echo esc_html( $hero_cats[0]->name ); ?>
                </span>
              <?php endif; ?>

              <h2 class="blog-hero-title"><?php the_title(); ?></h2>

              <p class="blog-hero-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 28 ); ?></p>

              <div class="blog-card-meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                  <?php echo esc_html( get_the_date( 'M Y' ) ); ?>
                </time>
                <span class="blog-meta-sep">·</span>
                <span><?php echo esc_html( $hero_rtime ); ?> min read</span>
              </div>
            </div>

          </a>
        </div>
      </section>

      <!-- ── Filtro de categorías ─────────────────────────────── -->
      <div class="post-container">
        <nav class="blog-filter">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
             class="btn <?php echo ! is_category() ? 'btn-primary' : 'btn-secondary'; ?>">
            All
          </a>
          <?php
            $cats = get_categories( [ 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true ] );
            foreach ( $cats as $cat ) :
              $is_active = is_category( $cat->term_id );
          ?>
          <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
             class="btn <?php echo $is_active ? 'btn-primary' : 'btn-secondary'; ?>">
            <?php echo esc_html( $cat->name ); ?>
          </a>
          <?php endforeach; ?>
        </nav>
      </div>

      <!-- ── Grid de posts ────────────────────────────────────── -->
      <div class="post-container">
      <?php if ( have_posts() ) : ?>
      <div class="blog-grid">
        <?php while ( have_posts() ) : the_post(); $post_count++; ?>
          <?php
            $card_cats  = get_the_category();
            $card_words = str_word_count( wp_strip_all_tags( get_the_content() ) );
            $card_rtime = max( 1, (int) ceil( $card_words / 200 ) );
          ?>
          <article class="blog-card">
            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>" class="blog-card-image" tabindex="-1" aria-hidden="true">
                <?php the_post_thumbnail( 'volinga-card', [ 'alt' => '' ] ); ?>
              </a>
            <?php endif; ?>

            <div class="blog-card-body">
              <?php if ( $card_cats ) : ?>
                <div class="blog-card-category">
                  <a href="<?php echo esc_url( get_category_link( $card_cats[0]->term_id ) ); ?>">
                    <?php echo esc_html( $card_cats[0]->name ); ?>
                  </a>
                </div>
              <?php endif; ?>

              <h2 class="blog-card-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>

              <div class="blog-card-meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                  <?php echo esc_html( get_the_date( 'M Y' ) ); ?>
                </time>
                <span class="blog-meta-sep">·</span>
                <span><?php echo esc_html( $card_rtime ); ?> min read</span>
              </div>

              <a href="<?php the_permalink(); ?>" class="blog-card-readmore">Read more →</a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>

      <!-- ── Paginación ────────────────────────────────────────── -->
      <nav class="blog-pagination">
        <?php
          the_posts_pagination( [
            'mid_size'  => 2,
            'prev_text' => '← Anterior',
            'next_text' => 'Siguiente →',
          ] );
        ?>
      </nav>

      </div><!-- /.post-container -->

    <?php else : ?>
      <div class="post-container">
        <p class="blog-empty">No hay artículos publicados todavía.</p>
      </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
