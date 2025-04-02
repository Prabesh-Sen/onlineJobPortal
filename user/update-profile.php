<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_POST)) {

    $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $stream = mysqli_real_escape_string($conn, $_POST['stream']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);

    $uploadOk = true;
    $resumeFile = null;
    $profilePicFile = null;

    if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $folder_dir = "../uploads/resume/";
        $base = basename($_FILES['resume']['name']);
        $resumeFileType = pathinfo($base, PATHINFO_EXTENSION);
        $resumeFile = uniqid() . "." . $resumeFileType; 
        $resumeFilename = $folder_dir . $resumeFile;


        if($resumeFileType == "pdf") {
            if($_FILES['resume']['size'] < 5000000) { 
                move_uploaded_file($_FILES["resume"]["tmp_name"], $resumeFilename);
            } else {
                $_SESSION['uploadError'] = "Wrong Size. Max Size Allowed: 5MB";
                header("Location: edit-profile.php");
                exit();
            }
        } else {
            $_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed";
            header("Location: edit-profile.php");
            exit();
        }
    }

    if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profilePicDir = "../uploads/profile_pictures/";
        $profilePicBase = basename($_FILES['profile_picture']['name']);
        $profilePicFileType = pathinfo($profilePicBase, PATHINFO_EXTENSION);
        $profilePicFile = uniqid() . "." . $profilePicFileType; 
        $profilePicFilename = $profilePicDir . $profilePicFile;

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if(in_array(strtolower($profilePicFileType), $allowedTypes)) {
            if ($_FILES['profile_picture']['size'] < 5000000) { 
                move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profilePicFilename);
            } else {
                $_SESSION['uploadError'] = "Profile picture is too large. Max size: 5MB.";
                header("Location: edit-profile.php");
                exit();
            }
        } else {
            $_SESSION['uploadError'] = "Invalid file type for profile picture. Only JPG, PNG, and GIF are allowed.";
            header("Location: edit-profile.php");
            exit();
        }
    }

    $sql = "UPDATE users SET 
                firstname='$firstname', 
                lastname='$lastname', 
                address='$address', 
                city='$city', 
                state='$state', 
                contactno='$contactno', 
                qualification='$qualification', 
                stream='$stream', 
                skills='$skills', 
                aboutme='$aboutme'";

    if ($resumeFile) {
        $sql .= ", resume='$resumeFile'";
    }

    if ($profilePicFile) {
        $sql .= ", profile_picture='$profilePicFile'";
    }

    $sql .= " WHERE id_user='$_SESSION[id_user]'";

    if($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $firstname.' '.$lastname;
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

} else {
    header("Location: edit-profile.php");
    exit();
}
?>
