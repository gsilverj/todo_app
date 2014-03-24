<!-- this will be the panel that holds the to-do list that is pulled from the database...-->

<form role="form">
    <div id=cat class="container">

        <?php


        //this grabs the information in the database and returns it as an mysqli object(array) to $results...
        $results = $this->returnTodoListArray();


            while($row = mysqli_fetch_array($results))
            {
                ?>

                <input type="checkbox" /> <b><?php echo $row['Task_Description'];?></b>
                <br />

                <?

            }

        ?>

    </div>
</form>