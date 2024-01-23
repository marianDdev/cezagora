<?php

namespace App\Services\Service;

interface ServicesServiceInterface
{
    public const LABORATORY                = 'laboratory';
    public const REGULATORY_CONSULTING     = 'regulatory_consulting';
    public const QUALITY_ASSURANCE         = 'quality_assurance';
    public const MARKET_RESEARCH           = 'market_research';
    public const BRANDING                  = 'branding';
    public const EXPORT_IMPORT             = 'export_import';
    public const SUSTAINABILITY_CONSULTING = 'sustainability_consulting';
    public const TRAINING                  = 'training';
    public const FORMULATION               = 'formulation';
    public const MARKETING                 = 'marketing';
    public const DELIVERY                  = 'delivery';
    public const BUSINESS_STRATEGY         = 'business_strategy';
    public const INNOVATION                = 'innovation';
    public const PRIVATE_LABEL = 'private_label';

    public const TYPES = [
        self::FORMULATION,
        self::LABORATORY,
        self::PRIVATE_LABEL,
        self::REGULATORY_CONSULTING,
        self::QUALITY_ASSURANCE,
        self::MARKET_RESEARCH,
        self::BRANDING,
        self::EXPORT_IMPORT,
        self::SUSTAINABILITY_CONSULTING,
        self::TRAINING,
        self::MARKETING,
        self::DELIVERY,
        self::BUSINESS_STRATEGY,
        self::INNOVATION,
    ];
}
