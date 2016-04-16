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

namespace axelitus\PHPIt\Tests;

use Codeception\TestCase\Test;

/**
 * Class GitTest
 * @package axelitus\PHPIt\Tests
 */
class GitTest extends Test
{
    /**
     * Tests if git is available
     * Git::isAvailable()
     */
    public function testIsAvailable()
    {
        // Cannot reliably test as this depends on the underlying platform.
    }

    /**
     * Tests the git version
     * Git::version()
     */
    public function testVersion()
    {
        // Cannot reliably test as this depends on the underlying platform.
    }
}
