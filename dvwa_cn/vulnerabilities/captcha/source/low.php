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
        $html .= "<pre><br />��֤��������������롣</pre>";
        $hide_form = false;
        return;	
    } else {
            if (($pass_new == $pass_conf)){
            $html .= "<pre><br />��֤��ͨ�����뵥�����İ�ť�� <br /></pre>";
            $html .= "
            <form action=\"#\" method=\"POST\">
                <input type=\"hidden\" name=\"step\" value=\"2\" />
                <input type=\"hidden\" name=\"password_new\" value=\"" . $pass_new . "\" />
                <input type=\"hidden\" name=\"password_conf\" value=\"" . $pass_conf . "\" />
                <input type=\"submit\" name=\"Change\" value=\"ȷ��\" />
            </form>";
            }	

            else{
                    $html .= "<pre> ������������������ͬ�� </pre>";
            $hide_form = false;
            }
    }
}

if( isset( $_POST['Change'] ) && ( $_POST['step'] == '2' ) ) 
{
     $pass_new = $_POST['password_new'];
    $pass_conf = $_POST['password_conf'];  //���Եȴ���ӣ�����ԭ�����еĴ���
    $hide_form = true;
        if ($pass_new  != $pass_conf)
        {
                $html .= "<pre><br />������������������ͬ��</pre>";
        $hide_form = false;
                return;
        }
        $pass = md5($pass_new);
        if (($pass_new == $pass_conf)){
               $pass_new = mysql_real_escape_string($pass_new);
               $pass_new = md5($pass_new);

               $insert="UPDATE `users` SET password = '$pass_new' WHERE user = '" . dvwaCurrentUser() . "';";
               $result=mysql_query($insert) or die('<pre>' . mysql_error() . '</pre>' );

               $html .= "<pre> �����Ѹ��ġ� </pre>";
               mysql_close();
        }

        else{
               $html .= "<pre> ���벻ƥ�䡣 </pre>";
        }
}
?>
