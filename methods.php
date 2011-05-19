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

function exportZippedImagesDirectory($POD, $excludeResized=true) {
  $file_dir = realpath('../../files/images');
  $handle = opendir($file_dir);
  
  $files = array();

  while (false !== ($file = readdir($handle))) {
    if ($excludeResized && preg_match('/original|resized/', $file) 
        || !$excludeResized && $file != '.' && $file != '..' ) 
    {
      $files []=$file;
    }
  }
  
  closedir($handle);
  
  $outfile = tempnam("tmp", "zip");
  $zip = new ZipArchive();
  if ($zip->open($outfile, ZIPARCHIVE::CREATE )!==TRUE) {
    exit("cannot open <$outfile>\n");
  }  
  foreach ($files as $f) {
    $zip->addFile("$file_dir/$f", $f);
  }
  $zip->close();

  header('Content-Type: application/zip');
  header('Content-Length: ' . filesize($outfile));
  header('Content-Disposition: attachment; filename="archive.zip"');

  readfile($outfile);
  unlink($outfile);
  exit;

}

PeoplePod::registerMethod('exportZippedImagesDirectory');