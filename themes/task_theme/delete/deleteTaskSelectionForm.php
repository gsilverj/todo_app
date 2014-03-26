<form role="form" method="get" action="index\">
    <fieldset>
        <div id=cat class="container">
            <?php


            //this grabs the information in the database and returns it as an mysqli object(array) to $results...
            $results = $this->returnTodoListArray();

            $index = 0;
            while($row = mysqli_fetch_array($results))
            {
                ?>

                <input type="checkbox" name="selections" value="<?php echo $index; ?>" /> <b><?php echo $row['Task_Description'];?></b>
                <br />

                <?
                $index++;
            }
                ?>
        </div>
        <div class="form-control">
            <input type="submit" value="Delete"/>
        </div>
    </fieldset>
</form>