<?php

session_start();

$id=0;
$name = "";
$tech = "";
$update = false;

$mysqli = new mysqli('localhost', 'root','1234', 'data') or die(mysqli_error($mysqli));

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $tech = $_POST['tech'];

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    $mysqli->query("INSERT INTO data (name, tech) VALUES('$name','$tech')") or
        die($mysqli->error);

    header("location: index.php");
}

if (isset($_GET['delete'])){

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    $update = true;
    $row = $result->fetch_array();
    $name = $row['name'];
    $tech = $row['tech'];

}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tech = $_POST['tech'];

    $mysqli->query("UPDATE data SET name='$name', tech='$tech' WHERE id=$id") or die($mysqli->error());
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}