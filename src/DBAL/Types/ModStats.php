<?php

namespace App\DBAL\Types;

class ModStats
{
    private const STAT_HEALTH = 0;
    private const STAT_DEFENSE = 1;
    private const STAT_CRIT_DAMAGE = 2;
    private const STAT_CRIT_CHANCE = 3;
    private const STAT_TENACITY = 4;
    private const STAT_OFFENSE = 5;
    private const STAT_POTENCY = 6;
    private const STAT_SPEED = 7;

    public const MOD_STATS = [
        self::STAT_HEALTH => 'Health',
        self::STAT_DEFENSE => 'Defense',
        self::STAT_CRIT_DAMAGE => 'Critical damange',
        self::STAT_CRIT_CHANCE => 'Critical chance',
        self::STAT_TENACITY => 'Tenacity',
        self::STAT_OFFENSE => 'Offense',
        self::STAT_POTENCY => 'Potency',
        self::STAT_SPEED => 'Speed',
    ];

}
