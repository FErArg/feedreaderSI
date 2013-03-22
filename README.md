feedreaderSI v2
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

feedreaderSI es un sistema de lectura y almacen de feeds, de estilo de
Bloglines o Google Reader pero mucho mas modesto y menos pretencioso.

El sistema funciona con una Base de datos MySQL y PHP5, esta planeado
para ser utilizado por múltilpes usuarios simultaneamente.

feedreaderSI utiliza MagPieRSS para conectar los feed RSS y descargar
los artículos y el script Im OPML Parser

Esta aplicación web nació a causa del uso que hacemos de información
a la que accedemos por medio de los canales de RSS.

Hasta hace unos meses utilizabamos servicios en línea, como Bloglines,
pero con los cambios de su política, nos vimos en la necesidad de mover
los feeds a clientes, tanto de escritorio como para los móviles y
tabletas.

Necesitabamos un lugar centralizado, independiente de aplicaciones
de terceros, tipo Bloglines o Google Reader, por motivos de privacidad
y por seguridad, además de poder extender nosotros las fucionalidades.

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

La configuracion de los usuarios se debe realizar desde el panel de administardión


Configuración aplicación
------------------------
Editar el archivo "inc/framework.php" y configure las opciones:

$db = "NOMBREDB";
$servidor="SERVIDORDV";
$usuario="USUARIODB";
$clave="CLAVEUSUARIODB";
$db="NOMBREDB";

Para el envío de email configurar en el archivo "inc/email/SMTPconfig.php"

$SmtpServer="server smtp";
$SmtpPort="25"; //default
$SmtpUser="usuario";
$SmtpPass="clave";


--------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------
feedreaderSI v.0.1

feedreaderSI es un sistema de lectura y almacen de feeds, de estilo de
Bloglines o Google Reader pero mucho mas modesto y menos pretencioso.

El sistema funciona con una Base de datos MySQL y PHP5, esta planeado
para ser utilizado por múltilpes usuarios simultaneamente.

feedreaderSI utiliza MagPieRSS para conectar los feed RSS y descargar
los artículos y el script Im OPML Parser

Esta aplicación web nació a causa del uso que hacemos de información
a la que accedemos por medio de los canales de RSS.

Hasta hace unos meses utilizabamos servicios en línea, como Bloglines,
pero con los cambios de su política, nos vimos en la necesidad de mover
los feeds a clientes, tanto de escritorio como para los móviles y
tabletas.

Necesitabamos un lugar centralizado, independiente de aplicaciones
de terceros, tipo Bloglines o Google Reader, por motivos de privacidad
y por seguridad, además de poder extender nosotros las fucionalidades.



notaSI+ - Beta 4
Actualización 2012-02-08 -----------------------------------------------------------------------------------------------------------------
Novedades
- mejorado y modificado archivo de carga de enlaces "usuario/cargar.php"

Pendiente:
- Panel de Administración de Usuarios (Alta, Baja, Modificar)
- Cambio clave de acceso por el usuario
- Recuperar clave de Acceso
- Hoja Estilo de toda la web
- Manejo de tags del enlace (Alta, Baja, Modificar)

Actualización 2012-02-07 -----------------------------------------------------------------------------------------------------------------
Novedades
- Contador de Visitas al enlace
- Agregado "usuario/ver3.php"
- Modificada DB para contabilizar las visitas - Tabla Notas Columna visitas
- Modificado "usuario/ver.php" para visualizar el numero de visitas
- Agregado botones de "Ver, Editar, Eliminar" en "usuario/ver.php"
- Modificado "index.php" - formulario de login con estilo
- Agregado hoja de Estilo en tablas
- Modificado el Código para utilizar micro Framework de SerInformaticos

Pendiente:
- Panel de Administración de Usuarios (Alta, Baja, Modificar)
- Cambio clave de acceso por el usuario
- Recuperar clave de Acceso
- Hoja Estilo de toda la web
- Manejo de tags del enlace (Alta, Baja, Modificar)


notaSI+ - Beta 4
Actualización 2012-02-06 -----------------------------------------------------------------------------------------------------------------

Novedades:
- Modificado el código y la base de datos para que funcione con varios usuarios
- Modificado el código de "usuario/cargar.php" para que Controle que no se duplique la carga del mismo enlace
- Modificado el código de "usuario/eliminar3.php" para que no elimine el enlace, sino que lo marque como eliminado
- Modificado el código de "usuario/ver.php" para que solo muestre los enlaces del usuario y que no se hayan eliminado

Pendiente:
- Panel de Administración de Usuarios (Alta, Baja, Modificar)
- Cambio clave de acceso por el usuario
- Recuperar clave de Acceso
- Hoja Estilo de toda la web
- Manejo de tags del enlace (Alta, Baja, Modificar)

notaSI+ - Beta
Detalle ----------------------------------------------------------------------------------------------------------------------------------

En el despacho utilizamos ownCloud v.3, conectando con el servidor por medio de WebDAV, para enviar y almacenar información y archivos que
necesitamos acceder desde nuestros teléfonos inteligentes, tabletas y/o desde la web.

Una de las funcionas que mas utilizamos desde las tabletas, es la función de enviar enlaces al Servidor para leerlos mas tarde, al estilo
de Evernote o Catch.

En las tabletas Android utilizamos el software WebDAV File Manager, ENLACE, este programa crea en el apartado personal de cada usuario del
ownCloud un archivo, que utiliza de almacén de enlaces, llamado “ShareURL.html”.

El archivo “ShareURL.html” es donde el WebDAV File Manager almacena los enlaces, uno sobre otro, y el usuario no puede hacer modificaciones
ni agregar mas información que la que este programa envía al Servidor.

Una función que echamos en falta fue el poder eliminar los enlaces, una vez visitados, o modificarlos, para ello reutilizamos una aplicación
que escribimos hace un tiempo, notasSI, y la adaptamos para que leyese el archivo “ShareURL.html” y almacenase los enlaces en una base de
datos y poder “trabajar” sobre los enlaces desde un navegador web.

El programa es muy sencillo, está en fase beta, y nos falta aún mucha programación, la aplicación, que llamamos notasSI+, funciona de la
siguiente manera:

1- Lee el archivo “ShareURL.html” desde los documentos del usuario (Configuración en "inc/framework.php")
2- Procesa el contenido, ( Título, Fecha, Enlace )
3- Carga los datos en la base de datos
4- Renombra el archivo “ShareURL.html” y lo mueve a al directorio "URL_Cargados" dentro del directorio del usuario en ownCloud
   ( se configura en el archivo "usuario/cargar.php")


Para acceder al código fuente, en nuestra repositorio de GitHUB, en el archivo “inc/framework.php” se deben configurar :

A- Información de la Base de datos
B- Información de donde se almacenan los archivos de ownCloud

En la base de datos, el usuario se almacena en texto plano y la contraseña se almacena el hash MD5


Contacto

info@serinformaticos.es
www.SerInformaticos.es--------------------------------------------------------------------------------------------

--------------------------------------------------------------------------------------------
