<?php
    include_once('../config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    class Sub{
        function checkSub($userID){
            try {
                $db = config::getConnexion();
        
                $query = "SELECT * FROM subscriber WHERE id_user = :userID";
                $statement = $db->prepare($query);
                $statement->bindParam(':userID', $userID);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return ($result != false);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        function addSub($userID, $mail) {
          //echo 'bob';
            try {
                $db = config::getConnexion();
    
                $query = "INSERT INTO subscriber (id_user, email) VALUES (:userID, :userMail)";
                $statement = $db->prepare($query);
                $statement->bindParam(':userID', $userID);
                $statement->bindParam(':userMail', $mail);
                $statement->execute();
                
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        function removeSub($userID) {
            try {
                $db = config::getConnexion();
                $query = "DELETE FROM subscriber WHERE id_user = :userID";
                $statement = $db->prepare($query);
                $statement->bindParam(':userID', $userID);
                $statement->execute();
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        function getAllSubscribers() {
            try {
                $db = config::getConnexion();
    
                $query = "SELECT email FROM subscriber"; // Assuming the column name for emails is 'email'
                $statement = $db->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
                return $result;
            } catch (PDOException $e) {
                return false; // Return false if there's an error
            }
        }

        function sendMailToSubscribers($post) {
            $subscribers = $this->getAllSubscribers();
            $mail = new PHPMailer(true);
        
            try {
                foreach ($subscribers as $subscriber) {
                    $email = $subscriber['email'];
                    $mail->isSMTP();
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ahmedaziz.mazigh@esprit.tn'; // Your Gmail address
                    $mail->Password = '221JMT2955'; // Your Gmail password
                    $mail->Port = 587;
        
                    // Recipients
                    $mail->setFrom('ahmedaziz.mazigh@esprit.tn', 'Walter');
                    $mail->addAddress($email, 'Recipient Name');
        
                    // Content
                    $htmlTemplate = <<<EOD
                    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html
                      dir="ltr"
                      xmlns="http://www.w3.org/1999/xhtml"
                      xmlns:o="urn:schemas-microsoft-com:office:office"
                    >
                      <head>
                        <meta charset="UTF-8" />
                        <meta content="width=device-width, initial-scale=1" name="viewport" />
                        <meta name="x-apple-disable-message-reformatting" />
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <meta content="telephone=no" name="format-detection" />
                        <title></title>
                    
                        <link href="https://stripo.email/" rel="stylesheet" />
                      </head>
                      <body class="body">
                        <div dir="ltr" class="es-wrapper-color">
                          <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td class="esd-email-paddings" valign="top">
                                  <table
                                    cellpadding="0"
                                    cellspacing="0"
                                    class="es-content esd-header-popover"
                                    align="center"
                                  >
                                    <tbody>
                                      <tr>
                                        <td class="esd-stripe" align="center">
                                          <table
                                            bgcolor="#333333"
                                            class="es-content-body"
                                            align="center"
                                            cellpadding="0"
                                            cellspacing="0"
                                            width="600"
                                            style="background-color: #333333"
                                          >
                                            <tbody>
                                              <tr>
                                                <td
                                                  class="esd-structure es-p10t es-p10b es-p15r es-p15l"
                                                  align="left"
                                                >
                                                  <table
                                                    cellpadding="0"
                                                    cellspacing="0"
                                                    align="left"
                                                    class="es-left"
                                                  >
                                                    <tbody>
                                                      <tr>
                                                        <td
                                                          width="275"
                                                          class="esd-container-frame"
                                                          align="center"
                                                          valign="top"
                                                        >
                                                          <table
                                                            cellpadding="0"
                                                            cellspacing="0"
                                                            width="100%"
                                                          >
                                                            <tbody>
                                                              <tr>
                                                                <td
                                                                  align="left"
                                                                  class="esd-block-text es-infoblock es-m-txt-c"
                                                                >
                                                                  <p style="color: #efefef">
                                                                    &ensp;&ensp; Dear user, Check
                                                                    out this new post !
                                                                  </p>
                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                    
                                                  <table
                                                    cellpadding="0"
                                                    cellspacing="0"
                                                    class="es-right"
                                                    align="right"
                                                  >
                                                    <tbody>
                                                      <tr>
                                                        <td
                                                          width="275"
                                                          align="left"
                                                          class="esd-container-frame"
                                                        >
                                                          <table
                                                            cellpadding="0"
                                                            cellspacing="0"
                                                            width="100%"
                                                          >
                                                            <tbody>
                                                              <tr>
                                                                <td
                                                                  align="right"
                                                                  class="esd-block-text es-infoblock es-m-txt-c"
                                                                  esd-links-color="#ffffff"
                                                                >
                                                                  <p>​</p>
                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                    
                                  <table
                                    cellpadding="0"
                                    cellspacing="0"
                                    class="es-content"
                                    align="center"
                                  >
                                    <tbody>
                                      <tr>
                                        <td class="esd-stripe" align="center">
                                          <table
                                            bgcolor="#ffffff"
                                            class="es-content-body"
                                            align="center"
                                            cellpadding="0"
                                            cellspacing="0"
                                            width="600"
                                          >
                                            <tbody>
                                              <tr>
                                                <td
                                                  class="es-p30t es-p15r es-p15l esd-structure"
                                                  align="left"
                                                >
                                                  <table
                                                    cellpadding="0"
                                                    cellspacing="0"
                                                    width="100%"
                                                  >
                                                    <tbody>
                                                      <tr>
                                                        <td
                                                          width="570"
                                                          class="esd-container-frame"
                                                          align="center"
                                                          valign="top"
                                                        >
                                                          <table
                                                            cellpadding="0"
                                                            cellspacing="0"
                                                            width="100%"
                                                          >
                                                            <tbody>
                                                              <tr>
                                                                <td
                                                                  align="center"
                                                                  class="esd-block-image"
                                                                  style="font-size: 0px"
                                                                >
                                                                  <a
                                                                    target="_blank"
                                                                    href="https://storyset.com/illustration/new-message/rafiki"
                                                                    ><img
                                                                      class="adapt-img"
                                                                      src="https://demo.stripocdn.email/content/guids/372d64e1-1f47-4edc-9f26-acfaa389fef4/images/blog_postamico.png"
                                                                      alt=""
                                                                      style="display: block"
                                                                      width="300"
                                                                  /></a>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td
                                                                  align="center"
                                                                  class="esd-block-text es-p30t es-m-txt-c"
                                                                >
                                                                  <h1>
                                                                    <blockquote>
                                                                      Post title:{$post['post_title']}
                                                                    </blockquote>
                                                                  </h1>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td
                                                                  align="center"
                                                                  class="esd-block-button es-p30t"
                                                                >
                                                                  <a
                                                                    href="http://localhost/forumV1/View/FrontOffice/blog-single-full.php?id={$post["id_post"]}"
                                                                    class="btn btn-default"
                                                                    style="
                                                                      background: #92e3a9;
                                                                      border-color: #92e3a9;
                                                                      border-style: solid;
                                                                      border-width: 1px;
                                                                      border-radius: 12px;
                                                                      font-size: 15px;
                                                                      padding: 15px 15px 15px 15px;
                                                                      color: white;
                                                                      text-decoration: none;
                                                                      display: inline-block;
                                                                    "
                                                                    >View Post</a
                                                                  >
                                                                  <br />
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td
                                                                  align="center"
                                                                  class="esd-block-spacer es-p20"
                                                                  style="font-size: 0"
                                                                >
                                                                  <table
                                                                    border="0"
                                                                    width="100%"
                                                                    height="100%"
                                                                    cellpadding="0"
                                                                    cellspacing="0"
                                                                    class="es-spacer"
                                                                  >
                                                                    <tbody>
                                                                      <tr>
                                                                        <td
                                                                          style="
                                                                            border-bottom: 1px solid
                                                                              #cccccc;
                                                                            background: none;
                                                                            height: 1px;
                                                                            width: 100%;
                                                                            margin: 0px 0px 0px 0px;
                                                                          "
                                                                        ></td>
                                                                      </tr>
                                                                    </tbody>
                                                                  </table>
                                                                </td>
                                                              </tr>
                                                              <tr>
                                                                <td
                                                                  align="left"
                                                                  class="esd-block-text"
                                                                >
                                                                  <h4>Best regards,</h4>
                                                                  <h4>Psychologist Team</h4>
                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </body>
                    </html>
                    EOD;
        
                    // Set the subject and body of the email
                    $mail->Subject = 'New post! ' . $post['post_title'];
                    $mail->isHTML(true);
                    $mail->Body = $htmlTemplate;
                    $mail->AltBody = 'Plain text message body if HTML is not supported';
        
                    $mail->send();
                    echo 'Email has been sent';
                }
        
                return 'Emails have been sent to all subscribers.';
            } catch (Exception $e) {
                return "Emails could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        
    }


?>