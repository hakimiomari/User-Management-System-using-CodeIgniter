<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
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

<body>
  <div class="card px-4 ">
    <!-- navbar section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">Al Hawa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/dashboard">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/add_user">Add User</a>
            </li>
          </ul>
          <?php

          use App\Models\UserModel;

          $session = session();
          $profile = new UserModel();
          $admin = $profile->where('u_email', $session->get('email'))->find();
          ?>
          <div class="float-end d-flex align-items-center justify-content-center gap-4 ">
            <form class="d-flex" method="post">
              <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a href="/profile/" class="text-decoration-none link "><img class=" image " src="<?php if ($admin[0]['image'] != null) {
                                                                                                echo "/uploads/" . $admin[0]['image'];
                                                                                              } else {
                                                                                                echo "https://media.istockphoto.com/id/1226886130/photo/3d-illustration-of-smiling-happy-man-with-laptop-sitting-in-armchair-cartoon-businessman.jpg?s=2048x2048&w=is&k=20&c=EeJb9xBANKhPVg42Ab7fb3QFk2nz6nnM8poAvPykVJE=";
                                                                                              }
                                                                                              ?>" alt=""></a>
            <form action="/logout" method="get">
              <input type="submit" class="btn btn-danger float-end text-white fw-bold" value="Log out">
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- table -->
    <div class="card-header d-flex justify-content-between align-items-center mt-4">
      <h2>User List</h2>
      <a href="/add_user" class="btn btn-primary float-end">Add User</a>
    </div>
    <div class="card-body">
      <table class="table" id="mydatatable">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Date Of Birth</th>
            <th scope="col">Phone</th>
            <th scope="col">Role</th>
            <th scope="col">Created Date</th>
            <th scope='col'>
              <span href="#" class="fw-bold">Edit</span>
              <span> / </span>
              <span href="#" class="fw-bold">Delete</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
            <tr>
              <th scope="row"><?php echo $user['u_id'] ?></th>
              <td><?php echo $user['u_first_name'] . " " . $user['u_last_name'] ?> </td>
              <td><?php echo $user['u_email'] ?></td>
              <td>
                <?php
                if ($user['u_gender'] == 0) {
                  echo 'Male';
                } else if ($user['u_gender'] == 1) {
                  echo "Female";
                } else {
                  echo "Other";
                }

                ?>
              </td>
              <td><?php echo $user['u_dob'] ?></td>
              <td><?php echo $user['u_phone'] ?></td>
              <td><?php echo $user['role'] ?></td>
              <td><?php echo $user['created_at'] ?></td>
              <td scope='col'>
                <a href="/edit/<?php echo $user['u_id'] ?>
                 " class="btn btn-primary mr-1">Edit</a>
                <a href="/delete/<?php echo $user['u_id'] ?>" class="btn btn-danger mr-1">Delete</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <!--start pagination -->
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <?php if (isset($pager)) : ?>
              <?php $pagi_path = '/dashboard'; ?>
              <?php $pager->setPath($pagi_path); ?>
              <?= $pager->links() ?>
            <?php endif ?>
          </div>
        </div>
      </div>
      <!--end pagination -->
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script>
    $('#mydatatable').DataTable();
  </script>
</body>

</html>