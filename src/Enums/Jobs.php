<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Contracts\HasSushiModel;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;
use Talp1\LaravelRegistry\Enums\Traits\HasSushiModel as HasSushiModelTrait;

/**
 * Enum of jobs.
 *
 * Note that creating an enum of ALL the jobs, would be nearly impossible,so here is listed a more generic subset.
 * If you think this enum should contain a value that's currently missing, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum Jobs: string implements CanBeCollected, HasLabels, HasRandom, HasSushiModel {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait, HasSushiModelTrait;

    case FARMER = 'farmer';
    case BEEKEEPER = 'beekeeper';
    case GARDENER = 'gardener';
    case WINEMAKER = 'winemaker';
    case ENVIRONMENTAL_TECHNICIAN = 'environmental technician';
    case BRICKLAYER = 'bricklayer';
    case CARPENTER = 'carpenter';
    case ELECTRICIAN = 'electrician';
    case PLUMBER = 'plumber';
    case PAINTER = 'painter';
    case BLACKSMITH = 'blacksmith';
    case SURVEYOR = 'surveyor';
    case ARCHITECT = 'architect';
    case CIVIL_ENGINEER = 'civil engineer';
    case MACHINE_OPERATOR = 'machine operator';
    case METALWORKER = 'metalworker';
    case WELDER = 'welder';
    case TURNER = 'turner';
    case PRODUCTION_TECHNICIAN = 'production technician';
    case MECHANICAL_MAINTENANCE_TECHNICIAN = 'mechanical maintenance technician';
    case QUALITY_CONTROL_SPECIALIST = 'quality control specialist';
    case INDUSTRIAL_CHEMIST = 'industrial chemist';
    case PROGRAMMER = 'programmer';
    case WEB_DEVELOPER = 'web developer';
    case APP_DEVELOPER = 'app developer';
    case DATA_SCIENTIST = 'data scientist';
    case CYBERSECURITY_SPECIALIST = 'cybersecurity specialist';
    case HARDWARE_TECHNICIAN = 'hardware technician';
    case IT_ENGINEER = 'it engineer';
    case UX_UI_DESIGNER = 'ux/ui designer';
    case ARTIFICIAL_INTELLIGENCE_SPECIALIST = 'artificial intelligence specialist';
    case IT_SYSTEM_ADMINISTRATOR = 'it system administrator';
    case SALES_ASSISTANT = 'sales assistant';
    case CASHIER = 'cashier';
    case SALES_REPRESENTATIVE = 'sales representative';
    case STORE_MANAGER = 'store manager';
    case REAL_ESTATE_AGENT = 'real estate agent';
    case TRUCK_DRIVER = 'truck driver';
    case TAXI_DRIVER = 'taxi driver';
    case PILOT = 'pilot';
    case FLIGHT_ATTENDANT = 'flight attendant';
    case TRAIN_CONDUCTOR = 'train conductor';
    case SHIP_CAPTAIN = 'ship captain';
    case FISHERMAN = 'fisherman';
    case FIREFIGHTER = 'firefighter';
    case POLICE_OFFICER = 'police officer';
    case SECURITY_GUARD = 'security guard';
    case SOLDIER = 'soldier';
    case PARAMEDIC = 'paramedic';
    case DOCTOR = 'doctor';
    case NURSE = 'nurse';
    case SURGEON = 'surgeon';
    case PHARMACIST = 'pharmacist';
    case DENTIST = 'dentist';
    case VETERINARIAN = 'veterinarian';
    case PHYSIOTHERAPIST = 'physiotherapist';
    case PSYCHOLOGIST = 'psychologist';
    case TEACHER = 'teacher';
    case PROFESSOR = 'professor';
    case LIBRARIAN = 'librarian';
    case WRITER = 'writer';
    case JOURNALIST = 'journalist';
    case EDITOR = 'editor';
    case TRANSLATOR = 'translator';
    case ACTOR = 'actor';
    case SINGER = 'singer';
    case MUSICIAN = 'musician';
    case COMPOSER = 'composer';
    case DANCER = 'dancer';
    case SCULPTOR = 'sculptor';
    case PHOTOGRAPHER = 'photographer';
    case GRAPHIC_DESIGNER = 'graphic designer';
    case FASHION_DESIGNER = 'fashion designer';
    case CHEF = 'chef';
    case PASTRY_CHEF = 'pastry chef';
    case WAITER = 'waiter';
    case BARTENDER = 'bartender';
    case SOMMELIER = 'sommelier';
    case HOTEL_MANAGER = 'hotel manager';
    case TOUR_GUIDE = 'tour guide';
    case TRAVEL_AGENT = 'travel agent';
    case LAWYER = 'lawyer';
    case JUDGE = 'judge';
    case NOTARY = 'notary';
    case ACCOUNTANT = 'accountant';
    case FINANCIAL_ANALYST = 'financial analyst';
    case ECONOMIST = 'economist';
    case BANKER = 'banker';
    case STOCKBROKER = 'stockbroker';
    case HR_MANAGER = 'hr manager';
    case RECRUITER = 'recruiter';
    case CONSULTANT = 'consultant';
    case MARKETING_MANAGER = 'marketing manager';
    case SEO_SPECIALIST = 'seo specialist';
    case SOCIAL_MEDIA_MANAGER = 'social media manager';
    case PUBLIC_RELATIONS_SPECIALIST = 'public relations specialist';
    case EVENT_PLANNER = 'event planner';
    case SCIENTIST = 'scientist';
    case ASTRONOMER = 'astronomer';
    case PHYSICIST = 'physicist';
    case BIOLOGIST = 'biologist';
    case CHEMIST = 'chemist';
    case MATHEMATICIAN = 'mathematician';
    case ENGINEER = 'engineer';
    case ROBOTICS_TECHNICIAN = 'robotics technician';
    case MECHANIC = 'mechanic';
    case AEROSPACE_ENGINEER = 'aerospace engineer';
    case BIOMEDICAL_ENGINEER = 'biomedical engineer';
    case CIVIL_SERVANT = 'civil servant';
    case DIPLOMAT = 'diplomat';
    case MAYOR = 'mayor';
    case POLITICIAN = 'politician';
    case ENTREPRENEUR = 'entrepreneur';
    case BUSINESS_OWNER = 'business owner';
    case PRODUCER = 'producer';
    case ARTIST = 'artist';
    case PERFORMER = 'performer';
    case ENTERTAINER = 'entertainer';
    case COOK = 'cook';
    case SERVER = 'server';
    case PROMOTER = 'promoter';
    case SPOKESPERSON = 'spokesperson';
    case BROKER = 'broker';
    case THERAPIST = 'therapist';
    case CAREGIVER = 'caregiver';
    case DRIVER = 'driver';
    case SAILOR = 'sailor';
    case GUARD = 'guard';
    case DETECTIVE = 'detective';
    case RESCUER = 'rescuer';
    case HUNTER = 'hunter';
    case MINER = 'miner';
    case OPERATOR = 'operator';
    case MACHINIST = 'machinist';
    case ASSEMBLER = 'assembler';
    case FABRICATOR = 'fabricator';
    case HISTORIAN = 'historian';
    case PHILOSOPHER = 'philosopher';
    case DEVELOPER = 'developer';
    case IT_SPECIALIST = 'it specialist';
    case NETWORK_ENGINEER = 'network engineer';
    case DATA_ANALYST = 'data analyst';
    case STATISTICIAN = 'statistician';
    case SOCIAL_SCIENTIST = 'social scientist';
    case ANTHROPOLOGIST = 'anthropologist';
    case GEOGRAPHER = 'geographer';
    case METEOROLOGIST = 'meteorologist';
    case EXPLORER = 'explorer';
    case MODEL = 'model';
    case INFLUENCER = 'influencer';
    case SPEAKER = 'speaker';
    case MOTIVATOR = 'motivator';
    case FUNDRAISER = 'fundraiser';
}
