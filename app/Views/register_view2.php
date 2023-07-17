<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="bg-info d-flex justify-content-center align-items-center" style="height: 100vh;">
  <?php $validation = \Config\Services::validation(); ?>
  <section class="gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
              <form method="post" action="register" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" name="username" id="firstName" class="form-control form-control-lg" placeholder="First Name" />
                      <?php if ($validation->getError('username')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('username'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" name="last_name" id="lastName" class="form-control form-control-lg" placeholder="Last Name" />
                      <?php if ($validation->getError('last_name')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('last_name'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">
                    <div class="form-outline datepicker w-100">
                      <label for="birthdayDate" class="form-label">Birthday</label>
                      <input type="date" name="dob" class="form-control form-control-lg" id="birthdayDate" />
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
                      <input class="form-check-input" type="radio" name="gender" value='0' id="femaleGender" value="option1" checked />
                      <label class="form-check-label" for="femaleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" value='1' id="maleGender" value="option2" />
                      <label class="form-check-label" for="maleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" value='2' id="otherGender" value="option3" />
                      <label class="form-check-label" for="otherGender">Other</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" name="email" id="emailAddress" class="form-control form-control-lg" placeholder="Email" />
                      <?php if ($validation->getError('email')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('email'); ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="number" name="phone" id="phoneNumber" class="form-control form-control-lg" placeholder="Phone Number" />
                      <?php if ($validation->getError('phone')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('phone'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                </div>


                <!-- password -->
                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="password" name="password" id="emailAddress" class="form-control form-control-lg" placeholder="Password" />
                      <?php if ($validation->getError('password')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('password'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                      <input type="password" name="confirm_password" id="phoneNumber" class="form-control form-control-lg" placeholder="Confirm Password" />
                      <?php if ($validation->getError('confirm_password')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('username'); ?>
                        </div>
                      <?php } ?>
                    </div>

                  </div>
                </div>
                <!-- end of password -->
                <!-- file upload -->
                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                      <label for="formFileLg" class="form-label">Select Profile Picture</label>
                      <input class="form-control form-control-lg" id="formFileLg" type="file" name="file" />
                      <?php if ($validation->getError('file')) { ?>
                        <div class="alert alert-danger mt-2">
                          <?= $error = $validation->getError('file'); ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>




                <!-- end of file upload -->

                <div class="mt-4 pt-2 d-flex justify-content-between align-items-center">
                  <input class="btn btn-primary btn-lg" type="submit" value="Register" />
                  <a href="/" class="text-success">Already have an account</a>
                </div>

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