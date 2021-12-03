<?php
// app/config/packages/captcha.php
if (!class_exists('CaptchaConfiguration')){return;}

//BotDetect PHP Captcha Configuration options
return [
    //Captcha configuration for example from
    'ExampleCaptchaUserRegistration' =>[
        'UserInputId' => 'captchaCode',
        'ImageWidth' =>250,
        'ImageHeight'=>50,

    ],
];