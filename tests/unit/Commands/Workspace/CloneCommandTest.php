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

/**
 * Class CloneCommandTest
 * @package axelitus\FluGit\Tests\Commands\Workspace
 */
class CloneCommandTest extends Unit
{
    use Specify;

    /**
     * @var string A repo url for testing.
     */
    const TEST_REPO_URL = 'https://github.com/axelitus/php-flugit.git';

    /**
     * @var Repo Repo mock.
     */
    protected $repoMock;

    /**
     * Runs before each test.
     */
    protected function _before()
    {
        /**
         * @var Mock
         */
        $this->repoMock = Mockery::mock(Repo::class);
    }

    /**
     * Tests CloneCommand constructor.
     * new CloneCommand()
     */
    public function testCloneCommandConstructor()
    {
        $this->specify("Should create a CloneCommand object.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertInstanceOf(CloneCommand::class, $cmd);
        });
    }

    /**
     * Tests clone command's fluent interface compile.
     * CloneCommand->compile()
     */
    public function testCloneCommandFluentCompile()
    {
        $this->specify("Should return a GitCommand object.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertInstanceOf(GitCommand::class, $cmd->compile());
        });
    }

    /**
     * Tests clone command's getRepo.
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
        $str = "clone " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --bare " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->bare());
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'my_branch';
        $str = "clone --branch={$value} " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->branch($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'core.eol=false';
        $str = "clone --config={$value} " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->config($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'core.eol=false';
        $value2 = 'core.ignorecase=true';
        $str = "clone --config={$value} --config={$value2} " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value, $value2) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->config($value)->config($value2));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'core.eol=false';
        $value2 = 'core.ignorecase=true';
        $str = "clone --config={$value} --config={$value2} " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value, $value2) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->configs([$value, $value2]));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 3;
        $str = "clone --depth={$value} " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->depth($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --dissociate " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->dissociate());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --local " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->local());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --mirror " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->mirror());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --no-checkout " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->noCheckout());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --no-hardlinks " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->noHardlinks());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --no-local " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->noLocal());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --no-single-branch " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->noSingleBranch());
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'my_origin';
        $str = "clone --origin={$value} " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->origin($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --quiet " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->quiet());
            $this->assertEquals($str, (string)$cmd);
        });

        $str = "clone --recursive " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->recursive());
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'path/to/reference';
        $str = "clone --reference=\"{$value}\" " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->reference($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'path/to/separate/git/dir';
        $str = "clone --separate-git-dir=\"{$value}\" " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->separateGitDir($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'path/to/template';
        $str = "clone --template=\"{$value}\" " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->template($value));
            $this->assertEquals($str, (string)$cmd);
        });

        $value = 'path/to/upload/pack';
        $str = "clone --upload-pack=\"{$value}\" " . '"' . self::TEST_REPO_URL . '"';
        $this->specify("Should get '{$str}'.", function () use ($str, $value) {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertSame($cmd, $cmd->uploadPack($value));
            $this->assertEquals($str, (string)$cmd);
        });
    }

    /**
     * Tests clone command's fluent interface bare.
     * CloneCommand->bare()
     */
    public function testInitCommandFluentBare()
    {
        $this->specify("Should set and clear the bare option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getBare());
            $this->assertSame($cmd, $cmd->bare());
            $this->assertTrue($cmd->getBare());
            $this->assertSame($cmd, $cmd->bare(false));
            $this->assertFalse($cmd->getBare());
        });
    }

    /**
     * Tests clone command's fluent interface branch.
     * CloneCommand->branch()
     */
    public function testInitCommandFluentBranch()
    {
        $this->specify("Should set and clear the branch option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'my_branch';
            $this->assertNull($cmd->getBranch());
            $this->assertSame($cmd, $cmd->branch($value));
            $this->assertEquals($value, $cmd->getBranch());
            $this->assertSame($cmd, $cmd->branch());
            $this->assertNull($cmd->getBranch());
        });
    }

    /**
     * Tests clone command's fluent interface config.
     * CloneCommand->config()
     */
    public function testInitCommandFluentConfig()
    {
        $this->specify("Should set and clear the config option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value1 = 'core.eol=false';
            $value2 = 'core.ignorecase=true';
            $this->assertEquals(0, count($cmd->getConfig()));
            $this->assertSame($cmd, $cmd->config($value1));
            $this->assertEquals(1, count($cmd->getConfig()));
            $this->assertEquals($value1, $cmd->getConfig()[0]);
            $this->assertSame($cmd, $cmd->config($value2));
            $this->assertEquals(2, count($cmd->getConfig()));
            $this->assertEquals($value1, $cmd->getConfig()[0]);
            $this->assertEquals($value2, $cmd->getConfig()[1]);
            $this->assertSame($cmd, $cmd->config());
            $this->assertEquals(0, count($cmd->getConfig()));
        });
    }

    /**
     * Tests clone command's fluent interface configs.
     * CloneCommand->configs()
     */
    public function testInitCommandFluentConfigs()
    {
        $this->specify("Should set and clear an array of configs.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value1 = 'core.eol=false';
            $value2 = 'core.ignorecase=true';
            $this->assertEquals(0, count($cmd->getConfig()));
            $this->assertSame($cmd, $cmd->configs([$value1, $value2]));
            $this->assertEquals(2, count($cmd->getConfig()));
            $this->assertEquals($value1, $cmd->getConfig()[0]);
            $this->assertEquals($value2, $cmd->getConfig()[1]);
            $this->assertSame($cmd, $cmd->config());
            $this->assertEquals(0, count($cmd->getConfig()));
        });
    }

    /**
     * Tests clone command's fluent interface depth.
     * CloneCommand->depth()
     */
    public function testInitCommandFluentDepth()
    {
        $this->specify("Should set and clear the depth option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $depth = 3;
            $this->assertEquals(0, $cmd->getDepth());
            $this->assertSame($cmd, $cmd->depth($depth));
            $this->assertEquals($depth, $cmd->getDepth());
            $this->assertSame($cmd, $cmd->depth());
            $this->assertEquals(0, $cmd->getDepth());
        });
    }

    /**
     * Tests clone command's fluent interface destination.
     * CloneCommand->destination()
     */
    public function testInitCommandFluentDestination()
    {
        $this->specify("Should set and clear the destination option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'path/to/destination';
            $this->assertNull($cmd->getDestination());
            $this->assertSame($cmd, $cmd->destination($value));
            $this->assertEquals($value, $cmd->getDestination());
            $this->assertSame($cmd, $cmd->destination());
            $this->assertNull($cmd->getDestination());
        });
    }

    /**
     * Tests clone command's fluent interface dissociate.
     * CloneCommand->dissociate()
     */
    public function testInitCommandFluentDissociate()
    {
        $this->specify("Should set and clear the dissociate option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getDissociate());
            $this->assertSame($cmd, $cmd->dissociate());
            $this->assertTrue($cmd->getDissociate());
            $this->assertSame($cmd, $cmd->dissociate(false));
            $this->assertFalse($cmd->getDissociate());
        });
    }

    /**
     * Tests clone command's fluent interface local/no-local.
     * CloneCommand->local() | CloneCommand->noLocal()
     */
    public function testInitCommandFluentLocalNoLocal()
    {
        $this->specify("Should set and clear the local and no-local options.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getLocal());
            $this->assertFalse($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->local());
            $this->assertTrue($cmd->getLocal());
            $this->assertFalse($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->local(false));
            $this->assertFalse($cmd->getLocal());
            $this->assertFalse($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->noLocal());
            $this->assertFalse($cmd->getLocal());
            $this->assertTrue($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->noLocal(false));
            $this->assertFalse($cmd->getLocal());
            $this->assertFalse($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->local());
            $this->assertTrue($cmd->getLocal());
            $this->assertFalse($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->noLocal());
            $this->assertFalse($cmd->getLocal());
            $this->assertTrue($cmd->getNoLocal());

            $this->assertSame($cmd, $cmd->local());
            $this->assertTrue($cmd->getLocal());
            $this->assertFalse($cmd->getNoLocal());
        });
    }

    /**
     * Tests clone command's fluent interface mirror.
     * CloneCommand->mirror()
     */
    public function testInitCommandFluentMirror()
    {
        $this->specify("Should set and clear the mirror option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getMirror());
            $this->assertSame($cmd, $cmd->mirror());
            $this->assertTrue($cmd->getMirror());
            $this->assertSame($cmd, $cmd->mirror(false));
            $this->assertFalse($cmd->getMirror());
        });
    }

    /**
     * Tests clone command's fluent interface no-checkout.
     * CloneCommand->noCheckout()
     */
    public function testInitCommandFluentNoCheckout()
    {
        $this->specify("Should set and clear the no-checkout option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getNoCheckout());
            $this->assertSame($cmd, $cmd->noCheckout());
            $this->assertTrue($cmd->getNoCheckout());
            $this->assertSame($cmd, $cmd->noCheckout(false));
            $this->assertFalse($cmd->getNoCheckout());
        });
    }

    /**
     * Tests clone command's fluent interface no-hardlinks.
     * CloneCommand->noHardlinks()
     */
    public function testInitCommandFluentNoHardlinks()
    {
        $this->specify("Should set and clear the no-hardlinks option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getNoHardlinks());
            $this->assertSame($cmd, $cmd->noHardlinks());
            $this->assertTrue($cmd->getNoHardlinks());
            $this->assertSame($cmd, $cmd->noHardlinks(false));
            $this->assertFalse($cmd->getNoHardlinks());
        });
    }

    /**
     * Tests clone command's fluent interface origin.
     * CloneCommand->origin()
     */
    public function testInitCommandFluentOrigin()
    {
        $this->specify("Should set and clear the origin option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'my_origin';
            $this->assertNull($cmd->getOrigin());
            $this->assertSame($cmd, $cmd->origin($value));
            $this->assertEquals($value, $cmd->getOrigin());
            $this->assertSame($cmd, $cmd->origin());
            $this->assertNull($cmd->getOrigin());
        });
    }

    /**
     * Tests clone command's fluent interface quiet.
     * CloneCommand->quiet()
     */
    public function testInitCommandFluentQuiet()
    {
        $this->specify("Should set and clear the quiet option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getQuiet());
            $this->assertSame($cmd, $cmd->quiet());
            $this->assertTrue($cmd->getQuiet());
            $this->assertSame($cmd, $cmd->quiet(false));
            $this->assertFalse($cmd->getQuiet());
        });
    }

    /**
     * Tests clone command's fluent interface recursive.
     * CloneCommand->recursive()
     */
    public function testInitCommandFluentRecursive()
    {
        $this->specify("Should set and clear the recursive option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getRecursive());
            $this->assertSame($cmd, $cmd->recursive());
            $this->assertTrue($cmd->getRecursive());
            $this->assertSame($cmd, $cmd->recursive(false));
            $this->assertFalse($cmd->getRecursive());
        });
    }

    /**
     * Tests clone command's fluent interface reference.
     * CloneCommand->reference()
     */
    public function testInitCommandFluentReference()
    {
        $this->specify("Should set and clear the reference option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'path/to/reference';
            $this->assertNull($cmd->getReference());
            $this->assertSame($cmd, $cmd->reference($value));
            $this->assertEquals($value, $cmd->getReference());
            $this->assertSame($cmd, $cmd->reference());
            $this->assertNull($cmd->getReference());
        });
    }

    /**
     * Tests clone command's fluent interface separate-git-dir.
     * CloneCommand->separateGitDir()
     */
    public function testInitCommandFluentSeparateGitDir()
    {
        $this->specify("Should set and clear the separate-git-dir option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'path/to/reference';
            $this->assertNull($cmd->getSeparateGitDir());
            $this->assertSame($cmd, $cmd->separateGitDir($value));
            $this->assertEquals($value, $cmd->getSeparateGitDir());
            $this->assertSame($cmd, $cmd->separateGitDir());
            $this->assertNull($cmd->getSeparateGitDir());
        });
    }

    /**
     * Tests clone command's fluent interface shared.
     * CloneCommand->shared()
     */
    public function testInitCommandFluentShared()
    {
        $this->specify("Should set and clear the shared option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getShared());
            $this->assertSame($cmd, $cmd->shared());
            $this->assertTrue($cmd->getShared());
            $this->assertSame($cmd, $cmd->shared(false));
            $this->assertFalse($cmd->getShared());
        });
    }

    /**
     * Tests clone command's fluent interface single-branch/no-single-branch.
     * CloneCommand->singleBranch() | CloneCommand->noSingleBranch()
     */
    public function testInitCommandFluentSingleBranchNoSingleBranch()
    {
        $this->specify("Should set and clear the single-branch and no-single-branch options.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $this->assertFalse($cmd->getSingleBranch());
            $this->assertFalse($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->singleBranch());
            $this->assertTrue($cmd->getSingleBranch());
            $this->assertFalse($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->singleBranch(false));
            $this->assertFalse($cmd->getSingleBranch());
            $this->assertFalse($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->noSingleBranch());
            $this->assertFalse($cmd->getSingleBranch());
            $this->assertTrue($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->noSingleBranch(false));
            $this->assertFalse($cmd->getSingleBranch());
            $this->assertFalse($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->singleBranch());
            $this->assertTrue($cmd->getSingleBranch());
            $this->assertFalse($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->noSingleBranch());
            $this->assertFalse($cmd->getSingleBranch());
            $this->assertTrue($cmd->getNoSingleBranch());

            $this->assertSame($cmd, $cmd->singleBranch());
            $this->assertTrue($cmd->getSingleBranch());
            $this->assertFalse($cmd->getNoSingleBranch());
        });
    }

    /**
     * Tests clone command's fluent interface source.
     * CloneCommand->source()
     */
    public function testInitCommandFluentSource()
    {
        $this->specify("Should set and clear the source option.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'path/to/source';
            $this->assertEquals(self::TEST_REPO_URL, $cmd->getSource());
            $this->assertSame($cmd, $cmd->source($value));
            $this->assertEquals($value, $cmd->getSource());
        });
    }

    /**
     * Tests clone command's fluent interface template.
     * CloneCommand->template()
     */
    public function testInitCommandFluentTemplate()
    {
        $this->specify("Should set the bare option to true or false.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'path/to/template';
            $this->assertNull($cmd->getTemplate());
            $this->assertSame($cmd, $cmd->template($value));
            $this->assertEquals($value, $cmd->getTemplate());
            $this->assertSame($cmd, $cmd->template());
            $this->assertNull($cmd->getTemplate());
        });
    }

    /**
     * Tests clone command's fluent interface upload-pack.
     * CloneCommand->uploadPack()
     */
    public function testInitCommandFluentUploadPack()
    {
        $this->specify("Should set the bare option to true or false.", function () {
            $cmd = new CloneCommand($this->repoMock, self::TEST_REPO_URL);
            $value = 'path/to/upload/pack';
            $this->assertNull($cmd->getUploadPack());
            $this->assertSame($cmd, $cmd->uploadPack($value));
            $this->assertEquals($value, $cmd->getUploadPack());
            $this->assertSame($cmd, $cmd->uploadPack());
            $this->assertNull($cmd->getUploadPack());
        });
    }
}
