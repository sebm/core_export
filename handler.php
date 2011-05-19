<?php 

include_once('../../PeoplePods.php');
$POD = new PeoplePod(array(
  'authSecret'=>$_COOKIE['pp_auth'],
  'lockdown'=>'login'
));

switch ($_GET['action']) {
  case 'exportactivepods':
    $action = 'exportactivepods';

    $podJSON = json_encode($POD->podsList());
    
    break;
    
  case 'importactivepods':
    $action = 'importactivepods';
    
    $podJSON = $_POST['podjson'];
  
    if ($podJSON) {
      $POD->activating = true;
      $podlist = json_decode($podJSON,true);
      
      $POD->activatePods($podlist);
    }
    
    break;
  default:
    $action = 'index';
    break;
}

?>

<?php $POD->header('Import/Export') ?>

<?php $POD->output($action, dirname(__FILE__).'/templates') ?>

<?php $POD->footer() ?>