<?php

namespace App\Services\Document;

interface DocumentServiceInterface
{
    const SAFETY_DATA_SHEET          = 'Safety Data Sheet';
    const TECHNICAL_DATA_SHEET       = 'Technical Data Sheet';
    const SPECIFICATION              = 'Specification';
    const BROCHURE                   = 'Brochure';
    const ALLERGEN_DECLARATION       = 'Allergen declaration';
    const ANIMAL_TESTING_STATEMENT   = 'Animal testing statement';
    const BSE_TSE_STATEMENT          = 'BSE/TSE Statement';
    const CITES_DECLARATION          = 'CITES declaration';
    const CMR_STATEMENT              = 'CMR statement';
    const CERTIFICATE_OF_ANALYSIS    = 'Certificate of Analysis';
    const COMPOSITION_STATEMENT      = 'Composition statement';
    const ECOLOGICAL_SUMMARY         = 'Ecological summary';
    const EFFICACY_TEST_REPORT       = 'Efficacy test report';
    const FORMULATION                = 'Formulation';
    const GMO_STATEMENT              = 'GMO statement';
    const IMPURITY_STATEMENT         = 'Impurity statement';
    const MANUFACTURING_PROCEDURE    = 'Manufacturing procedure';
    const MICROPLASTIC_STATEMENT     = 'Microplastic statement';
    const MSDS                       = 'MSDS';
    const NANOMATERIAL_STATEMENT     = 'Nanomaterial statement';
    const ORIGIN_STATEMENT           = 'Origin statement';
    const REACH_DECLARATION          = 'REACH declaration';
    const TOXICOLOGICAL_SUMMARY      = 'Toxicological summary';
    const VEGETARIAN_VEGAN_STATEMENT = 'Vegetarian/vegan statement';

    const ALL_DOCUMENTS = [
        self::SAFETY_DATA_SHEET,
        self::TECHNICAL_DATA_SHEET,
        self::SPECIFICATION,
        self::BROCHURE,
        self::ALLERGEN_DECLARATION,
        self::ANIMAL_TESTING_STATEMENT,
        self::BSE_TSE_STATEMENT,
        self::CITES_DECLARATION,
        self::CMR_STATEMENT,
        self::CERTIFICATE_OF_ANALYSIS,
        self::COMPOSITION_STATEMENT,
        self::ECOLOGICAL_SUMMARY,
        self::EFFICACY_TEST_REPORT,
        self::FORMULATION,
        self::GMO_STATEMENT,
        self::IMPURITY_STATEMENT,
        self::MANUFACTURING_PROCEDURE,
        self::MICROPLASTIC_STATEMENT,
        self::MSDS,
        self::NANOMATERIAL_STATEMENT,
        self::ORIGIN_STATEMENT,
        self::REACH_DECLARATION,
        self::TOXICOLOGICAL_SUMMARY,
        self::VEGETARIAN_VEGAN_STATEMENT,
    ];

    public function create(array $validated, int $ingredientId): void;
    public function createOther(array $validated, int $ingredientId): void;
}
