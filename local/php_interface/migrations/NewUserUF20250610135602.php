<?php

namespace Sprint\Migration;


class NewUserUF20250610135602 extends Version
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
    }

}
