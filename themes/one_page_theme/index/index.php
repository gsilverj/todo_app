<!DOCTYPE html>
<html lang="en">

<!-- <head> tag is located in 'head.php' file (located in core_theme) that is displayed after doing getHead().-->
<?php $this->getHead() ?>

<body>
    <br />

    <div id="BodyHeaderContainer" class="container">
        <!-- place holder for the body header code. -->
    </div>

    <!-- this will be the container for all of the pieces of the body (besides body header & footer) of the page (style.css'd)-->
    <div id="bodyContainer" class="container">
        <h1>Todo List Application</h1>
        <h2>One Page Theme</h2>
        <h3>Welcome Back!</h3>
        <br />
        <?php $this->getTemplate(false, 'addTaskPanel.php')?>
        <br />
        <h3>Here Is your Current Todo List:</h3>
        <?php $this->getTemplate(false, 'populatedTodoListPanel.php')?>
        <?php $this->getTemplate(false, 'infoPanel.php')?>
        <?php $this->getTemplate(false, 'deleteAllBtn.php') ?>
    </div>

    <div id="bodyFooterContainer" class="container">
        <a target="_blank" href="http://www.blueacorn.com/">
            <img height="150" width="150" src="data:image/jpeg;base64,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" class="img-thumbnail">
        </a>

        <br/>
        <h5><?php echo '***' . Core_XMLConfig::getCurrentTheme();?></h5>
    </div>

    <?php $this->getTemplate(false, 'bootstrapJs.php') ?>
    <?php $this->getTemplate(false, 'compiledPlugins.php')?>
    <?php $this->getTemplate(false, 'individualIncludeFiles.php')?>
</body>

</html>