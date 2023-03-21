<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Add new Food</title>
</head>

<body>


    <?php
    require '../connect.php';

    $sql_select = 'select * from foodtype order by FoodTypeID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();

    if (isset($_POST['submit'])) {

        if (!empty($_POST['FoodName'])) {
            echo '<br>' . $_POST['FoodName'];
            //require 'connect.php';
    
            $sql = "INSERT INTO food(FoodName,FoodPrice,FoodTypeID) VALUES (:FoodName,:FoodPrice,:FoodTypeID)";

            $stmt = $conn->prepare($sql);
            // $stmt->bindParam(':FoodID', $_POST['FoodID']);
            $stmt->bindParam(':FoodName', $_POST['FoodName']);
            $stmt->bindParam(':FoodPrice', $_POST['FoodPrice']);
            $stmt->bindParam(':FoodTypeID', $_POST['FoodTypeID']);
        


            try {
                if ($stmt->execute()):
                    $message = 'Successfully add new customer';
                    // echo $stmt;
                else:
                    $message = 'Fail to add new customer';
                endif;
                echo $message;
            } catch (PDOException $e) {
                echo 'Fail! ' . $e;
            }

            $conn = null;
        }

        header('location:index.php');
    }
    ?>



    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มรายการอาหาร</h3>
                <form action="addFood_dropdown.php" method="POST">

                    <!-- <input type="text" placeholder="รหัสอาหาร" name="FoodID"> -->
                    <br>
                    <input type="text" placeholder="ชื่อรายการอาหาร" name="FoodName">
                    <br> <br>
                    <input type="number" placeholder="ราคา" name="FoodPrice">
                    <br> <br>
                    <label>เลือกประเภทอาหาร</label>
                    <select name="FoodTypeID">
                        <?php while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $cc['FoodTypeID']; ?>">
                                <?php echo $cc['FoodTypeName']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br> <br>

                    <input type="submit" value="Submit" name="submit" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>