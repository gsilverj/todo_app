<!DOCTYPE html>
<html lang="en">
<?php $this->getHead() ?>

<body>

<br />

<h1>One Page Theme</h1>
<h3>Welcome Back!</h3>


<?php $this->getTemplate(false, 'populatedTodoListPanel.php')?>

<?php $this->getTemplate(false, 'addBtn.php')?>
<?php $this->getTemplate(false, 'deleteBtn.php')?>

<?php $this->getTemplate(false, 'addTaskPanel.php')?>
<?php $this->getTemplate(false, 'deleteTaskPanel.php')?>
<?php $this->getTemplate(false, 'updateTodoListPanel.php')?>



<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>

<?php $this->getTemplate(false, 'footer.php')?>

</body>
</html>