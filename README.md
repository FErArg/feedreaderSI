feedreaderSI v1
===============

OnLine RSS feed store and read, with very usefull options


Detalle
-------
Hemos programado feedreaderSI como una herramienta interna debido a las
idas y vueltas del lector que RSS que utilizábamos, Bloglines.

feedreaderSI es una aplicación muy simple escrita para solventar un problema
interno y muy concreto, el almacenar los artículos que nos eran de importancia,
que necesitábamos almacenar para una lectura posterior, guardarlos,
eliminarlos o compartirlos por email.

feedreaderSI nació como multi usuarios, pero hemos preferido fortalecerlo
en funciones y postergamos este capítulo.

A día de hoy nuestra instalación de feedreaderSI almacena mas de 50 mil
artículos


Como Funciona
=============
feedreaderSI utilizando un script de php que se ejecuta desde el panel
de configuracion o desde cron revisa los Feeds RSS y descarga los nuevos
artículos.

Según el origen del artículo se le asigna un "TAG", que posteriormente
puede modificarse.

Los artículos se muestran según el Origen en la página principal,
pudiendo :

* Verlo
* Modificarlo
* Envialo por email
* Eliminarlo
* Marcarlo como Protejido - no se puede eliminar hasta que se desmarque esta opción
* Marcarlo como Importante - para leerlo posteriormente

feedreaderSI almacena todo el artúclo dentro de la base de datos

También agregamos la opción de importar a la base de datos artículos a la
base de datos, desde el acceso de "Web", donde se debe "pegar" el enlace
del artículo que se quiere agregar a la base de datos.


Funciones
---------
Inicio
* Muestra los artículos sin leer ordenador por su origen

Importante
* Detalle de todos los artículos marcados como Importantes

Protegidos
* Detalle de todos los artículos marcados como Protegidos

Buscar
* Permite buscar dentro de los artículos almacenados en la DB

Feeds
* Agregar
* Modificar
* Eliminar

Web
* Descarga el artículo del que se escriba la dirección del artículo

Estadísticas de Artículos
* Por días
* Eliminados por día
* Click por día
* Click por Dia y Eliminados
* Importante por Dia
* Protegido por Dia
* Importantes y Protegidos
* Totales

Configuración
* Agregar Feeds
* Configurar Feeds
* Configurar Tags
* Descargar Artículos


Aplicaciones dentro de la aplicación
------------------------------------
feedreaderSI hace uso de las siguientes herramientas:

* magpierss : http://magpierss.sourceforge.net/
Esta aplicación realiza el "parse" de las información RSS

* Libchart : http://naku.dohcrew.com/libchart/pages/introduction/
Genera los gráficos de las estadísticas

* CSS Table Designs : http://coding.smashingmagazine.com/2008/08/13/top-10-css-table-designs/
Diseño CSS de las tablas para HTML

* Send Mail using SMTP and PHP : http://www.9lessons.info/2009/10/send-mail-using-smtp-and-php.html
Envío de email desde PHP


Usuarios Predeterminados
------------------------
* Administrador
U: admin
C: SerInformaticos

* Usuario
U: serinformaticos
C: SerInformaticos
