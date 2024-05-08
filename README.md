# Framework CodeIgniter 4

## ¿Qué es CodeIgniter?

CodeIgniter es un framework web full-stack para PHP que es ligero, rápido, flexible y seguro. Puedes encontrar más información en el [sitio oficial](https://codeigniter.com).

Este repositorio contiene la versión distribuible del framework. Ha sido creado a partir del [repositorio de desarrollo](https://github.com/codeigniter4/CodeIgniter4).

Más información sobre los planes para la versión 4 se puede encontrar en [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) en los foros.

La guía de usuario correspondiente a la última versión del framework se puede encontrar [aquí](https://codeigniter4.github.io/userguide/).

## Cambio importante con `index.php`

El archivo `index.php` ya no está en la raíz del proyecto. Ahora se ha movido a la carpeta *public*, para mejorar la seguridad y la separación de componentes.

Esto significa que debes configurar tu servidor web para "apuntar" a la carpeta *public* de tu proyecto y no a la raíz del proyecto. Una práctica recomendada sería configurar un host virtual para apuntar allí. Una práctica incorrecta sería configurar el servidor web para apuntar a la raíz del proyecto y esperar entrar a *public/...*, ya que el resto de tu lógica y el framework quedarían expuestos.

**Por favor** lee la guía de usuario para una mejor explicación de cómo funciona CI4.

## Gestión del Repositorio

Usamos issues en GitHub, en nuestro repositorio principal, para rastrear **ERRORES** y para hacer seguimiento de paquetes de trabajo de **DESARROLLO** aprobados. Usamos nuestro [foro](http://forum.codeigniter.com) para proporcionar SOPORTE y discutir SOLICITUDES DE CARACTERÍSTICAS.

Este repositorio es uno de "distribución", construido por nuestro script de preparación de lanzamientos. Los problemas relacionados con este repositorio se pueden reportar en nuestro foro o como issues en el repositorio principal.

## Contribuciones

Damos la bienvenida a las contribuciones de la comunidad.

Por favor, lee la sección [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) en el repositorio de desarrollo.

## Requisitos del Servidor

Se requiere PHP versión 7.4 o superior, con las siguientes extensiones instaladas:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> **Advertencia**
> La fecha de fin de vida para PHP 7.4 fue el 28 de noviembre de 2022. Si aún estás utilizando PHP 7.4, deberías actualizarte de inmediato. La fecha de fin de vida para PHP 8.0 será el 26 de noviembre de 2023.

Además, asegúrate de que las siguientes extensiones estén habilitadas en tu PHP:

- json (habilitado por defecto - no lo deshabilites)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) si planeas usar MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) si planeas usar la librería HTTP\CURLRequest


# Instalación y Configuración

Descargar o clonar el proyecto.


## Instalación


```bash
  cd mi-proyect-name
  composer install
```
    
## Conexión MySQL (.env)
```bash
  database.default.hostname = localhost
  database.default.database = digital
  database.default.username = root
  database.default.password = 
  database.default.DBDriver = MySQLi
  database.default.DBPrefix =
  database.default.port = 3306
```
## baseURL (.env)

Agregar la url de como se accede al proyecto en el navegador:
```bash
  app.baseURL = 'http://digital.test/'
```
## Migraciones
Una vez creado la base de datos y cambiado la conexión.

```bash
  php spark migrate
```

## Seeder y factory
Ejecutar seeder

```bash
  php spark db:seed MainSeeder
```

## Usuario Administrador Generado

```bash
  Correo: admin@gmail.com
  Clae : admin123
```