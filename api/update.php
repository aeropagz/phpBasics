<?php
    include('../utility.php');
    $link = createLink();
    $vorname = mysqli_real_escape_string($link, $_POST['vorname']);
    $nachname = mysqli_real_escape_string($link, $_POST['nachname']);
    $grade = mysqli_real_escape_string($link, $_POST['grade']);
    $id = mysqli_real_escape_string($link, $_POST['id']);

    $sql = "UPDATE noten SET firstname='$vorname',
                             lastname='$nachname',
                             grade='$grade'
            WHERE id='$id'";
    if(mysqli_query($link, $sql)){
        header("Location: /example.php");
    } else{
        printf("Error: %s\n", mysqli_error($link));
    }
?>