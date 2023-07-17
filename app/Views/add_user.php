<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/form_style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/453e8cccab.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<style>
  .link {
    width: 40px;
    height: 40px;
    border-radius: 100%;
  }

  .image {
    width: 100%;
    height: 100%;
    border-radius: 100%;
  }
</style>

<body class="d-block">
  <?php

  use App\Models\UserModel;

  $validation = \Config\Services::validation(); ?>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid"><a class="navbar-brand" href="/dashboard">Al Hawa</a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="/dashboard">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Product</a></li>
          <li class="nav-item"><a class="nav-link" href="/add_user">Add User</a></li>
        </ul>
        <?php
        $session = session();
        $profile = new UserModel();
        $admin = $profile->where('u_email', $session->get('email'))->find();
        ?>
        <div class="float-end d-flex align-items-center gap-4 ">
          <a href="/profile/" class="text-decoration-none link "><img class=" image " src="<?php if ($admin[0]['image'] != null) {
                                                                                              echo "/uploads/" . $admin[0]['image'];
                                                                                            } else {
                                                                                              echo "https://media.istockphoto.com/id/1226886130/photo/3d-illustration-of-smiling-happy-man-with-laptop-sitting-in-armchair-cartoon-businessman.jpg?s=2048x2048&w=is&k=20&c=EeJb9xBANKhPVg42Ab7fb3QFk2nz6nnM8poAvPykVJE=";
                                                                                            }
                                                                                            ?>" alt=""></a>
          <form action="/logout" method="get"><input type="submit" class="btn btn-danger float-end text-white fw-bold" value="Log out"></form>
        </div>
      </div>
    </div>
  </nav>
  <!-- end of navbar -->
  <?php $validation = \Config\Services::validation(); ?>
  <section class="gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-10 col-xl-9">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Add User</h3>
              <form method="post" action="add_user">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline"><input type="text" name="username" id="firstName" class="form-control form-control-lg" placeholder="First Name" /><?php if ($validation->getError('username')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('username'); ?></div><?php } ?></div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline"><input type="text" name="last_name" id="lastName" class="form-control form-control-lg" placeholder="Last Name" /><?php if ($validation->getError('last_name')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('last_name'); ?></div><?php } ?></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">
                    <div class="form-outline datepicker w-100"><label for="birthdayDate" class="form-label">Birthday</label><input type="date" name="dob" class="form-control form-control-lg" id="birthdayDate" /><?php if ($validation->getError('dob')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('dob'); ?></div><?php } ?></div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <h6 class="mb-2 pb-1">Gender: </h6>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="gender" value='0' id="femaleGender" value="option1" checked /><label class="form-check-label" for="femaleGender">Male</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="gender" value='1' id="maleGender" value="option2" /><label class="form-check-label" for="maleGender">Female</label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="gender" value='2' id="otherGender" value="option3" /><label class="form-check-label" for="otherGender">Other</label></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline"><input type="email" name="email" id="emailAddress" class="form-control form-control-lg" placeholder="Email" /><?php if ($validation->getError('email')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('email'); ?></div><?php } ?></div>
                  </div>
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline"><input type="number" name="phone" id="phoneNumber" class="form-control form-control-lg" placeholder="Phone Number" /><?php if ($validation->getError('phone')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('phone'); ?></div><?php } ?></div>
                  </div>
                </div>
                <!-- role -->
                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline"><label class="form-check-label mb-2" for="maleGender">Role</label><select name="role" class="form-control form-control-lg" id="#">
                        <option class="d-flex align-items-center justify-content-center"><span>Select Role</span><img src="/assets/icons/angle-down-solid.svg" alt=""></option>
                        <option value="user">User </option>
                        <option value="admin">Admin</option>
                      </select><?php if ($validation->getError('role')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('role'); ?></div><?php } ?></div>
                  </div>
                </div>
                <!-- role end -->
                <!-- password -->
                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline"><input type="password" name="password" id="emailAddress" class="form-control form-control-lg" placeholder="Password" /><?php if ($validation->getError('password')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('password'); ?></div><?php } ?></div>
                  </div>
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline"><input type="password" name="confirm_password" id="phoneNumber" class="form-control form-control-lg" placeholder="Confirm Password" /><?php if ($validation->getError('confirm_password')) { ?><div class="alert alert-danger mt-2"><?= $error = $validation->getError('username'); ?></div><?php } ?></div>
                  </div>
                </div>
                <div class="mt-4 pt-2 d-flex justify-content-between align-items-center float-start"><a href="/dashboard" class="btn btn-warning btn-lg text-white">Back</a></div>
                <div class="mt-4 pt-2 d-flex justify-content-between align-items-center float-end"><input class="btn btn-primary btn-lg" type="submit" value="Add User" /></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>