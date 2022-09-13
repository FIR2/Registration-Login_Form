<!-- <?php

//  session_start();

?> -->
<!DOCTYPE html>
<html lang="en">
<head>
       <title>Login Form</title>
       <?php   include'style.php'     ?>
       <?php   include'links.php'     ?>

</head>
<body>

  <?php
     include 'dbcon.php';

     if(isset($_POST['submit']))
      {
        $email = $_POST['email'];
        $paasword = $_POST['password'];

        //validation for user ne jo email enter kiya hai wo akready data base me hai ki check krna
       $email_search = " select * from registration  where email ='$email' ";
       $query = mysqli_query($con,$email_search);
    //  check karnge ki same email ek se jaida rows m to nahi hai
        $email_count = mysqli_num_rows($query);
          
        if($email_count)
            {
               $email_pass = mysqli_fetch_assoc($query);

               $db_pass = $email_pass['password'];
              // argument pass jo ho raha hai mtlb jo user ne password dala or jo database m password hai match ho raha hai ki nahi
               $db_decode = password_verify($paasword,$db_pass);
                    
               if($db_decode)
                  {
                    echo "Login successful";
                    // is page ko hame page pr send krne ke liye code
                    ?>
                     <script>
                        location.replace("IQ.php");
                      </script>
                    <?php  
                  }
                  else
                  {
                    echo "Password Incorrect";
                  }

            }
            else
            {
                echo "Invalid Email";
            }




      }
  
  
  
  
  ?>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="width: 400px;">
               <h4 class="card-title mt-3 text-center"> Create Account</h4>
               <p class="text-center">Get started with your free account</p>
                <p>
                  <a href="" class="btn btn-block btn-gmail"><i class="fa fa-google"></i>  Login via Gmail</a>
                  <a href="" class="btn btn-block btn-facebook"><i class="fa fa-facebook"></i>  Login via facebook</a>
                </p>
                <p class="divider-text"> <span class="bg-light">OR</span></p>

                <form  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                   <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email address" value="" required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" value="" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary btn-block">Login Now</button>
                    </div>
                    <p class=" text-center">Not Have an account? <a href="index.php">SignUp Here</a></p>
                </form>
            </article>
         </div>

    </body>
</html>