<?php
/**
 * Pattern: Insight Post
 * Categoría: Volinga
 * Estructura estándar para nuevos posts de Carin
 */
register_block_pattern(
    'volinga/insight-post',
    [
        'title'       => __( 'Insight Post', 'volinga-cms' ),
        'description' => __( 'Estructura estándar para posts de Insights. Incluye intro, imagen, secciones y CTA.', 'volinga-cms' ),
        'categories'  => [ 'volinga' ],
        'content'     => '
<!-- wp:paragraph {"className":"volinga-insight-intro"} -->
<p class="volinga-insight-intro">Escribe aquí el párrafo de introducción del post. Debe resumir el tema en 2-3 frases y enganchar al lector.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="" alt="Imagen principal del post"/><figcaption class="wp-element-caption">Pie de foto descriptivo</figcaption></figure>
<!-- /wp:image -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Primera sección</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Contenido de la primera sección.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Segunda sección</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Contenido de la segunda sección.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>Cita destacada del post o de una persona relevante.</p><cite>Nombre, Cargo</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Conclusión</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Párrafo de cierre y llamada a la acción.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Saber más</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
',
    ]
);
