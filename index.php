<?php get_header(); ?>

<h1 style="margin-bottom:2rem;">Insights</h1>

<?php if ( have_posts() ) : ?>
  <div style="display:grid;gap:2rem;">
  <?php while ( have_posts() ) : the_post(); ?>
    <article style="border:1px solid var(--color-border);border-radius:var(--radius);overflow:hidden;">
      <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'volinga-card', [ 'style' => 'width:100%;aspect-ratio:16/9;object-fit:cover;display:block;' ] ); ?>
        </a>
      <?php endif; ?>
      <div style="padding:1.25rem;">
        <div style="font-size:0.75rem;color:var(--color-muted);margin-bottom:0.5rem;"><?php the_date(); ?></div>
        <h2 style="font-size:1.1rem;margin-bottom:0.5rem;"><a href="<?php the_permalink(); ?>" style="color:var(--color-text);text-decoration:none;"><?php the_title(); ?></a></h2>
        <div style="font-size:0.875rem;color:var(--color-muted);"><?php the_excerpt(); ?></div>
      </div>
    </article>
  <?php endwhile; ?>
  </div>
  <?php the_posts_pagination(); ?>
<?php else : ?>
  <p>No hay posts todavía.</p>
<?php endif; ?>

<?php get_footer(); ?>
