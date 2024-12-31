<?php
$database = mysqli_connect("localhost", "root", "", "exam31");
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $database->query("call manufacturer_n('$name','$address','$contact')");
    header("location:$_SERVER[PHP_SELF]");
}
if (isset($_POST["submit2"])) {
    $name2 = $_POST['name2'];
    $price = $_POST['price'];
    $manu_id = $_POST['manu'];
    $database->query("call product_n('$name2','$price','$manu_id')");
    header("location:$_SERVER[PHP_SELF]");
}
if (isset($_POST["delete"])) {
    $manu_del = $_POST['manu-del'];
    $database->query("delete from manufacturer where id='$manu_del'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <style>
        input,
        select {
            margin-top: 5px;
            width: 150px;
            padding: 5px;
        }

        div {
            margin-top: 0px auto;
            
            
        }
    </style>

</head>

<body>

    <div style="float:left; margin-right:100px;">
        <h2>Insert Manufacturer</h2>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name"><br>
            <input type="text" name="address" placeholder="Address"><br>
            <input type="text" name="contact" placeholder="Contact"><br>
            <input type="submit" name="submit" value="Submit">
        </form>



        <h2>Insert Product</h2>
        <form action="" method="post">
            <input type="text" name="name2" placeholder="Product Name"><br>
            <input type="number" name="price" placeholder="Price"><br>
            <select name="manu">
                <?php
                $r = $database->query("select * from manufacturer");
                while (list($id, $name) = $r->fetch_row()) {
                    echo "<option value='$id'>$name</option>";
                }
                ?>
            </select><br>
            <input type="submit" name="submit2" value="Submit">
        </form>




        <h2>Delete Manufacturer</h2>
        <form action="" method="post">
            <select name="manu-del">
                <?php
                $r = $database->query("select * from manufacturer");
                while (list($id, $name) = $r->fetch_row()) {
                    echo "<option value='$id'>$name</option>";
                }
                ?>
            </select><br>
            <input type="submit" name="delete" value="Delete">
        </form>
    </div><br>
    <br>
    <h2>Full Deetails</h2>
    <?php
    $user = $database->query("select * from details2");
    echo "<table border='1'  width='600px' style='border-collapse:collapse;'>
            <tr style='background:gray; '>
                
                <th>Name</th>
                <th>Address</th>
                <th>contact</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Manufacturer ID</th>
            </tr>";
    while (list($name, $address, $contact, $name2, $price, $manu_id) = $user->fetch_row()) {
        echo "<tr style='background-color: lightblue; '>
                
                <td>$name</td>
                <td>$address</td>
                <td>$contact</td>
                <td>$name2</td>
                <td>$price</td>
                <td>$manu_id</td>
            </tr>";
    }
    echo "</table>";
    ?><br>
    <h2>Only show gretter than 5000</h2>
    <?php
    $user = $database->query("select * from conn");
    echo "<table border='1' width='500px' style='border-collapse:collapse;'>
            <tr  style='background:gray;' >
                
                
                <th>Id</th>
                <th>ProductN</th>
                <th>Price</th>
               
            </tr>";
    while (list($id, $name2, $price,) = $user->fetch_row()) {
        echo "<tr style='background-color: lightblue;'>
                
                <td>$id</td>
                <td>$name2</td>
                <td>$price</td>
               
            </tr>";
    }
    echo "</table>";
    ?>


</body>

</html>