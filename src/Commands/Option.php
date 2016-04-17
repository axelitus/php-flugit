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

namespace axelitus\FluGit\Commands;

/**
 * Class Option
 * @package axelitus\FluGit\Commands
 */
class Option
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
}
