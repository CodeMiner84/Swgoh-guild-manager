<?php

namespace App\DBAL\Types;

class ModSecondary
{
    private const STAT_DEFENSE = 1;
    private const STAT_DEFENSE_PERCENTAGE = 2;
    private const STAT_CRITICAL_CHANCE = 3;
    private const STAT_CRITICAL_DAMAGE = 4;
    private const STAT_HEALTH = 5;
    private const STAT_HEALTH_PERCENTAGE = 6;
    private const STAT_OFFENSE = 7;
    private const STAT_OFFENSE_PERCENTAGE = 8;
    private const STAT_POTENCY = 9;
    private const STAT_PROTECTION = 10;
    private const STAT_SPEED = 11;
    private const STAT_TENACITY = 12;

    public const STATS = [
        self::STAT_DEFENSE => 'Defense',
        self::STAT_DEFENSE_PERCENTAGE => 'Defense %',
        self::STAT_CRITICAL_CHANCE => 'Critical chance',
        self::STAT_CRITICAL_DAMAGE => 'Critical damage',
        self::STAT_HEALTH => 'Health',
        self::STAT_HEALTH_PERCENTAGE => 'Health %',
        self::STAT_OFFENSE => 'Offense',
        self::STAT_OFFENSE_PERCENTAGE => 'Offense %',
        self::STAT_POTENCY => 'Potency',
        self::STAT_PROTECTION => 'Protection',
        self::STAT_SPEED => 'Speed',
        self::STAT_TENACITY => 'Tenacity',
    ];
}
