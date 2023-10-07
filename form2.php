<?php
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname="class";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $status = "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

?>


    <div style="border-style:solid;height:50vh">
            <form method="post" >
                <button type="submit" name="Update">Update</button>
                <button type="submit" name="Insert">Insert</button>
                <button type="submit" name="Delete">Delete</button>
            </form>
            <div class="parent">
            <?php
            if(isset($_POST['Update'])){
                echo "Update";
            }
            if(isset($_POST['Insert'])){
                echo "Insert";
            }
            if(isset($_POST['Delete'])){
                echo "Delete";
            }
        ?>
            
    </div>
</div>