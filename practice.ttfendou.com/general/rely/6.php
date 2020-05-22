<?php
/**
 * Created by wking
 * Date: 2019/12/5
 * Time: 11:39
 */
interface Mail
{
    function send();
}

class sendSms implements Mail
{
    function send()
    {
        // TODO: Implement send() method.
        echo 'this is Sms send!';
    }
}

class sendEmail implements Mail
{
    function send()
    {
        // TODO: Implement send() method.
        echo 'this is Email send!';
    }
}

class Register
{
    protected $_mail;
    public function __construct($mail)
    {
        $this->_mail = $mail;
    }

    public function doRegister()
    {
        $this->_mail->send();
    }
}

$register_email = new Register(new sendEmail());
$register_email -> doRegister();
echo "<hr/>";
$register_sms = new Register(new sendSms());
$register_sms -> doRegister();