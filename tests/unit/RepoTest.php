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

use axelitus\PHPIt\Commands\Workspace\InitCommand;
use axelitus\PHPIt\Repo;
use Codeception\Specify;
use Codeception\TestCase\Test;

/**
 * Class RepoTest
 * @package axelitus\PHPIt\Tests
 */
class RepoTest extends Test
{
    use Specify;

    /**
     * @var string The repo test path.
     */
    const TEST_PATH = './tests/_temp';

    /**
     * Tests Repo creation.
     * new Repo()
     */
    public function testRepoCreation()
    {
        $this->specify("Should create a Repo.", function () {
            $repo = new Repo(self::TEST_PATH);
            $this->assertInstanceOf(Repo::class, $repo);
        });
    }

    /**
     * Tests the repo getPath.
     * Repo->getPath()
     */
    public function testsRepoGetPath()
    {
        $this->specify("Should get an InitCommand", function () {
            $repo = new Repo(self::TEST_PATH);
            $this->assertEquals(realpath(self::TEST_PATH), $repo->getPath());
        });
    }

    /**
     * Tests the repo fluent interface: init.
     * Repo->init()
     */
    public function testsRepoFluentInterfaceInit()
    {
        $this->specify("Should get an InitCommand", function () {
            $repo = new Repo(self::TEST_PATH);
            $this->assertInstanceOf(InitCommand::class, $repo->init());
        });
    }
}
