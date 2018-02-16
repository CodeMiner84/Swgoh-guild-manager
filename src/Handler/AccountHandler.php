<?php

namespace App\Handler;

use App\Entity\RequestTrait;

/**
 * Class AccountHandler.
 */
class AccountHandler extends ApiHandler
{
    use RequestTrait;

    protected const ALLOWED_PARAMS = [
        'uuid',
        'guildId',
        'guildCode'
    ];
}
