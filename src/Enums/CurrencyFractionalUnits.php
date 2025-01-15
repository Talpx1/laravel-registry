<?php

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

/**
 * Enum of all the currency fractional units in the world.
 *
 * See fractional unit column of the table at {@link https://en.wikipedia.org/wiki/List_of_circulating_currencies}
 *
 * Note that the list or its bindings may be incomplete or not up-to-date.
 * If you find an error or an inconsistency, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum CurrencyFractionalUnits: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case AGORA = 'agora';
    case ATT = 'att';
    case AURAR = 'aurar';
    case BANI = 'bani';
    case BOLIVAR = 'bolivar';
    case BUTUT = 'butut';
    case CENT = 'cent';
    case CHETRUM = 'chetrum';
    case COBO = 'cobo';
    case DINAR = 'dinar';
    case DIRHAM = 'dirham';
    case DIME = 'dime';
    case DONG = 'dong';
    case DRAM = 'dram';
    case FEN = 'fen';
    case FENING = 'fening';
    case FIL = 'fil';
    case FILLER = 'filler';
    case GAPIK = 'gapik';
    case GHANA_PESAWA = 'ghana pesawa';
    case GROSZ = 'grosz';
    case HALALA = 'halala';
    case HALER = 'haler';
    case KAPIEK = 'kapiek';
    case KIP = 'kip';
    case KOPIYKA = 'kopiyka';
    case KROON = 'kroon';
    case LARI = 'lari';
    case LEK = 'lek';
    case LEPTA = 'lepta';
    case LIPA = 'lipa';
    case LIRA = 'lira';
    case LUMA = 'luma';
    case MIL = 'mil';
    case MILIM = 'milim';
    case MO = 'mo';
    case NGULTRUM = 'ngultrum';
    case ORE = 'ore';
    case PAISA = 'paisa';
    case PENCE = 'pence';
    case PENI = 'peni';
    case PESAWA = 'pesawa';
    case PIASTRE = 'piastre';
    case PENNY = 'penny';
    case PISO = 'piso';
    case POIS = 'pois';
    case PULA = 'pula';
    case PUL = 'pul';
    case QINDARKA = 'qindarka';
    case QIRSH = 'qirsh';
    case RIEL = 'riel';
    case RIN = 'rin';
    case SATANG = 'satang';
    case SENE = 'sene';
    case SHILLING = 'shilling';
    case SOM = 'som';
    case STOTINKA = 'stotinka';
    case TENGE = 'tenge';
    case TETRI = 'tetri';
    case THEBE = 'thebe';
    case TIAO = 'tiao';
    case TUMAN = 'tuman';
    case TIYIN = 'tiyin';
    case YEN = 'yen';
    case YUAN = 'yuan';
    case ZHU = 'zhu';
    case ZLOTY = 'zloty';
    case CHON = 'chon';
    case JEON = 'jeon';
    case IRAIMBILANJA = 'iraimbilanja';
    case TAMBALA = 'tambala';
    case LAARI = 'laari';
    case KHOUMS = 'khoums';
    case BAN = 'ban';
    case MONGO = 'mongo';
    case PYA = 'pya';
    case KOBO = 'kobo';
    case DENI = 'deni';
    case BAISA = 'baisa';
    case TOEA = 'toea';
    case KOPEK = 'kopek';
    case PARA = 'para';
    case RAPPEN = 'rappen';
    case MILLIEME = 'millieme';
    case KURUS = 'kurus';
    case TENNESI = 'tennesi';
    case HAO = 'hao';
    case NGWEE = 'ngwee';
    case AVO = 'avo';

    /**
     * Get the alternative names array of the currency fractional unit.
     *
     * @return string[]|null
     */
    public function alternativeNames(): ?array {
        return match ($this) {
            self::CENT => ['centimo', 'centesimo', 'centavo', 'sen', 'tene', 'sent', 'centime', 'santim', 'sente', 'centas', 'sentimo', 'santims', 'sente', 'centimo'],
            self::TIYIN => ['tiyn', 'tyiyn'],
            self::DIRHAM => ['diram'],
            default => null
        };
    }
}
