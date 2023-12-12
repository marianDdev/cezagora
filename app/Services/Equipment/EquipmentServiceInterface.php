<?php

namespace App\Services\Equipment;

interface EquipmentServiceInterface
{
    public const LAB_EQUIPMENT        = 'laboratory_equipment';
    public const SAFETY_EQUIPMENT     = 'safety_equipment';
    public const PRODUCTION_MACHINERY = 'production machinery';
    public const LABEL_PRINTING       = 'label_printing';

    public const TYPES = [
        self::LAB_EQUIPMENT,
        self::SAFETY_EQUIPMENT,
        self::PRODUCTION_MACHINERY,
        self::LABEL_PRINTING,
    ];

    public const AVAILABLE_NOW       = 'now';
    public const AVAILABLE_ON_DEMAND = 'on_demand';
    public const NOT_AVAILABLE       = 'unavailable';
    public const AVAILABILITY_TYPES  = [self::AVAILABLE_NOW, self::AVAILABLE_ON_DEMAND];
}
