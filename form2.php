<?php
    function connectDb(){
        try{

            $db= new PDO("mysql:host=localhost;dbname=class","root");
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    if(isset($_POST['operation']) && $_POST['operation']=='insert')
    {
        $conn=connectDb(); 
        $sql="insert into students(name,rollNo,class) values(:name,:rollNo,:class)";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':name',$_POST['name']);
        $stmt->bindParam(':rollNo',$_POST['rollNo']);
        $stmt->bindParam(':class',$_POST['class']);
        $stmt->execute();

    }
    if(isset($_POST['operation']) && $_POST['operation']=='update')
    {
        $conn=connectDb(); 
        $sql="update students set class=:class where rollNo=:rollNo";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':rollNo',$_POST['rollNo']);
        $stmt->bindParam(':class',$_POST['class']);
        $stmt->execute();
    }
    if(isset($_POST['operation']) && $_POST['operation']=='delete')
    {
        $conn=connectDb(); 
        $sql="delete from students where rollNo=:rollNo";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':rollNo',$_POST['rollNo']);
        $stmt->execute();
    }
    $status='Connected Successfully';
?>

