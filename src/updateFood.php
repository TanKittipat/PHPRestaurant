<?php

if (isset($_POST['FoodID'])) {
    require '../connect.php';

    $FoodID = $_POST['FoodID'];
    $FoodName = $_POST['FoodName'];
    $FoodPrice = $_POST['FoodPrice'];

    echo 'รหัสอาหาร = ' . $FoodID;
    echo 'ชื่อรายการอาหาร = ' . $FoodName;
    echo 'ราคา = ' . $FoodPrice;


    $stmt = $conn->prepare(
        'UPDATE  food SET FoodName = :FoodName,FoodPrice = :FoodPrice WHERE FoodID = :FoodID'
    );
    $stmt->bindParam('FoodID', $_POST['FoodID']);
    $stmt->bindParam('FoodName', $_POST['FoodName']);
    $stmt->bindParam('FoodPrice', $_POST['FoodPrice']);
    $stmt->execute();

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->rowCount() >= 0) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update customer information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}
?>