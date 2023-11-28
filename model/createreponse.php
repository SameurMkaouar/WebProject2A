<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\Yassine\Downloads\PHPMailer-master\PHPMailer-master\src\Exception.php';
require 'C:\Users\Yassine\Downloads\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require 'C:\Users\Yassine\Downloads\PHPMailer-master\PHPMailer-master\src\SMTP.php';

include_once '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    function Createreponse()
    {
        global $pdo;

        $id = $_GET['id'];

        try {
            $query = $pdo->prepare("INSERT INTO reponse (reponse, ticketid, reponsedate) VALUES (:reponse, :ticketid, :reponsedate)");
            $query->execute([
                'reponse' => $_POST['reponse'],
                'reponsedate' => date("Y-m-d H:i:s"),
                'ticketid' => $id,
            ]);

            // Send email to user
            sendEmailToUser($id, $_POST['reponse']);

            echo "Reply sent!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function sendEmailToUser($ticketId, $response)
    {
        // Fetch user email from the database based on ticket ID
        $userEmail = getUserEmail($ticketId);

        if ($userEmail) {
            // Create a PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.elasticemail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 2525;
                $mail->Username = 'noreply.psychologist@gmail.com';
                $mail->Password = 'A0D76FF140CCA5A2EAF1B5D3B3A83599B768';

                // Sender and recipient settings
                $mail->setFrom('noreply.psychologist@gmail.com', 'Psychologist Support');
                $mail->addAddress($userEmail);

                // Email subject and message
                $mail->Subject = 'Your Ticket Reply';
                $mail->isHTML(true);

                // Your HTML template
                $htmlTemplate = <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="telephone=no" name="format-detection">
  <title></title>
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <!--[if !mso]><!-- -->
  <link href="https://stripo.email/" rel="stylesheet">
  <!--<![endif]-->
 <!--[if mso]>
 <style type="text/css">
     ul {
  margin: 0 !important;
  }
  ol {
  margin: 0 !important;
  }
  li {
  margin-left: 47px !important;
  }

 </style><![endif]
--></head> 
  <body class="body">
  <div dir="ltr" class="es-wrapper-color">
   <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f0f0f0"></v:fill>
			</v:background>
		<![endif]-->
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
     <tr>
      <td class="esd-email-paddings" valign="top">
       <table cellpadding="0" cellspacing="0" class="es-content esd-header-popover" align="center">
        <tbody>
         <tr>
          <td class="esd-stripe" align="center">
           <table bgcolor="#333333" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: #333333;">
            <tbody>
             <tr>
              <td class="esd-structure es-p10t es-p10b es-p15r es-p15l" align="left">
               <!--[if mso]><table width="570" cellpadding="0" cellspacing="0"><tr><td width="275" valign="top"><![endif]-->
               <table cellpadding="0" cellspacing="0" align="left" class="es-left">
                <tbody>
                 <tr>
                  <td width="275" class="esd-container-frame" align="center" valign="top">
                   <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                     <tr>
                      <td align="left" class="esd-block-text es-infoblock es-m-txt-c"><p style="color: #efefef;">&ensp;&ensp; Dear user, Your ticket has been answered:</p></td>
                     </tr>
                    </tbody>
                   </table></td>
                 </tr>
                </tbody>
               </table>
               <!--[if mso]></td><td width="20"></td><td width="275" valign="top"><![endif]-->
               <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                <tbody>
                 <tr>
                  <td width="275" align="left" class="esd-container-frame">
                   <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                     <tr>
                      <td align="right" class="esd-block-text es-infoblock es-m-txt-c" esd-links-color="#ffffff"><p>​</p></td>
                     </tr>
                    </tbody>
                   </table></td>
                 </tr>
                </tbody>
               </table>
               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
            </tbody>
           </table></td>
         </tr>
        </tbody>
       </table>

       <table cellpadding="0" cellspacing="0" class="es-content" align="center">
        <tbody>
         <tr>
          <td class="esd-stripe" align="center">
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
            <tbody>
             <tr>
              <td class="es-p30t es-p15r es-p15l esd-structure" align="left">
               <table cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                 <tr>
                  <td width="570" class="esd-container-frame" align="center" valign="top">
                   <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                     <tr>
                      <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank" href="https://storyset.com/illustration/new-message/rafiki"><img class="adapt-img" src="https://fcuhzea.stripocdn.email/content/guids/CABINET_c79dacb07f89b369b3f8c25757939e7d44a2c39b9a2da94df5544185d6040215/images/new_messagerafiki_1.png" alt="" style="display:block" width="300"></a></td>
                     </tr>
                     <tr>
                      <td align="center" class="esd-block-text es-p30t es-m-txt-c"><h1><blockquote>{$response}</blockquote></h1></td>
                     </tr>
                      <tr>
                      <td align="center" class="esd-block-button es-p30t">
                       
                       <!--<span class="es-button-border" style="background:#92E3A9;border-color:#92E3A9;border-style:solid;border-width:1px;border-radius:12px"><a  class="btn btn-default" target="_blank" style="border-radius:12px; background:#92E3A9;mso-border-alt:10px solid #92E3A9 font-size:16px"> View Reply</a></span>[endif]-->
                       <a href="http://localhost/HERE2/view/contact.php" class="btn btn-default" style="background: #92E3A9; border-color: #92E3A9; border-style: solid; border-width: 1px; border-radius: 12px; font-size: 15px; padding: 15px 15px 15px 15px; color: white; text-decoration: none; display: inline-block;">View Reply</a>
 <br>
                      </td>
                     </tr>
                     <tr>
                      <td align="center" class="esd-block-spacer es-p20" style="font-size: 0">
                       <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" class="es-spacer">
                        <tbody>
                         <tr>
                          <td style="border-bottom: 1px solid #cccccc;; background: none; height: 1px; width: 100%; margin: 0px 0px 0px 0px"></td>
                         </tr>
                        </tbody>
                       </table>
                      </td>
                     </tr>
                     <tr>
                      <td align="left" class="esd-block-text">
                        <h4>If you have further questions, feel free to reply to this email.</h4>
                        <h4>Best regards,</h4>
                        <h4>Psychologist Support Team</h4>
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

                // Set the modified template as the email body
                $mail->Body = $htmlTemplate;

                // Send email
                $mail->send();

                echo 'Email sent to user.';
            } catch (Exception $e) {
                echo 'Error sending email: ' . $e->getMessage();
            }
        } else {
            echo "Error: User email not found.";
        }
    }


    function getUserEmail($ticketId)
    {
        global $pdo;
        $query = $pdo->prepare("SELECT email FROM ticket WHERE ticketid = :ticketid");
        $query->execute(['ticketid' => $ticketId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['email'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Createreponse();
        // Uncomment the line below to redirect after sending the response
        header('Location: ../view/admin_tickets.php');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
?>
