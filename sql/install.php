<?php
/**
* 2007-2017 PrestaShop
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
*  @copyright 2007-2017 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'whatsapp` (
    `id_whatsapp` int(11) NOT NULL AUTO_INCREMENT,
	`telefon` varchar(28),
	`shareThis` int(1),
	`shareMessage` varchar(256),
	`userName` varchar(256),
	`hook` varchar(24),
    PRIMARY KEY  (`id_whatsapp`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'whatsapp_status` (
    `id_status` int(11) NOT NULL AUTO_INCREMENT,
	`status_name` varchar(28),
    PRIMARY KEY  (`id_status`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'whatsapp_status_lang` (
    `id_status_lang` int(11) NOT NULL AUTO_INCREMENT,
    `id_status` int(11),
	`status_message` varchar(128),
	`id_lang` int(3),
    PRIMARY KEY  (`id_status_lang`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'whatsapp_settings` (
    `id_settings` int(11) NOT NULL AUTO_INCREMENT,
    `open` int(5),
    `close` int(5),
	`show_efect` int(1),
	`show_offline` int(1),
	`status` int(1),
    PRIMARY KEY  (`id_settings`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'INSERT INTO `'._DB_PREFIX_.'whatsapp` (`telefon`, `shareThis`, `shareMessage`, `userName`, `hook`) 
VALUES (NULL, 1, "I want to buy {PRODUCT} Product", "Admin", "footer");';

$sql[] = 'INSERT INTO `'._DB_PREFIX_.'whatsapp_status` (`status_name`) VALUES ("online");';
$sql[] = 'INSERT INTO `'._DB_PREFIX_.'whatsapp_status` (`status_name`) VALUES ("offline");';
$sql[] = 'INSERT INTO `'._DB_PREFIX_.'whatsapp_status` (`status_name`) VALUES ("busy");';

$sql[] = 'INSERT INTO `'._DB_PREFIX_.'whatsapp_settings` (`open`, `close`, `show_efect`, `show_offline`) VALUES ("800", "2000", "1", "1");';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
