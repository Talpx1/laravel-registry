<?php

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\ConvertsValueToLabel;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

// TODO: refactor values to be the domain name segment of the provider
// TODO: add countriesOfUse() method to return an array with countries enum instances where this provider is used

/**
 * Enum of all the e-mail address providers.
 *
 * Note that the list or its bindings may be incomplete or not up-to-date.
 * If you find an error or an inconsistency, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum EmailAddressProviders: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, ConvertsValueToLabel, HasRandomTrait;

    case _123MAIL = '123 mail';
    case _150MAIL = '150 mail';
    case _16MAIL = '16 mail';
    case _2MAIL = '2 mail';
    case _4EMAIL = '4 email';
    case _50MAIL = '50 mail';
    case AIM = 'aim';
    case AIRPOST = 'airpost';
    case ALICE = 'alice';
    case ALICEADSL = 'aliceadsl';
    case ALLMAIL = 'allmail';
    case AOL = 'aol';
    case ARCOR = 'arcor';
    case ARUBA = 'aruba';
    case ATT = 'att';
    case ATTORNEYMAIL = 'attorneymail';
    case BARMAIL = 'barmail';
    case BELLSOUTH = 'bellsouth';
    case BESTMAIL = 'bestmail';
    case BIGPOND = 'bigpond';
    case BK = 'bk';
    case BLUEWIN = 'bluewin';
    case BLUEYONDER = 'blueyonder';
    case BOL = 'bol';
    case CENTURYTEL = 'centurytel';
    case CHARTER = 'charter';
    case CHELLO = 'chello';
    case CLUB_INTERNET = 'club internet';
    case CLUEMAIL = 'cluemail';
    case COLLABORATIVE = 'collaborative';
    case COMCAST = 'comcast';
    case COX = 'cox';
    case DIPLOMAIL = 'diplomail';
    case EARTHLINK = 'earthlink';
    case ELITEMAIL = 'elitemail';
    case EMAILCORNER = 'emailcorner';
    case EMAILENGINE = 'emailengine';
    case EMAILGROUPS = 'emailgroups';
    case EMAILPLUS = 'emailplus';
    case EMAILUSER = 'emailuser';
    case EML = 'eml';
    case EXCITE = 'excite';
    case FM = 'f-m';
    case FACEBOOK = 'facebook';
    case FAST_EMAIL = 'fast email';
    case FAST_MAIL = 'fast mail';
    case FASTEM = 'fastem';
    case FASTEMAIL = 'fastemail';
    case FASTEMAILER = 'fastemailer';
    case FASTEST = 'fastest';
    case FASTIMAP = 'fastimap';
    case FASTMAIL = 'fastmail';
    case FASTMAILBOX = 'fastmailbox';
    case FASTMESSAGING = 'fastmessaging';
    case FEA = 'fea';
    case FMAIL = 'fmail';
    case FMAILBOX = 'fmailbox';
    case FMGIRL = 'fmgirl';
    case FMGUY = 'fmguy';
    case FREE = 'free';
    case FREEDOMMAIL = 'freedommail';
    case FREENET = 'freenet';
    case FRONTIERNET = 'frontiernet';
    case FTML = 'ftml';
    case GANDI = 'gandi';
    case GMAIL = 'gmail';
    case GMX = 'gmx';
    case GOOGLEMAIL = 'google mail';
    case GROUPOFFICE = 'groupoffice';
    case H_MAIL = 'h mail';
    case HAILMAIL = 'hailmail';
    case HETNET = 'hetnet';
    case HEY = 'hey';
    case HOME = 'home';
    case HOTMAIL = 'hotmail';
    case HUSHMAIL = 'hushmail';
    case ICLOUD = 'icloud';
    case IG = 'ig';
    case IMAP_MAIL = 'imap-mail';
    case IMAP = 'imap';
    case IMAPMAIL = 'imapmail';
    case INBOX = 'inbox';
    case INOUTBOX = 'inoutbox';
    case INTERNET_E_MAIL = 'internet e mail';
    case INTERNET_MAIL = 'internet mail';
    case INTERNET = 'internet';
    case INTERNETEMAILS = 'internetemails';
    case INTERNETMAILING = 'internetmailing';
    case JETEMAIL = 'jetemail';
    case JOURNALISTMAIL = 'journalistmail';
    case JUNO = 'juno';
    case JUSTEMAIL = 'justemail';
    case KEEMAIL = 'keemail';
    case KOLABNOW = 'kolabnow';
    case LAPOSTE = 'laposte';
    case LEGALPRIVILEGE = 'legalprivilege';
    case LETTERBOXES = 'letterboxes';
    case LIBERO = 'libero';
    case LIBERTYMAIL = 'libertymail';
    case LIST = 'list';
    case LIVE = 'live';
    case LYCOS = 'lycos';
    case MAC = 'mac';
    case MAIL_CENTRAL = 'mail central';
    case MAIL_PAGE = 'mail page';
    case MAIL = 'mail';
    case MAILANDFTP = 'mailandftp';
    case MAILATLAW = 'mailatlaw';
    case MAILBOLT = 'mailbolt';
    case MAILC = 'mailc';
    case MAILCAN = 'mailcan';
    case MAILFORCE = 'mailforce';
    case MAILFTP = 'mailftp';
    case MAILHAVEN = 'mailhaven';
    case MAILHOST = 'mailhost';
    case MAILHOUSE = 'mailhouse';
    case MAILINGADDRESS = 'mailingaddress';
    case MAILITE = 'mailite';
    case MAILMIGHT = 'mailmight';
    case MAILNEW = 'mailnew';
    case MAILSENT = 'mailsent';
    case MAILSERVICE = 'mailservice';
    case MAILUP = 'mailup';
    case MAILWORKS = 'mailworks';
    case ME = 'me';
    case MEDMAIL = 'medmail';
    case MESSAGEBOX = 'messagebox';
    case ML1 = 'ml1';
    case MM = 'mm';
    case MSN = 'msn';
    case MYFASTMAIL = 'myfastmail';
    case MYKOLAB = 'mykolab';
    case MYMACMAIL = 'mymacmail';
    case MYSWISSMAIL = 'myswissmail';
    case NEUF = 'neuf';
    case NOSPAMMAIL = 'nospammail';
    case NTLWORLD = 'ntlworld';
    case OFFSHORE = 'offshore';
    case OPENGROUPWARE = 'opengroupware';
    case OPTONLINE = 'optonline';
    case OPTUSNET = 'optusnet';
    case ORANGE = 'orange';
    case OUTLOOK = 'outlook';
    case OWNMAIL = 'ownmail';
    case PETML = 'petml';
    case PLANET = 'planet';
    case POSTEO = 'posteo';
    case POSTINBOX = 'postinbox';
    case POSTPRO = 'postpro';
    case PRESSMAIL = 'pressmail';
    case PROINBOX = 'proinbox';
    case PROMESSAGE = 'promessage';
    case PROTOMNMAIL = 'protomnmail';
    case QQ = 'qq';
    case RAMBLER = 'rambler';
    case RBOX = 'rbox';
    case RBX = 'rbx';
    case REALEMAIL = 'realemail';
    case REALLYFAST = 'reallyfast';
    case REDIFFMAIL = 'rediffmail';
    case RNBX = 'rnbx';
    case ROCKETMAIL = 'rocketmail';
    case RUNBOX = 'runbox';
    case RUSHPOST = 'rushpost';
    case SBCGLOBAL = 'sbcglobal';
    case SENT = 'sent';
    case SFR = 'sfr';
    case SHAW = 'shaw';
    case SKY = 'sky';
    case SKYNET = 'skynet';
    case SPEEDPOST = 'speedpost';
    case SPEEDYMAIL = 'speedymail';
    case SSL_MAIL = 'ssl mail';
    case SWIFT_MAIL = 'swift mail';
    case SWISSGROUPWARE = 'swissgroupware';
    case SWITZERLANDMAIL = 'switzerlandmail';
    case SYMPATICO = 'sympatico';
    case T_ONLINE = 't online';
    case TELENET = 'telenet';
    case TERRA = 'terra';
    case THE_FASTEST = 'the fastest';
    case THE_QUICKEST = 'the quickest';
    case THEINTERNETEMAIL = 'theinternetemail';
    case TIN = 'tin';
    case TISCALI = 'tiscali';
    case TRUSTED_LEGAL_MAIL = 'trusted legal mail';
    case TUTA = 'tuta';
    case TUTAMAIL = 'tutamail';
    case TUTANOTA = 'tutanota';
    case UOL = 'uol';
    case VERIZON = 'verizon';
    case VERYFAST = 'veryfast';
    case VERYSPEEDY = 'veryspeedy';
    case VIRGILIO = 'virgilio';
    case VOILA = 'voila';
    case WANADOO = 'wanadoo';
    case WARPMAIL = 'warpmail';
    case WEB = 'web';
    case WINDSTREAM = 'windstream';
    case XOBNUR = 'xobnur';
    case XSMAIL = 'xsmail';
    case YAHOO = 'yahoo';
    case YANDEX = 'yandex';
    case YEPMAIL = 'yepmail';
    case YMAIL = 'ymail';
    case YOUR_MAIL = 'your mail';
    case ZOHOMAIL = 'zohomail';
    case ZONNET = 'zonnet';
    case INFOCERT = 'infocert';
    case TWT = 'twt';
    case REGISTER_IT = 'register it';
    case POSTE_ITALIANE = 'poste italiane';
    case NAMIRIAL = 'namirial';
    case CEDACRI_CERT = 'cedacri cert';
    case IN_TE_SA = 'in.te.sa';

    /**
     * Returns an array of root domains for the email address provider.
     *
     * @return string[]
     */
    public function availableRootDomains(): array {
        return match ($this) {
            self::_150MAIL => ['.com', '.net', '.us'],
            self::_16MAIL => ['.com', '.net'],
            self::_2MAIL => ['.com', '.net'],
            self::_4EMAIL => ['.com', '.net'],
            self::_50MAIL => ['.com', '.net'],
            self::AIM => ['.com', '.net'],
            self::AIRPOST => ['.com'],
            self::ALICE => ['.com', '.fr'],
            self::ALICEADSL => ['.com', '.fr'],
            self::ALLMAIL => ['.com', '.ru'],
            self::AOL => ['.com', '.uk'],
            self::ARCOR => ['.de', '.at'],
            self::ARUBA => ['.nl'],
            self::ATT => ['.com', '.net'],
            self::ATTORNEYMAIL => ['.com', '.net'],
            self::BARMAIL => ['.com'],
            self::BELLSOUTH => ['.com'],
            self::BESTMAIL => ['.com'],
            self::BIGPOND => ['.co.uk'],
            self::BK => ['.com'],
            self::BLUEWIN => ['.ch'],
            self::BLUEYONDER => ['.de'],
            self::BOL => ['.com', '.br'],
            self::CENTURYTEL => ['.com'],
            self::CHARTER => ['.com', '.net'],
            self::CHELLO => ['.fr'],
            self::CLUB_INTERNET => ['.fr'],
            self::CLUEMAIL => ['.com', '.nl'],
            self::COLLABORATIVE => ['.com'],
            self::COMCAST => ['.com'],
            self::COX => ['.com'],
            self::DIPLOMAIL => ['.de'],
            self::EARTHLINK => ['.com'],
            self::ELITEMAIL => ['.com'],
            self::EMAILCORNER => ['.com', '.net'],
            self::EMAILENGINE => ['.com'],
            self::EMAILGROUPS => ['.com', '.net'],
            self::EMAILPLUS => ['.com', '.net'],
            self::EMAILUSER => ['.com', '.net'],
            self::EML => ['.com'],
            self::EXCITE => ['.com', '.net'],
            self::FM => ['.com', '.net'],
            self::FACEBOOK => ['.com', '.me'],
            self::FAST_EMAIL => ['.com'],
            self::FAST_MAIL => ['.com'],
            self::FASTEM => ['.com'],
            self::FASTEMAIL => ['.com'],
            self::FASTEMAILER => ['.com'],
            self::FASTEST => ['.com'],
            self::FASTIMAP => ['.com'],
            self::FASTMAIL => ['.com', '.net'],
            self::FASTMAILBOX => ['.com'],
            self::FASTMESSAGING => ['.com'],
            self::FEA => ['.com'],
            self::FMAIL => ['.com'],
            self::FMAILBOX => ['.com'],
            self::FMGIRL => ['.com'],
            self::FMGUY => ['.com'],
            self::FREE => ['.com', '.net'],
            self::FREEDOMMAIL => ['.com'],
            self::FREENET => ['.de'],
            self::FRONTIERNET => ['.com'],
            self::FTML => ['.com'],
            self::GANDI => ['.fr', '.net', '.us'],
            self::GMAIL => ['.com', '.co.uk', '.edu'],
            self::GMX => ['.de', '.at'],
            self::GOOGLEMAIL => ['.com', '.co.uk'],
            self::GROUPOFFICE => ['.org', '.net'],
            self::H_MAIL => ['.com'],
            self::HAILMAIL => ['.com'],
            self::HETNET => ['.nl'],
            self::HEY => ['.com'],
            self::HOME => ['.com'],
            self::HOTMAIL => ['.com', '.uk'],
            self::HUSHMAIL => ['.com'],
            self::ICLOUD => ['.com', '.me'],
            self::IG => ['.com', '.me'],
            self::IMAP_MAIL => ['.com'],
            self::IMAP => ['.com'],
            self::IMAPMAIL => ['.com'],
            self::INBOX => ['.com'],
            self::INOUTBOX => ['.com'],
            self::INTERNET_E_MAIL => ['.com'],
            self::INTERNET_MAIL => ['.com', '.net'],
            self::INTERNET => ['.com'],
            self::INTERNETEMAILS => ['.com'],
            self::INTERNETMAILING => ['.com'],
            self::JETEMAIL => ['.com'],
            self::JOURNALISTMAIL => ['.com'],
            self::JUNO => ['.com', '.net'],
            self::JUSTEMAIL => ['.com'],
            self::KEEMAIL => ['.com'],
            self::KOLABNOW => ['.org'],
            self::LAPOSTE => ['.fr'],
            self::LEGALPRIVILEGE => ['.com'],
            self::LETTERBOXES => ['.com'],
            self::LIBERO => ['.it', '.net'],
            self::LIBERTYMAIL => ['.com'],
            self::LIST => ['.com'],
            self::LIVE => ['.com'],
            self::LYCOS => ['.co.uk', '.de'],
            self::MAC => ['.com'],
            self::MAIL_CENTRAL => ['.com'],
            self::MAIL_PAGE => ['.com'],
            self::MAIL => ['.com', '.net'],
            self::MAILANDFTP => ['.com'],
            self::MAILATLAW => ['.com'],
            self::MAILBOLT => ['.com'],
            self::MAILC => ['.com'],
            self::MAILCAN => ['.com'],
            self::MAILFORCE => ['.com'],
            self::MAILFTP => ['.com'],
            self::MAILHAVEN => ['.com'],
            self::MAILHOST => ['.com'],
            self::MAILHOUSE => ['.com'],
            self::MAILINGADDRESS => ['.com'],
            self::MAILITE => ['.com'],
            self::MAILMIGHT => ['.com'],
            self::MAILNEW => ['.com'],
            self::MAILSENT => ['.com'],
            self::MAILSERVICE => ['.com'],
            self::MAILUP => ['.com'],
            self::MAILWORKS => ['.com'],
            self::ME => ['.com'],
            self::MEDMAIL => ['.com'],
            self::MESSAGEBOX => ['.com'],
            self::ML1 => ['.com'],
            self::MM => ['.com'],
            self::MSN => ['.com', '.net'],
            self::MYFASTMAIL => ['.com'],
            self::MYKOLAB => ['.org'],
            self::MYSWISSMAIL => ['.ch'],
            self::NEUF => ['.fr'],
            self::NOSPAMMAIL => ['.com'],
            self::NTLWORLD => ['.uk'],
            self::OFFSHORE => ['.com'],
            self::OPENGROUPWARE => ['.org', '.net'],
            self::OPTONLINE => ['.com'],
            self::OPTUSNET => ['.com'],
            self::ORANGE => ['.fr', '.be', '.lu'],
            self::OUTLOOK => ['.com', '.co.uk', '.edu'],
            self::OWNMAIL => ['.com'],
            self::PETML => ['.com'],
            self::PLANET => ['.de', '.at'],
            self::POSTEO => ['.net', '.us', '.ca'],
            self::POSTINBOX => ['.com'],
            self::POSTPRO => ['.com'],
            self::PRESSMAIL => ['.com'],
            self::PROINBOX => ['.com'],
            self::PROMESSAGE => ['.com'],
            self::PROTOMNMAIL => ['.com'],
            self::QQ => ['.com', '.net'],
            self::RAMBLER => ['.ru'],
            self::RBOX => ['.com'],
            self::RBX => ['.com'],
            self::REALEMAIL => ['.com'],
            self::REALLYFAST => ['.com'],
            self::REDIFFMAIL => ['.com'],
            self::RNBX => ['.com'],
            self::ROCKETMAIL => ['.com'],
            self::RUNBOX => ['.com'],
            self::RUSHPOST => ['.com'],
            self::SBCGLOBAL => ['.com', '.net'],
            self::SENT => ['.com'],
            self::SFR => ['.fr'],
            self::SHAW => ['.ca'],
            self::SKY => ['.co.uk', '.ie'],
            self::SKYNET => ['.uk'],
            self::SPEEDPOST => ['.com'],
            self::SPEEDYMAIL => ['.com'],
            self::SSL_MAIL => ['.com'],
            self::SWIFT_MAIL => ['.com'],
            self::SWISSGROUPWARE => ['.ch'],
            self::SWITZERLANDMAIL => ['.ch'],
            self::SYMPATICO => ['.ca'],
            self::T_ONLINE => ['.de', '.at'],
            self::TELENET => ['.be', '.lu'],
            self::TERRA => ['.com'],
            self::THE_FASTEST => ['.com'],
            self::THE_QUICKEST => ['.com'],
            self::THEINTERNETEMAIL => ['.com'],
            self::TIN => ['.co.uk', '.de'],
            self::TISCALI => ['.it'],
            self::TRUSTED_LEGAL_MAIL => ['.com'],
            self::TUTA => ['.es'],
            self::TUTAMAIL => ['.es'],
            self::TUTANOTA => ['.ch', '.at', '.de'],
            self::UOL => ['.br'],
            self::VERIZON => ['.com', '.net'],
            self::VERYFAST => ['.com'],
            self::VERYSPEEDY => ['.com'],
            self::VIRGILIO => ['.it'],
            self::VOILA => ['.fr'],
            self::WANADOO => ['.fr', '.co.uk'],
            self::WARPMAIL => ['.com'],
            self::WEB => ['.com'],
            self::WINDSTREAM => ['.net'],
            self::XOBNUR => ['.tr'],
            self::XSMAIL => ['.de'],
            self::YAHOO => ['.com', '.uk', '.ru'],
            self::YANDEX => ['.com', '.ru'],
            self::YEPMAIL => ['.com'],
            self::YMAIL => ['.com'],
            self::YOUR_MAIL => ['.com'],
            self::ZOHOMAIL => ['.com'],
            self::ZONNET => ['.nl'],
            self::_123MAIL => ['.com'],
            self::MYMACMAIL => ['.com'],
            self::INFOCERT => ['.it'],
            self::TWT => ['.it'],
            self::REGISTER_IT => ['.it'],
            self::POSTE_ITALIANE => ['.it'],
            self::NAMIRIAL => ['.it'],
            self::CEDACRI_CERT => ['.it'],
            self::IN_TE_SA => ['.it'],
        };
    }

    /**
     * Returns true if the email address provider issues certified addresses like a PEC or similar.
     *
     * @link https://en.wikipedia.org/wiki/Certified_email
     */
    public function issuesCertifiedAddresses(): bool {
        return match ($this) {
            self::INFOCERT,
            self::TWT,
            self::REGISTER_IT,
            self::POSTE_ITALIANE,
            self::NAMIRIAL,
            self::CEDACRI_CERT,
            self::IN_TE_SA => true,
            default => false,
        };
    }
}
