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

use axelitus\FluGit\Commands\Workspace\InitCommand;
use axelitus\FluGit\Repo;
use Codeception\Specify;
use Codeception\Test\Unit;
use RuntimeException;

/**
 * Class RepoTest
 * @package axelitus\FluGit\Tests
 */
class RepoTest extends Unit
{
    use Specify;

    /**
     * @var string The repo test path.
     */
    const TEST_PATH = './tests/_temp';

    /**
     * @var string Nonexistent path.
     */
    const TEST_NONEXISTENT_PATH = './tests/_nonexistent';

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

        $this->specify("Should throw a RuntimeException.", function () {
            $repo = new Repo(self::TEST_NONEXISTENT_PATH);
        }, ['throws' => RuntimeException::class]);
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
