<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location:../frontoffice/login.php");
}
require_once "../../model/user.php";
require_once "../../model/util.php";
include_once "header.php";

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

  <link rel="stylesheet" href="../../assets/frontoffice/css/bootstrap.minsamer.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/animationssamer.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/fontssamer.css" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/mainsamer.css" class="color-switcher-link" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/shopsamer.css" class="color-switcher-link" />
  <link rel="stylesheet" href="../../assets/frontoffice/css/visacard.css">
  <script src="../../assets/frontoffice/js/vendor/modernizr-2.6.2.min.js"></script>

  <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
      <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <![endif]-->
</head>

<body>
  <!--[if lt IE 9]>
      <div class="bg-danger text-center">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/" class="highlight"
          >upgrade your browser</a
        >
        to improve your experience.
      </div>
    <![endif]-->

  <div class="preloader">
    <div class="preloader_image"></div>
  </div>

  <!-- search modal -->
  <div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">
        <i class="rt-icon2-cross2"></i>
      </span>
    </button>
    <div class="widget widget_search">
      <form method="get" class="searchform search-form form-inline" action="./">
        <div class="form-group">
          <input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input" />
        </div>
        <button type="submit" class="theme_button">Search</button>
      </form>
    </div>
  </div>

  <!-- Unyson messages modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
    <div class="fw-messages-wrap ls with_padding">
      <!-- Uncomment this UL with LI to show messages in modal popup to your user: -->
      <!--
		<ul class="list-unstyled">
			<li>Message To User</li>
		</ul>
		-->
    </div>
  </div>
  <!-- eof .modal -->

  <!-- wrappers for visual page editor and boxed version of template -->
  <div id="canvas">
    <div id="box_wrapper">
      <!-- template sections -->



      <section class="page_breadcrumbs ds background_cover section_padding_50">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 text-center">
              <h2>Checkout</h2>
              <ol class="breadcrumb divided_content wide_divider">
                <li>
                  <a href="./"> Home </a>
                </li>
                <li>
                  <a href="#">Shop</a>
                </li>
                <li class="active">Checkout</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="ls section_padding_top_100 section_padding_bottom_75 columns_padding_25">
        <div class="container">
          <div class="row">
            <div class="col-sm-7 col-md-8 col-lg-8">
              <!-- <div class="shop-info">
                Returning customer?
                <a data-toggle="collapse" href="#registeredForm" aria-expanded="false" aria-controls="registeredForm">Click here to login</a>
              </div> -->

              <div class="collapse" id="registeredForm">
                <form class="checkout with_border with_padding form-horizontal" role="form">
                  <p>
                    If you have shopped with us before, please enter your
                    details in the boxes below. If you are a new customer
                    please proceed to the Billing &amp; Shipping section.
                  </p>

                  <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">
                      <span class="grey">Nick or email:</span>
                      <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="username" id="username" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">
                      <span class="grey">Password:</span>
                      <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                      <input class="form-control" type="password" name="password" id="password" />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <div class="checkbox">
                        <label for="rememberme" class="control-label">
                          <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                          Remember me
                        </label>
                      </div>
                      <input type="submit" class="theme_button color1 topmargin_20" name="login" value="Login" />
                      <div class="lost_password">
                        <a href="#">Lost your password?</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <h2>Billing Address</h2>

              <form class="form-horizontal checkout shop-checkout" role="form">
                <div class="form-group">
                  <label for="billing_province" class="col-sm-3 control-label">
                    <span class="grey">Province:</span>
                    <span class="required">*</span>
                  </label>
                  <div class="col-sm-9">
                    <select class="form-control" name="billing_province" id="billing_province">
                      <option value="">Select a province...</option>
                      <option value="AR">Ariana</option>
                      <option value="BJ">Beja</option>
                      <option value="BA">Ben Arous</option>
                      <option value="BI">Bizerte</option>
                      <option value="GB">Gabes</option>
                      <option value="GF">Gafsa</option>
                      <option value="JE">Jendouba</option>
                      <option value="KR">Kairouan</option>
                      <option value="KB">Kebili</option>
                      <option value="KS">Kasserine</option>
                      <option value="LK">Le Kef</option>
                      <option value="MA">Mahdia</option>
                      <option value="MN">Manouba</option>
                      <option value="ME">Medenine</option>
                      <option value="MO">Monastir</option>
                      <option value="NA">Nabeul</option>
                      <option value="SF">Sfax</option>
                      <option value="SD">Sidi Bouzid</option>
                      <option value="SI">Siliana</option>
                      <option value="SO">Sousse</option>
                      <option value="TA">Tataouine</option>
                      <option value="TO">Tozeur</option>
                      <option value="TU">Tunis</option>
                      <option value="ZA">Zaghouan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group validate-required" id="billing_name_field">
                  <label for="billing_name" class="col-sm-3 control-label">
                    <span class="grey">Full Name:</span>
                    <span class="required">*</span>
                  </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="billing_name" id="billing_name" placeholder="" value="" />
                  </div>
                </div>


                <div class="form-group address-field validate-required" id="billing_address_fields">
                  <label for="billing_address" class="col-sm-3 control-label">
                    <span class="grey">Address:</span>
                    <span class="required">*</span>
                  </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="" value="" />
                  </div>
                </div>

                <div class="form-group validate-required validate-email" id="billing_email_field">
                  <label for="billing_email" class="col-sm-3 control-label">
                    <span class="grey">Email Address:</span>
                    <span class="required">*</span>
                  </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="billing_email" id="billing_email" placeholder="" value="" />
                  </div>
                </div>
                <div class="form-group validate-required validate-phone" id="billing_phone_field">
                  <label for="billing_phone" class="col-sm-3 control-label">
                    <span class="grey">Phone:</span>
                    <span class="required">*</span>
                  </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="billing_phone" id="billing_phone" placeholder="" value="" />
                  </div>
                </div>


                <div class="form-group">
                  <label for="order_comments" class="col-sm-3 control-label">
                    <span class="grey">Order Notes:</span>
                  </label>
                  <div class="col-sm-9">
                    <textarea name="order_comments" class="form-control" id="order_comments" placeholder="" rows="5"></textarea>
                  </div>
                </div>
              </form>
            </div>
            <!--eof .col-sm-8 (main content)-->

            <!-- sidebar -->
            <aside class="col-sm-5 col-md-4 col-lg-4">
              <h3 class="widget-title" id="order_review_heading">
                Your order
              </h3>
              <?php include "../../controller/showorderside.php" ?>

              <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
              <script>
                $(document).ready(function() {
                  // When any radio button in the "payment_method" group is changed
                  $("input[name='payment_method']").change(function() {
                    // Check if the "Online Payment" option is selected
                    if ($("#payment_method_online").is(":checked")) {
                      // Show the modal
                      $("#paymentModal").modal("show");
                    } else {
                      // If not selected, hide the modal (optional)
                      $("#paymentModal").modal("hide");
                    }
                  });

                  // When the "Place order" button is clicked
                  $("#place_order").click(function() {
                    // Check if the "Online Payment" option is selected
                    if ($("#payment_method_online").is(":checked")) {
                      // Show the modal
                      $("#paymentModal").modal("show");
                    }
                  });
                  $("#payment_method_another").click(function() {
                    // Check if the "Online Payment" option is selected
                    if ($("#payment_method_online").is(":checked")) {
                      // Show the modal
                      $("#paymentModalstripe").modal("show");
                    }
                  });
                });
              </script>

              <div id="payment" class="shop-checkout-payment">
                <h3 class="widget-title">Payment</h3>
                <ul class="list1 no-bullets payment_methods methods">

                  <li class=" payment_method_cheque">
                    <div class="radio">
                      <label for="payment_method_cheque">
                        <input id="payment_method_cheque" type="radio" name="payment_method" value="cheque" checked="checked" />
                        <span class="grey">Cheque Payment</span>
                      </label>
                    </div>
                  </li>
                  <li class="payment_method_cheque">
                    <div class="radio">
                      <label for="payment_method_delivery">
                        <input id="payment_method_delivery" type="radio" name="payment_method" value="delivery" />
                        <span class="grey">Payment At Delivery</span>
                      </label>
                    </div>
                  </li>
                </ul>
                <div class="place-order" style="display: flex; justify-content: space-between;">
                  <a class="theme_button color1" href="../../controller/validatecart.php?Cart_ID=<?php echo $cart["Cart_ID"] ?>&User_ID=<?php echo $_SESSION["user_id"] ?>" name="checkout_place_order" id="place_order">Place order</a>
                  <button type="button" class="place-order theme_button color2" name="payment_method_online" id="payment_method_online" data-toggle="modal" data-target="#paymentModal">Online Payment</button>
                  <button type="button" class="place-order theme_button " name="payment_method_another" id="payment_method_another" data-toggle="modal" data-target="#paymentModalstripe">Stripe Payment</button>

                </div>
              </div>
          </div>
          </aside>
          <!-- eof aside sidebar -->
        </div>
    </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="paymentModalstripe">
      <!-- <div class="ls with_padding"> -->
      <div class="modal-dialog modal-sm" style="width: 330px" role="document">
        <div class="modal-content">
          <form class="with_padding contact-form" method="post" action="/">
            <div class="row">

              <script async src="https://js.stripe.com/v3/buy-button.js">
              </script>

              <stripe-buy-button buy-button-id="buy_btn_1OMDkBEdGG4RuPzwg0MgEIEi" publishable-key="pk_test_51OMDKZEdGG4RuPzwvhfZMsxPf8Rx3QE1Ddlq1PCmdto7emZL7Gqliv6l00TIlcEGZwfXCRFXQwfK4WIdZPfB8cXf004VzhrFDe">
              </stripe-buy-button>

            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="https://bot.insertchatgpt.com/widgets/bubble.js?widget_id=2d98b160-43e7-428b-a68b-f55ee1617297" async></script>
    <div class="modal fade" tabindex="-1" role="dialog" id="paymentModal">
      <div class="modal-dialog" style="height: 700px" role="document">
        <div class="">
          <form class="with_padding" method="post" action="">
            <div class="row">
              <div class="">
                <div class="wrapper" id="app">
                  <div class="card-form">
                    <div class="card-list">
                      <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
                        <div class="card-item__side -front">
                          <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
                          <div class="card-item__cover">
                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
                          </div>

                          <div class="card-item__wrapper">
                            <div class="card-item__top">
                              <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">
                              <div class="card-item__type">
                                <transition name="slide-fade-up">
                                  <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                                </transition>
                              </div>
                            </div>
                            <label for="cardNumber" class="card-item__number" ref="cardNumber">
                              <template v-if="getCardType === 'amex'">
                                <span v-for="(n, $index) in amexCardMask" :key="$index">
                                  <transition name="slide-fade-up">
                                    <div class="card-item__numberItem" v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''">*</div>
                                    <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" :key="$index" v-else-if="cardNumber.length > $index">
                                      {{cardNumber[$index]}}
                                    </div>
                                    <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" v-else :key="$index + 1">{{n}}</div>
                                  </transition>
                                </span>
                              </template>

                              <template v-else>
                                <span v-for="(n, $index) in otherCardMask" :key="$index">
                                  <transition name="slide-fade-up">
                                    <div class="card-item__numberItem" v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''">*</div>
                                    <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" :key="$index" v-else-if="cardNumber.length > $index">
                                      {{cardNumber[$index]}}
                                    </div>
                                    <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" v-else :key="$index + 1">{{n}}</div>
                                  </transition>
                                </span>
                              </template>
                            </label>
                            <div class="card-item__content">
                              <label for="cardName" class="card-item__info" ref="cardName">
                                <div class="card-item__holder">Card Holder</div>
                                <transition name="slide-fade-up">
                                  <div class="card-item__name" v-if="cardName.length" key="1">
                                    <transition-group name="slide-fade-right">
                                      <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                                    </transition-group>
                                  </div>
                                  <div class="card-item__name" v-else key="2">Full Name</div>
                                </transition>
                              </label>
                              <div class="card-item__date" ref="cardDate">
                                <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                                <label for="cardMonth" class="card-item__dateItem">
                                  <transition name="slide-fade-up">
                                    <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                                    <span v-else key="2">MM</span>
                                  </transition>
                                </label>
                                /
                                <label for="cardYear" class="card-item__dateItem">
                                  <transition name="slide-fade-up">
                                    <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                                    <span v-else key="2">YY</span>
                                  </transition>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-item__side -back">
                          <div class="card-item__cover">
                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
                          </div>
                          <div class="card-item__band"></div>
                          <div class="card-item__cvv">
                            <div class="card-item__cvvTitle">CVV</div>
                            <div class="card-item__cvvBand">
                              <span v-for="(n, $index) in cardCvv" :key="$index">
                                *
                              </span>

                            </div>
                            <div class="card-item__type">
                              <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-form__inner">
                      <div class="card-input">
                        <label for="cardNumber" class="card-input__label">Card Number</label>
                        <input type="text" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
                      </div>
                      <div class="card-input">
                        <label for="cardName" class="card-input__label">Card Holders</label>
                        <input type="text" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
                      </div>
                      <div class="card-form__row">
                        <div class="card-form__col">
                          <div class="card-form__group">
                            <label for="cardMonth" class="card-input__label">Expiration Date</label>
                            <select class="card-input__input -select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                              <option value="" disabled selected>Month</option>
                              <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
                                {{n < 10 ? '0' + n : n}}
                              </option>
                            </select>
                            <select class="card-input__input -select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                              <option value="" disabled selected>Year</option>
                              <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                                {{$index + minCardYear}}
                              </option>
                            </select>
                          </div>
                        </div>
                        <div class="card-form__col -cvv">
                          <div class="card-input">
                            <label for="cardCvv" class="card-input__label">CVV</label>
                            <input type="text" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
                          </div>
                        </div>
                      </div>

                      <button class="card-form__button">
                        Submit
                      </button>
                    </div>
                  </div>


                </div>
              </div>
              <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
              <script>
                new Vue({
                  el: "#app",
                  data() {
                    return {
                      currentCardBackground: Math.floor(Math.random() * 25 + 1), // just for fun :D
                      cardName: "",
                      cardNumber: "",
                      cardMonth: "",
                      cardYear: "",
                      cardCvv: "",
                      minCardYear: new Date().getFullYear(),
                      amexCardMask: "#### ###### #####",
                      otherCardMask: "#### #### #### ####",
                      cardNumberTemp: "",
                      isCardFlipped: false,
                      focusElementStyle: null,
                      isInputFocused: false
                    };
                  },
                  mounted() {
                    this.cardNumberTemp = this.otherCardMask;
                    document.getElementById("cardNumber").focus();
                  },
                  computed: {
                    getCardType() {
                      let number = this.cardNumber;
                      let re = new RegExp("^4");
                      if (number.match(re) != null) return "visa";

                      re = new RegExp("^(34|37)");
                      if (number.match(re) != null) return "amex";

                      re = new RegExp("^5[1-5]");
                      if (number.match(re) != null) return "mastercard";

                      re = new RegExp("^6011");
                      if (number.match(re) != null) return "discover";

                      re = new RegExp('^9792')
                      if (number.match(re) != null) return 'troy'

                      return "visa"; // default type
                    },
                    generateCardNumberMask() {
                      return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
                    },
                    minCardMonth() {
                      if (this.cardYear === this.minCardYear) return new Date().getMonth() + 1;
                      return 1;
                    }
                  },
                  watch: {
                    cardYear() {
                      if (this.cardMonth < this.minCardMonth) {
                        this.cardMonth = "";
                      }
                    }
                  },
                  methods: {
                    flipCard(status) {
                      this.isCardFlipped = status;
                    },
                    focusInput(e) {
                      this.isInputFocused = true;
                      let targetRef = e.target.dataset.ref;
                      let target = this.$refs[targetRef];
                      this.focusElementStyle = {
                        width: `${target.offsetWidth}px`,
                        height: `${target.offsetHeight}px`,
                        transform: `translateX(${target.offsetLeft}px) translateY(${target.offsetTop}px)`
                      }
                    },
                    blurInput() {
                      let vm = this;
                      setTimeout(() => {
                        if (!vm.isInputFocused) {
                          vm.focusElementStyle = null;
                        }
                      }, 300);
                      vm.isInputFocused = false;
                    }
                  }
                });
              </script>
            </div>
          </form>
        </div>
      </div>
    </div>



    <?php include_once('footerfront.php'); ?>

    <section class="cs main_color2 page_copyright section_padding_15">
      <div class="container with_top_border">
        <div class="row">
          <div class="col-sm-12 text-center">
            <p class="small-text">
              &copy; 2017 Psychology and Counseling. All Rights Reserved
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- eof #box_wrapper -->
  </div>
  <!-- eof #canvas -->

  <script src="../../assets/frontoffice/js/compressed.js"></script>
  <script src="../../assets/frontoffice/js/main.js"></script>
</body>

</html>