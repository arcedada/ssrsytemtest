<?php
    $employee_id = "";
    $log_password = "";
    $employee_id_error = "";
    $password_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["employee_id"])){
            $employee_id_error = "Email is required!";
        }else{
            $employee_id = $_POST["employee_id"];
        }

        if(empty($_POST["password"])){
            $password_error = "Password is required!";
        }else{
            $log_password = $_POST["password"];
        }


        if($employee_id && $log_password){
            include ("connections.php");

            $check_employee = mysqli_query($connections, "SELECT * FROM ssr_accounts WHERE employee_id='$employee_id'");
            $check_employee_row = mysqli_num_rows($check_employee);

            if($check_employee_row > 0){
                while($row = mysqli_fetch_assoc($check_employee)){
                    $db_password = $row["password"];
                    $db_type = $row["type"];
                    
                        if($log_password == $db_password){
                            $password_error = "Password is correct!";
                            
                        }else{
                            $password_error = "Password is incorrect!";
                        }
                }
            }else{
                $employee_id_error = "Employee ID is not registered!";
            }
        }
    }
?>

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Email ID: <input type="text" name="employee_id" value="<?php echo $employee_id; ?>"> <br>
    <span class="error"><?php echo $employee_id_error; ?></span> <br>

    Password: <input type="password" name="password" value="<?php echo $log_password; ?>"> <br>
    <span class="error"><?php echo $password_error; ?></span> <br>

    <input type="submit" value="Login">
</form>