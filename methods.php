<?php

function podsList($POD) {
  $POD->loadAvailablePods();
  
  $pods = array();
  
  foreach ($POD->PODS as $name=>$podling) {
    $pods []= array(
      'name'=> $name,
      'isActive'=>$POD->isEnabled($name)
    );
  }
  return $pods;
}

PeoplePod::registerMethod('podsList');