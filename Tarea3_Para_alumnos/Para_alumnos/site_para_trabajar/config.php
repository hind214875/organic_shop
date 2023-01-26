
<?php
function connectDB(){
    $servername = "localhost";
    $database = "organic_shop_db";
    $username = "dwes";
    $password = "dwes";
    // Create connection
    $con = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}

function closeCn($con){
    $con->close();
}

?>   

 