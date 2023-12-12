<?php

namespace App\Services\Qualification;

interface QualificationServiceInterface
{
    public const CERTIFICATION = 'certification';
    public const SPECIALIZATION = 'specialization';
    public const ACCREDITATION = 'accreditation';
    public const LICENSE = 'license';
    public const OTHER = 'other';

    public const TYPES = [self::CERTIFICATION, self::SPECIALIZATION, self::ACCREDITATION, self::LICENSE, self::OTHER];
}
