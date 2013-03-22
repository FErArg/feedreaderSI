	/**************************************************************************************************
	#     Copyright (c) 2008 - 2013 Fernando A. Rodríguez para SerInformaticos.es                     #
	#                                                                                                 #
	#     Este programa es software libre: usted puede redistribuirlo y / o modificarlo               #
	#     bajo los t&eacute;rminos de la GNU General Public License publicada por la                  #
	#     la Free Software Foundation, bien de la versi&oacute;n 3 de la Licencia, o de               #
	#     la GPL2, o cualquier versi&oacute;n posterior.                                              #
	#                                                                                                 #
	#     Este programa se distribuye con la esperanza de que sea &uacute;til,                        #
	#     pero SIN NINGUNA GARANTÍA, incluso sin la garant&iacute;a impl&iacute;cita de               #
	#     COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. V&eacute;ase el                   #
	#     GNU General Public License para m&aacute;s detalles.                                        #
	#                                                                                                 #
	#     Usted deber&iacute;a haber recibido una copia de la Licencia P&uacute;blica General de GNU  #
	#     junto con este programa. Si no, visite <http://www.gnu.org/licenses/>.                      #
	#                                                                                                 #
	#     Puede descargar la version completa de la GPL3 en este enlace:                              #
	#     	< http://www.serinformaticos.es/index.php?file=kop804.php >                               #
	#                                                                                                 #
	#     Para mas información puede contactarnos :                                                   #
	#                                                                                                 #
	#       Teléfono  (+34) 961 19 60 62                                                              #
	#                                                                                                 #
	#       Email:    info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       MSn:      info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       Twitter:  @SerInformaticos                                                                #
	#                                                                                                 #
	#       Web:      www.SerInformaticos.es                                                          #
	#                                                                                                 #
	**************************************************************************************************/

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `feedreaderSIdemo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioId` int(11) NOT NULL,
  `rssId` int(11) NOT NULL,
  `titulo` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` int(11) NOT NULL,
  `enlace` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` longtext COLLATE utf8_spanish_ci NOT NULL,
  `importante` int(11) NOT NULL DEFAULT '0',
  `eliminado` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  `visitas` int(11) NOT NULL,
  `protegido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `feeds`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filtros`
--

CREATE TABLE IF NOT EXISTS `filtros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filtro` tinytext NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `filtros`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rss`
--

CREATE TABLE IF NOT EXISTS `rss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `rss` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `tagId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=64 ;

--
-- Volcar la base de datos para la tabla `rss`
--

INSERT INTO `rss` (`id`, `nombre`, `usuarioId`, `rss`, `tagId`) VALUES
(6, 'HowtoForge', 2, 'http://www.howtoforge.com/feed.rss', 2),
(8, 'Linux Magazine Full Feed', 2, 'http://www.linux-magazine.com/rss/feed/lmi_full', 2),
(9, 'Linux Today', 2, 'http://feeds.feedburner.com/linuxtoday/linux', 2),
(10, 'Linux.com', 2, 'https://www.linux.com/rss/feeds.php', 2),
(12, 'Linuxaria', 2, 'http://feeds.feedburner.com/Linuxaria_En', 2),
(13, 'Linuxers', 2, 'http://feeds.feedburner.com/Linuxers', 2),
(15, 'MuyLinux', 2, 'http://feeds.feedburner.com/muylinux', 2),
(16, 'nixCraft', 2, 'http://feeds.cyberciti.biz/Nixcraft-LinuxFreebsdSolarisTipsTricks', 2),
(1, 'Huerfanos', 2, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'feedrssSI'),
(2, 'Linux'),
(3, 'Tecnologia'),
(4, 'Informacion'),
(5, 'Web'),
(6, 'Soft');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`) VALUES
(1, 'admin', '49871bc17798142ef1abeab9c2ca67a5'),
(2, 'serinformaticos', '49871bc17798142ef1abeab9c2ca67a5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cliente` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `os` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idioma` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `visitas`
--

