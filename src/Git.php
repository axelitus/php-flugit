<?php
/**
 * PHPIt is a PHP package for using Git through a fluent interface.
 *
 * @package    axelitus\PHPIt
 * @version    0.1
 * @author     Axel Pardemann
 * @license    MIT License
 * @copyright  2016 axelitus
 * @link       https://github.com/axelitus/phpit
 */
declare(strict_types = 1);

namespace axelitus\PHPIt;

use RuntimeException;

/**
 * Class Git
 * @package axelitus\PHPIt
 */
class Git
{
    /**
     * Gets whether git command is available or not.
     * @param string[] $output
     * @return bool True if git can be used, false otherwise.
     */
    public static function isAvailable(&$output = null) : bool
    {
        if (function_exists('exec')) {
            exec('git version', $output, $exitCode);
            return ($exitCode === 0);
        }
        return false;
    }

    /**
     * Gets the git version.
     * @return string The git version
     */
    public static function version() : string
    {
        if (!self::isAvailable($version)) {
            throw new RuntimeException("Git command is not available!");
        }
        return $version[0];
    }
}
