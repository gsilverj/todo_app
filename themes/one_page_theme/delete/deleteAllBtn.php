<!-- This button will send the user to the delete method and will pass an id of '*'. (currently '*'  = delete all code for the delete method in the task controller) -->

<a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete?id=*';?>">
    <button name="deleteAllBtn" type="button" class="btn btn-danger">DELETE ALL</button>
</a>
<!--The original idea was to put the message after pressing a button at the bottom of the screen...-->
<!--<p class="alert-success">Todo-List tasks have now been deleted</p>-->
<!--<label class="alert alert-danger">im sofa king we tard dead.</label>-->

