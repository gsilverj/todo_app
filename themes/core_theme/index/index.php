<!DOCTYPE html>
<html lang="en">


<?php $this->getHead() ?>



<body>

<?php $this->getHeader() ?>

<br />



<?php $this->getTemplate(false, 'btnChangeThemeToOnePageTheme.php');?>

<br />





<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>
<?php $this->getTemplate(false, 'footer.php')?>

</body>
</html>