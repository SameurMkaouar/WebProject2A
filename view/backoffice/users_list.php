<?php
require_once "../../model/user.php";

$user = new user;
$result=$user->listusers();

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
  <!--<![endif]-->

  <head>
    <title>Psychologist</title>
    <meta charset="utf-8" />
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link
      rel="stylesheet"
      href="../../assets/frontoffice/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../assets/frontoffice/css/animations.css" />
    <link rel="stylesheet" href="../../assets/frontoffice/css/fonts.css" />
    <link
      rel="stylesheet"
      href="../../assets/frontoffice/css/main.css"
      class="color-switcher-link"
    />
    <link
      rel="stylesheet"
      href="../../assets/frontoffice/css/dashboard.css"
      class="color-switcher-link"
    />
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
      <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->
  </head>

  <body class="admin">
    <!--[if lt IE 9]>
      <div class="bg-danger text-center">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/" class="highlight"
          >upgrade your browser</a
        >
        to improve your experience.
      </div>
    <![endif]-->

    <section
      class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10"
    >
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h3>
              USERS
              <small>list</small>
            </h3>
          </div>
          <!-- .col-* -->
        </div>
        <!-- .row -->

        <div class="row">
          <div class="col-xs-12">
            <div class="with_border with_padding">
              <div class="row admin-table-filters">
                
                <!-- .col-* -->
                <div class="col-lg-3 text-lg-right">
                  <div class="widget widget_search">
                    <form
                      method="get"
                      class="searchform form-inline"
                      action="./"
                    >
                      <div class="form-group">
                        <label class="screen-reader-text" for="widget-search"
                          >Search for:</label
                        >
                        <input
                          id="widget-search"
                          type="text"
                          value=""
                          name="search"
                          class="form-control"
                          placeholder="Search"
                        />
                      </div>
                      <button type="submit" class="theme_button">Search</button>
                    </form>
                  </div>
                </div>
                <!-- .col-* -->
              </div>
              <!-- .row -->

              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <tr>
                    <td class="media-middle text-center">
                      <input type="checkbox" />
                    </td>
                    <th>username:</th>
                    <th>id:</th>
                    <th>firstname</th>
                    <th>lastname:</th>
                    <th>email:</th>
                    <th>sex:</th>
                    <th>role:</th>
                    <th>date_of_birth:</th>
                    <th>Creation_date:</th>
                  </tr>
                  <?php
foreach( $result as $row)
{
    ?> 
                  <tr class="item-editable">
                    <td class="media-middle text-center">
                    <a href="../../controller/deleteuser.php?id=<?php echo $row["Id"];?>">delete</a>
                    </td>
                    <td>
                      <div class="media">
                        <div class="media-left">
                <img src="../../assets/frontoffice/images/Default_ProfilPic.jpg" />
                        </div>
                        <div class="media-body">
                          <h5><?=$row['Username'];?></h5>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h5><?=$row['Id'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Firstname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Lastname'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Email'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Sex'];?></h5>
                    </td>
                    <td>
                      <h5><?=$row['Role'];?></h5>
                    </td>
                    <td class="media-middle">
                      <time><?=$row['DateOfBirth'];?></time>
                    </td>
                    <td class="media-middle"><?=$row['CreationDate'];?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>

              <!-- .table-responsive -->
            </div>
            <!-- .with_border -->
          </div>
          <!-- .col-* -->
        </div>
        <!-- .row -->
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-md-6">
                <ul class="pagination">
                  <li class="disabled">
                    <a href="#">
                      <span class="sr-only">Prev</span>
                      <i class="fa fa-angle-left"></i>
                    </a>
                  </li>
                  <li class="active">
                    <a href="#">1</a>
                  </li>
                  <li>
                    <a href="#">2</a>
                  </li>
                  <li>
                    <a href="#">3</a>
                  </li>
                  <li>
                    <a href="#">4</a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="sr-only">Next</span>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 text-md-right">
                Showing x to x of xx items
              </div>
            </div>
          </div>
        </div>
        <!-- .row main columns -->
      </div>
      <!-- .container -->
    </section>
  </body>
</html>
