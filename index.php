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
            height:50vh;
            padding:2rem;
        }
        .parent>div{
            border-style:solid;
            width:50%;
            height:50vh;
            padding:2rem;
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
       
    </style>
</head>
<body>
    <?php function connectDb1(){
        $db= new PDO("mysql:host=localhost;dbname=class","root");
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $db;
    }?>
    <div class="parent">
        <div>
        <?php
        $db="def";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['mysql'])) {
                $db = "mysql";
            } elseif (isset($_POST['postgres'])) {
                $db = "pgsql";
            } elseif (isset($_POST['sqlite'])) {
                $db = "sqlite";
            } elseif (isset($_POST['mssql'])) {
                $db = "mssql";
            } elseif (isset($_POST['mariaDB'])) {
                $db = "mariaDB";
            }
        }
        
        $status="Not connected";
        if($db=="mysql"){
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
        }
        else if($db=="pgsql"){
            $host= 'localhost';
            $dbname = 'class';
            $user = 'postgres';
            $password = 'postgres';
            try{
                $conn = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;user=$user;password=$password");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $status = "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        else if($db=="sqlite"){
            $dbname="class";
            try{
                $conn = new PDO("sqlite::memory:");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $status = "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }else if($db=="mariaDB"){
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
        }
    ?>
            <form method="post">
                <button type="submit" name="mysql" onclick="connectDB('mysql')">mysql</button>
                <button type="submit" name="postgres" onclick="connectDB('postgres')">postgres</button>
                <button type="submit" name="sqlite" onclick="connectDB('sqlite')">sqlite</button>
                <button type="submit" name="mariaDB" onclick="connectDB('maria')">maria db</button>
            </form>
        </div>
        <div>
        <h3>
            <?php echo $status; ?>
            </h3>
            
            <?php 
            if($db=="mysql"){
                echo '
                    $servername = "localhost";<br>
                    $username = "root";<br>
                    $password = "password";<br>
                    try {<br>
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);<br>
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);<br>
                        echo "Connected successfully";<br>
                    } catch(PDOException $e) {<br>
                        echo "Connection failed: " . $e->getMessage();<br>
                    }
                ';
            }else if($db=="pgsql"){
                echo ' $host="localhost";<br>
                $dbname = "class";<br>
                $user = "postgres";<br>
                $password = "postgres";<br>
                try{<br>
                    $conn = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;user=$user;password=$password");<br>
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);<br>
                    $status = "Connected successfully";<br>
                } catch(PDOException $e) {<br>
                    echo "Connection failed: " . $e->getMessage();<br>
                }';
            }
            else if($db=="sqlite"){
                echo '$dbname="class";<br>
                try{<br>
                    $conn = new PDO("sqlite::memory:");<br>
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);<br>
                    $status = "Connected successfully";<br>
                } catch(PDOException $e) {<br>
                    echo "Connection failed: " . $e->getMessage();<br>
                }';
            }else if($db=="mariaDB"){
                echo '$servername = "localhost";<br><br>
                $username = "root";<br>
                $password = "password";<br>
                $dbname="class";<br>
                try {<br>
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);<br>
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);<br>
                    $status = "Connected successfully";<br>
                } catch(PDOException $e) {<br>
                    echo "Connection failed: " . $e->getMessage();<br>
                }';
            }
        ?>
            
        </div>
    </div>


    <div class="parent">
        <div> 
            <div>
                <button onclick="handleOperation('update')" name="Update">Update</button>
                <button onclick="handleOperation('insert')" name="Insert">Insert</button>
                <button onclick="handleOperation('delete')" name="Delete">Delete</button>
            </div>
            <?php include 'form2.php';?>
            <div id="operationCentre">
                
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
            if(event==="insert"){
                document.getElementById("operationCentre").innerHTML=`<h1>Insert</h1>
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
                </form>`;
            }else if(event==="update"){
                document.getElementById("operationCentre").innerHTML=`<h1>Update</h1>
                <form method="post" >
                    <input type="hidden" name="operation" value="update">
                    <div>
                        <label for="rollNo">Enter Roll No of person whose class you want to update</label>
                        <input type="text" name="rollNo" id="rollNo" placeholder="Enter rollNo">
                    </div>
                    <div>
                        <label for="class">Class</label>
                        <input type="text" name="class" id="class" placeholder="Enter class">
                    </div>

                    <div>
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>`;
            }
            else if(event==="delete"){
                document.getElementById("operationCentre").innerHTML=`<h1>Delete</h1>
                <form method="post" >
                    <input type="hidden" name="operation" value="delete">
                    <div>
                        <label for="rollNo">Enter Roll No of person whose entry you want to delete</label>
                        <input type="text" name="rollNo" id="rollNo" placeholder="Enter rollNo">
                    </div>
                    <div>
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>`;
            }
        }
    </script>
</body>
</html>