<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Settings.
  | -------------------------------------------------------------------------
 */
$config['app_id'] = '1484920491793074';   // Your app id
$config['app_secret'] = '03ab459f2d7e0a0fc54b9df8383eb6db';   // Your app secret key
$config['scope'] = 'email,user_birthday,user_location,user_work_history,user_hometown,user_photos';  // custom permissions check - http://developers.facebook.com/docs/reference/login/#permissions
$config['redirect_uri'] = 'http://www.jib.co.th/ws/index.php/authentication/auth/regfb';   // url to redirect back from facebook. If set to '', site_url('') will be used