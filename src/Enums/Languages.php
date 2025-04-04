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
 * Enum containing all the world spoken languages and their ISO 639 info ({@link https://en.wikipedia.org/wiki/ISO_639}).
 *
 * Note that the list or its bindings may be incomplete or not up-to-date.
 * If you find an error or an inconsistency, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum Languages: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait,ConvertsValueToLabel, HasRandomTrait;

    case AFRIKAANS = 'afrikaans';
    case ALBANIAN = 'albanian';
    case AMHARIC = 'amharic';
    case ARABIC = 'arabic';
    case ARMENIAN = 'armenian';
    case AZERBAIJANI = 'azerbaijani';
    case BASQUE = 'basque';
    case BELARUSIAN = 'belarusian';
    case BENGALI = 'bengali';
    case BOSNIAN = 'bosnian';
    case BULGARIAN = 'bulgarian';
    case CATALAN = 'catalan';
    case CEBUANO = 'cebuano';
    case CHICHEWA = 'chichewa';
    case CHINESE = 'chinese';
    case CORSICAN = 'corsican';
    case CROATIAN = 'croatian';
    case CZECH = 'czech';
    case DANISH = 'danish';
    case DUTCH = 'dutch';
    case ENGLISH = 'english';
    case ESPERANTO = 'esperanto';
    case ESTONIAN = 'estonian';
    case FILIPINO = 'filipino';
    case FINNISH = 'finnish';
    case FRENCH = 'french';
    case FRISIAN = 'frisian';
    case GALICIAN = 'galician';
    case GEORGIAN = 'georgian';
    case GERMAN = 'german';
    case GREEK = 'greek';
    case GUJARATI = 'gujarati';
    case HAITIAN_CREOLE = 'haitian creole';
    case HAUSA = 'hausa';
    case HAWAIIAN = 'hawaiian';
    case HEBREW = 'hebrew';
    case HINDI = 'hindi';
    case HMONG = 'hmong';
    case HUNGARIAN = 'hungarian';
    case ICELANDIC = 'icelandic';
    case IGBO = 'igbo';
    case INDONESIAN = 'indonesian';
    case IRISH = 'irish';
    case ITALIAN = 'italian';
    case JAPANESE = 'japanese';
    case JAVANESE = 'javanese';
    case KANNADA = 'kannada';
    case KAZAKH = 'kazakh';
    case KHMER = 'khmer';
    case KINYARWANDA = 'kinyarwanda';
    case KOREAN = 'korean';
    case KURDISH = 'kurdish';
    case KYRGYZ = 'kyrgyz';
    case LAO = 'lao';
    case LATIN = 'latin';
    case LATVIAN = 'latvian';
    case LITHUANIAN = 'lithuanian';
    case LUXEMBOURGISH = 'luxembourgish';
    case MACEDONIAN = 'macedonian';
    case MALAGASY = 'malagasy';
    case MALAY = 'malay';
    case MALAYALAM = 'malayalam';
    case MALTESE = 'maltese';
    case MAORI = 'maori';
    case MARATHI = 'marathi';
    case MONGOLIAN = 'mongolian';
    case MYANMAR = 'myanmar';
    case NEPALI = 'nepali';
    case NORWEGIAN = 'norwegian';
    case ODIA = 'odia';
    case PASHTO = 'pashto';
    case PERSIAN = 'persian';
    case POLISH = 'polish';
    case PORTUGUESE = 'portuguese';
    case PUNJABI = 'punjabi';
    case ROMANIAN = 'romanian';
    case RUSSIAN = 'russian';
    case SAMOAN = 'samoan';
    case SCOTS_GAELIC = 'scots gaelic';
    case SERBIAN = 'serbian';
    case SOUTHERN_SOTHO = 'southern sotho';
    case SHONA = 'shona';
    case SINDHI = 'sindhi';
    case SINHALA = 'sinhala';
    case SLOVAK = 'slovak';
    case SLOVENIAN = 'slovenian';
    case SOMALI = 'somali';
    case SPANISH = 'spanish';
    case SUNDANESE = 'sundanese';
    case SWAHILI = 'swahili';
    case SWEDISH = 'swedish';
    case TAJIK = 'tajik';
    case TAMIL = 'tamil';
    case TATAR = 'tatar';
    case TELUGU = 'telugu';
    case THAI = 'thai';
    case TURKISH = 'turkish';
    case TURKMEN = 'turkmen';
    case UKRAINIAN = 'ukrainian';
    case URDU = 'urdu';
    case UYGHUR = 'uyghur';
    case UZBEK = 'uzbek';
    case VIETNAMESE = 'vietnamese';
    case WELSH = 'welsh';
    case XHOSA = 'xhosa';
    case YIDDISH = 'yiddish';
    case YORUBA = 'yoruba';
    case ZULU = 'zulu';
    case AIMARA = 'aimara';
    case BERBER = 'berber';
    case BISLAMA = 'bislama';
    case BURMESE = 'burmese';
    case COMORIAN = 'comorian';
    case DHIVEHI = 'dhivehi';
    case DZONGKHA = 'dzongkha';
    case GUARANI = 'guarani';
    case HIRI_MOTU = 'hiri motu';
    case KIRUNDI = 'kirundi';
    case MARSHALLESE = 'marshallese';
    case MONTENEGRIN = 'montenegrin';
    case NAURUAN = 'nauruan';
    case QUECHUA = 'quechua';
    case SANGO = 'sango';
    case SEYCHELLOIS_CREOLE = 'seychellois creole';
    case TSWANA = 'tswana';
    case SWATI = 'swati';
    case TETUM = 'tetum';
    case TOK_PISIN = 'tok pisin';
    case TONGAN = 'tongan';
    case TIGRINYA = 'tigrinya';
    case FIJIAN = 'fijian';
    case NORTHERN_SOTHO = 'northern sotho';
    case SOUTH_NDEBELE = 'south ndebele';
    case NORTHERN_NDEBELE = 'northern ndebele';
    case TSONGA = 'tsonga';
    case VENDA = 'venda';
    case ROMANSH = 'romansh';
    case TUVALUAN = 'tuvaluan';

    /**
     * Returns the ISO 639-1 code of the language or `null` if the language has no ISO 639-1 code.
     *
     * @link https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes, https://en.wikipedia.org/wiki/ISO_639-1
     */
    public function iso6391Code(): ?string {
        return match ($this) {
            self::AFRIKAANS => 'af',
            self::ALBANIAN => 'sq',
            self::AMHARIC => 'am',
            self::ARABIC => 'ar',
            self::ARMENIAN => 'hy',
            self::AZERBAIJANI => 'az',
            self::BASQUE => 'eu',
            self::BELARUSIAN => 'be',
            self::BENGALI => 'bn',
            self::BOSNIAN => 'bs',
            self::BULGARIAN => 'bg',
            self::CATALAN => 'ca',
            self::CEBUANO => 'ceb',
            self::CHICHEWA => 'ny',
            self::CHINESE => 'zh',
            self::CORSICAN => 'co',
            self::CROATIAN => 'hr',
            self::CZECH => 'cs',
            self::DANISH => 'da',
            self::DUTCH => 'nl',
            self::ENGLISH => 'en',
            self::ESPERANTO => 'eo',
            self::ESTONIAN => 'et',
            self::FILIPINO => 'tl',
            self::FINNISH => 'fi',
            self::FRENCH => 'fr',
            self::FRISIAN => 'fy',
            self::GALICIAN => 'gl',
            self::GEORGIAN => 'ka',
            self::GERMAN => 'de',
            self::GREEK => 'el',
            self::GUJARATI => 'gu',
            self::HAITIAN_CREOLE => 'ht',
            self::HAUSA => 'ha',
            self::HEBREW => 'he',
            self::HINDI => 'hi',
            self::HUNGARIAN => 'hu',
            self::ICELANDIC => 'is',
            self::IGBO => 'ig',
            self::INDONESIAN => 'id',
            self::IRISH => 'ga',
            self::ITALIAN => 'it',
            self::JAPANESE => 'ja',
            self::JAVANESE => 'jv',
            self::KANNADA => 'kn',
            self::KAZAKH => 'kk',
            self::KHMER => 'km',
            self::KINYARWANDA => 'rw',
            self::KOREAN => 'ko',
            self::KURDISH => 'ku',
            self::KYRGYZ => 'ky',
            self::LAO => 'lo',
            self::LATIN => 'la',
            self::LATVIAN => 'lv',
            self::LITHUANIAN => 'lt',
            self::LUXEMBOURGISH => 'lb',
            self::MACEDONIAN => 'mk',
            self::MALAGASY => 'mg',
            self::MALAY => 'ms',
            self::MALAYALAM => 'ml',
            self::MALTESE => 'mt',
            self::MAORI => 'mi',
            self::MARATHI => 'mr',
            self::MONGOLIAN => 'mn',
            self::NEPALI => 'ne',
            self::NORWEGIAN => 'no',
            self::ODIA => 'or',
            self::PASHTO => 'ps',
            self::PERSIAN => 'fa',
            self::POLISH => 'pl',
            self::PORTUGUESE => 'pt',
            self::PUNJABI => 'pa',
            self::ROMANIAN => 'ro',
            self::RUSSIAN => 'ru',
            self::SAMOAN => 'sm',
            self::SCOTS_GAELIC => 'gd',
            self::SERBIAN => 'sr',
            self::SOUTHERN_SOTHO => 'st',
            self::SHONA => 'sn',
            self::SINDHI => 'sd',
            self::SINHALA => 'si',
            self::SLOVAK => 'sk',
            self::SLOVENIAN => 'sl',
            self::SOMALI => 'so',
            self::SPANISH => 'es',
            self::SUNDANESE => 'su',
            self::SWAHILI => 'sw',
            self::SWEDISH => 'sv',
            self::TAJIK => 'tg',
            self::TAMIL => 'ta',
            self::TATAR => 'tt',
            self::TELUGU => 'te',
            self::THAI => 'th',
            self::TURKISH => 'tr',
            self::TURKMEN => 'tk',
            self::UKRAINIAN => 'uk',
            self::URDU => 'ur',
            self::UZBEK => 'uz',
            self::VIETNAMESE => 'vi',
            self::WELSH => 'cy',
            self::XHOSA => 'xh',
            self::YIDDISH => 'yi',
            self::YORUBA => 'yo',
            self::ZULU => 'zu',
            self::AIMARA => 'ay',
            self::BISLAMA => 'bi',
            self::BURMESE => 'my',
            self::DHIVEHI => 'dv',
            self::DZONGKHA => 'dz',
            self::GUARANI => 'gn',
            self::KIRUNDI => 'rn',
            self::MARSHALLESE => 'mh',
            self::QUECHUA => 'qu',
            self::SANGO => 'sg',
            self::TSWANA => 'tn',
            self::SWATI => 'ss',
            self::TONGAN => 'to',
            self::TIGRINYA => 'ti',
            self::FIJIAN => 'fj',
            self::SOUTH_NDEBELE => 'nr',
            self::NORTHERN_NDEBELE => 'nd',
            self::TSONGA => 'ts',
            self::VENDA => 've',
            self::ROMANSH => 'rm',
            default => null,
        };
    }

    /**
     * Returns the ISO 639-2 code of the language or `null` if the language has no ISO 639-2 code.
     *
     * @link https://en.wikipedia.org/wiki/List_of_ISO_639-2_codes, https://en.wikipedia.org/wiki/ISO_639-2
     */
    public function iso6392Code(): ?string {
        return match ($this) {
            self::AFRIKAANS => 'afr',
            self::ALBANIAN => 'sqi',
            self::AMHARIC => 'amh',
            self::ARABIC => 'ara',
            self::ARMENIAN => 'hye',
            self::AZERBAIJANI => 'aze',
            self::BASQUE => 'eus',
            self::BELARUSIAN => 'bel',
            self::BENGALI => 'ben',
            self::BOSNIAN => 'bos',
            self::BULGARIAN => 'bul',
            self::CATALAN => 'cat',
            self::CEBUANO => 'ceb',
            self::CHICHEWA => 'nya',
            self::CHINESE => 'zho',
            self::CORSICAN => 'cos',
            self::CROATIAN => 'hrv',
            self::CZECH => 'ces',
            self::DANISH => 'dan',
            self::DUTCH => 'nld',
            self::ENGLISH => 'eng',
            self::ESPERANTO => 'epo',
            self::ESTONIAN => 'est',
            self::FILIPINO => 'fil',
            self::FINNISH => 'fin',
            self::FRENCH => 'fra',
            self::FRISIAN => 'fry',
            self::GALICIAN => 'glg',
            self::GEORGIAN => 'kat',
            self::GERMAN => 'deu',
            self::GREEK => 'ell',
            self::GUJARATI => 'guj',
            self::HAITIAN_CREOLE => 'hat',
            self::HAUSA => 'hau',
            self::HEBREW => 'heb',
            self::HINDI => 'hin',
            self::HUNGARIAN => 'hun',
            self::ICELANDIC => 'isl',
            self::IGBO => 'ibo',
            self::INDONESIAN => 'ind',
            self::IRISH => 'gle',
            self::ITALIAN => 'ita',
            self::JAPANESE => 'jpn',
            self::JAVANESE => 'jav',
            self::KANNADA => 'kan',
            self::KAZAKH => 'kaz',
            self::KHMER => 'khm',
            self::KINYARWANDA => 'kin',
            self::KOREAN => 'kor',
            self::KURDISH => 'kur',
            self::KYRGYZ => 'kir',
            self::LAO => 'lao',
            self::LATIN => 'lat',
            self::LATVIAN => 'lav',
            self::LITHUANIAN => 'lit',
            self::LUXEMBOURGISH => 'ltz',
            self::MACEDONIAN => 'mkd',
            self::MALAGASY => 'mlg',
            self::MALAY => 'msa',
            self::MALAYALAM => 'mal',
            self::MALTESE => 'mlt',
            self::MAORI => 'mri',
            self::MARATHI => 'mar',
            self::MONGOLIAN => 'mon',
            self::NEPALI => 'nep',
            self::NORWEGIAN => 'nor',
            self::ODIA => 'ori',
            self::PASHTO => 'pus',
            self::PERSIAN => 'fas',
            self::POLISH => 'pol',
            self::PORTUGUESE => 'por',
            self::PUNJABI => 'pan',
            self::ROMANIAN => 'ron',
            self::RUSSIAN => 'rus',
            self::SAMOAN => 'smo',
            self::SCOTS_GAELIC => 'gla',
            self::SERBIAN => 'srp',
            self::SOUTHERN_SOTHO => 'sot',
            self::SHONA => 'sna',
            self::SINDHI => 'snd',
            self::SINHALA => 'sin',
            self::SLOVAK => 'slk',
            self::SLOVENIAN => 'slv',
            self::SOMALI => 'som',
            self::SPANISH => 'spa',
            self::SUNDANESE => 'sun',
            self::SWAHILI => 'swa',
            self::SWEDISH => 'swe',
            self::TAJIK => 'tgk',
            self::TAMIL => 'tam',
            self::TATAR => 'tat',
            self::TELUGU => 'tel',
            self::THAI => 'tha',
            self::TURKISH => 'tur',
            self::TURKMEN => 'tuk',
            self::UKRAINIAN => 'ukr',
            self::URDU => 'urd',
            self::UZBEK => 'uzb',
            self::VIETNAMESE => 'vie',
            self::WELSH => 'cym',
            self::XHOSA => 'xho',
            self::YIDDISH => 'yid',
            self::YORUBA => 'yor',
            self::ZULU => 'zul',
            self::AIMARA => 'aym',
            self::BERBER => 'ber',
            self::BISLAMA => 'bis',
            self::BURMESE => 'mya',
            self::DHIVEHI => 'div',
            self::DZONGKHA => 'dzo',
            self::GUARANI => 'grn',
            self::KIRUNDI => 'run',
            self::MARSHALLESE => 'mah',
            self::QUECHUA => 'que',
            self::SANGO => 'sag',
            self::TSWANA => 'tsn',
            self::SWATI => 'ssw',
            self::TETUM => 'tet',
            self::TONGAN => 'ton',
            self::TIGRINYA => 'tir',
            self::FIJIAN => 'fij',
            self::NORTHERN_SOTHO => 'nso',
            self::SOUTH_NDEBELE => '',
            self::NORTHERN_NDEBELE => '',
            self::TSONGA => 'tso',
            self::VENDA => 'ven',
            self::ROMANSH => 'roh',
            self::TUVALUAN => 'tvl',
            default => null,
        };
    }

    /**
     * Returns the ISO 639-3 code of the language or `null` if the language has no ISO 639-3 code.
     *
     * @link https://en.wikipedia.org/wiki/List_of_ISO_639-3_codes, https://en.wikipedia.org/wiki/ISO_639-3
     */
    public function iso6393Code(): ?string {
        return match ($this) {
            self::AFRIKAANS => 'afr',
            self::ALBANIAN => 'sqi',
            self::AMHARIC => 'amh',
            self::ARABIC => 'ara',
            self::ARMENIAN => 'hye',
            self::AZERBAIJANI => 'aze',
            self::BASQUE => 'eus',
            self::BELARUSIAN => 'bel',
            self::BENGALI => 'ben',
            self::BOSNIAN => 'bos',
            self::BULGARIAN => 'bul',
            self::CATALAN => 'cat',
            self::CEBUANO => 'ceb',
            self::CHICHEWA => 'nya',
            self::CHINESE => 'zho',
            self::CORSICAN => 'cos',
            self::CROATIAN => 'hrv',
            self::CZECH => 'ces',
            self::DANISH => 'dan',
            self::DUTCH => 'nld',
            self::ENGLISH => 'eng',
            self::ESPERANTO => 'epo',
            self::ESTONIAN => 'est',
            self::FILIPINO => 'fil',
            self::FINNISH => 'fin',
            self::FRENCH => 'fra',
            self::FRISIAN => 'fry',
            self::GALICIAN => 'glg',
            self::GEORGIAN => 'kat',
            self::GERMAN => 'deu',
            self::GREEK => 'ell',
            self::GUJARATI => 'guj',
            self::HAITIAN_CREOLE => 'hat',
            self::HAUSA => 'hau',
            self::HEBREW => 'heb',
            self::HINDI => 'hin',
            self::HUNGARIAN => 'hun',
            self::ICELANDIC => 'isl',
            self::IGBO => 'ibo',
            self::INDONESIAN => 'ind',
            self::IRISH => 'gle',
            self::ITALIAN => 'ita',
            self::JAPANESE => 'jpn',
            self::JAVANESE => 'jav',
            self::KANNADA => 'kan',
            self::KAZAKH => 'kaz',
            self::KHMER => 'khm',
            self::KINYARWANDA => 'kin',
            self::KOREAN => 'kor',
            self::KURDISH => 'kur',
            self::KYRGYZ => 'kir',
            self::LAO => 'lao',
            self::LATIN => 'lat',
            self::LATVIAN => 'lav',
            self::LITHUANIAN => 'lit',
            self::LUXEMBOURGISH => 'ltz',
            self::MACEDONIAN => 'mkd',
            self::MALAGASY => 'mlg',
            self::MALAY => 'msa',
            self::MALAYALAM => 'mal',
            self::MALTESE => 'mlt',
            self::MAORI => 'mri',
            self::MARATHI => 'mar',
            self::MONGOLIAN => 'mon',
            self::NEPALI => 'nep',
            self::NORWEGIAN => 'nor',
            self::ODIA => 'ori',
            self::PASHTO => 'pus',
            self::PERSIAN => 'fas',
            self::POLISH => 'pol',
            self::PORTUGUESE => 'por',
            self::PUNJABI => 'pan',
            self::ROMANIAN => 'ron',
            self::RUSSIAN => 'rus',
            self::SAMOAN => 'smo',
            self::SCOTS_GAELIC => 'gla',
            self::SERBIAN => 'srp',
            self::SOUTHERN_SOTHO => 'sot',
            self::SHONA => 'sna',
            self::SINDHI => 'snd',
            self::SINHALA => 'sin',
            self::SLOVAK => 'slk',
            self::SLOVENIAN => 'slv',
            self::SOMALI => 'som',
            self::SPANISH => 'spa',
            self::SUNDANESE => 'sun',
            self::SWAHILI => 'swa',
            self::SWEDISH => 'swe',
            self::TAJIK => 'tgk',
            self::TAMIL => 'tam',
            self::TATAR => 'tat',
            self::TELUGU => 'tel',
            self::THAI => 'tha',
            self::TURKISH => 'tur',
            self::TURKMEN => 'tuk',
            self::UKRAINIAN => 'ukr',
            self::URDU => 'urd',
            self::UZBEK => 'uzb',
            self::VIETNAMESE => 'vie',
            self::WELSH => 'cym',
            self::XHOSA => 'xho',
            self::YIDDISH => 'yid',
            self::YORUBA => 'yor',
            self::ZULU => 'zul',
            self::AIMARA => 'aym',
            self::BISLAMA => 'bis',
            self::BURMESE => 'mya',
            self::DHIVEHI => 'div',
            self::DZONGKHA => 'dzo',
            self::GUARANI => 'grn',
            self::KIRUNDI => 'run',
            self::MARSHALLESE => 'mah',
            self::QUECHUA => 'que',
            self::SANGO => 'sag',
            self::TSWANA => 'tsn',
            self::SWATI => 'ssw',
            self::TETUM => 'tet',
            self::TONGAN => 'ton',
            self::TIGRINYA => 'tir',
            self::FIJIAN => 'fij',
            self::NORTHERN_SOTHO => 'nso',
            self::SOUTH_NDEBELE => '',
            self::NORTHERN_NDEBELE => '',
            self::TSONGA => 'tso',
            self::VENDA => 'ven',
            self::ROMANSH => 'roh',
            self::TUVALUAN => 'tvl',
            default => null,
        };
    }
}
