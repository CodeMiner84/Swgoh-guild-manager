<?php

namespace App\DBAL\Types;

class ModPrimary
{
    private const STAT_ACCURACY = 1;
    private const STAT_DEFENSE = 2;
    private const STAT_CRITICAL_AVOIDANCE = 3;
    private const STAT_CRITICAL_CHANCE = 4;
    private const STAT_CRITICAL_DAMAGE = 5;
    private const STAT_HEALTH = 6;
    private const STAT_OFFENSE = 7;
    private const STAT_POTENCY = 8;
    private const STAT_PROTECTION = 9;
    private const STAT_SPEED = 10;
    private const STAT_TENACITY = 11;

    public const STATS = [
        self::STAT_ACCURACY => 'Accuracy',
        self::STAT_DEFENSE => 'Defense',
        self::STAT_CRITICAL_AVOIDANCE => 'Critical avoidance',
        self::STAT_CRITICAL_CHANCE => 'Critical chance',
        self::STAT_CRITICAL_DAMAGE => 'Critical damage',
        self::STAT_HEALTH => 'Health',
        self::STAT_OFFENSE => 'Offense',
        self::STAT_POTENCY => 'Potency',
        self::STAT_PROTECTION => 'Protection',
        self::STAT_SPEED => 'Speed',
        self::STAT_TENACITY => 'Tenacity',
    ];
}
