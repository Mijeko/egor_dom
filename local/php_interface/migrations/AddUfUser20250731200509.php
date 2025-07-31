<?php

namespace Sprint\Migration;


class AddUfUser20250731200509 extends Version
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
  'FIELD_NAME' => 'UF_PHONE_TWO',
  'USER_TYPE_ID' => 'string',
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
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Второй номер телефона',
    'ru' => 'Второй номер телефона',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Второй номер телефона',
    'ru' => 'Второй номер телефона',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Второй номер телефона',
    'ru' => 'Второй номер телефона',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Второй номер телефона',
    'ru' => 'Второй номер телефона',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Второй номер телефона',
    'ru' => 'Второй номер телефона',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_EMAIL_TWO',
  'USER_TYPE_ID' => 'string',
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
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Втоой email адрес',
    'ru' => 'Втоой email адрес',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Втоой email адрес',
    'ru' => 'Втоой email адрес',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Втоой email адрес',
    'ru' => 'Втоой email адрес',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Втоой email адрес',
    'ru' => 'Втоой email адрес',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Втоой email адрес',
    'ru' => 'Втоой email адрес',
  ),
));
    }

}
