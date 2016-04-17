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

namespace axelitus\FluGit\Tests\Commands\Workspace;

use axelitus\FluGit\Commands\GitCommand;
use axelitus\FluGit\Commands\Workspace\CloneCommand;
use axelitus\FluGit\Repo;
use Codeception\Specify;
use Codeception\Test\Unit;
use Mockery;
use Mockery\Mock;
use stdClass;

/**
 * Class CloneCommandTest
 * @package axelitus\FluGit\Tests\Commands\Workspace
 */
class CloneCommandTest extends Unit
{
    use Specify;

    /**
     * @var string A repo test path.
     */
    const TEST_PATH = './tests/_temp';

    /**
     * @var string A repo url for testing.
     */
    const TEST_REPO_URL = 'https://github.com/axelitus/php-flugit.git';

    /**
     * @var Mock Repo mock.
     */
    protected $repoMock;

    /**
     * Runs before each test.
     */
    protected function _before()
    {
        $this->repoMock = Mockery::mock(Repo::class);
    }

    /**
     * Tests CloneCommand creation.
     * new CloneCommand()
     */
    public function testCloneCommandCreation()
    {
        $this->specify("Should create an CloneCommand.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertInstanceOf(CloneCommand::class, $cmd);
        });
    }

    /**
     * Tests init command's getRepo.
     * CloneCommand->getRepo()
     */
    public function testCloneCommandGetRepo()
    {
        $this->specify("Should get the command's repo.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($this->repoMock, $cmd->getRepo());
        });
    }



    /**
     * Tests init command's toString.
     * CloneCommand->__toString()
     */
    public function testCloneCommandToString()
    {
        $str = 'clone';
        /*
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --bare';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->bare());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --separate-git-dir=' . escapeshellarg(self::TEST_PATH);
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->separateGitDir(self::TEST_PATH));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --shared';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->shared());
            $this->assertEquals($str, (string)$cmd);
        });

        $shared = CloneCommand::SHARED_EVERYBODY;
        $str = "init --shared={$shared}";
        $this->specify("Should get '{$str}'.", function () use ($str, $shared) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->shared($shared));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --template=' . escapeshellarg(self::TEST_PATH);
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->template(self::TEST_PATH));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --quiet';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->quiet());
            $this->assertEquals($str, (string)$cmd);
        });
        */
    }
}
