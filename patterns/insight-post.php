<?php
/**
 * Pattern: Insight Post — Volinga
 *
 * Estructura del cuerpo del post (lo que va dentro del editor de bloques).
 * El post header (categoría, H1, meta, imagen destacada) lo gestiona singular.php.
 * Este pattern cubre: intro → secciones con imágenes → quote → conclusión.
 */
register_block_pattern(
    'volinga/insight-post',
    [
        'title'       => __( 'Insight Post', 'volinga-cms' ),
        'description' => __( 'Estructura estándar para posts de Insights. Intro, imagen, secciones H2/H3, quote y conclusión.', 'volinga-cms' ),
        'categories'  => [ 'volinga' ],
        'content'     => '
<!-- wp:paragraph -->
<p>Escribe aquí el párrafo introductorio. Debe resumir el tema central en 2-3 frases claras y enganchar al lector antes de que decida seguir leyendo.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Primera sección</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Desarrollo del primer bloque temático. Mantén los párrafos cortos, entre 3-5 líneas, para facilitar la lectura en pantalla.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Segundo párrafo de esta sección con más detalle o ejemplos concretos.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="" alt="Descripción de la imagen" /><figcaption class="wp-element-caption">Pie de foto: contexto o fuente de la imagen.</figcaption></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Segunda sección</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Continúa el desarrollo del artículo con la segunda idea principal. Recuerda: un H2 por cada concepto mayor.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Subsección o detalle</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Usa H3 para profundizar en un aspecto específico dentro de la sección. Limita el uso de H3 a 2-3 por sección.</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>Primer punto relevante del listado</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Segundo punto con información adicional</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Tercer punto que cierra la idea</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p>Aquí va la cita destacada del artículo, de una persona relevante del sector o una idea clave que merezca énfasis visual.</p>
<!-- /wp:paragraph --><cite>Nombre, Cargo — Empresa</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Tercera sección</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Desarrollo de la tercera idea. Si el artículo tiene más de tres secciones, duplica este bloque H2 + párrafos.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="" alt="Segunda imagen del artículo" /><figcaption class="wp-element-caption">Pie de foto opcional.</figcaption></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Conclusión</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cierra el artículo resumiendo los puntos clave y dejando al lector con una idea o acción concreta. Evita introducir ideas nuevas en la conclusión.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Descubre más sobre Volinga</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
',
    ]
);
