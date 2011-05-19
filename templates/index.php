<h1>Import/Export</h1>

<h2>Hello, <?php echo $POD->currentUser()->nick ?>!</h2>

<p>This pod allows the import and export of data to/from your PeoplePods installation.</p>

<nav>
  <ul>
    <li><a href='<?php $POD->siteRoot ?>/export?action=exportactivepods'>
      Export the list of currently-active pods
    </a></li>
  </ul>
</nav>