<?php

namespace Sprint\Migration;


class NewUserGroups20250818172619 extends Version
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

        $helper->UserGroup()->saveGroup('STUDENT',array (
  'ACTIVE' => 'Y',
  'C_SORT' => '100',
  'ANONYMOUS' => 'N',
  'NAME' => 'Ученик',
  'DESCRIPTION' => '',
  'SECURITY_POLICY' => 
  array (
  ),
));
        $helper->UserGroup()->saveGroup('EXTERNAL_REALTOR',array (
  'ACTIVE' => 'Y',
  'C_SORT' => '100',
  'ANONYMOUS' => 'N',
  'NAME' => 'Внешний риэлтор',
  'DESCRIPTION' => '',
  'SECURITY_POLICY' => 
  array (
  ),
));
        $helper->UserGroup()->saveGroup('MANAGER',array (
  'ACTIVE' => 'Y',
  'C_SORT' => '100',
  'ANONYMOUS' => 'N',
  'NAME' => 'Менеджер',
  'DESCRIPTION' => '',
  'SECURITY_POLICY' => 
  array (
  ),
));
        $helper->UserGroup()->saveGroup('AGENT',array (
  'ACTIVE' => 'Y',
  'C_SORT' => '100',
  'ANONYMOUS' => 'N',
  'NAME' => 'Агент',
  'DESCRIPTION' => '',
  'SECURITY_POLICY' => 
  array (
  ),
));
    }

}
