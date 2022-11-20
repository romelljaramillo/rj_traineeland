<?php
/*
* 2007-2016 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class InternshipCompany extends ObjectModel
{

    public $name;
    public $description;
    public $position;
    public $group;
    public $active;
    public $date_add;
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'rj_internship_company',
        'primary' => 'id_internship_company',
        'multilang' => true,
        'fields' => [
            'name'        => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 50, 'required' => true],
            'description' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 250],
            'group'       => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 250],
            'position'    => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],
            'active'      => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'date_add'    => ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
            'date_upd'    => ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
        ]
    ];

}