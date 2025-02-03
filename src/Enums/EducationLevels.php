<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

/**
 * Enum of education levels.
 * These values are based on ISCED 2011:
 * {@link https://en.wikipedia.org/wiki/International_Standard_Classification_of_Education},
 * {@link https://web.archive.org/web/20130124032233/http://www.uis.unesco.org/Education/Documents/isced-2011-en.pdf}.
 *
 *
 * Please note that ISCED 2011 is one of the education level classification, but also other classifications exist, like
 * EQF (European Qualifications Framework) {@link https://en.wikipedia.org/wiki/European_Qualifications_Framework}
 *
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum EducationLevels: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case EARLY_CHILDHOOD_EDUCATIONAL_DEVELOPMENT = 'early childhood educational development';
    case PRE_PRIMARY_EDUCATION = 'pre-primary education';
    case PRIMARY_EDUCATION = 'primary education';
    case LOWER_SECONDARY_EDUCATION_GENERAL = 'lower_secondary_education_general';
    case LOWER_SECONDARY_EDUCATION_PROFESSIONAL = 'lower_secondary_education_professional';
    case UPPER_SECONDARY_EDUCATION_GENERAL = 'upper secondary education general';
    case UPPER_SECONDARY_EDUCATION_PROFESSIONAL = 'upper secondary education professional';
    case POST_SECONDARY_NON_TERTIARY_EDUCATION_GENERAL = 'post secondary non tertiary education general';
    case POST_SECONDARY_NON_TERTIARY_EDUCATION_PROFESSIONAL = 'post secondary non tertiary education professional';
    case SHORT_CYCLE_TERTIARY_EDUCATION_GENERAL = 'short cycle tertiary education general';
    case SHORT_CYCLE_TERTIARY_EDUCATION_PROFESSIONAL = 'short cycle tertiary education professional';
    case BACHELORS_OR_EQUIVALENT_LEVEL_ACADEMIC = 'bachelor\'s or equivalent level academic';
    case BACHELORS_OR_EQUIVALENT_LEVEL_PROFESSIONAL = 'bachelor\'s or equivalent level professional';
    case BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 = 'bachelor\'s or equivalent level orientation unspecified1';
    case MASTERS_OR_EQUIVALENT_LEVEL_ACADEMIC = 'master\'s or equivalent level academic';
    case MASTERS_OR_EQUIVALENT_LEVEL_PROFESSIONAL = 'master\'s or equivalent level professional';
    case MASTERS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 = 'master\'s or equivalent level orientation unspecified1';
    case DOCTORAL_OR_EQUIVALENT_LEVEL_ACADEMIC = 'doctoral or equivalent level academic';
    case DOCTORAL_OR_EQUIVALENT_LEVEL_PROFESSIONAL = 'doctoral or equivalent level professional';
    case DOCTORAL_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED = 'doctoral or equivalent level orientation unspecified';

    /**
     * Returns the ISCED 2011 number for this education level.
     *
     * @link https://en.wikipedia.org/wiki/International_Standard_Classification_of_Education#ISCED_2011_levels,_categories,_and_sub-categories
     */
    public function isced2011Number(): string {
        return match ($this) {
            self::EARLY_CHILDHOOD_EDUCATIONAL_DEVELOPMENT => '01',
            self::PRE_PRIMARY_EDUCATION => '02',
            self::PRIMARY_EDUCATION => '10',
            self::LOWER_SECONDARY_EDUCATION_GENERAL => '24',
            self::LOWER_SECONDARY_EDUCATION_PROFESSIONAL => '25',
            self::UPPER_SECONDARY_EDUCATION_GENERAL => '34',
            self::UPPER_SECONDARY_EDUCATION_PROFESSIONAL => '35',
            self::POST_SECONDARY_NON_TERTIARY_EDUCATION_GENERAL => '44',
            self::POST_SECONDARY_NON_TERTIARY_EDUCATION_PROFESSIONAL => '45',
            self::SHORT_CYCLE_TERTIARY_EDUCATION_GENERAL => '54',
            self::SHORT_CYCLE_TERTIARY_EDUCATION_PROFESSIONAL => '55',
            self::BACHELORS_OR_EQUIVALENT_LEVEL_ACADEMIC => '64',
            self::BACHELORS_OR_EQUIVALENT_LEVEL_PROFESSIONAL => '65',
            self::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 => '66',
            self::MASTERS_OR_EQUIVALENT_LEVEL_ACADEMIC => '74',
            self::MASTERS_OR_EQUIVALENT_LEVEL_PROFESSIONAL => '75',
            self::MASTERS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 => '76',
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_ACADEMIC => '84',
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_PROFESSIONAL => '85',
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED => '86',
        };
    }

    /**
     * Returns the ISCED 2011 macro category for this education level.
     *
     * @link https://en.wikipedia.org/wiki/International_Standard_Classification_of_Education#ISCED_2011_levels,_categories,_and_sub-categories
     */
    public function isced2011Category(): string {
        return match ($this) {
            self::EARLY_CHILDHOOD_EDUCATIONAL_DEVELOPMENT,
            self::PRE_PRIMARY_EDUCATION => 'EARLY CHILDHOOD EDUCATION',

            self::PRIMARY_EDUCATION => 'PRIMARY EDUCATION',

            self::LOWER_SECONDARY_EDUCATION_GENERAL,
            self::LOWER_SECONDARY_EDUCATION_PROFESSIONAL => 'LOWER SECONDARY EDUCATION',

            self::UPPER_SECONDARY_EDUCATION_GENERAL,
            self::UPPER_SECONDARY_EDUCATION_PROFESSIONAL => 'UPPER SECONDARY EDUCATION',

            self::POST_SECONDARY_NON_TERTIARY_EDUCATION_GENERAL,
            self::POST_SECONDARY_NON_TERTIARY_EDUCATION_PROFESSIONAL => 'POST-SECONDARY NON-TERTIARY EDUCATION',

            self::SHORT_CYCLE_TERTIARY_EDUCATION_GENERAL,
            self::SHORT_CYCLE_TERTIARY_EDUCATION_PROFESSIONAL => 'SHORT-CYCLE TERTIARY EDUCATION',

            self::BACHELORS_OR_EQUIVALENT_LEVEL_ACADEMIC,
            self::BACHELORS_OR_EQUIVALENT_LEVEL_PROFESSIONAL,
            self::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 => 'BACHELOR\'S OR EQUIVALENT LEVEL',

            self::MASTERS_OR_EQUIVALENT_LEVEL_ACADEMIC,
            self::MASTERS_OR_EQUIVALENT_LEVEL_PROFESSIONAL,
            self::MASTERS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 => 'MASTER\'S OR EQUIVALENT LEVEL',

            self::DOCTORAL_OR_EQUIVALENT_LEVEL_ACADEMIC,
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_PROFESSIONAL,
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED => 'DOCTORAL OR EQUIVALENT LEVEL',
        };
    }

    /**
     * Returns the ISCED 2011 description for this education level.
     *
     * @link https://en.wikipedia.org/wiki/International_Standard_Classification_of_Education#2011_version
     */
    public function isced2011Description(): string {
        return match ($this) {
            self::EARLY_CHILDHOOD_EDUCATIONAL_DEVELOPMENT => 'Education designed to support early development in preparation for participation in school and society. Programmes designed for children below the age of 3.',
            self::PRE_PRIMARY_EDUCATION => 'Education designed to support early development in preparation for participation in school and society. Programmes designed for children from age 3 to the start of primary education.',
            self::PRIMARY_EDUCATION => 'Programmes typically designed to provide students with fundamental skills in reading, writing and mathematics and to establish a solid foundation for learning.',

            self::LOWER_SECONDARY_EDUCATION_GENERAL,
            self::LOWER_SECONDARY_EDUCATION_PROFESSIONAL => 'First stage of secondary education building on primary education, typically with a more subject-oriented curriculum.',

            self::UPPER_SECONDARY_EDUCATION_GENERAL,
            self::UPPER_SECONDARY_EDUCATION_PROFESSIONAL => 'Second/final stage of secondary education preparing for tertiary education or providing skills relevant to employment. Usually with an increased range of subject options and streams.',

            self::POST_SECONDARY_NON_TERTIARY_EDUCATION_GENERAL,
            self::POST_SECONDARY_NON_TERTIARY_EDUCATION_PROFESSIONAL => 'Programmes providing learning experiences that build on secondary education and prepare for labour market entry or tertiary education. The content is broader than secondary but not as complex as tertiary education.',

            self::SHORT_CYCLE_TERTIARY_EDUCATION_GENERAL,
            self::SHORT_CYCLE_TERTIARY_EDUCATION_PROFESSIONAL => 'Short first tertiary programmes that are typically practically-based, occupationally-specific and prepare for labour market entry. These programmes may also provide a pathway to other tertiary programmes.',

            self::BACHELORS_OR_EQUIVALENT_LEVEL_ACADEMIC,
            self::BACHELORS_OR_EQUIVALENT_LEVEL_PROFESSIONAL,
            self::BACHELORS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 => 'Programmes designed to provide intermediate academic or professional knowledge, skills and competencies leading to a first tertiary degree or equivalent qualification.',

            self::MASTERS_OR_EQUIVALENT_LEVEL_ACADEMIC,
            self::MASTERS_OR_EQUIVALENT_LEVEL_PROFESSIONAL,
            self::MASTERS_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED1 => 'Programmes designed to provide advanced academic or professional knowledge, skills and competencies leading to a second tertiary degree or equivalent qualification.',

            self::DOCTORAL_OR_EQUIVALENT_LEVEL_ACADEMIC,
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_PROFESSIONAL,
            self::DOCTORAL_OR_EQUIVALENT_LEVEL_ORIENTATION_UNSPECIFIED => 'Programmes designed primarily to lead to an advanced research qualification, usually concluding with the submission and defense of a substantive dissertation of publishable quality based on original research.',
        };
    }
}
