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


echo "To see dumb messages..\n";
echo "..join the DiscPHPWebhook chanel https://discord.gg/Bh4EZB and enjoy!\n";
echo "Feel free to test!\n";


// First message
$msg = new \FDev\DiscPHPWebhook('Hello, Friends');
$msg->send();


// Second message
(new \FDev\DiscPHPWebhook(
    'I started the example.php, something happened?',
    null,
    $_ENV["USER"] ?? 'Norman'
))->send();

// https://discord.com/api/webhooks/885320652029042709/WyYd6RhJY4JxBBEoF82BLTv9JDR58oqOV2kXQj21Cs-Khf6VSNWpoY2J5HM5vIVx6520
// Third message
(new \FDev\DiscPHPWebhook(
    "Maybe the missile is launched? :grimacing:", // message
    'https://discord.com/api/webhooks/885320652029042709/' . // chanel webhook link
        'WyYd6RhJY4JxBBEoF82BLTv9JDR58oqOV2kXQj21Cs-Khf6VSNWpoY2J5HM5vIVx6520',
    get_current_user(), // bot name
    '' // avatar url
))->send();

?>