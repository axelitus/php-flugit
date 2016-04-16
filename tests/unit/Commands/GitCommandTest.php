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

namespace axelitus\FluGit\Tests\Commands;

use axelitus\FluGit\Commands\Command;
use axelitus\FluGit\Commands\GitCommand;
use axelitus\FluGit\Repo;
use Codeception\Specify;
use Codeception\TestCase\Test;
use Mockery;
use Mockery\Mock;
use ReflectionMethod;
use RuntimeException;

/**
 * Class GitCommandTest
 * @package axelitus\FluGit\Tests\Commands
 */
class GitCommandTest extends Test
{
    use Specify;

    /**
     * @var string The repo test path.
     */
    const TEST_PATH = './tests/_temp';

    /**
     * @var string The test command.
     */
    const TEST_COMMAND = 'version';

    /**
     * @var string Nonexistent path.
     */
    const TEST_NONEXISTENT_PATH = './tests/_nonexistent';

    /**
     * @var string Nonexistent git command.
     */
    const TEST_NONEXISTENT_COMMAND = 'nonexistent';

    /**
     * @var Mock Repo mock.
     */
    protected $repoMock;

    /**
     * @var Mock Command mock;
     */
    protected $commandMock;

    /**
     * Runs before each test.
     */
    public function _before()
    {
        $this->repoMock = Mockery::mock(Repo::class);
        $this->repoMock->shouldReceive('getPath')->andReturn(self::TEST_PATH);
        $this->commandMock = Mockery::mock(Command::class);
        $this->commandMock->shouldReceive('getRepo')->andReturn($this->repoMock);
        $this->commandMock->shouldReceive('__toString')->andReturn(self::TEST_COMMAND);
    }

    /**
     * Tests GitCommand creation.
     * new GitCommand()
     */
    public function testGitCommandCreation()
    {
        $this->specify("Should create a GitCommand.", function () {
            $cmd = new GitCommand($this->commandMock);
            $this->assertInstanceOf(GitCommand::class, $cmd);
        });
    }

    /**
     * Tests the git command prepare function.
     * GitCommand->prepare()
     */
    public function testPrepare()
    {
        $this->specify("Should prepare the command correctly.", function () {
            $cmd = new GitCommand($this->commandMock);
            $git = 'git -C ' . self::TEST_PATH . ' ' . self::TEST_COMMAND;
            $method = new ReflectionMethod(GitCommand::class, 'prepare');
            $method->setAccessible(true);
            $this->assertEquals($git, $method->invoke($cmd, $this->commandMock));
        });
    }

    /**
     * Tests git command execution.
     */
    public function testExecute()
    {
        $this->specify("Should execute the command correctly.", function () {
            $cmd = new GitCommand($this->commandMock);
            $output = $cmd->execute();
            $this->assertInternalType('array', $output);
            $this->assertCount(1, $output);
            $this->assertStringStartsWith('git version', $output[0]);
        });

        $this->specify("Should throw a RuntimeException.", function () {
            $repoMock = Mockery::mock(Repo::Class);
            $repoMock->shouldReceive('getPath')->andReturn(self::TEST_NONEXISTENT_PATH);
            $cmdMock = Mockery::mock(Command::class);
            $cmdMock->shouldReceive('getRepo')->andReturn($repoMock);
            $cmdMock->shouldReceive('__toString')->andReturn(self::TEST_NONEXISTENT_COMMAND);
            $cmd = new GitCommand($cmdMock);
            $cmd->execute();
        }, ['throws' => RuntimeException::class]);
    }
}
