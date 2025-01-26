<?php

declare(strict_types=1);

/**
 * Expect that a value is either lowercase or uppercase,
 * counting as valid characters also the one passed in the argument array.
 *
 * All numbers may be allowed passing `numbers`.
 * Dashes (`-`,  `_`) may be allowed passing `dashes`.
 * Spaces (` `) may be allowed passing `spaces`.
 * Symbols may be allowed passing `symbols`
 *
 * @throws \InvalidArgumentException if `$casing` is not 'lowercase' or 'uppercase' (case-insensitive)
 */
expect()->extend('toBeCasingAllowing', function (string $casing, array $allowed_characters = []) {
    $casing = ucfirst(strtolower($casing));

    if (! in_array($casing, ['Lowercase', 'Uppercase'])) {
        throw new \InvalidArgumentException('Invalid casing type');
    }

    $casing_method = "toBe{$casing}";

    if ($allowed_characters === []) {
        return $this->{$casing_method}();
    }

    $allowed_characters = substituteCharacterSetsWithActualCharacters($allowed_characters);

    $normalized_value = str_replace($allowed_characters, '', $this->value);

    expect($normalized_value)->{$casing_method}();
});

/**
 * Expect that a value is lowercase,
 * counting as valid characters also the one passed in the argument array.
 *
 * All numbers may be allowed passing `numbers`.
 * Dashes (`-`,  `_`) may be allowed passing `dashes`.
 * Spaces (` `) may be allowed passing `spaces`.
 * Symbols may be allowed passing `symbols`
 */
expect()->extend('toBeLowercaseAllowing', function (array $allowed_characters = []) {
    return $this->toBeCasingAllowing('lowercase', $allowed_characters);
});

/**
 * Expect that a value is uppercase,
 * counting as valid characters also the one passed in the argument array.
 *
 * All numbers may be allowed passing `numbers`.
 * Dashes (`-`,  `_`) may be allowed passing `dashes`.
 * Spaces (` `) may be allowed passing `spaces`.
 * Symbols may be allowed passing `symbols`
 */
expect()->extend('toBeUppercaseAllowing', function (array $allowed_characters = []) {
    return $this->toBeCasingAllowing('uppercase', $allowed_characters);
});

/** Expect that a value is uppercase, allowing for numbers.  */
expect()->extend('toBeUppercaseAllowingNumbers', function () {
    return $this->toBeUppercaseAllowing(['numbers']);
});

/** Expect that a value is uppercase, allowing for spaces.  */
expect()->extend('toBeUppercaseAllowingSpaces', function () {
    return $this->toBeUppercaseAllowing(['spaces']);
});

/** Expect that a value is uppercase, allowing for dashes (`-`,  `_`).  */
expect()->extend('toBeUppercaseAllowingDashes', function () {
    return $this->toBeUppercaseAllowing(['dashes']);
});

/**
 * Expect that a value is uppercase, allowing for symbols.
 * Symbols are: `-`, `!`, `$`, `@`, `#`, `%`, `^`, `&`, `*`, `(`, `)`, `_`, `+`, `|`, `~`, `=`, ```, `{`, `}`, `\`, `[`, `]`, `:`, `"`, `;`, `'`, `<`, `>`, `?`, `,`, `.`, `/`
 */
expect()->extend('toBeUppercaseAllowingSymbols', function () {
    return $this->toBeUppercaseAllowing(['symbols']);
});

/**
 * Expect that a value is uppercase, allowing non word characters (numbers, spaces, symbols).
 *
 * @internal dashes are comprehended in symbols, so no need of specifying that set.
 */
expect()->extend('toBeUppercaseAllowingNonWordChars', function () {
    return $this->toBeUppercaseAllowing(['numbers', 'spaces', 'symbols']);
});

/** Expect that a value is lowercase, allowing for numbers.  */
expect()->extend('toBeLowercaseAllowingNumbers', function () {
    return $this->toBeLowercaseAllowing(['numbers']);
});

/** Expect that a value is lowercase, allowing for spaces.  */
expect()->extend('toBeLowercaseAllowingSpaces', function () {
    return $this->toBeLowercaseAllowing(['spaces']);
});

/** Expect that a value is lowercase, allowing for dashes (`-`,  `_`).  */
expect()->extend('toBeLowercaseAllowingDashes', function () {
    return $this->toBeLowercaseAllowing(['dashes']);
});

/**
 * Expect that a value is uppercase, allowing for symbols.
 * Symbols are: `-`, `!`, `$`, `@`, `#`, `%`, `^`, `&`, `*`, `(`, `)`, `_`, `+`, `|`, `~`, `=`, ```, `{`, `}`, `\`, `[`, `]`, `:`, `"`, `;`, `'`, `<`, `>`, `?`, `,`, `.`, `/`
 */
expect()->extend('toBeUppercaseAllowingSymbols', function () {
    return $this->toBeLowercaseAllowing(['symbols']);
});

/**
 * Expect that a value is lowercase, allowing non word characters (numbers, spaces, symbols).
 *
 * @internal dashes are comprehended in symbols, so no need of specifying that set.
 */
expect()->extend('toBeLowercaseAllowingNonWordChars', function () {
    return $this->toBeLowercaseAllowing(['numbers', 'spaces', 'symbols']);
});
