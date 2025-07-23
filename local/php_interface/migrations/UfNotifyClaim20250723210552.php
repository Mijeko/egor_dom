<?php

namespace Sprint\Migration;


class UfNotifyClaim20250723210552 extends Version
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
  'FIELD_NAME' => 'UF_TG_NOTIFY_CLAIM',
  'USER_TYPE_ID' => 'boolean',
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
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Получать уведомления о заявка в ТГ',
    'ru' => 'Получать уведомления о заявка в ТГ',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Получать уведомления о заявка в ТГ',
    'ru' => 'Получать уведомления о заявка в ТГ',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Получать уведомления о заявка в ТГ',
    'ru' => 'Получать уведомления о заявка в ТГ',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Получать уведомления о заявка в ТГ',
    'ru' => 'Получать уведомления о заявка в ТГ',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Получать уведомления о заявка в ТГ',
    'ru' => 'Получать уведомления о заявка в ТГ',
  ),
));
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'USER',
  'FIELD_NAME' => 'UF_EMAIL_NOTIFY_CLAIM',
  'USER_TYPE_ID' => 'boolean',
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
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Получать уведомления о заявка по почте',
    'ru' => 'Получать уведомления о заявка по почте',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Получать уведомления о заявка по почте',
    'ru' => 'Получать уведомления о заявка по почте',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Получать уведомления о заявка по почте',
    'ru' => 'Получать уведомления о заявка по почте',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Получать уведомления о заявка по почте',
    'ru' => 'Получать уведомления о заявка по почте',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Получать уведомления о заявка по почте',
    'ru' => 'Получать уведомления о заявка по почте',
  ),
));
    }

}
