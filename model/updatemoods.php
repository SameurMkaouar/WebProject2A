<?php
include_once '../config.php';

$pdo = config::getConnexion();

function updateProduct()
{
    global $pdo;
    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ticketid'])) {
            $ticketid = $_GET['ticketid'];

            try {
                $query = $pdo->prepare("SELECT * FROM ticket WHERE ticketid = :ticketid");
                $query->execute(['ticketid' => $ticketid]);
                $product = $query->fetch(PDO::FETCH_ASSOC);

                if ($product) {
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
                        <meta charset="utf-8">
                        <!--[if IE]>
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <![endif]-->
                        <meta name="description" content="">
                        <meta name="viewport" content="width=device-width, initial-scale=1">

                        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

                        <link rel="stylesheet" href="../view/css/bootstrap.min.css">
                        <link rel="stylesheet" href="../view/css/animations.css">
                        <link rel="stylesheet" href="../view/css/fonts.css">
                        <link rel="stylesheet" href="../view/css/main.css" class="color-switcher-link">
                        <script src="../view/js/vendor/modernizr-2.6.2.min.js"></script>

                        <!--[if lt IE 9]>
                        <script src="../view/js/vendor/html5shiv.min.js"></script>
                        <script src="../view/js/vendor/respond.min.js"></script>
                        <script src="../view/js/vendor/jquery-1.12.4.min.js"></script>
                        <![endif]-->

                    </head>

                    <body>
                    <!--[if lt IE 9]>
                    <div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="highlight">upgrade your browser</a> to improve your experience.</div>
                    <![endif]-->

                    <div class="preloader">
                        <div class="preloader_image"></div>
                    </div>

                    <!-- search modal -->



                    <!-- eof .modal -->

                    <!-- wrappers for visual page editor and boxed version of template -->
                    <div id="canvas">
                        <div id="box_wrapper">
                            <section class="ls columns_padding_25 section_padding_top_100 section_padding_bottom_100">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-8 to_animate" data-animation="scaleAppear">

                                            <h2 class="section_header small bottommargin_40">Update the ticket</h2>

                                            <form class="contact-form row columns_margin_bottom_40" method="post" action="./processupdate.php">
                                                <input type="hidden" name="ticketid" value="<?php echo $product['ticketid']; ?>">

                                                <div class="col-sm-6">
                                                    <div class="contact-form-subject">
                                                        <label for="subject">Subject
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" aria-required="true" size="30"  name="subject" id="subject" class="form-control" placeholder="Subject" value="<?php echo $product['subject']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">

                                                    <div class="contact-form-message">
                                                        <label for="message">Message</label>
                                                        <textarea aria-required="true" rows="1" cols="45" name="message" id="message" class="form-control" placeholder="Message" ><?php echo $product['message']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="contact-form-submit topmargin_20">
                                                        <button type="submit" id="contact_form_submit" name="contact_submit" class="theme_button color1 with_shadow">Update</button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <!--.col-* -->

                                        <div class="col-md-4 to_animate" data-animation="scaleAppear">

                                            <h2 class="section_header small bottommargin_40">Contact Form</h2>

                                            <div class="small-teaser media fontsize_16">
                                                <div class="media-left">
                                                    <i class="highlight fa fa-phone"></i>
                                                </div>
                                                <div class="media-body">
                                                    8(800) 123-12345
                                                </div>
                                            </div>

                                            <div class="small-teaser media fontsize_16">
                                                <div class="media-left">
                                                    <i class="highlight fa fa-map-marker"></i>
                                                </div>
                                                <div class="media-body">
                                                    350 Leverton Cove Road Springfield, MA
                                                </div>
                                            </div>

                                            <div class="small-teaser media fontsize_16">
                                                <div class="media-left">
                                                    <i class="highlight fa fa-envelope-o"></i>
                                                </div>
                                                <div class="media-body">
                                                    support@psychologist.com
                                                </div>
                                            </div>
                                        </div>
                                        <!--.col-* -->
                                    </div>
                                    <!--.row -->
                                </div>
                                <!--.container -->
                            </section>
                            <footer class="page_footer cs main_color2 table_section section_padding_50 columns_padding_0">
                                <div class="container">

                                    <div class="row">

                                        <div class="col-sm-4 col-sm-push-4 text-center">
                                            <a href="./" class="logo big text-shadow">
                                                Psychologist
                                                <span class="small-text">Premium HTML Template</span>
                                            </a>
                                        </div>

                                        <div class="col-sm-4 col-sm-pull-4 text-center text-sm-left text-md-left">
                                            <div class="widget widget_nav_menu greylinks">

                                                <ul class="menu divided_content wide_divider">
                                                    <li class="">
                                                        <a href="./">Home</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="about.html">About</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="services.html">Services</a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>

                                        <div class="col-sm-4 text-center text-sm-right text-md-right">
                                            <div class="widget widget_nav_menu greylinks">

                                                <ul class="menu divided_content wide_divider">
                                                    <li class="">
                                                        <a href="gallery-regular-3-cols.html">Gallery</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="blog-right.html">Blog</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="contact.html">Contacts</a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </footer>



                        </div>
                        <!-- eof #box_wrapper -->
                    </div>
                    <!-- eof #canvas -->

                    <script src="../view/js/compressed.js"></script>
                    <script src="../view/js/main.js"></script>

                    </body>

                    </html>


                    <?php
                } else {
                    echo "Ticket not found.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid request.";
        }
    } else {
        echo "Error: Unable to connect to the database.";
    }
}

// Call the function to update a product
updateProduct();

// Redirect without output buffering
exit();
?>