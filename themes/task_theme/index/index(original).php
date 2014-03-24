<!DOCTYPE html>
<html lang="en">
<h5>piece = TASK index page, source = task/.../index.php</h5>

<?php $this->getHead() ?>

<body>

<?php $this->getHeader() ?>

<br />

<h1>YOLO THIS BE THAT TEMPLATE TASK SWAG...</h1>


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
*/
?>





<?php $this->getTemplate(false, 'todoListPanel.php')?>

<?php $this->getTemplate(false, 'backToHomeBtn.php') ?>
<?php $this->getTemplate(false, 'addBtn.php') ?>
<?php $this->getTemplate(false, 'deleteBtn.php') ?>

<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>

<?php $this->getTemplate(false, 'footer.php')?>

</body>
</html>