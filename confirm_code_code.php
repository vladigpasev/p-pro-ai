<?php
session_start();
require ('dbconn.php');
$email_addr = $_SESSION['user_email'];
$pers_name = $_SESSION['pers_name'];
$return_url = $_SESSION['return_url'];
$password_u8 = $_SESSION['user_password'];
$code = trim(stripslashes(htmlspecialchars($_POST['code'])));
$right_code = $_SESSION['random_code'];
if(isset($email_addr, $password_u8, $pers_name)){
    if(md5(md5($code)) == $right_code){
        $_SESSION['random_code'] = null;
        $sql = "INSERT INTO users_ai (email_addr, password_u8, pers_name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email_addr, $password_u8, $pers_name);
        $stmt->execute();
        $_SESSION['user_password'] = $password_u8;
        $_SESSION['user_email'] = $email_addr;
        $_SESSION['login_success'] = true;
        $sql = "SELECT email_addr, pers_name FROM users_ai WHERE isAdmin='yes'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $to = $row['email_addr'];
                $subject = 'Нова регистрация за потвърждение в anketi.holiday';

                // Вашият имейл шаблон

                $headers = 'From: Abax toll system <registrations@p-pro.eu>' . "\r\n" .
                            'Content-Type: text/html; charset=UTF-8' . "\r\n" .
                            "X-Priority: 1" . "\r\n" . 
                            "X-MSMail-Priority: High" . "\r\n" .
                            "Priority: Urgent" . "\r\n" .
                            "Importance: high";
                mail($to,'=?utf-8?B?'.base64_encode($subject).'?=',$txt,$headers);
            }
        }
        echo '<meta http-equiv="refresh" content="0;url='.$return_url.'" />';
    }else{
        $_SESSION['error'] = 'Предоставеният код е грешен!';
        echo '<meta http-equiv="refresh" content="0;url=confirm_code.php" />';
    }
}else{
    echo 'ERROR 404';
}
?>
