<?php
/**
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
$sql = array();

// Company

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rj_internship_company` (
    `id_internship_company` int(10) NOT NULL AUTO_INCREMENT,
    `position` int(10) NOT NULL DEFAULT \'0\',
    `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
    `date_add` datetime NOT NULL,
    `date_upd` datetime NOT NULL,
    PRIMARY KEY  (`id_internship_company`),
    KEY `position` (`position`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rj_internship_company_lang` (
    `id_internship_company` int(10) unsigned NOT NULL,
    `id_lang` int(10) unsigned NOT NULL,
    `name` varchar(50) NOT NULL,
    `description` text NULL,
    `group` varchar(50) NULL DEFAULT \'none\',
    PRIMARY KEY (`id_internship_company`,`id_lang`)
  ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rj_internship_company_shop` (
    `id_internship_company` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_shop` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id_internship_company`, `id_shop`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;';

// Profession

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rj_internship_profession` (
    `id_internship_profession` int(10) NOT NULL AUTO_INCREMENT,
    `position` int(10) NOT NULL DEFAULT \'0\',
    `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
    `date_add` datetime NOT NULL,
    `date_upd` datetime NOT NULL,
    PRIMARY KEY  (`id_internship_profession`),
    KEY `position` (`position`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rj_internship_profession_lang` (
    `id_internship_profession` int(10) unsigned NOT NULL,
    `id_lang` int(10) unsigned NOT NULL,
    `name` varchar(50) NOT NULL,
    `description` text NULL,
    `group` varchar(50) NULL DEFAULT \'none\',
    PRIMARY KEY (`id_internship_profession`,`id_lang`)
  ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rj_internship_profession_shop` (
    `id_internship_profession` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_shop` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id_internship_profession`, `id_shop`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;';


// tipo de practica
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rj_internship_type_practica` (
    `id_internship_type_practica` int(10) NOT NULL AUTO_INCREMENT,
    `position` int(10) NOT NULL DEFAULT \'0\',
    `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
    `date_add` datetime NOT NULL,
    `date_upd` datetime NOT NULL,
    PRIMARY KEY  (`id_internship_type_practica`),
    KEY `position` (`position`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rj_internship_type_practica_lang` (
    `id_internship_type_practica` int(10) unsigned NOT NULL,
    `id_lang` int(10) unsigned NOT NULL,
    `name` varchar(50) NOT NULL,
    `description` text NULL,
    `group` varchar(50) NULL DEFAULT \'none\',
    PRIMARY KEY (`id_internship_type_practica`,`id_lang`)
  ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=UTF8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rj_internship_type_practica_shop` (
    `id_internship_type_practica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_shop` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`id_internship_type_practica`, `id_shop`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;';

// Insert Company
$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_company` (`id_internship_company`,`position`, `active`,`date_add`, `date_upd`) VALUES
    (1, 1, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."'),
    (2, 2, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."'),
    (3, 3, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."');";

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_company_lang` (`id_internship_company`, `id_lang`, `name`, `description`,`group`) VALUES
    (1, 1, 'Traineeland', 'Empresa de educación', 'educación'),
    (2, 1, 'Dimitra International', 'Empresa de derecho y negocios','derecho'),
    (3, 1, 'Nurservicio', 'Empresa de salud', 'salud');";

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_company_shop` (`id_internship_company`, `id_shop`) VALUES
    (1, 1),
    (2, 1),
    (3, 1);";

// Insert Profession

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_profession` (`id_internship_profession`,`position`, `active`,`date_add`, `date_upd`) VALUES
    (1, 1, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."'),
    (2, 2, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."'),
    (3, 3, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."');";

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_profession_lang` (`id_internship_profession`, `id_lang`, `name`, `description`,`group`) VALUES
    (1, 1, 'Relaciones internacionales', 'educación', 'educación'),
    (2, 1, 'Recursos humanos', 'negocios','derecho'),
    (3, 1, 'Management', 'salud', 'salud');";

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_profession_shop` (`id_internship_profession`, `id_shop`) VALUES
    (1, 1),
    (2, 1),
    (3, 1);";

// Insert Type practica

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_type_practica` (`id_internship_type_practica`,`position`, `active`,`date_add`, `date_upd`) VALUES
    (1, 1, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."'),
    (2, 2, 1, '".date('Y-m-d H:m:s')."', '".date('Y-m-d H:m:s')."');";

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_type_practica_lang` (`id_internship_type_practica`, `id_lang`, `name`, `description`,`group`) VALUES
    (1, 1, 'Erasmus', 'Erasmus', 'educación'),
    (2, 1, 'No Erasmus', 'No Erasmus','derecho');";

$sql[] = "INSERT INTO `" . _DB_PREFIX_ . "rj_internship_type_practica_shop` (`id_internship_type_practica`, `id_shop`) VALUES
    (1, 1),
    (2, 1);";

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
