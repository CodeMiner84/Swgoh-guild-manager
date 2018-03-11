<?php

namespace App\DBAL\Types;

class ModType
{
    private const MOD_HEALTH = 1;
    private const MOD_OFFENSE = 2;
    private const MOD_DEFENSE = 3;
    private const MOD_SPEED = 4;
    private const MOD_CRIT_CHANCE = 5;
    private const MOD_CRIT_DAMAGE = 6;
    private const MOD_POTENCY = 7;
    private const MOD_TENACITY = 8;

    public const MOD_IMAGES = [
        self::MOD_HEALTH => '/img/mod_health.png',
        self::MOD_OFFENSE => '/img/mod_offense.png',
        self::MOD_DEFENSE => '/img/mod_defense.png',
        self::MOD_SPEED => '/img/mod_speed.png',
        self::MOD_CRIT_DAMAGE => '/img/mod_crit_damage.png',
        self::MOD_CRIT_CHANCE => '/img/mod_crit_chance.png',
        self::MOD_POTENCY => '/img/mod_accuracy.png',
        self::MOD_TENACITY => '/img/icon_tenacity.png',
    ];

    public const MOD_SPOTS = [
        self::MOD_HEALTH => 2,
        self::MOD_DEFENSE => 2,
        self::MOD_CRIT_DAMAGE => 4,
        self::MOD_CRIT_CHANCE => 2,
        self::MOD_TENACITY => 2,
        self::MOD_OFFENSE => 4,
        self::MOD_POTENCY => 2,
        self::MOD_SPEED => 4,
    ];
}
