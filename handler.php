<?php 

include_once('../../PeoplePods.php');
$POD = new PeoplePod(array(
  'authSecret'=>$_COOKIE['pp_auth'],
  'lockdown'=>'login'
));

switch ($_GET['action']) {
  case 'exportactivepods':
    $action = 'exportactivepods';
    break;
  default:
    $action = 'index';
    break;
}

?>

<?php $POD->header('Import/Export') ?>

<?php $POD->output($action, dirname(__FILE__).'/templates') ?>

<?php $POD->footer() ?>