<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="assets/css/form_style.css"> -->
  <link rel="stylesheet" href="/assets/css/form_style.css">
</head>
<style>
  .link {
    width: 100px;
    height: 100px;
    border-radius: 100%;
    border: 10px solid grey;
  }

  .image {
    width: 100%;
    height: 100%;
    border-radius: 100%;
  }
</style>

<body class="bg-info d-block" style="height: 100vh;">
  <?php $validation = \Config\Services::validation(); ?>

  <?php $validation = \Config\Services::validation(); ?>
  <section class="gradient-custom d-flex justify-content-center align-items-center">
    <div class="container py-5">
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-9 col-xl-8">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <div class="mb-4 pb-2 pb-md-0 mb-md-5 d-flex justify-content-between align-items-center">
                <h3 class="text-lg">Edit Form</h3>
                <a href="/change_password/<?php if (isset($users)) {
                                            echo $users['u_id'];
                                          } ?>" class="btn btn-success">Change Password</a>
              </div>
              <form method="post" action="/update" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <input class='input' type="text" name="id" value="<?php if (isset($users)) {
                                                                        echo $users['u_id'];
                                                                      } ?>" hidden>
                    <div class="form-outline">
                      <input type="text" name="username" value="<?php if (isset($users)) {
                                                                  echo $users['u_first_name'];
                                                                } ?>" id="firstName" class="form-control form-control-lg" placeholder="First Name" />
                      <?php if ($validation->getError('username')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('username'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" value="<?php if (isset($users)) {
                                                  echo $users['u_last_name'];
                                                } ?>" name="last_name" id="lastName" class="form-control form-control-lg" placeholder="Last Name" />
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 ">
                    <div class="form-outline datepicker w-100">
                      <label for="birthdayDate" class="form-label">Birthday</label>
                      <input type="date" value="<?php if (isset($users)) {
                                                  echo $users['u_dob'];
                                                } ?>" name="dob" class="form-control form-control-lg" id="birthdayDate" />
                      <?php if ($validation->getError('dob')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('dob'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" value='0' id="femaleGender" value="option1" <?php if ($users['u_gender'] == '0') {
                                                                                                                                echo 'checked';
                                                                                                                              } ?> />
                      <label class="form-check-label" for="femaleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" value='1' id="maleGender" value="option2" <?php if ($users['u_gender'] == '1') {
                                                                                                                              echo 'checked';
                                                                                                                            } ?> />
                      <label class="form-check-label" for="maleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" value='2' id="otherGender" value="option3" <?php if ($users['u_gender'] == '2') {
                                                                                                                              echo 'checked';
                                                                                                                            } ?> />
                      <label class="form-check-label" for="otherGender">Other</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" value="<?php if (isset($users)) {
                                                    echo $users['u_email'];
                                                  } ?>" name="email" id="emailAddress" class="form-control form-control-lg" placeholder="Email" />
                      <?php if ($validation->getError('email')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('email'); ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="number" value="<?php if (isset($users)) {
                                                    echo $users['u_phone'];
                                                  } ?>" name="phone" id="phoneNumber" class="form-control form-control-lg" placeholder="Phone Number" />
                      <?php if ($validation->getError('phone')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('phone'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                      <label for="formFileLg" class="form-label">Change Profile Picture</label>
                      <input class="form-control form-control-lg" id="formFileLg" type="file" name="file" />
                      <?php if ($validation->getError('file')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('file'); ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                      <label for="formFileLg" class="form-label">Role</label>
                      <select name="role" id="role" class="form-control">
                        <option value="user" <?php if ($users['role'] == 'user') {
                                                echo "selected";
                                              }  ?>>User</option>
                        <option value="admin" <?php if ($users['role'] == 'admin') {
                                                echo "selected";
                                              }  ?>>Admin</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mt-4 pt-2 d-flex justify-content-between align-items-center float-start">
                  <a href="/dashboard" class="btn btn-warning btn-lg text-white">Back</a>
                </div>
                <div class="mt-4 pt-2 d-flex justify-content-between align-items-center float-end">
                  <input class="btn btn-primary btn-lg" type="submit" value="Save" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>