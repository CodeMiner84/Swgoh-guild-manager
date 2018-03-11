<?php

namespace App\Handler;

use App\DBAL\Types\ModStats;
use App\DBAL\Types\ModType;

/**
 * Class ModHandler.
 */
class ModHandler extends ApiHandler
{
    public function getConfig()
    {
        return [
            'stats' => ModStats::MOD_STATS,
            'images' => ModType::MOD_IMAGES,
            'spots' => ModType::MOD_SPOTS,
        ];
    }
}
