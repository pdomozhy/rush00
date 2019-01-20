<?php
include('../connect.php');
$id = 10;
$con = connect();
session_start();
include('../is_admin.php');

if (is_admin() && $con && $_POST['submit'] && $_POST['title'] && $_POST['submit'] == 'OK'){
    $title = $_POST['title'];
    $sql = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if (strlen($title) > 100){
        echo "Too long title";
        return;
    }
    if ($title == "others"){
        echo "You couldn't name category others";
        return;
    }
    $row = mysqli_fetch_row($result);
    if (!$row) {
        echo "Category doesn't exist <br>";
        return;
    }
    $sql = "UPDATE categories SET title='$title' WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result){
        echo "Category updated!";
        header("Location: http://localhost:8800/");
    }else {
        echo "Error ".mysqli_error($con);
    }
    mysqli_close($con);
}
?>
<html><head>
    <meta charset="UTF-8">
    <title>Rushshop</title>
    <link rel="stylesheet" href="menu.css">
</head><body>
<?php     include("../navbar.php"); ?>
<form action="update_category.php" method="post" style="border:1px solid #ccc">
    Title<input type="text" placeholder="Enter category title" title="title" max="100" name="title" required>
    <br />
    <input type="submit" name="submit" title="submit" value="OK" />
</form>
</body></html>
