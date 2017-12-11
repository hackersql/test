<?php

if( isset( $_POST['Change'] ) && ( $_POST['step'] == '1' ) ) {
    
    $hide_form = true;
    $user = $_POST['username'];
    $pass_new = $_POST['password_new'];
    $pass_conf = $_POST['password_conf'];
    $resp = recaptcha_check_answer ($_DVWA['recaptcha_private_key'],
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
        // What happens when the CAPTCHA was entered incorrectly
        $html .= "<pre><br />验证码错误，请重新输入。</pre>";
        $hide_form = false;
        return;	
    } else {
            if (($pass_new == $pass_conf)){
            $html .= "<pre><br />验证码通过，请单击更改按钮。 <br /></pre>";
            $html .= "
            <form action=\"#\" method=\"POST\">
                <input type=\"hidden\" name=\"step\" value=\"2\" />
                <input type=\"hidden\" name=\"password_new\" value=\"" . $pass_new . "\" />
                <input type=\"hidden\" name=\"password_conf\" value=\"" . $pass_conf . "\" />
                <input type=\"submit\" name=\"Change\" value=\"确定\" />
            </form>";
            }	

            else{
                    $html .= "<pre> 两次输入的密码必须相同。 </pre>";
            $hide_form = false;
            }
    }
}

if( isset( $_POST['Change'] ) && ( $_POST['step'] == '2' ) ) 
{
     $pass_new = $_POST['password_new'];
    $pass_conf = $_POST['password_conf'];  //独自等待添加，修正原程序中的错误
    $hide_form = true;
        if ($pass_new  != $pass_conf)
        {
                $html .= "<pre><br />两次输入的密码必须相同。</pre>";
        $hide_form = false;
                return;
        }
        $pass = md5($pass_new);
        if (($pass_new == $pass_conf)){
               $pass_new = mysql_real_escape_string($pass_new);
               $pass_new = md5($pass_new);

               $insert="UPDATE `users` SET password = '$pass_new' WHERE user = '" . dvwaCurrentUser() . "';";
               $result=mysql_query($insert) or die('<pre>' . mysql_error() . '</pre>' );

               $html .= "<pre> 密码已更改。 </pre>";
               mysql_close();
        }

        else{
               $html .= "<pre> 密码不匹配。 </pre>";
        }
}
?>
