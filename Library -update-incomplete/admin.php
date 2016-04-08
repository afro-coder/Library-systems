


<?php 

include('admin.php');
session_start();

if($_SESSION['user'] !== $username && $_SESSION['password'] !== $passwd )
{echo "error";header('location:http://localhost/Library/index.php');}
?>

<html>
    <head><title>Admin Panel</title>
    <script type="text/javascript">
        function users(){
            window.location="http://localhost/Library/input_form.php";
            
        }
        </script>
    </head>
    <body>
        <div>
        <table>
            <tr><td>Add &amp; Remove  users</td> <td><input type="button" name="inputform" onclick="users();" value="Click here"> </td></tr> 
               <tr><td>Add &amp; Remove  Books</td><td><input type="button"  name="addbk" onclick="books();" value="Click here"> </td></tr>
                  <tr><td>View Books</td><td><input type="button" name="viewbk" onclick="viewbk();" value="Click Here"></td></tr>
            <tr><td>Issue and return books</td><td><input type="button" name="issuebk" onclick="issue();" value="Click Here"></td></tr>
            <tr><td>Reports</td><td><input type="button" name="reports" onclick="reports();" value="Click Here"></td></tr>
                    
        </table>
        </div>
    </body>
</html>

    