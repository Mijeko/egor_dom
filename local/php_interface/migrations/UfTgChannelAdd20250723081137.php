<?php

namespace Sprint\Migration;


class UfTgChannelAdd20250723081137 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "5.3.3";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_TG_ID',
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
    'en' => 'ID telegram',
    'ru' => 'ID телеграмма',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'ID telegram',
    'ru' => 'ID телеграмма',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'ID telegram',
    'ru' => 'ID телеграмма',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'ID telegram',
    'ru' => 'ID телеграмма',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'ID telegram',
    'ru' => 'ID телеграмма',
  ),
));
    }

}
