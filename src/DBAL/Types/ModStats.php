<?php

namespace App\DBAL\Types;

class ModStats
{
    private const STAT_HEALTH = 1;
    private const STAT_OFFENSE = 2;
    private const STAT_DEFENSE = 3;
    private const STAT_SPEED = 4;
    private const STAT_CRIT_CHANCE = 5;
    private const STAT_CRIT_DAMAGE = 6;
    private const STAT_POTENCY = 7;
    private const STAT_TENACITY = 8;

    public const MOD_STATS = [
        self::STAT_HEALTH => 'Health',
        self::STAT_OFFENSE => 'Offense',
        self::STAT_DEFENSE => 'Defense',
        self::STAT_SPEED => 'Speed',
        self::STAT_CRIT_CHANCE => 'Critical chance',
        self::STAT_CRIT_DAMAGE => 'Critical damange',
        self::STAT_TENACITY => 'Tenacity',
        self::STAT_POTENCY => 'Potency',
    ];
}
