<!DOCTYPE html>
<html id="sp-ht">

<head>
    <title>Q/A MASTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/style.css') ?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary fw-bold">
  <div class="container-fluid fw-bold">
    <a class="navbar-brand fs-2 text-danger" >Q/A MASTER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse fw-bold" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item fw-bold">
          <a class="nav-link fw-bold " aria-current="page" href="<?php echo base_url(); ?>index.php/login/">Login</a>
        </li>
        <li class="nav-item fw-bold">
          <a class="nav-link fw-bold" href="<?php echo base_url(); ?>index.php/HomeController/">Home</a>
        </li>
    
        <li class="nav-item fw-bold">
          <a class="nav-link fw-bold" href="<?php echo base_url(); ?>index.php/Register">Register</a>
        </li>
   
      </ul>
     
    </div>
  </div>
</nav>
    <div class="container p-3 mb-2 bg-primary w-25 p-3">
        <div class="head-bar">
            <div class="logo-name fw-bold text-center text-danger fs-1" data-aos="fade-down">Q/A MASTER</div>
        </div>

        <div class="panel panel-default " data-aos="fade-right">
            <div class="panel-heading mr-b welcome text-white text-center">Register form</div>
            <div class="panel-body text-white">
                <form method="post" class="was-validated" action="<?php echo base_url(); ?>index.php/register/register">
                    <div class="form-group w-100 p-3">
                        <label> Name</label>
                        <input type="text" name="name" class="form-control " placeholder="Enter text " value="" required />
                        <div class="valid-feedback">Looks good!</div>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group w-100 p-3">
                        <label> Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter text or text with numbers  " value="" required/>
                        <div class="valid-feedback">perfect!</div>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group w-100 p-3">
                        <label> Email </label>
                        <input type="text" name="email" class="form-control"  value="" required/>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group w-100 p-3">
                        <label> Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter 5 digits  " value=""  required/>
                        <div class="valid-feedback">Looks good!</div>
                        <span class="text-danger"></span>
                    </div>
                    <div></div>
                    <div class="form-group w-50 p-3">
                        <input type="submit" name="register" value="Register"
                            class="btn  btn-light" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                            href="<?php echo base_url(); ?>index.php/login">Login</a>
                    </div>
                    <?php 
                    if (isset($error)) {
                            ?>
                            <div style="color:red">
                            <?php echo $error ?>
                            </div>
                            <?php
                        }?>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    // animation 
    AOS.init({
        duration: 1500,
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    
</body>

</html>