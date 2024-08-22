<?php include('dashboard/config/config.php'); ?>
<?php 

    if(isset($_POST['submit'])){
        $name =  $_POST['name'];
        $usertype =  $_POST['usertype'];
        $email =  $_POST['email'];
        $pass =  $_POST['password'];
        $hass = hash('sha1', $_POST['password']);
        
        $sql = "SELECT email FROM users where email = '$email'";
        if($query = $conn->query($sql)){
            $rowcount = mysqli_num_rows($query);
            if($rowcount>0){
                $msg = "<div class='alert alert-danger'>User Email allready Exist</div>";
                header("Location: index.php?msg=".$msg);
            }else{
                $sqls = "INSERT INTO users(usertype, name, email, password) VALUES ('$usertype','$name','$email','$hass')";
                if($qry = $conn->query($sqls)){
                    $msg ="<div class='alert alert-success'>Successfully user created!</div>";
                    header("Location: dashboard?msg=".$msg);
                }else{
                  echo "User creation failed! Please try again";  
                }

            }
            
        }
        
    }

?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <select name="usertype" id="usertype" class="form-control">
                <option value="">Select User Type</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" name='submit' class="btn btn-success">Register</button>
    </form>