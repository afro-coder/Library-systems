    <html>

            <body>
            <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="Inputs">
                <table>
            <tr>
                <td>username:</td>
                <td><input type="text" name="usr" ></td>
              </tr>
            <tr>
                <td>Password</td>
                <td><input type="password"  name="pass">
                </td>
                </tr>
              <tr>
                  <td>Usertype(a,u)</td><td><input type="text" name="usertype" ></td>
                </tr>
                <tr><td>Date of Birth</td><td><input type="text" name="dob"></td> </tr>

                    <tr><td><input type="submit" name="sub" value="Add user"></td><td><input type="submit" name="remove" value="Remove user"></td></tr>

            </table>

            </form>
                </div>

        </body>
                </html>

    <?php

    include("config.php");
//Declaring Variables
    $username=$_POST['usr'];
    $passwd=$_POST['pass'];
    

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $connect = mysqli_connect(dbhost, dbuser, dbpass,dbname);
    if(!$connect)
    {
        die('Error while connecting: '.mysqli_error($connect));
        exit();
    }
//Hashing passwords
    $newpassword=md5($passwd);
    $usert=$_POST['usertype'];
    $dob=$_POST['dob'];     
         /////////////Validating//////////
         if(isset($_POST['sub']))
         {
        if (!preg_match('/\s/',$username))  //checking for whitespaces
         {
    if(!empty($username) && !empty($usert)){

    //echo "Reached here";

    $sql="INSERT INTO `users`(`userid`, `username`, `passwd`, `usertype`, `userdoj`) VALUES (NULL, '$username', '$newpassword','$usert', '$dob')";                           

         $quer = mysqli_query($connect,$sql);
         if($quer === TRUE)
         {
    echo "query success";
    $connect -> close();   
         }
         else {
             echo "Query failed";
             $connect -> close();
         }
     }
         else
         {
             echo"Error Please enter again";
             $connect -> close();
         }
     }
    else 
    {
        echo "username contains whitespaces";
        $connect -> close();
    }
         
     }
     }


                ///////////////////////////////////REMOVE Option///////////////////////////////////////////////
      if(isset($_POST['remove']) && !empty($username)  )
      {
          $sql="DELETE FROM `users` WHERE username='$username' and usertype='$usert' ";
            $rmquery=mysqli_query($connect,$sql);
            if($rmquery === TRUE)
            {
                echo "Removed user ";
                
            }
          else
          {
              echo "Failed to remove user";
          }
                
      }

     

    ?>