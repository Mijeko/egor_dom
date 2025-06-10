<?php

namespace Sprint\Migration;


class NewUserGroups20250610135029 extends Version
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
        $helper->UserGroup()->saveGroup('HOME_SELLER',array (
  'ACTIVE' => 'Y',
  'C_SORT' => '100',
  'ANONYMOUS' => 'N',
  'NAME' => 'Риэлтор',
  'DESCRIPTION' => '',
  'SECURITY_POLICY' => 
  array (
  ),
));
    }

}
