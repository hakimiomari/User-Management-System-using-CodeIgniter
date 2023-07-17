<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/form_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php $validation = \Config\Services::validation(); ?>
    <div class="cards">
            <form class="sign_in form" action="register" method="post">
                <h2 class="mb-4 text-center fw-bold">Sign Up</h2>
                <div class="form_group">
                    <input class='input' type="text" name='username' id="username" placeholder="@userame">
                    <?php if($validation->getError('username')) { ?>
                        <div class="alert alert-danger mt-2">
                            <?= $error = $validation->getError('username'); ?>
                        </div>
                    <?php } ?>
                </div>
              <div class="form_group">
                    <input class='input' type="email" name='email' id="email" placeholder="Email">
                    <?php if($validation->getError('email')) { ?>
                        <div class="alert alert-danger mt-2">
                            <?= $error=$validation->getError('email') ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form_group password">
                    <input class='input' type="Password" name="password" id="password" placeholder="Password">
                    <?php if($validation->getError('password')){ ?>
                        <div class="alert alert-danger mt-2">
                            <?= $error = $validation->getError('password') ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form_group password">
                    <input class='input' type="Password" name="confirm_password" id="password" placeholder="Confirm Password">
                    <?php if($validation->getError('confirm_password')){ ?>
                        <div class="alert alert-danger mt-2">
                            <?= $error = $validation->getError('confirm_password') ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form_group">
                    <input  type="submit" class='submit input' value="Sign Up">
                </div>
                <div class="form_group">
                     <a href="/" class='register'>Already have an account</a>
                </div>
            </form>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>