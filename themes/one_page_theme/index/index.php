<!DOCTYPE html>
<html lang="en">

<?php $this->getHead() ?>

<body>
<br />

<h1>One Page Theme</h1>
<h3>Welcome Back!</h3>
<a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete/1'?>" onclick="return '1'"> <span class="glyphicon glyphicon-trash"></span> </a>

<button type="submit" formaction="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete/1'?>" formmethod="post">
    <span class="glyphicon glyphicon-trash"></span>
</button>

<?php $this->getTemplate(false, 'populatedTodoListPanel.php')?>

<?php $this->getTemplate(false, 'addBtn.php')?>
<?php $this->getTemplate(false, 'addTaskPanel.php')?>


<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>

<?php $this->getTemplate(false, 'footer.php')?>

</body>

</html>