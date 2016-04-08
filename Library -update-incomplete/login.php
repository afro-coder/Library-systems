<?php
include("config.php");   //includes the config file for connecting to the database

session_start();       //Starting the session



if($_SERVER["REQUEST_METHOD"]=="POST")
{        //Run if the form method is POST TYPE ONLY

//Checking For connection -> database

$connect= mysqli_connect(dbhost, dbuser, dbpass,dbname);
if(!$connect)
{
    die('Error while connecting: '.mysqli_error($connect));
    exit();
}


//declaring form variables



//$user=$_POST['user']; //Need to figure out why mysqli_real_escape doesn't work
$user = $_POST['user'];

//$passwd=$_POST['passwd']; 
$passwd = $_POST['passwd'];
$newpass = md5($passwd);
//encpassws=($passwd);  //encrypting password
    

$sql="SELECT  `userid` ,  `username` ,  `passwd` ,  `usertype` ,`userdoj` FROM  `users` WHERE username =  '$user' and passwd='$newpass' ";
$_SESSION['user']=$_POST['user'];
$_SESSION['password']=$_POST['passwd'];
$sqlquery= mysqli_query($connect,$sql);
$numb_row= mysqli_num_rows($sqlquery);
 echo "Reached here";
    if($numb_row >= 1)
    {
        while ($rw = mysqli_fetch_assoc($sqlquery))
        {
            $usern = $rw['username'];
            $type = $rw['usertype'];
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
            
            
            header("Location:http://localhost/Library/index.php");
        }

}
else {echo "error";}
?>
