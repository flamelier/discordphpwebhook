<?php

/**
 * Example script
 *
 * Open console or terminal and run:
 *
 * ```bash
 * php ./example.php
 * ```
 *
 * @author flamelier @ flamelier.com <sean@flamelier.com>
 */
require_once 'Msg.php';
require_once 'DiscPHPWebhook.php';
require_once ('config.php');

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    /* $msg = new \FDev\DiscPHPWebhook('Sending Website Form');
    $msg->send(); */

    if (!empty($name) || !empty($email) || !empty($formRating) || !empty($message)) {
        
        (new \FDev\DiscPHPWebhook(
            "**" . $name . "**\n`" . $email . "`\n" . $message .
                "\n ***Thanks for using flamelier's <https://github.com/flamelier/discordphpwebhook>***", // message
            $webhook, // chanel webhook link
            get_current_user(), // bot name
            'https://flamelier.com/static/img/pfp.png' // avatar url
        ))->send();
    }
    else {
        echo "Please make sure to fill out each section of form.";
        (new \FDev\DiscPHPWebhook(
            "User did not imput all information.", // message
            $webhook, // chanel webhook link
            get_current_user(), // bot name
            'https://flamelier.com/static/img/pfp.png' // avatar url
        ))->send();
    }
}
else {
    echo "<meta http-equiv=\"Refresh\" content=\"0 url=https://fdev.pro/discordwebhook/\" />";
}