<?php

namespace FDev;

use Exception;

/**
 * Message to Discord Chanel
 *
 * Uses simple webhook api
 * See https://github.com/flamelier/discordphpwebhook for details.
 *
 * Official doc about webhook
 * @link https://discordapp.com/developers/docs/resources/webhook#execute-webhook
 *
 * Example:
 *
 * ```php
 * (new \FDev\DiscPHPWebhook('Hello'))->send();
 * ```
 *
 * DiscPHPWebhook is immutable object.
 *
 * @package FDev
 * @author flamelier @ flamelier.com <sean@flamelier.com>
 */

require_once ('config.php');
final class DiscPHPWebhook implements Msg
{
    private $msg;
    private $url;
    private $username;
    private $avatar;

    /**
     * DiscPHPWebhook constructor.
     *
     * To Test Join https://discord.gg/Bh4EZB
     *
     * How to create own webhook see at https://github.com/flamelier/discordphpwebhook
     *
     * @param string $msg text messae
     * @param string $url Discord Webhook url (default is sandboxc channel, put yours chanel here)
     * @param string|null $username
     * @param string|null $avatar
     */
    public function __construct(
        string $msg,
        string $url = null,
        string $username = null,
        string $avatar = null
    )
    {
        $this->msg = $msg;
        $this->url = $url ?? $webhook;
        $this->username = $username ?? 'DiscPHPWebhook';
        $this->avatar = $avatar ??
            'https://flamelier.com/static/img/pfp.png';
    }

    /**
     * Sends message
     *
     * @return void
     * @throws \Exception
     */
    public function send(): void
    {
        $curl = curl_init();
        //timeouts - 5 seconds
        curl_setopt($curl, CURLOPT_TIMEOUT, 5); // 5 seconds
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); // 5 seconds

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            'content' => $this->msg,
            'username' => $this->username,
            'avatar_url' => $this->avatar,
        ]));

        $output = json_decode(
            curl_exec($curl),
            true
        );

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
            curl_close($curl);
            throw new Exception("Something went wrong to send a discord message: " . $output['message']);
        }

        curl_close($curl);
    }
}