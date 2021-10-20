<?php

namespace FDev;

use Exception;

/**
 * Message
 *
 * @author flamelier @ flamelier.com <sean@flamelier.com>
 */
interface Msg
{
    /**
     * Send message
     *
     * @throws Exception
     */
    public function send(): void;
}