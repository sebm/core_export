<h1>Import Active Pods List</h1>

<?php if ($POD->activating): ?>
  
  <h3>Activating Pods...</h3>
  
  <?php if(count($POD->activated_success)): ?>
    <h4>The following pods successfully loaded:</h4>
    <ul>
      <?php foreach ($POD->activated_success as $s): ?>
        <li><?php echo $s ?></li>
      <?php endforeach ?>
    </ul>
  <?php else:?>
    <h4>No pods needed to load</h4>
  <?php endif ?>
  
  <?php if(count($POD->activated_failure)): ?>
    <h4>The following pods failed to load:</h4>
    <ul>
      <?php foreach ($POD->activated_failure as $f): ?>
        <li><?php echo $f ?></li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>
  
  <?php if($POD->newsflash): ?>
    <p><?php echo $POD->newsflash ?></p>
  <?php endif ?>
  
<?php endif ?>

<h2>Steps:</h2>
<ol>
  <li>Copy a list of active pods from another PeoplePods site</li>
  <li>Paste that list into this form</li>
  <li>Hit "Import Pods"</li>
</ol>

<form 
  action='<?php $POD->siteRoot() ?>/export?action=importactivepods'
  method='POST'
>
  <input type='text' name='podjson' id='podjson'>
  
  <input type='submit' value='Import Pods'>
  
</form>