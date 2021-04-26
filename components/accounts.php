<?php
    @include_once './components/accounts.php';

    function registerUser() {
        @include_once './database/dao/usersDAO.php';
        $users = new usersDAO();

        if (empty($_POST['email'])) {
          showRegistrationErrorMessage("email");
          return;
        }
        else {
          $username = $_POST['email'];
        }

        if (empty($_POST['password'])) {
          showRegistrationErrorMessage("password");
          return;
        }
        if (empty($_POST['firstname'])) {
          showRegistrationErrorMessage("firstname");
          return;
        }
        if (empty($_POST['lastname'])) {
          showRegistrationErrorMessage("lastname");
          return;
        }
        if (empty($_POST['address'])) {
          showRegistrationErrorMessage("address");
          return;
        }
        if (empty($_POST['city'])) {
          showRegistrationErrorMessage("city");
          return;
        }
        if (empty($_POST['region'])) {
          showRegistrationErrorMessage("region");
          return;
        }
        if (empty($_POST['country'])) {
          showRegistrationErrorMessage("country");
          return;
        }
        if (empty($_POST['postal'])) {
          showRegistrationErrorMessage("postal");
          return;
        }
        if (empty($_POST['phone'])) {
          showRegistrationErrorMessage("phone");
          return;
        }

        if (!empty($_POST['privacy']) && $_POST['privacy'] == "true") {
          $privacy = '2';
        }
        else {
          $privacy = '1';
        }

        $_SESSION['user'] = $users->addUser(
          $username,
          $_POST['password'],
          $_POST['firstname'],
          $_POST['lastname'],
          $_POST['address'],
          $_POST['city'],
          $_POST['region'],
          $_POST['country'],
          $_POST['postal'],
          $_POST['phone'],
          $_POST['email'],
          $privacy
        );


    }

    function processLogin() {
        @include_once './database/dao/usersDAO.php';
        $users = new usersDAO();

        $user = NULL;
        if (!empty($_POST['username']) && !isset($_POST['password'])) {
          $user = $users->getUser($_POST['username'], $_POST['password']);
        }

        if ($user) {
          $users->logUserIn($user->uId);
          $_SESSION['user'] = $user;
        }
        else {
          showLoginErrorMessage();
        }

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['submit'])) {
        if($_POST['submit'] == "login")
            processLogin();
        elseif ($_POST['submit'] == "register")
            registerUser();
    }

?>

<!-- Register Modal -->
<div id="registerPortal" class="modal fade"
    tabindex="-1" role="dialog"
    aria-labelledby="registerTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="registerTitle" class="modal-title">
          Register
        </h5>
      </div>
      <form action="" method="post">
        <div class="modal-body">

          <div class="row">
            <div class="col-5 my-2">
              <label class="col-form-label" for="email">Email:</label>
              <input id="email" class="form-control"
                type="text" name="email"></input>
            </div>
            <div class="col-5 my-2">
              <label class="col-form-label" for="passwordr">Password:</label>
              <input id="passwordr" class="form-control"
                type="text" name="password"></input>
            </div>
          </div>

          <div class="row">
            <div class="col-5 my-2">
              <label class="col-form-label" for="firstname">First Name:</label>
              <input id="firstname" class="form-control"
                type="text" name="firstname"></input>
            </div>
            <div class="col-5 my-2">
              <label class="col-form-label" for="lastname">Last Name:</label>
              <input id="lastname" class="form-control"
                type="text" name="lastname"></input>
            </div>
          </div>

          <div class="row">
            <div class="col-5 my-2">
              <label class="col-form-label" for="address">Address:</label>
              <input id="address" class="form-control"
                type="text" name="address"></input>
            </div>
            <div class="col-5 my-2">
              <label class="col-form-label" for="city">City:</label>
              <input id="city" class="form-control"
                type="text" name="city"></input>
            </div>
          </div>

          <div class="row">
            <div class="col-5 my-2">
              <label class="col-form-label" for="region">Region:</label>
              <input id="region" class="form-control"
                type="text" name="region"></input>
            </div>
            <div class="col-5 my-2">
              <label class="col-form-label" for="country">Country:</label>
              <input id="country" class="form-control"
                type="text" name="country"></input>
            </div>
          </div>

          <div class="row">
            <div class="col-5 my-2">
              <label class="col-form-label" for="postal">Postal:</label>
              <input id="postal" class="form-control"
                type="text" name="postal"></input>
            </div>
            <div class="col-5 my-2">
              <label class="col-form-label" for="phone">Phone:</label>
              <input id="phone" class="form-control"
                type="text" name="phone"></input>
            </div>
          </div>


          <div class="form-group my-1">
            <label class="col-form-label" for="privacy">Privacy:</label>
            <input id="privacy" class="form-check-input mt-3 ms-2"
              type="checkbox" name="privacy" value="true"></input>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">
            Close
          </button>
          <button class="btn btn-primary" type="submit"
              name="submit" value="register">
            Register
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Login Modal -->
<div id="loginPortal" class="modal fade"
    tabindex="-1" role="dialog"
    aria-labelledby="loginTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="loginTitle" class="modal-title">
          Login
        </h5>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-form-label" for="usernamel">Username:</label>
            <input id="usernamel" class="form-control"
              type="text" name="username"></input>
          </div>
          <div class="form-group my-3">
            <label class="col-form-label" for="passwordl">Password:</label>
            <input id="passwordl" class="form-control"
              type="text" name="password"></input>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">
            Close
          </button>
          <button class="btn btn-primary" type="submit"
              name="submit" value="login">
            Login
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
