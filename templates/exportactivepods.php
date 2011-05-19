<h1>Export Active Pods</h1>
<p>This is a list of the pods currently active on this PeoplePods site.</p>

<textarea style='width:300px;height:100px;'>
  <?php echo json_encode($POD->podsList()) ?>
</textarea>
<p>
  <a href='<?php $POD->siteRoot() ?>/export'>Back to Import/Export Main</a>
</p>