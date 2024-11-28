<?php  
    include_once "../init.php";
    include_once '../connection.php';
    
    // User login check
    if (isset($_SESSION['UserId'])) {
      header('Location: 3-Dashboard.php');
    }

    if(isset($_POST['register']))
    {
        // Storing image path in database
        if(empty($_FILES['inpFile']['name']))
        {
            $target = '../static/images/userlogo.png';
        }
        else
        {
            // Unique profile image name for each user
            $profileImageName = time() .'_'. $_FILES['inpFile']['name'];
            $target = '../static/profileImages/' . $profileImageName;
        }
        
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $signupError = "";

        // Form validation
        $email = $getFromU->checkInput($email);
        $fullname = $getFromU->checkInput($fullname);
        $username = $getFromU->checkInput($username);
        $password = $getFromU->checkInput($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $signupError = "Invalid email";
        } 
        elseif (strlen($fullname) > 30 || (strlen($fullname)) < 2) 
        {
            $signupError = "Name must be between 2-30 characters";
        } 
        elseif (strlen($username) > 30 || (strlen($username)) < 3) 
        {
            $signupError = "Username must be between 3-30 characters";
        } 
        elseif (strlen($password) < 6) 
        {
            $signupError = "Password too short";
        }
        elseif (strlen($password) >30) 
        {
            $signupError = "Password too long";
        }
        else 
        {
            if ($getFromU->checkEmail($email) === true) 
            {
                $signupError = "Email already registered";
            } 
            
            if ($getFromU->checkUsername($username) === true) 
            {
                $signupError = "Username already exists";
            }
            else 
            {
                move_uploaded_file($_FILES['inpFile']['tmp_name'], $target);
                $user_id = $getFromU->create('user', array('Email' => $email,'Password' => md5($password), 'Full_Name' => $fullname, 'Username' => $username, 'Photo' =>$target, 'RegDate' => date("Y-m-d H:i:s")));
                $_SESSION['UserId'] = $user_id; 
                $_SESSION['swal'] = "<script>
                    Swal.fire({
                        title: 'Yay!',
                        text: 'Congrats! You are now a registered user',
                        icon: 'success',
                        confirmButtonText: 'Done'
                    })
                    </script>";
                header('Location: 3-Dashboard.php');
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/wallet.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="../static/css/2-sign-up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Expense Tracker</title>         
</head>
<style>
    body {
    background-image: url('../static/images/bg.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

.container {
    padding: 30px;
    border-radius: 8px;
    width: 100%;
    max-width: 500px;
    background-color: rgba(0, 0, 0, 0.5); /* Optional for background color */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional for box shadow */
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Aligns all child elements to the center */
    margin-top: 20px;
}

.form-control {
    margin-bottom: 20px; /* Space between text boxes */
    width: 100%; /* Stretch to the container's full width */
    max-width: 400px; /* Prevent excessive width */
}

.form-control input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px; /* Adjust font size for better readability */
    box-sizing: border-box; /* Ensures padding does not increase width */
}

.form-control input:focus {
    border-color: #4CAF50;
    outline: none; /* Removes default focus outline */
    box-shadow: 0 0 5px rgba(72, 239, 128, 0.7);
}

.user-pic-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px; /* Wider padding for a better look */
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    text-align: center;
    width: auto; /* Ensure it doesn’t stretch */
}

.form-container button {
    display: block; /* Ensures block-level element */
    margin: 0 auto; /* Centers horizontally */
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, background 0.3s ease;
    text-align: center;
}


.form-container button:hover {
    background: linear-gradient(135deg, #45a049, #3e8e41);
    transform: scale(1.05);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.form-container button:active {
    transform: scale(0.98);
    background: linear-gradient(135deg, #3e8e41, #368a3b);
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
}


.image-preview {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.image-preview__image {
    width: 100px;
}

.image-preview__default-text {
    font-size: 14px;
    color: #777;
    padding-top: 30px;
}

h1 {
    font-size: 2rem;
    color: white;
    font-family: 'Baloo Bhai 2', sans-serif;
    text-align: center;
    font-weight: 500;
}

</style>
<body>
    <div class="container">
        <form action="2-sign-up.php" method="post" id="form" onsubmit="return validate()" enctype="multipart/form-data">
            
            
            <div class="heading">
    <h1 style="text-align: center; font-weight: bold;">Create Your Account</h1>
</div>
<!-- Image Upload -->
<div class="image-preview" id="imagePreview">
<img src="" alt="Image Preview" class="image-preview__image" id="profileDisplay">
<span class="image-preview__default-text"><img src="../static/images/userlogo.png" alt=""></span>
    <label for="imageUpload" class="user-pic-btn" style="cursor: pointer;">Add Photo</label>
    <input type="file" name="inpFile" id="imageUpload" accept="image/*" style="display: none">
</div>

            
            <!-- Single Container for User Details -->
            <div class="form-container">
                <div class="form-control">
                    <input type="text" name="full_name" id="fullname" placeholder="Full Name" required>
                </div>

                <div class="form-control">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>

                <div class="form-control">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <span id="uname_response"></span>
                </div>

                <div class="form-control">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <div class="form-control">

            <input type="password" name="password_confirm" id="confirmpassword" placeholder="Confirm Password" required>
            <button type="submit" value="Submit" name="register">Complete</button>
                </div>
            </div>
            
            <?php  
                if (isset($signupError)) {
                    echo '<div style="color: red;">'.$signupError.'</div>';
                }
            ?>
        </form>
        
    </div>
    
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#username").keyup(function() {
                var username = $(this).val().trim();
                if(username != '') {
                    $.ajax({
                        url: '../ajaxfile.php',
                        type: 'post',
                        data: {username: username},
                        success: function(response){
                            $('#uname_response').html(response);
                        }
                    });
                } else {
                    $("#uname_response").html("<br/>");
                }
            });
        });
    </script>
    <script src="../static/js/2-sign-up.js"></script>

</body>
</html>
