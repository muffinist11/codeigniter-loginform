<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if($_POST['magagine'] === "1") {


    $auto_reply_subject = null;
    $auto_reply_text = null;
    
    date_default_timezone_set('Asia/Tokyo');
    $auto_reply_subject = 'お問い合わせありがとうございます';
    
    $auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます下記の内容でお問い合わせを受け付けました。\n\n";
    $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
    $auto_reply_text .= "氏名：" . $_POST['name'] . "\n";
    $auto_reply_text .= "カナ：" . $_POST['kana'] . "\n";
    $auto_reply_text .= "電話番号：" . $_POST['tel'] . "\n";
    $auto_reply_text .= "メールアドレス：" . $_POST['mail'] . "\n";
    $auto_reply_text .= "生まれ：" . $_POST['year'] . "\n";
    $auto_reply_text .= "性別：" . $_POST['sex'] . "\n";
    $auto_reply_text .= "tech_is 事務局";

    // Composer のオートローダー
    require 'PHPMailer/vendor/autoload.php';

    //日本語設定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    // インスタンス
    $mail = new PHPMailer(true);

    //日本語用設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";

    try {
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Gmail SMTP サーバーを指定
            $mail->SMTPAuth = true;
            // gmailメールアドレスを指定
            $mail->Username = 'xxxxxxxxxxxxx.gmail.com'; 
            // アカウントのパスワードを指定
            $mail->Password = 'xxxxxxxxxxxx';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587;  
            $mail->setFrom('testisjv9inr@gmail.com', mb_encode_mimeheader('松原弘樹')); 
            $mail->addAddress($_POST['mail'], mb_encode_mimeheader($_POST['name'])); 
            $mail->addCC($_POST['mail']); 
            //コンテンツ設定
            $mail->isHTML(false); 
            $mail->Subject = $auto_reply_subject; 
            $mail->Body = $auto_reply_text;
            $mail->send();  //送信
            echo 'Message has been sent';
            } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
}

echo "送信しました";
header('Location:index');
?>