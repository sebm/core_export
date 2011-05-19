<?php 

include_once('../../PeoplePods.php');
$POD = new PeoplePod(array(
  'authSecret'=>$_COOKIE['pp_auth'],
  'lockdown'=>'login'
));

?>

<?php $POD->output('header') ?>
<h1>Hello World!</h1>

<?php $POD->output('footer') ?>