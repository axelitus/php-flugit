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

namespace axelitus\PHPIt\Tests\Commands\Workspace;

use axelitus\PHPIt\Commands\GitCommand;
use axelitus\PHPIt\Commands\Workspace\InitCommand;
use axelitus\PHPIt\Repo;
use Codeception\Specify;
use Codeception\TestCase\Test;
use Mockery;
use Mockery\Mock;
use stdClass;

/**
 * Class InitCommandTest
 * @package axelitus\PHPIt\Tests\Commands\Workspace
 */
class InitCommandTest extends Test
{
    use Specify;

    /**
     * @var string A repo test path.
     */
    const TEST_PATH = './tests/_temp';

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
     * Tests InitCommand creation.
     * new InitCommand()
     */
    public function testInitCommandCreation()
    {
        $this->specify("Should create an InitCommand.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertInstanceOf(InitCommand::class, $cmd);
        });
    }

    /**
     * Tests init command's getRepo.
     * InitCommand->getRepo()
     */
    public function testInitCommandGetRepo()
    {
        $this->specify("Should get the command's repo.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($this->repoMock, $cmd->getRepo());
        });
    }

    /**
     * Tests init command's fluent interface bare.
     * InitCommand->bare()
     */
    public function testInitCommandFluentBare()
    {
        $this->specify("Should set the bare option to true or false.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertFalse($cmd->getBare());
            $this->assertSame($cmd, $cmd->bare());
            $this->assertTrue($cmd->getBare());
            $this->assertSame($cmd, $cmd->bare(false));
            $this->assertFalse($cmd->getBare());
        });
    }

    /**
     * Tests init command's fluent interface separateGitDir.
     * InitCommand->separateGitDir()
     */
    public function testInitCommandFluentSeparateGitDir()
    {
        $this->specify("Should set the separateGitDir option.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertNull($cmd->getSeparateGitDir());
            $this->assertSame($cmd, $cmd->separateGitDir(self::TEST_PATH));
            $this->assertEquals(self::TEST_PATH, $cmd->getSeparateGitDir());
        });
    }

    /**
     * Tests init command's fluent interface shared.
     * InitCommand->shared()
     */
    public function testInitCommandFluentShared()
    {
        $this->specify("Should set the shared option for bool and string.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertNull($cmd->getShared());
            $this->assertSame($cmd, $cmd->shared());
            $this->assertTrue($cmd->getShared());
            $this->assertSame($cmd, $cmd->shared(InitCommand::SHARED_WORLD));
            $this->assertEquals(InitCommand::SHARED_WORLD, $cmd->getShared());
            $this->assertSame($cmd, $cmd->shared(false));
            $this->assertNull($cmd->getShared());
        });

        $this->specify("Should not set the shared option for values other than bool and string.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertNull($cmd->getShared());
            $this->assertSame($cmd, $cmd->shared(new stdClass()));
            $this->assertNull($cmd->getShared());
            $this->assertSame($cmd, $cmd->shared(1));
            $this->assertNull($cmd->getShared());
        });
    }

    /**
     * Tests init command's fluent interface template.
     * InitCommand->template()
     */
    public function testInitCommandFluentTemplate()
    {
        $this->specify("Should set the template option.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertNull($cmd->getTemplate());
            $this->assertSame($cmd, $cmd->template(self::TEST_PATH));
            $this->assertEquals(self::TEST_PATH, $cmd->getTemplate());
        });
    }

    /**
     * Tests init command's fluent interface quiet.
     * InitCommand->quiet()
     */
    public function testInitCommandFluentQuiet()
    {
        $this->specify("Should set the quiet option to true or false.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertFalse($cmd->getQuiet());
            $this->assertSame($cmd, $cmd->quiet());
            $this->assertTrue($cmd->getQuiet());
            $this->assertSame($cmd, $cmd->quiet(false));
            $this->assertFalse($cmd->getQuiet());
        });
    }

    /**
     * Tests init command's fluent interface compile.
     * InitCommand->compile()
     */
    public function testInitCommandFluentCompile()
    {
        $this->specify("Should return a GitCommand object.", function () {
            $cmd = new InitCommand($this->repoMock);
            $this->assertInstanceOf(GitCommand::class, $cmd->compile());
        });
    }

    /**
     * Tests init command's toString.
     * InitCommand->__toString()
     */
    public function testInitCommandFluentToString()
    {
        $str = 'init';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --bare';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->bare());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --separate-git-dir=' . escapeshellarg(self::TEST_PATH);
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->separateGitDir(self::TEST_PATH));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --shared';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->shared());
            $this->assertEquals($str, (string)$cmd);
        });

        $shared = InitCommand::SHARED_EVERYBODY;
        $str = "init --shared={$shared}";
        $this->specify("Should get '{$str}'.", function () use ($str, $shared) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->shared($shared));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --template=' . escapeshellarg(self::TEST_PATH);
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->template(self::TEST_PATH));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = 'init --quiet';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new InitCommand($this->repoMock);
            $this->assertSame($cmd, $cmd->quiet());
            $this->assertEquals($str, (string)$cmd);
        });
    }
}
