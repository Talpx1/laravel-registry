<?php

namespace Talp1\LaravelRegistry\Enums;

use Talp1\LaravelRegistry\Enums\Contracts\CanBeCollected;
use Talp1\LaravelRegistry\Enums\Contracts\HasLabels;
use Talp1\LaravelRegistry\Enums\Contracts\HasRandom;
use Talp1\LaravelRegistry\Enums\Traits\CanBeCollected as CanBeCollectedTrait;
use Talp1\LaravelRegistry\Enums\Traits\HasRandom as HasRandomTrait;

/**
 * Enum of all the social networks.
 *
 * Note that the list or its bindings may be incomplete or not up-to-date.
 * If you find an error or an inconsistency, please open an issue or a pull request at {@link https://github.com/Talpx1/laravel-registry}
 *
 * @implements CanBeCollected<string>
 * @implements HasRandom<string>
 */
enum SocialNetworks: string implements CanBeCollected, HasLabels, HasRandom {
    /**
     * @use CanBeCollectedTrait<string>
     * @use HasRandomTrait<string>
     */
    use CanBeCollectedTrait, HasRandomTrait;

    case BEREAL = 'bereal';
    case BITBUCKET = 'bitbucket';
    case CLUBHOUSE = 'clubhouse';
    case DISCORD = 'discord';
    case DOUYIN = 'douyin';
    case DUOLINGO = 'duolingo';
    case FACEBOOK = 'facebook';
    case FLICKR = 'flickr';
    case GITHUB = 'github';
    case GITLAB = 'gitlab';
    case INSTAGRAM = 'instagram';
    case KUAISHOU = 'kuaishou';
    case LINE = 'line';
    case LINKEDIN = 'linkedin';
    case MESSENGER = 'messenger';
    case MEDIUM = 'medium';
    case PINTEREST = 'pinterest';
    case QQ = 'qq';
    case QUORA = 'quora';
    case REDDIT = 'reddit';
    case SLACK = 'slack';
    case SNAPCHAT = 'snapchat';
    case SOUNDCLOUD = 'soundcloud';
    case STACK_OVERFLOW = 'stack overflow';
    case STEAM = 'steam';
    case TELEGRAM = 'telegram';
    case THREADS = 'threads';
    case TIKTOK = 'tiktok';
    case TUMBLR = 'tumblr';
    case TWITCH = 'twitch';
    case VIMEO = 'vimeo';
    case VK = 'vk';
    case WECHAT = 'wechat';
    case WHATSAPP = 'whatsapp';
    case X = 'x';
    case YOUTUBE = 'youtube';

    /**
     * Returns a label for the given case
     */
    public function label(): string {
        return match ($this) {
            default => ucwords($this->value),
            self::TIKTOK => 'TikTok',
            self::LINKEDIN => 'LinkedIn',
            self::YOUTUBE => 'YouTube',
            self::WHATSAPP => 'WhatsApp',
            self::WECHAT => 'WeChat',
            self::QQ => 'QQ',
            self::GITHUB => 'GitHub',
            self::GITLAB => 'GitLab',
            self::BEREAL => 'BeReal',
            self::SOUNDCLOUD => 'SoundCloud',
            self::VK => 'VK',
        };
    }

    public function handlePrefix(): ?string {
        return match ($this) {
            self::X,
            self::INSTAGRAM,
            self::TIKTOK,
            self::GITHUB,
            self::GITLAB,
            self::DISCORD,
            self::SLACK,
            self::TELEGRAM,
            self::TWITCH => '@',
            self::REDDIT => 'u/',
            default => null,
        };
    }
}
