<?php 
    session_start();

    if(isset($_POST['SaveUserdetails'])){


        $userdetails = [
            'FirstName' =>  !empty($_POST['FirstName']) ? $_POST['FirstName'] : '',
            'Lastname' =>  !empty($_POST['Lastname']) ? $_POST['Lastname'] : '',
            'Phone' =>  !empty($_POST['Phone']) ? $_POST['Phone'] : '',
            'Email' =>  !empty($_POST['Email']) ? $_POST['Email'] : '',
            'Address' =>  !empty($_POST['Address']) ? $_POST['Address'] : '',
            'City' =>  !empty($_POST['City']) ? $_POST['City'] : '',
            'State' =>  !empty($_POST['State']) ? $_POST['State'] : '',
            'Zip' =>  !empty($_POST['Zip']) ? $_POST['Zip'] : '',
            'ordernotes' =>  !empty($_POST['ordernotes']) ? $_POST['ordernotes'] : ''
        ];

        $_SESSION['UserDetails'] = $userdetails;
    }

    header("Location:payment.php"); 
    // header("Location:clover-charge.php"); 
?>