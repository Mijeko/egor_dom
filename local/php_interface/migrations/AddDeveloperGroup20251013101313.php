<?php

namespace Sprint\Migration;


class AddDeveloperGroup20251013101313 extends Version
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

        $helper->UserGroup()->saveGroup('DEVELOPER',array (
  'ACTIVE' => 'Y',
  'C_SORT' => '100',
  'ANONYMOUS' => 'N',
  'NAME' => 'Застройщик',
  'DESCRIPTION' => '',
  'SECURITY_POLICY' => 
  array (
  ),
));
    }

}
