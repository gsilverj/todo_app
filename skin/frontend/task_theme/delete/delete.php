<!DOCTYPE html>
<html lang="en">

<?php $this->getHead() ?>

<body>



<h1>DELETE</h1>



<?php $this->getTemplate(false, 'deleteTaskSelectionForm.php')?>



<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>


<?php $this->getTemplate(false, 'footer.php')?>

</body>
</html>