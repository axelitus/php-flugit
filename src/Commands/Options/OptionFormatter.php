<?php
/**
 * FluGit is a PHP package for using Git through a fluent interface.
 *
 * @package    axelitus\FluGit
 * @version    0.1
 * @author     Axel Pardemann
 * @license    MIT License
 * @copyright  2016 axelitus
 * @link       https://github.com/axelitus/flugit
 */
declare(strict_types = 1);

namespace axelitus\FluGit\Commands\Options;

/**
 * Class OptionFormatter
 * @package axelitus\FluGit\Commands
 */
class OptionFormatter
{
    /**
     * Formats a bool command option.
     * @param string $option The option name.
     * @param bool $value The option value.
     * @return string Returns the formatted option.
     */
    public static function formatBool(string $option, bool $value)
    {
        return (($value) ? ' ' . $option : '');
    }

    /**
     * Formats a bool command option that has a counterpart (local vs. no-local).
     * The $option takes precedence over it's counterpart.
     * @param string $option The $option name.
     * @param bool $value The option value.
     * @param string $optionCounterpart The counterpart option name.
     * @param bool $valueCounterpart The counterpart option value.
     * @return string Returns the formatted option.
     */
    public static function formatBoolWithCounterpart(
        string $option,
        bool $value,
        string $optionCounterpart,
        bool $valueCounterpart
    ) {
        return (($value) ? ' ' . $option : (($valueCounterpart) ? ' ' . $optionCounterpart : ''));
    }

    /**
     * Formats a "bool or string" command option.
     * @param string $option The option name.
     * @param bool|string|null $value The option value.
     * @return string Returns the formatted option.
     */
    public static function formatBoolOrString(string $option, $value)
    {
        return (($value !== null) ?
            ' ' . $option . ((is_string($value)) ?
                '=' . $value
                : '')
            : '');
    }

    /**
     * Formats a string value option.
     * @param string $option The option name.
     * @param null|string $value The option value.
     * @return string Returns the formatted option.
     */
    public static function formatString(string $option, $value)
    {
        return (($value !== null && $value !== '') ?
            ' ' . $option . '=' . $value
            : '');
    }

    /**
     * Formats a positive integer option.
     * @param string $option The option name.
     * @param int $value The option value.
     * @return string Returns the formatted option.
     */
    public static function formatPositiveInteger(string $option, int $value)
    {
        return (($value > 0) ?
            ' ' . $option . '=' . $value
            : '');
    }

    /**
     * Formats a path command option.
     * @param string $option The option name.
     * @param string|null $value The option value.
     * @param bool $noEscapeShellArg Whether to avoid escapeshellarg() or not.
     * @return string Returns the formatted option.
     */
    public static function formatPath(string $option, $value, bool $noEscapeShellArg = false)
    {
        return (($value !== null) ?
            ' ' . $option . '=' . (($noEscapeShellArg) ?
                $value
                : escapeshellarg($value))
            : '');
    }

    /**
     * Formats an array command option. Each array value repeats the option:
     * --option=option1 --option=option2 [... and so on]
     * @param string $option The option name.
     * @param string[] $values The array of values.
     * @return string Returns the formatted option.
     */
    public static function formatArray(string $option, array $values)
    {
        $str = '';
        foreach ($values as $value) {
            $str .= ' ' . $option . '=' . $value;
        }
        return $str;
    }
}
