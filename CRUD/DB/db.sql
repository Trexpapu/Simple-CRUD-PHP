CREATE DATABASE php_ajax_crud;

CREATE TABLE IF NOT EXISTS `articulos_crud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `creado` timestamp NULL DEFAULT NULL,
  `actualizado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;