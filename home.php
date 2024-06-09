<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
   
    
</html>

</head>

<body class="main-body">
<div  class="container-fluid vh-100 d-flex justify-content-center ">

<div class=" d-none" id="msgdiv">
        <div class="alert alert-danger" role="alert" id="msg">

                                </div>
                </div>
        <div class="row align-content-center">

        
        <div class="wrapper">
        
         
            <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
            <div class="form-box login ">
                <h2>Login</h2>
                
                <?php

                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                ?>

                <form action="#">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" required id="email2">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" required id="password2">
                        <label>Password</label>
                    </div>
                    <div class="remember-forget form-switch">
                        <label><input class="form-check-input" type="checkbox" id="rememberme">Remember Me</label>
                        <a href="#" onclick="forgotPassword();">Forgot Password?</a>
                    </div>
                    <button type="Submit" class=" btn btnm" onclick="signIn();">Login</button>
                    <div class="login-register"><p>Dont have an account? <a href="#" class="register-link"  >Register</a></p></div>


                </form>
            </div>

            <div style="padding-top: 290px;" class="form-box register ">
                <h2>Register</h2>
                <form action="#">
                <div class="input-box">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <input type="text" required id="fname">
                        <label>First Name</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"></span>
                        <input type="text" required id="lname">
                        <label>Last Name</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="text" required id="mobile">
                        <label>Mobile No.</label>
                    </div>
                    
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" required id="email">
                        <label>Email</label>
                    </div>
                   

                    <div  class="input-box">
                                <select style="color:#162938;" class="form-select transparent" id="gender">

                                    <?php

                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`");

                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>
                                        <option hidden><label >Gender</label></option>
                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>

                                </select>
                    </div>


                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input  type="password" required id="password">
                        <label>Password</label>
                    </div>
                    
                    <button type="Submit" class="btn btnm" onclick="signUp();">Submit</button>
                    <div class="login-register"><p>Already have an account? <a href="#" class="login-link">Login</a></p></div>


                </form>
            </div>

        </div>



        </div>
</div>

<!-- modal -->
<div class="modal " tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content transparent">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np"/>
                                        <button class="btn btn-outline-secondary" style="color:white;" type="button" id="npb" onclick="showPassword();">Show</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button class="btn btn-outline-secondary" type="button" style="color:white;" id="rnpb" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc"/>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
<!-- modal -->
         <script src="https://js.stripe.com/v3/"></script>
         <script  src="script.js"></script>
         <script src="bootstrap.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>