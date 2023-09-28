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
            height:50vh;
            width:100vw;
            display:flex;
        }
        .parent>div{
            width:50vw;
            border-style: solid;

        }
    </style>
</head>
<body>
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
        }else if($db=="mssql"){
            try{
                $conn = new PDO("sqlsrv:Server=localhost;Database=master;Trusted_Connection=True;");
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

    
    <div class="parent">
        <div> 
            <form method="post">
                <button type="submit" name="mysql">mysql</button>
                <button type="submit" name="postgres">postgres</button>
                <button type="submit" name="sqlite">sqlite</button>
                <button type="submit" name="mssql">mssql</button>
                <button type="submit" name="mariaDB">maria db</button>
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
        ?></div>
    </div>
    <div class="parent">
        <div>hello</div>
        <div>hello</div>
    </div>
    
</body>
</html>