-
your url on this feed : <?php echo $url?>
-

<?php foreach ($jobs as $url => $job): ?>
-
  url: <?php echo $url ?>

<?php foreach ($job as $key => $value): ?>
  <?php echo $key ?>: <?php echo sfYaml::dump($value) ?>

<?php endforeach ?>
<?php endforeach ?>