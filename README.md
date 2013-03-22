feedreaderSI v1
===============

OnLine RSS feed store and read, with very usefull options


Detalle
-------
Hemos programado feedreaderSI como una herramienta interna debido a las
idas y vueltas del lector que RSS que utilizábamos, Bloglines.

feedreaderSI es una aplicación muy simple para solventar un problema
interno, el almacenar los artículos que nos eran de importancia, que
necesitábamos almacenar para una lectura posterior, guardarlos, eliminarlos
o compartirlos por email.

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
* Marcarlo como Protejido - no se puede eliminar hasta que se desmarque esta opcion
* Marcarlo como Importante - para leerlo posteriormente

feedreaderSI almacena todo el artúclo dentro de la base de datos

También agregamos la opción de importar a la base de datos artículos a la
base de datos, desde el acceso de "Web", donde se debe "pegar" el enlace
del artículo que se quiere agregar a la base de datos.


Configuración
-------------
* Agregar Feeds
* Configurar Feeds
* Configurar Tags
* Descargar Artículos

Funciones
---------

Feeds RSS
* Agregar
* Modificar
* Eliminar

Estadísticas de Artículos
* Por días
* Eliminados por día
* Click por día
* Click por Dia y Eliminados
* Importante por Dia
* Protegido por Dia
* Importantes y Protegidos
* Totales



Aplicaciones dentro de la aplicación
------------------------------------
Esta aplicación utiliza herramientas no programadas por nosotros, estas son:

* magpierss : http://magpierss.sourceforge.net/

Esta aplicación realiza el "parse" de las información RSS


* Libchart : http://naku.dohcrew.com/libchart/pages/introduction/

Genera lo sgráficos de las estadísticas

