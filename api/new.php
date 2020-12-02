<?php
    include('../utility.php');
    $link = createLink();
    $vorname = mysqli_real_escape_string($link, $_POST['vorname']);
    $nachname = mysqli_real_escape_string($link, $_POST['nachname']);
    $grade = mysqli_real_escape_string($link, $_POST['grade']);
    $sql = "INSERT INTO noten (firstname, lastname, grade) VALUES ('$vorname', '$nachname', '$grade')";
    if(mysqli_query($link, $sql)){
        header("Location: /example.php");
    } else{
        printf("Error: %s\n", mysqli_error($link));
    }
?>