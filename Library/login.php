<?php
include("config.php");   //includes the config file for connecting to the database

session_start();       //Starting the session



//if($_SERVER["REQUEST_METHOD"]=="POST")
//{        //Run if the form method is POST TYPE ONLY

//Checking For connection -> database

$connect= mysqli_connect(dbhost, dbuser, dbpass,dbname);
if(!$connect)
{
    die('Error while connecting: '.mysqli_error($connect));
    exit();
}

/*$dbconnect= mysqli_select_db($connect,dbname);

if (!$dbconnect)
{
    die('Failed to select db: '.mysqli_error($dbconnect));
    exit();
}*/

//declaring form variables



//$user=$_POST['user'];
$user=mysqli_real_escape_string($_POST["user"]);

//$passwd=$_POST['passwd']; 
$passwd=mysqli_real_escape_string($_POST["passwd"]);

//encpassws=($passwd);                                             //encrypting password%s

$sql="SELECT  `userid` ,  `username` ,  `passwd` ,  `usertype` ,`userdoj` FROM  `users` WHERE username =  '$user' and passwd='$passwd' ";

$sqlquery= mysqli_query($connect,$sql);
$numb_row= mysqli_num_rows($sqlquery);
 echo "Reached here";
    if($numb_row >= 1)
    {
        while ($rw = mysqli_fetch_assoc($sqlquery))
        {
            $usern=$rw['username'];
            $type= $rw['usertype'];
        }
        if($type=="a" and $usern==$user)
        {
            echo "Redirecting ...";
            header('Location:http://localhost/Library/admin.php');
        }
        elseif ($type=="u" or $user==$user)
        {   echo "Please wait";
            header('Location:http://localhost/Library/user.php');
        }
        
    }
else
        {  
            echo"<script type="text/javascript">";
                echo"alert("Login Failed click OK to continue");"
            echo"</script>"
            
            header("Location:http://localhost/Library/index.php");
        }
    //}
//else {
  //  echo "Failed";
    //header("Location:index.php");
//}
?>
