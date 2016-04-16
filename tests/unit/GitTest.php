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

namespace axelitus\FluGit\Tests;

use Codeception\Test\Unit;

/**
 * Class GitTest
 * @package axelitus\FluGit\Tests
 */
class GitTest extends Unit
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
