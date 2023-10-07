<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        .parent{
            display:flex;
            justify-content:space-around;
            height:100vh;
            padding:2rem;
        }
        .parent>div{
            border-style:solid;
            width:50%;
            height:50vh;
        }
        table{
            border-collapse:collapse;
            width:100%;
        }
        th,td{
            border:1px solid black;
            text-align:center;
        }
        th{
            background-color:grey;
        }
        button{
            margin:1rem;
        }
       
    </style>
</head>
<body>
    <?php
    function connectDb1(){
        $db= new PDO("mysql:host=localhost;dbname=class","root");
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $db;
    }?>
    <div class="parent">
        <div> 
            <div>
                <button onclick="handleOperation('update')" name="Update">Update</button>
                <button onclick="handleOperation('insert')" name="Insert">Insert</button>
                <button onclick="handleOperation('delete')" name="Delete">Delete</button>
            </div>
            <?php include 'form2.php';?>
            <div id="operationCentre">
                <h1>Insert</h1>
                <form method="post" >
                    <input type="hidden" name="operation" value="insert">
                    <div>                        
                        <label for="name">Name</label>                        
                        <input type="text" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div>
                        <label for="rollNo">Roll No</label>
                        <input type="text" name="rollNo" id="rollNo" placeholder="Enter rollNo">
                    </div>
                    <div>
                        <label for="class">Class</label>
                        <input type="text" name="class" id="class" placeholder="Enter class">
                    </div>

                    <div>
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <?php 
                
                $conn=connectDb1();
                $sql="select * from students";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "<table>";
                echo "<tr>";
                echo "<th>name</th>";
                echo "<th>rollNo</th>";
                echo "<th>class</th>";
                echo "</tr>";
                foreach($result as $row){
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['rollNO']."</td>";
                    echo "<td>".$row['class']."</td>";
                    echo "</tr>";
                }

            ?>
        </div>
    </div>

    <script>
        function handleOperation(event){
            console.log(event);
        }
    </script>
</body>
</html>