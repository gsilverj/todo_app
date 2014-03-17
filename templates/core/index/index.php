<!DOCTYPE html>
<html lang="en">
<h5>piece = index page, source = core/.../index.php</h5>

<?php $this->getHead() ?>

<body>
<?php $this->getHeader() ?>
<br />



<?php $this->getTemplate(false, 'page/backToHomeBtn.php') ?>
<?php $this->getTemplate(false, 'page/addBtn.php') ?>
<?php $this->getTemplate(false, 'page/deleteBtn.php') ?>





<?php $this->getTemplate(false, 'page/bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'page/compiledPlugins.php')?>
<?php $this->getTemplate(false, 'page/individualIncludeFiles.php')?>

<?php $this->getTemplate(false, 'page/footer.php')?>

</body>
</html>