<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFING 
| ------------------------------------------------------------------- 
| Configuration of outgoing mail server. 
| */   
$config['protocol']='sendmail';
$config['smtp_host']='ssl://smtp.googlemail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='30';  
$config['smtp_user']='elviskudo@gmail.com';
$config['smtp_pass']='umarsaid';
$config['mailtype'] = 'html';
$config['charset']='utf-8';
$config['wordwrap'] = FALSE;
$config['newline']="\r\n";
$config['crlf'] = "\r\n";
  
/* End of file email.php */  
/* Location: ./system/application/config/email.php */ 