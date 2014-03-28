<div class="container" id="deleteTaskPanel" >

    <form role="form" action="<?php echo Core_XMLConfig::getBaseUrl() . 'task/delete';?>" method="post">
        <fieldset>
        <div class="form-group">
            <h2>DELETE</h2>
        </div>
        <div class="form-group">
            <h3 class="help-block">Please Check The Tasks That You Would Like To DELETE, Then Press The Submit Button.</h3>
            <br />
            <input type="submit" value="Submit">
        </div>
        </fieldset>
    </form>

</div>