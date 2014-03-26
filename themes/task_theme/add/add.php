<!DOCTYPE html>
<html lang="en">

<?php $this->getHead() ?>

<body>

<?php var_dump($_GET);?>

<h1>ADD</h1>



<?php $this->getTemplate(false, 'addTaskInputForm.php')?>



<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>


<?php $this->getTemplate(false, 'footer.php')?>

</body>
</html>