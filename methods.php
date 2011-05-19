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

function activatePods($POD, $podlist) {
  $POD->loadAvailablePods();
  $htaccessPath = realpath("../../../");
  
  $POD->activated_success = array();
  $POD->activated_failure = array();

  foreach($podlist as $podlet) {
    $n = $podlet['name'];
    if ($podlet['isActive'] and !$POD->isEnabled($n)) {
      $POD->enablePOD($n);
      if ($POD->isEnabled($n)) {
        $POD->activated_success []= $n;
      } else {
        $POD->activated_failure []= $n;
      }
    }
  }

  $POD->saveLibOptions();
  if (!$POD->success()) { 
    $POD->newsflash = $POD->error();
  } else {
    $POD->processIncludes();
    $POD->newsflash = $POD->writeHTACCESS($htaccessPath);
  }
  
}

PeoplePod::registerMethod('activatePods');
