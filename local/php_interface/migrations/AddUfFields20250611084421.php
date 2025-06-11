<?php

namespace Sprint\Migration;


class AddUfFields20250611084421 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "5.0.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_INN',
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
    'en' => 'ИНН',
    'ru' => 'ИНН',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'ИНН',
    'ru' => 'ИНН',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'ИНН',
    'ru' => 'ИНН',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'ИНН',
    'ru' => 'ИНН',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'ИНН',
    'ru' => 'ИНН',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_OGRN',
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
    'en' => 'ОГРН',
    'ru' => 'ОГРН',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'ОГРН',
    'ru' => 'ОГРН',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'ОГРН',
    'ru' => 'ОГРН',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'ОГРН',
    'ru' => 'ОГРН',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'ОГРН',
    'ru' => 'ОГРН',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_CORR_ACC',
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
    'en' => 'Корреспондентский счет',
    'ru' => 'Корреспондентский счет',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Корреспондентский счет',
    'ru' => 'Корреспондентский счет',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Корреспондентский счет',
    'ru' => 'Корреспондентский счет',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Корреспондентский счет',
    'ru' => 'Корреспондентский счет',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Корреспондентский счет',
    'ru' => 'Корреспондентский счет',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_CURR_ACC',
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
    'en' => 'Расчетный счет',
    'ru' => 'Расчетный счет',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Расчетный счет',
    'ru' => 'Расчетный счет',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Расчетный счет',
    'ru' => 'Расчетный счет',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Расчетный счет',
    'ru' => 'Расчетный счет',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Расчетный счет',
    'ru' => 'Расчетный счет',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_KPP',
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
    'en' => 'КПП',
    'ru' => 'КПП',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'КПП',
    'ru' => 'КПП',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'КПП',
    'ru' => 'КПП',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'КПП',
    'ru' => 'КПП',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'КПП',
    'ru' => 'КПП',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_BIK',
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
    'en' => 'БИК',
    'ru' => 'БИК',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'БИК',
    'ru' => 'БИК',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'БИК',
    'ru' => 'БИК',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'БИК',
    'ru' => 'БИК',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'БИК',
    'ru' => 'БИК',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_POST_ADDRESS',
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
    'en' => 'Почтовый адрес',
    'ru' => 'Почтовый адрес',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Почтовый адрес',
    'ru' => 'Почтовый адрес',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Почтовый адрес',
    'ru' => 'Почтовый адрес',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Почтовый адрес',
    'ru' => 'Почтовый адрес',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Почтовый адрес',
    'ru' => 'Почтовый адрес',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_LEGAL_ADDRESS',
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
    'en' => 'Юридический адрес',
    'ru' => 'Юридический адрес',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Юридический адрес',
    'ru' => 'Юридический адрес',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Юридический адрес',
    'ru' => 'Юридический адрес',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Юридический адрес',
    'ru' => 'Юридический адрес',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Юридический адрес',
    'ru' => 'Юридический адрес',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_BANK_NAME',
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
    'en' => 'Банк',
    'ru' => 'Банк',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Банк',
    'ru' => 'Банк',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Банк',
    'ru' => 'Банк',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Банк',
    'ru' => 'Банк',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Банк',
    'ru' => 'Банк',
  ),
));
    }

}
