<!DOCTYPE html>
<html lang="en">
<h5>piece = CORE index page, source = core/.../index.php</h5>

<!-- maybe have <head> here>

<!--  make a getPreHead() ? -->
<?php $this->getHead() ?>
<!--  make a getPostHead() ? -->

<!-- maybe have </head> here-->


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


<?php $this->getTemplate(false, 'bootstrapJs.php') ?>
<?php $this->getTemplate(false, 'compiledPlugins.php')?>
<?php $this->getTemplate(false, 'individualIncludeFiles.php')?>
<?php $this->getTemplate(false, 'footer.php')?>

</body>
</html>