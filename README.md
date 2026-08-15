# cms-volinga-theme

WordPress theme para `cms.volinga.ai` — setup headless. Este tema es exclusivamente para el **preview editorial de Carin**. El frontend público lo genera Astro.

## Instalación local (XAMPP)

1. Copia esta carpeta a `htdocs/tu-wp/wp-content/themes/cms-volinga-theme/`
2. En WP Admin → Apariencia → Temas → Activar **Volinga CMS Theme**
3. Ajustes → Lectura → asegúrate de que los posts se muestran en la portada

## Deploy al servidor

```bash
ssh volinga@20.71.104.221
cd /var/www/cms.volinga.ai/wp-content/themes/
git clone git@github.com:jfosela81/cms-volinga-theme.git
# Activar en WP Admin → Apariencia → Temas
```

Para actualizar tras cambios:
```bash
ssh volinga@20.71.104.221 "cd /var/www/cms.volinga.ai/wp-content/themes/cms-volinga-theme && git pull"
```

## Estructura

```
cms-volinga-theme/
  style.css          # Metadatos del tema + CSS frontend
  functions.php      # Registro de features, patterns, estilos del editor
  header.php         # Header con badge "CMS Preview"
  footer.php         # Footer con enlace al admin
  singular.php       # Template de post individual
  index.php          # Listado de posts
  patterns/
    insight-post.php # Block pattern estándar para nuevos posts
  assets/
    css/
      editor.css     # Estilos del editor de bloques (Carin ve el diseño oscuro)
```

## Credenciales CMS

- Basic Auth: `volinga` / (ver gestor de contraseñas)
- WP Admin: `volingaadmin` / (ver gestor de contraseñas)
- URL admin: https://cms.volinga.ai/wp-admin
