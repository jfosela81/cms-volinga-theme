# Setup local — cms-volinga-theme

Guía para montar el entorno WordPress local en cualquier máquina con XAMPP.

## Requisitos previos

- XAMPP instalado (Apache + MySQL corriendo)
- WP-CLI: `brew install wp-cli` (si no lo tienes)
- Git configurado con acceso a GitHub

---

## Pasos

### 1. Crear el directorio y descargar WordPress

```bash
mkdir -p ~/Sites/cms.volinga.ai
cd ~/Sites/cms.volinga.ai
wp core download --locale=en_US
```

### 2. Añadir el vhost HTTP en XAMPP

```bash
cat >> /Applications/XAMPP/etc/extra/httpd-vhosts.conf << 'EOF'

<VirtualHost dev.cms.volinga:80>
  ServerName dev.cms.volinga
  DocumentRoot "/Users/TU_USUARIO/Sites/cms.volinga.ai"
  ErrorLog "/var/log/cms-volinga-error.log"
  CustomLog "/var/log/cms-volinga-access.log" common
  <Directory "/Users/TU_USUARIO/Sites/cms.volinga.ai/">
    Options FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>

<VirtualHost dev.cms.volinga:443>
  ServerName dev.cms.volinga
  DocumentRoot "/Users/TU_USUARIO/Sites/cms.volinga.ai"
  SSLEngine on
  SSLCertificateFile "/etc/apache2/server.crt"
  SSLCertificateKeyFile "/etc/apache2/server.key"
  <Directory "/Users/TU_USUARIO/Sites/cms.volinga.ai/">
    Options FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
EOF
```

> Sustituye `TU_USUARIO` por el nombre de tu usuario de macOS (ej: `jorge`).

### 3. Añadir el dominio local

```bash
echo "127.0.0.1 dev.cms.volinga" | sudo tee -a /etc/hosts
```

### 4. Crear la base de datos

Abre `http://localhost/phpmyadmin` → Nueva → Nombre: `cms_volinga_local` → Cotejamiento: `utf8mb4_unicode_ci` → Crear.

### 5. Configurar y instalar WordPress

```bash
cd ~/Sites/cms.volinga.ai

wp config create \
  --dbname=cms_volinga_local \
  --dbuser=root \
  --dbpass='' \
  --dbhost=127.0.0.1 \
  --dbprefix=vol_ \
  --locale=en_US

wp core install \
  --url="https://dev.cms.volinga" \
  --title="Volinga CMS (local)" \
  --admin_user="volingaadmin" \
  --admin_password='Volinga2026!cms#' \
  --admin_email="jfosela81@gmail.com" \
  --skip-email

wp option update siteurl 'https://dev.cms.volinga'
wp option update home 'https://dev.cms.volinga'
```

### 6. Instalar y activar el tema

```bash
cd ~/Sites/cms.volinga.ai/wp-content/themes/
git clone git@github.com:jfosela81/cms-volinga-theme.git

cd ~/Sites/cms.volinga.ai
wp theme activate cms-volinga-theme
wp rewrite structure '/%postname%/'
wp rewrite flush
```

### 7. Reiniciar Apache en XAMPP

Desde el panel de XAMPP: **Stop → Start** en Apache.

### 8. Verificar

Abre `https://dev.cms.volinga/wp-admin`
- Usuario: `volingaadmin`
- Contraseña: `Volinga2026!cms#`

---

## Actualizar el tema tras cambios

```bash
cd ~/Sites/cms.volinga.ai/wp-content/themes/cms-volinga-theme
git pull
```

## Acceso SSH al servidor

El servidor es `volinga@20.71.104.221`. Para conectarte sin contraseña desde esta máquina:

1. Obtén tu clave pública: `cat ~/.ssh/id_rsa.pub` (o `id_ed25519.pub`)
2. Envíasela a Jorge para que la autorice en el servidor
3. Verifica: `ssh volinga@20.71.104.221 "echo OK"`

## Deploy del tema al servidor

Tras hacer cambios en el tema, commitea y pushea al repo, luego sincroniza al servidor con rsync:

```bash
rsync -avz --exclude='.git/' \
  ~/Sites/cms.volinga.ai/wp-content/themes/cms-volinga-theme/ \
  volinga@20.71.104.221:/var/www/cms.volinga.ai/wp-content/themes/cms-volinga-theme/
```

Después corrige permisos:
```bash
ssh volinga@20.71.104.221 "sudo chown -R www-data:www-data /var/www/cms.volinga.ai/wp-content/themes/cms-volinga-theme/"
```

O todo en una línea:
```bash
rsync -avz --exclude='.git/' \
  ~/Sites/cms.volinga.ai/wp-content/themes/cms-volinga-theme/ \
  volinga@20.71.104.221:/var/www/cms.volinga.ai/wp-content/themes/cms-volinga-theme/ \
  && ssh volinga@20.71.104.221 "sudo chown -R www-data:www-data /var/www/cms.volinga.ai/wp-content/themes/cms-volinga-theme/"
```

## Importar posts XML en el servidor (cms.volinga.ai)

Una vez verificado que el XML se ve bien en local, importar en producción:

1. Ve a `https://cms.volinga.ai/wp-admin` (Basic Auth: `volinga` / contraseña en gestor)
2. Herramientas → Importar → WordPress
3. Sube el fichero `volinga-clean.xml`
4. Mapea todos los autores a `volingaadmin`
5. Marca **"Descargar e importar archivos adjuntos"**
6. Importar

## Credenciales

| | Usuario | Contraseña |
|---|---|---|
| Basic Auth (cms.volinga.ai) | `volinga` | ver gestor |
| WP Admin (cms.volinga.ai) | `volingaadmin` | ver gestor |
| WP Admin (local) | `volingaadmin` | `Volinga2026!cms#` |

