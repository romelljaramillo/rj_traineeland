
<?php
/**
 * 2016-2018 ROANJA.COM
 *
 * NOTICE OF LICENSE
 *
 *  @author Romell Jaramillo <info@roanja.com>
 *  @copyright 2016-2018 ROANJA.COM
 *  @license GNU General Public License version 2
 *
 * You can not resell or redistribute this software.
 */

// namespace Roanja\Module\RjCarrier\Controller\Admin;

class AdminRjInternshipTypePracticaController extends ModuleAdminController
{
    public $name = 'rj_internship_type_practica';

    public function __construct()
    {
        $this->bootstrap = true;
        $this->lang = true;
        $this->actionsRow();
        $this->table = 'rj_internship_type_practica';
        $this->className = 'InternshipProfession';
        
        parent::__construct();

        $this->allow_export = true;
        $this->deleted = false;
        $this->identifier = 'id_internship_type_practica';
        $this->_defaultOrderBy = 'id_internship_type_practica';
        $this->_defaultOrderWay = 'ASC';
        $this->context = Context::getContext();
        $this->bulk_actions = [
            'delete' => [
                'text' => $this->trans('Delete selected', [], 'Modules.Rj_Traineeland.Admin'),
                'confirm' => $this->trans('Delete selected items?', [], 'Modules.Rj_Traineeland.Admin'),
                'icon' => 'icon-trash'
            ]
        ];

        $this->querySql();
    }

    protected function actionsRow()
    {
        // $this->addRowAction('view');
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    protected function querySql(){

        $this->_select = "
            a.id_internship_type_practica,
            b.name,
            b.description,
            b.group,
            a.position,
            a.active,
            a.date_add,
            a.date_upd
        ";

        $this->fields_list = [
            'id_internship_type_practica' => [
                'title' => $this->l('ID'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs',
                'havingFilter' => true
            ],
            'name' => [
                'title' => $this->l('name'),
                'havingFilter' => true,
                'filter_key' => 'a!name'
            ],
            'description' => [
                'title' => $this->l('description'),
            ],
            'group' => [
                'title' => $this->l('type'),
                'havingFilter' => true,
                'filter_key' => 'a!group'
            ],
            'active' => [
                'title' => $this->l('active'),
                'type' => 'bool',
                'active' => 'active',
                'filter_key' => 'a!active'
            ],
            'position' => [
                'title' => $this->l('position'),
                'position'=>'position',
                'orderby' => true
            ],
            'date_add' => [
                'title' => $this->l('date_add'),
                'havingFilter' => true,
                'type' => 'datetime',
                'filter_key' => 'a!date_add'
            ],
            'date_upd' => [
                'title' => $this->l('date_upd'),
                'havingFilter' => true,
                'type' => 'datetime',
                'filter_key' => 'a!date_upd'
            ]
        ];
    }

    public function renderList()
    {
        return parent::renderList();
    }

    public function renderForm()
    {  

        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Internship', [], 'Modules.Rj_Traineeland.Admin'),
                'icon' => 'icon-time'
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->trans('name', [], 'Modules.Rj_Traineeland.Admin'),
                    'name' => 'name',
                    'lang' => true,              
                    'required' => true
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('description', [], 'Modules.Rj_Traineeland.Admin'),
                    'name' => 'description',
                    'lang' => true
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('type', [], 'Modules.Rj_Traineeland.Admin'),
                    'name' => 'group',
                    'lang' => true
                ],
                [
                    'type' => 'text',
                    'label' => $this->trans('position', [], 'Modules.Rj_Traineeland.Admin'),
                    'name' => 'position'
                ],
                [
                    'type' => 'switch',
                    'label' => $this->trans('active', [], 'Admin.Actions'),
                    'name' => 'active',
                    'class' => 't',
                    'is_bool' => true,
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Enabled', [], 'Admin.Global')
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('Disabled', [], 'Admin.Global')
                        ]
                    ]
                ],
            ]
        ];

        if (Shop::isFeatureActive()) {
            $this->fields_form['input'][] = [
                'type' => 'shop',
                'label' => $this->trans('Shop association', [], 'Admin.Global'),
                'name' => 'checkBoxShopAsso',
            ];
        }

        $this->fields_form['submit'] = [
            'title' => $this->trans('Save', [], 'Admin.Actions')
        ];

        return parent::renderForm();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('active' . $this->name)){
            $internshipCompany = new InternshipCompany((int)Tools::getValue($this->identifier));
            if ($internshipCompany->active == 0) {
                $internshipCompany->active = 1;
            } else {
                $internshipCompany->active = 0;
            }

            $internshipCompany->update();
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminRjInternshipProfession', false).'&conf=4&token='.Tools::getAdminTokenLite('AdminRjInternshipProfession'));
        }

        return parent::postProcess();
    }
}