<div class="container" id="addTaskPanel" >

    <form role="form" action="<?php echo Core_XMLConfig::getBaseUrl() . 'task/add';?>" method="post">
        <div class="form-group">
            <h2>ADD</h2>
        </div>
        <div class="form-group">
            <label for="taskDescriptionTbox">Task Description</label>
            <input type="text" class="form-control" name="taskDescriptionTbox" placeholder="Please Enter A Task Description..."/>
            <p class="help-block">Please Enter A Task Description, Then Press The Submit Button.</p>
            <br />
            <input type="submit" value="Submit"  >
        </div>
    </form>
</div>




