<?php
if (count($_POST) > 0) {
    include 'db.php';
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    if (empty($_POST['id'])) {
        $query = "INSERT INTO users (name,age,email)
VALUES ('$name','$age','$email')";
    } else {
        $query = "UPDATE users set id='" . $_POST['id'] . "', name='" . $_POST['name'] . "', age='" . $_POST['age'] . "', email='" . $_POST['email'] . "' WHERE id='" . $_POST['id'] . "'";
    }
    $res = mysqli_query($dbCon, $query);
    if ($res) {
        echo json_encode($res);
    } else {
        echo "Error: " . $sql . "" . mysqli_error($dbCon);
    }
}
