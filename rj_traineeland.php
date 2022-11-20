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

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once(__DIR__ . '/model/InternshipCompany.php');
include_once(__DIR__ . '/model/InternshipProfession.php');
include_once(__DIR__ . '/model/InternshipTypePractica.php');

class Rj_Traineeland extends Module
{   
    /**
     * Default hook to install
     * 1.6 and 1.7
     *
     * @var array
     */
    const RJ_HOOK_LIST = [
        'displayHeader',
        'displayBackOfficeHeader'
    ];

        /**
     * Hook to install for 1.7
     *
     * @var array
     */
    const RJ_HOOK_LIST_17 = [
        'header',
    ];

    /**
     * Hook to install for 1.6
     *
     * @var array
     */
    const RJ_HOOK_LIST_16 = [
        'adminOrder',
    ];

        /**
     * Names of ModuleAdminController used
     */
    const RJ_MODULE_ADMIN_CONTROLLERS = [
        'AdminParentTabRjInternship' => [
            'name' => 'Traineelan',
            'visible' => true,
            'class_name' => 'AdminParentTabRjInternship'
        ],
        'AdminRjInternshipModule' => [
            'name' => 'Configuration',
            'visible' => true,
            'class_name' => 'AdminRjInternshipModule',
            'parent_class_name' => 'AdminParentTabRjInternship',
            'icon' => 'settings'
        ],
        'AdminRjInternshipCompany' => [
            'name' => 'Companies',
            'visible' => true,
            'class_name' => 'AdminRjInternshipCompany',
            'parent_class_name' => 'AdminRjInternshipModule',
        ],
        'AdminRjInternshipProfession' => [
            'name' => 'Professions',
            'visible' => true,
            'class_name' => 'AdminRjInternshipProfession',
            'parent_class_name' => 'AdminRjInternshipModule',
        ],
        'AdminRjInternshipTypePractica' => [
            'name' => 'Type Practica',
            'visible' => true,
            'class_name' => 'AdminRjInternshipTypePractica',
            'parent_class_name' => 'AdminRjInternshipModule',
        ],
    ];

    public function __construct()
    {
        $this->name = 'rj_traineeland';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Roanja';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Internship Traineeland');
        $this->description = $this->l('Gestión de practicas');

        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];

        // $this->templateFile = 'module:rj_hosting/views/templates/hook/search_domain.tpl';
    }

    public function install()
    {
        $defaultInstall = parent::install()
            && $this->registerHook(self::RJ_HOOK_LIST)
            && $this->installTabs();

        if(!$defaultInstall){
            return false;
        }

        include(dirname(__FILE__).'/sql/install.php');

        // Install specific to prestashop 1.7
        if(_PS_VERSION_ >= 1.7){
            $result = $this->registerHook(self::RJ_HOOK_LIST_17);
            return $result;
        }

        // Install specific to prestashop 1.6
        $result = $this->registerHook(self::RJ_HOOK_LIST_16);
        return $result;
    }

    /**
     * Install all Tabs.
     *
     * @return bool
     */
    public function installTabs()
    {
        foreach (static::RJ_MODULE_ADMIN_CONTROLLERS as $adminTab) {
            if (false === $this->installTab($adminTab)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Install Tab.
     * Used in upgrade script.
     *
     * @param array $tabData
     *
     * @return bool
     */
    public function installTab(array $tabData)
    {
        if (Tab::getIdFromClassName($tabData['class_name'])) {
            return true;
        }

        $tab = new Tab();
        $tab->module = $this->name;
        $tab->class_name = $tabData['class_name'];
        $tab->id_parent = empty($tabData['parent_class_name']) ? 0 : Tab::getIdFromClassName($tabData['parent_class_name']);
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $tabData['name'];
        }
        if(!empty($tabData['icon'])){
            $tab->icon = $tabData['icon'];
        }

        return $tab->add();
    }

    /**
     * Function executed at the uninstall of the module
     *
     * @return bool
     */
    public function uninstall()
    {
        include(dirname(__FILE__).'/sql/uninstall.php');
        
        return parent::uninstall() && $this->uninstallTabs();
    }

    /**
     * Uninstall all Tabs.
     *
     * @return bool
     */
    public function uninstallTabs()
    {
        foreach (static::RJ_MODULE_ADMIN_CONTROLLERS as $adminTab) {
            if (false === $this->uninstallTab($adminTab)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Uninstall Tab.
     * Can be used in upgrade script.
     *
     * @param array $tabData
     *
     * @return bool
     */
    public function uninstallTab(array $tabData)
    {
        $tabId = Tab::getIdFromClassName($tabData['class_name']);
        $tab = new Tab($tabId);

        if (false === Validate::isLoadedObject($tab)) {
            return false;
        }

        if (false === (bool) $tab->delete()) {
            return false;
        }

        if (isset($tabData['core_reference'])) {
            $tabCoreId = Tab::getIdFromClassName($tabData['core_reference']);
            $tabCore = new Tab($tabCoreId);

            if (Validate::isLoadedObject($tabCore)) {
                $tabCore->active = true;
            }

            if (false === (bool) $tabCore->save()) {
                return false;
            }
        }

        return true;
    }

    public function getContent()
    {

        return '<h1>Apartado de configuration Falta</h1>';
    }
}