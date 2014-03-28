<!-- This button will send the user to the delete method and will pass an id of '*'. (currently '*'  = delete all code for the delete method in the task controller) -->

<a href="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete?id=*';?>">
    <button name="deleteAllBtn" type="button" class="btn btn-danger">DELETE ALL</button>
</a>
<h5 class="text-danger"><strong>****THIS WILL DELETE ALL TASKS</strong></h5>

<p class="alert-success">Todo-List tasks have now been deleted</p>
<label class="alert alert-danger">im sofa king we tard dead.</label>

