<!DOCTYPE html>
<html lang="en">
<h5>piece = index page, source = core/.../index.php</h5>

<?php $this->getHead() ?>

<body>
<?php $this->getHeader() ?>
<br />





<?php
/*    $this->setUpPage('page/todoListPanel.php');
    $this->setUpPage('page/backToHomeBtn.php');
    $this->setUpPage('page/addBtn.php');
    $this->setUpPage('page/deleteBtn.php');
    $this->setUpPage('page/bootstrapJs.php');
    $this->setUpPage('page/compiledPlugins.php');
    $this->setUpPage('page/individualIncludeFiles.php');
    $this->setUpPage('page/footer.php');

    $this->loadPagePieces();
*/?>


<?php $this->getTemplate(false, 'page/todoListPanel.php')?>

<?php $this->getTemplate(false, 'page/backToHomeBtn.php') ?>
<?php $this->getTemplate(false, '../task/add/addBtn.php') ?>
<?php $this->getTemplate(false, '../task/delete/deleteBtn.php') ?>

<?php $this->getTemplate(false, 'page/bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'page/compiledPlugins.php')?>
<?php $this->getTemplate(false, 'page/individualIncludeFiles.php')?>

<?php $this->getTemplate(false, 'page/footer.php')?>

</body>
</html>