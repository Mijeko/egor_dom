<?php

namespace Sprint\Migration;


class AddManagerGroup20250723211049 extends Version
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
    }

}
