<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/form_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-info">

    <?php

    use App\Models\UserModel;

    $validation = \Config\Services::validation(); ?>
    <div class="cards">
        <form class="login form" action="/change_password" method="post">
            <h2 class="fw-bold text-center mb-4">Chaging Password</h2>
            <?php
            $user = new UserModel();
            $session = session();
            $data = $user->where('u_email', $session->get('email'))->find();
            if ($data[0]['role'] == 'user') {
            ?>
                <div class="form_group password">
                    <input class="input" type="password" name="old_password" id="confirm_password" placeholder="Old Password">
                    <?php if ($validation->getError('old_password')) { ?>
                        <div class="alert alert-danger mt-2">
                            <?= $error = $validation->getError('old_password') ?>
                        </div>
                    <?php } ?>
                </div>
            <?php
            } ?>
            <div class="form_group">
                <input type="text" name="id" value="<?php if (isset($users)) {
                                                        echo $users['u_id'];
                                                    }  ?>" hidden>
                <input class="input" type="password" name='password' id="password" placeholder="Password">
                <?php if ($validation->getError('password')) { ?>
                    <div class="alert alert-danger mt-2">
                        <?= $error = $validation->getError('password') ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form_group password">
                <input class="input" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                <?php if ($validation->getError('confirm_password')) { ?>
                    <div class="alert alert-danger mt-2">
                        <?= $error = $validation->getError('confirm_password') ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form_group d-flex justify-content-between flex-row mt-4 pt-4">
                <a href="/edit/<?php if (isset($users)) {
                                    echo $users['u_id'];
                                }  ?>" class="btn btn-warning text-decoration-none text-white">Back</a>
                <input type="submit" class='btn btn-primary' value="Save Change">
            </div>

        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>