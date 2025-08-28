<?php
$arUrlRewrite=array (
  3 => 
  array (
    'CONDITION' => '#^/developers/([^/]+)/?(\\?[^/]*)?$#',
    'RULE' => 'ELEMENT_ID=$1',
    'ID' => '',
    'PATH' => '/developers/detail.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/objects/([^/]+)/?(\\?[^/]*)?$#',
    'RULE' => 'ELEMENT_ID=$1',
    'ID' => '',
    'PATH' => '/objects/detail.php',
    'SORT' => 100,
  ),
  7 =>
  array (
    'CONDITION' => '#^/ref/([^/]+)/?(\\?[^/]*)?$#',
    'RULE' => 'JOIN_REF_CODE=$1',
    'ID' => '',
    'PATH' => '/ref/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/local/rest/#',
    'RULE' => '',
    'ID' => 'bitrix:rest.hook',
    'PATH' => '/local/rest/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/profile/#',
    'RULE' => '',
    'ID' => 'craft:profile',
    'PATH' => '/profile/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/test/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test/index.php',
    'SORT' => 100,
  ),
);
