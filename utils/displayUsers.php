<?php

// creates card for user
function createUserListing($uId, $userName, $dateJoined, $dateLastModified, $name)
{
    // initialize link var
    $link = 'user.php?id=' . $uId;

    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 my-3">';
    echo '<div class="card">';
    echo '<a class="link-no-color" href="' . $link . '">';

    echo '<div class="card-body">';

    echo '<h5 class="card-title">' . $name . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">';
    echo $userName . '<br>';
    echo '</h6>';

    echo '<p class="card-text">';
    echo 'Member since ' . $dateJoined . '<br>';
    echo 'Last active on ' . $dateLastModified;
    echo '</p>';


    echo '</div>';

    echo '</a>';
    echo '</div>';
    echo '</div>';
}

// creates modal for admin to modify user
function modifyUserModal($user) {
    // find out if boxes should be checked
    // state
    if ($user->state == 1) {
      $state = 'checked';
    }
    else {
      $state = '';
    }
    // privacy
    if ($user->privacy == 2) {
      $privacy = 'checked';
    }
    else {
      $privacy = '';
    }

    // modal
    echo '<div id="modifyUserPortal' . $user->uId . '" class="modal modifyUserPortal"
              tabindex="-1" role="dialog"
              aria-labelledby="modifyUserTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 id="modifyUserTitle" class="modal-title">
                    Enter New Values
                  </h5>
                </div>
                <form action="utils/modifyUser.php" method="post">
                  <div class="modal-body">

                    <div class="row">
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="email">
                          Email:<br>' . $user->email . '
                        </label>
                        <input id="email" class="form-control"
                          type="text" name="email"></input>
                      </div>
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="passwordm">
                          Password:<br>' . $user->pass . '
                        </label>
                        <input id="passwordm" class="form-control"
                          type="text" name="password"></input>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="firstname">
                          First Name:<br>' . $user->firstName . '
                        </label>
                        <input id="firstname" class="form-control"
                          type="text" name="firstname"></input>
                      </div>
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="lastname">
                          Last Name:<br>' . $user->lastName . '
                        </label>
                        <input id="lastname" class="form-control"
                          type="text" name="lastname"></input>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="address">
                          Address:<br>' . $user->address . '
                        </label>
                        <input id="address" class="form-control"
                          type="text" name="address"></input>
                      </div>
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="city">
                          City:<br>' . $user->city . '
                        </label>
                        <input id="city" class="form-control"
                          type="text" name="city"></input>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="region">
                          Region:<br>' . $user->region . '
                        </label>
                        <input id="region" class="form-control"
                          type="text" name="region"></input>
                      </div>
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="country">
                          Country:<br>' . $user->country . '
                        </label>
                        <input id="country" class="form-control"
                          type="text" name="country"></input>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="postal">
                          Postal:<br>' . $user->postal . '
                        </label>
                        <input id="postal" class="form-control"
                          type="text" name="postal"></input>
                      </div>
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="phone">
                          Phone:<br>' . $user->phone . '
                        </label>
                        <input id="phone" class="form-control"
                          type="text" name="phone"></input>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="privacy">
                          Privacy:
                        </label>
                        <input id="privacy" class="form-check-input mt-3 ms-2"
                          type="checkbox" name="privacy" value="true"
                          ' . $privacy . '
                        ></input>
                      </div>
                      <div class="col-5 my-2">
                        <label class="col-form-label" for="state">
                          Admin
                        </label>
                        <input id="state" class="form-check-input mt-3 ms-2"
                          type="checkbox" name="state" value="true"
                          ' . $state . '
                        ></input>
                      </div>
                    </div>

                    <input type="hidden" name="uid" value="' . $user->uId . '">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                      Close
                    </button>
                    <button class="btn btn-primary" type="submit">
                      Modify
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>';
}
