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

namespace axelitus\FluGit\Commands\Workspace;

use axelitus\FluGit\Commands\Command;
use axelitus\FluGit\Commands\OptionFormatter;
use axelitus\FluGit\Commands\GitCommand;
use axelitus\FluGit\Repo;

/**
 * Class InitCommand
 * @package axelitus\FluGit\Commands\Workspace
 * @see https://git-scm.com/docs/git-init
 */
class InitCommand implements Command
{
    /**
     * @var string The command's action.
     */
    const ACTION = 'init';

    /**
     * @var string Shared option value: all.
     */
    const SHARED_ALL = 'all';

    /**
     * @var string Shared option value: everybody.
     */
    const SHARED_EVERYBODY = 'everybody';

    /**
     * @var string Shared option value: false.
     */
    const SHARED_FALSE = 'false';

    /**
     * @var string Shared option value: group.
     */
    const SHARED_GROUP = 'group';

    /**
     * @var string Shared option value: true.
     */
    const SHARED_TRUE = 'true';

    /**
     * @var string Shared option value: umask.
     */
    const SHARED_UMASK = 'umask';

    /**
     * @var string Shared option value: world.
     */
    const SHARED_WORLD = 'world';

    /**
     * @var string Command option: quiet.
     */
    const OPTION_QUIET = '--quiet';

    /**
     * @var string Command option: bare.
     */
    const OPTION_BARE = '--bare';

    /**
     * @var string Command option: template.
     */
    const OPTION_TEMPLATE = '--template';

    /**
     * @var string Command option: separate-git-dir.
     */
    const OPTION_SEPARATE_GIT_DIR = '--separate-git-dir';

    /**
     * @var string Command option: shared.
     */
    const OPTION_SHARED = '--shared';

    /**
     * @var Repo The command's repo context.
     */
    protected $repo;

    /**
     * @var string The destination path.
     */
    protected $destination;

    /**
     * @var bool The command's bare option.
     */
    protected $bare = false;

    /**
     * @var null|string The command's separate-git-dir option.
     */
    protected $separateGitDir = null;

    /**
     * @var null|bool|string The command's shared option.
     */
    protected $shared = null;

    /**
     * @var null|string The command's template option.
     */
    protected $template = null;

    /**
     * @var bool The command's quiet option.
     */
    protected $quiet = false;

    /**
     * InitCommand constructor. Creates a new InitCommand instance.
     * @param Repo $repo The repo this InitCommand belongs to.
     * @param string $destination The destination path.
     */
    public function __construct(Repo $repo, string $destination = '')
    {
        $this->repo = $repo;
        $this->destination($destination);
    }

    /**
     * Gets the command's repo context.
     * @return Repo The repo context.
     */
    public function getRepo() : Repo
    {
        return $this->repo;
    }

    /**
     * Sets the destination path.
     * @param string $path The destination path.
     * @return InitCommand Returns itself for method chaining.
     */
    public function destination(string $path) : InitCommand
    {
        $this->destination = $path;
        return $this;
    }

    /**
     * Gets the destination path.
     * @return string The destination path.
     */
    public function getDestination() : string
    {
        return $this->destination;
    }

    /**
     * Sets the bare option value.
     * @param bool $value The option value.
     * @return InitCommand Returns itself for method chaining.
     */
    public function bare(bool $value = true) : InitCommand
    {
        $this->bare = $value;
        return $this;
    }

    /**
     * Gets the value of property bare.
     * @return bool Returns the value of property bare.
     */
    public function getBare() : bool
    {
        return $this->bare;
    }

    /**
     * Sets the separate-git-dir option value.
     * @param string|null $value The option value.
     * @return InitCommand Returns itself for method chaining.
     */
    public function separateGitDir(string $value = null) : InitCommand
    {
        $this->separateGitDir = $value;
        return $this;
    }

    /**
     * Gets the value of property separate-git-dir.
     * @return string|null Returns the value of property separate-git-dir or null.
     */
    public function getSeparateGitDir()
    {
        return $this->separateGitDir;
    }

    /**
     * Sets the shared option value.
     * @param bool|string|null $value The option value.
     * @return InitCommand Returns itself for method chaining.
     */
    public function shared($value = true) : InitCommand
    {
        if ($value === true || is_string($value)) {
            $this->shared = $value;
        } else {
            $this->shared = null;
        }
        return $this;
    }

    /**
     * Gets the value of property shared.
     * @return bool|string|null Returns the value of property shared which can be true, string or null
     */
    public function getShared()
    {
        return $this->shared;
    }

    /**
     * Sets the template option value.
     * @param string|null $value The option value.
     * @return InitCommand Returns itself for method chaining.
     */
    public function template(string $value = null) : InitCommand
    {
        $this->template = $value;
        return $this;
    }

    /**
     * Gets the value of property template.
     * @return string|null Returns the value of property template or null.
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the quiet option value.
     * @param bool $value The option value.
     * @return InitCommand Returns itself for method chaining.
     */
    public function quiet(bool $value = true) : InitCommand
    {
        $this->quiet = $value;
        return $this;
    }

    /**
     * Gets the value of property quiet.
     * @return bool Returns the value of property quiet.
     */
    public function getQuiet() : bool
    {
        return $this->quiet;
    }

    /**
     * Compiles the command into an executable git command.
     * @return GitCommand The compiled git command.
     */
    public function compile() : GitCommand
    {
        return new GitCommand($this);
    }

    /**
     * Converts the command to string.
     * @return string Returns the command as a string.
     */
    public function __toString()
    {
        $str = self::ACTION;

        // --- quiet ---
        $str .= OptionFormatter::formatBool(self::OPTION_QUIET, $this->quiet);
        // --- bare ---
        $str .= OptionFormatter::formatBool(self::OPTION_BARE, $this->bare);
        // --- template ---
        $str .= OptionFormatter::formatPath(self::OPTION_TEMPLATE, $this->template);
        // --- separate-git-dir ---
        $str .= OptionFormatter::formatPath(self::OPTION_SEPARATE_GIT_DIR, $this->separateGitDir);
        // --- shared ---
        $str .= OptionFormatter::formatBoolOrString(self::OPTION_SHARED, $this->shared);
        // --- destination ---
        ($this->destination !== '') && $str .= ' ' . escapeshellarg($this->destination);

        return $str;
    }
}
