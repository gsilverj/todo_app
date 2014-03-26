<!-- this will be the panel that holds the to-do list that is pulled from the database...-->

<div id=cat class="container">
    <form role="form" id="populatedTodoListPanel" name="populatedTodoListPanel" method="post" >
    <?php


    //this grabs the information in the database and returns it as an mysqli object(array) to $results...
    $results = $this->returnTodoListArray();


        while($row = mysqli_fetch_array($results))
        {
            ?>

            <input type="checkbox" id="taskNumber"/> <b><?php echo $row['Task_Description'];?></b>
            <br />

            <?

        }

    ?>
    </form>
</div>
