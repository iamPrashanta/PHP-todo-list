<?php
$con = mysqli_connect("localhost","root","") or die('Localhost Connecting Error');
$db = mysqli_select_db($con,"todo") or die('Database error');
?>
<head>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
    margin: 0;
    padding: 0;
    padding-left: 100px;
    padding-right: 100px;
    padding-top: 4%;
    text-align: center;
}
#add{
    height: 40px;
    width: auto;
    text-transform: uppercase;
    font-weight: bold;
    margin-left: 10px;
}
#input{
    height: 40px;
    width: 360px;
}
table{
    margin: auto;
}
tbody tr:hover{
    background-color: skyblue;
}
tbody td:nth-child(1){
    cursor: none;
    height: 40px;
    width: 30px;
    border-top: 1px solid black;
    border-left: 1px solid black;
}
tbody td:nth-child(2){
    width: 400px;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
}
tbody td:nth-child(3){
    font-weight: bold;
    font-size:25px;
}
a{
    color: rgba(202, 27, 27, 0.842);
    text-decoration: none;
}
p{
    margin-left: 230px;
    margin-right: 230px;
}
    </style>
</head>
<body>

<form method="POST">
    <h1>ToDo List Application</h1>
    <input type="text" name="todo" id="input" autocomplete="off"><input type="submit" name="add" id="add" value="add todo">
</form>
<?php


if(isset($_POST['add'])){
    $value = $_POST['todo'];
    $sql = "INSERT INTO mytodo(todos) VALUE('$value');";
    if($value == ''){
        echo "<p style='color:black';>Field blank</p>";
    }else{
        if($con->query($sql)== true){
            echo "<p style='color:blue';>Added to todos</p>";
        }else{
            echo "<p style='color:red;'>Error ". $con->error."</p>";
        }
    }
}


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM mytodo WHERE id='$id'";
    mysqli_query($con,$query);
    header('location: index.php');
}
?>
</body>

<?php

$sql2 = "SELECT * FROM mytodo ORDER BY id DESC";
$result = $con->query($sql2);
echo "<hr>";
if($result->num_rows>0){
    ?><table>
        <thead>
        <tr>
            <td>ID</td>
            <td>Tasks</td>
            <td>Delete</td>
        </tr>
        </thead><tbody><?php
    while($row = $result->fetch_assoc()){
        $aa = $row["id"];
        $bb = $row["todos"];

        echo "<tr>";
        echo "<td>$aa</td>";
        echo "<td>$bb</td>";
        echo "<td><a href='index.php?delete=$aa'>x</a></td>";
        echo "</td>";
    }
    ?></tbody></table><?php
}

?>