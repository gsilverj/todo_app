<!-- This piece is the area where user can add tasks to the todolist. -->
<form role="form" action="<?php echo Core_XMLConfig::getBaseUrl() . 'task/add';?>" method="post">
    <div class="form-group" id="addTaskFormGroupHeader">
        <h2>ADD TASK</h2>
    </div>

    <div class="form-group" id="addTaskFormGroupBody">
        <label for="taskDescriptionTbox">Task Description</label>

        <div class="input-group input-group-lg" id="addTaskFormGroupInputGroup">
            <input type="text" class="form-control" id="taskDescriptionTbox" name="taskDescriptionTbox" placeholder="Please Enter A Task Description..." autofocus="autofocus"/>

            <span class="input-group-addon">
                <input type="submit" class="btn btn-success" value="ADD">
            </span>
        </div>

        <div class="form-group" id="addTaskHelpBlockFormGroupBody">
            <p class="help-block">Please Enter A Task Description, Then Press The Submit Button.</p>
            <br />
        </div>
    </div>
</form>


<!-- older pieces used when initially created.-->
<!-- original input text box       <input type="text" class="form-control" id="taskDescriptionTbox" name="taskDescriptionTbox" placeholder="Please Enter A Task Description..." autofocus="autofocus"/>-->
<!-- original submit button  <input type="submit" class="btn btn-success btn-lg" value="ADD"> -->


