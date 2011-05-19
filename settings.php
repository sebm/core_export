<?php

$POD->registerPOD(
  'core_export',
  'Import/export pod',
  array(
    '^export$' => 'core_export/handler.php',
    '^export/?(.*)' => 'core_export/handler.php?$1'
  ),
  array(),
  dirname(__FILE__).'/methods.php'
);