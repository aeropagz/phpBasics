<?php
    include('../utility.php');
    $link = createLink();
    $id = mysqli_real_escape_string($link, $_GET['id']);

    $sql = "DELETE FROM noten WHERE id='$id'";
    if(mysqli_query($link, $sql)){
        header("Location: /example.php");
    } else{
        printf("Error: %s\n", mysqli_error($link));
    }
?>