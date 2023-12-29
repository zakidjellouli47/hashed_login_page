<?php
$verified = false;



if( isset($_POST['verify']) && $_POST['verify'] == "Verify"){

    $username = $_POST['username'];
    $password = $_POST['password'];


    $conn = pg_connect("host = localhost port = 5432 dbname = bistra user = postgres password = postgres47");
      if($conn){
    $query = "select * from password_verify($1,$2)";

    $result = pg_query_params($conn,$query,array($username,$password));

    $fetch_result = pg_fetch_object($result);
    if($result){

        $verified = $result->verify=="verified";
    }
}
     
    if(!$verified){
        echo "something went wrong";
    }
    else{

        header('location:welcome.php');
    }



}

?>





<html>

<title> password verify form </title>

<body>
    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" method = "POST">

username:
<input type="text" name = "username" placeholder = "username">

password:
<input type="password" name = "password" placeholder = "password">


<input type = "submit" name = "verify" value = "Verify">


</form>
</body>


</html>