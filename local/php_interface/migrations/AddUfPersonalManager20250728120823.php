<?php

namespace Sprint\Migration;


class AddUfPersonalManager20250728120823 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "5.4.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_PERSONAL_MANAGER',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'ID персонального менеджера',
    'ru' => 'ID персонального менеджера',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'ID персонального менеджера',
    'ru' => 'ID персонального менеджера',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'ID персонального менеджера',
    'ru' => 'ID персонального менеджера',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'ID персонального менеджера',
    'ru' => 'ID персонального менеджера',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'ID персонального менеджера',
    'ru' => 'ID персонального менеджера',
  ),
));
    }

}
