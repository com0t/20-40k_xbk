=== Mantenimiento web ===
Contributors: Carlos Doral (<a href="https://webartesanal.com/mantenimiento-web/">Web Artesanal</a>)
Tags: mantenimiento web, mantenimiento wordpress, caida de pagina, error de pagina, servicio 24 horas, soporte wordpress, vigilancia wordpress, monitor web, uptime monitor, uptime service
Requires at least: 3.5
Tested up to: 5.7
Stable tag: 0.8
License: GPLv2 or later 

== Description ==

Este plugin permite poner tu página en modo mantenimiento con el típico mensaje "Página en construcción" o "Página en mantenimiento". El mensaje se puede personalizar y se incorporan varias plantillas para que no tengas que elaborar el diseño.

**Para más información sobre [mantenimiento web](https://webartesanal.com/mantenimiento-web/)**

Características del plugin:

* Poner tu página en construcción para que ningún visitante pueda ver el contenido real.

== Screenshots ==

1. Ésta es la página de configuración del plugin

== Installation ==

1. Descargue el plugin, descomprímalo y súbalo al directorio /wp-content/plugins/
2. Vaya al apartado plugins y active "Mantenimiento Web".
3. El plugin le redigirá a la configuración del mismo. Si no lo hiciese vaya al menú Herramientas, Mantenimiento Web.
4. En este momento el plugin está operativo. El email al que llegarán las alertas es el correo general de su WordPress, ubicado en Ajustes, Generales.

Si lo desea, como método alternativo de instalación puede ir a la sección Plugins y hacer lo siguiente:

1. Pulse 'Añadir nuevo'.
2. En el buscador escriba 'mantenimiento web'.
3. Haga click en 'Instalar' y luego 'Activar'.
4. Ahora siga desde el paso 3 de la sección anterior.

== Changelog ==

= 0.8 =
* Desactivo servicio monitor web hasta que lo depure al 100%

= 0.7 =
* Bug corregido, faltaba una clase, no estaba subida al repositorio

= 0.6 =
* Bug corregido al detectar la clase WP_Error

= 0.5 =
* Añadimos funcionalidad para poner tu WordPress en modo mantenimiento con el típico mensaje "página en construcción"

= 0.4 =
* Bug no dejaba cambiar el email para las alertas
* Mejoras en búsqueda de texto para detectar caída de página

= 0.3 =
* Mejora a la hora de mostrar errores en la comunicación entre servidores.
* Mejora en la detección de caída de página. Ahora se genera un literal dentro del código fuente del sitio web que es buscado por el rastreador.
* Se muestra la versión del plugin en una nueva ruta rest.

= 0.2 =
* La alerta de web caída la envía una sóla vez en lugar de cada 5 minutos.
* Ahora envía una alerta cuando la web se pone en marcha.
* Se muestran más detalles si se produce un error

= 0.1 =
* Versión inicial.

== Troubleshooting ==

**[Si tienes algún problema contacta con nosotros](https://webartesanal.com/contactar/)**



