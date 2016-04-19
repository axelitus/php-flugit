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

use RuntimeException;

/**
 * Class OptionValidator
 * @package Commands\Options
 */
class OptionValidator
{
    public static function validNoSpace(string $option, string $value, $spareException = false)
    {
        if ($value !== null && strpos($value, ' ')) {
            if ($spareException) {
                return false;
            } else {
                throw new RuntimeException(
                    sprintf(
                        'The string "%s" is not valid for option "%s". [Spaces are not allowed.]',
                        $value, $option
                    )
                );
            }
        }
        return true;
    }
}
