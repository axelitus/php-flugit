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
use axelitus\FluGit\Commands\GitCommand;
use axelitus\FluGit\Commands\Options\OptionFormatter;
use axelitus\FluGit\Commands\Options\OptionValidator;
use axelitus\FluGit\Repo;

/**
 * Class CloneCommand
 * @package axelitus\FluGit\Commands\Workspace
 * @see https://git-scm.com/docs/git-clone
 */
class CloneCommand implements Command
{
    /**
     * @var string The command's action.
     */
    const ACTION = 'clone';

    /**
     * @var string Command option: bare.
     */
    const OPTION_BARE = '--bare';

    /**
     * @var string Command option: branch.
     */
    const OPTION_BRANCH = '--branch';

    /**
     * @var string Command option: config.
     */
    const OPTION_CONFIG = '--config';

    /**
     * @var string Command option: depth.
     */
    const OPTION_DEPTH = '--depth';

    /**
     * @var string Command option: dissociate.
     */
    const OPTION_DISSOCIATE = '--dissociate';

    /**
     * @var string Command option: local.
     */
    const OPTION_LOCAL = '--local';

    /**
     * @var string Command option: mirror.
     */
    const OPTION_MIRROR = '--mirror';

    /**
     * @var string Command option: no-checkout.
     */
    const OPTION_NO_CHECKOUT = '--no-checkout';

    /**
     * @var string Command option: no-hardlinks.
     */
    const OPTION_NO_HARDLINKS = '--no-hardlinks';

    /**
     * @var string Command option: no-local.
     */
    const OPTION_NO_LOCAL = '--no-local';

    /**
     * @var string Command option: no-single-branch.
     */
    const OPTION_NO_SINGLE_BRANCH = '--no-single-branch';

    /**
     * @var string Command option: origin.
     */
    const OPTION_ORIGIN = '--origin';

    /**
     * @var string Command option: quiet.
     */
    const OPTION_QUIET = '--quiet';

    /**
     * @var string Command option: recursive.
     */
    const OPTION_RECURSIVE = '--recursive';

    /**
     * @var string Command option: reference.
     */
    const OPTION_REFERENCE = '--reference';

    /**
     * @var string Command option: separate-git-dir.
     */
    const OPTION_SEPARATE_GIT_DIR = '--separate-git-dir';

    /**
     * @var string Command option: shared.
     */
    const OPTION_SHARED = '--shared';

    /**
     * @var string Command option: single-branch.
     */
    const OPTION_SINGLE_BRANCH = '--single-branch';

    /**
     * @var string Command option: template.
     */
    const OPTION_TEMPLATE = '--template';

    /**
     * @var string Command option: upload-pack.
     */
    const OPTION_UPLOAD_PACK = '--upload-pack';

    /**
     * @var Repo The command's repo context.
     */
    protected $repo;

    /**
     * @var string The repository source.
     */
    protected $source;

    /**
     * @var string The repository destination.
     */
    protected $destination;

    /**
     * @var null|string The command's template option.
     */
    protected $template = null;

    /**
     * @var bool The command's local option.
     */
    protected $local = false;

    /**
     * @var bool The command's no-local option.
     */
    protected $noLocal = false;

    /**
     * @var bool The command's shared option.
     */
    protected $shared = false;

    /**
     * @var bool The command's no-hardlinks option.
     */
    protected $noHardlinks = false;

    /**
     * @var bool The command's quiet option.
     */
    protected $quiet = false;

    /**
     * @var bool The command's no-checkout option.
     */
    protected $noCheckout = false;

    /**
     * @var bool The command's bare option.
     */
    protected $bare = false;

    /**
     * @var bool The command's mirror option.
     */
    protected $mirror = false;

    /**
     * @var null|string The command's origin option.
     */
    protected $origin = null;

    /**
     * @var null|string The command's branch option.
     */
    protected $branch = null;

    /**
     * @var null|string The command's upload-pack option.
     */
    protected $uploadPack = null;

    /**
     * @var null|string The command's reference option.
     */
    protected $reference = null;

    /**
     * @var bool The command's dissociate option.
     */
    protected $dissociate = false;

    /**
     * @var null|string The command's separated-git-dir option.
     */
    protected $separateGitDir = null;

    /**
     * @var int The command's depth option.
     */
    protected $depth = 0;

    /**
     * @var bool The command's single-branch option.
     */
    protected $singleBranch = false;

    /**
     * @var bool The command's no-single-branch option.
     */
    protected $noSingleBranch = false;

    /**
     * @var bool The command's recursive option.
     */
    protected $recursive = false;

    /**
     * @var string[] The command's config option.
     */
    protected $config = [];

    /**
     * CloneCommand constructor. Creates a new CloneCommand instance.
     * @param Repo $repo The repo this CloneCommand belongs to.
     * @param string $source The source repository path.
     * @param string $destination The destination path.
     */
    public function __construct(Repo $repo, string $source, string $destination = '')
    {
        $this->repo = $repo;
        $this->source($source);
        $this->destination($destination);
    }

    /**
     * Sets the source repository path.
     * @param string $value The path to the source repository.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function source(string $value) : CloneCommand
    {
        $this->source = $value;
        return $this;
    }

    /**
     * Sets the destination path.
     * @param string $value The destination path to clone.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function destination(string $value) : CloneCommand
    {
        $this->destination = $value;
        return $this;
    }

    /**
     * Gets the repository source.
     * @return string The repository source.
     */
    public function getSource() : string
    {
        return $this->source;
    }

    /**
     * Gets destination path.
     * @return string The cloned repository destination.
     */
    public function getDestination() : string
    {
        return $this->destination;
    }

    /**
     * Sets the template option value.
     * @param string|null $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function template(string $value = null) : CloneCommand
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
     * Sets the local option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function local(bool $value = true) : CloneCommand
    {
        ($this->local = $value) && $this->noLocal = false;
        return $this;
    }

    /**
     * Gets the value of property local.
     * @return bool Returns the value of property local.
     */
    public function getLocal() : bool
    {
        return $this->local;
    }

    /**
     * Sets the no-local option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function noLocal(bool $value = true) : CloneCommand
    {
        ($this->noLocal = $value) && $this->local = false;
        return $this;
    }

    /**
     * Gets the value of property no-local.
     * @return bool Returns the value of property no-local.
     */
    public function getNoLocal() : bool
    {
        return $this->noLocal;
    }

    /**
     * Sets the shared option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function shared(bool $value = true) : CloneCommand
    {
        $this->shared = $value;
        return $this;
    }

    /**
     * Gets the value of property shared.
     * @return bool Returns the value of property shared which can be true, string or null
     */
    public function getShared() : bool
    {
        return $this->shared;
    }

    /**
     * Sets the no-hardlinks option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function noHardlinks(bool $value = true) : CloneCommand
    {
        $this->noHardlinks = $value;
        return $this;
    }

    /**
     * Gets the value of property no-hardlinks.
     * @return bool Returns the value of property no-hardlinks.
     */
    public function getNoHardlinks() : bool
    {
        return $this->noHardlinks;
    }

    /**
     * Sets the quiet option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function quiet(bool $value = true) : CloneCommand
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
     * Sets the no-checkout option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function noCheckout(bool $value = true) : CloneCommand
    {
        $this->noCheckout = $value;
        return $this;
    }

    /**
     * Gets the value of property no-checkout.
     * @return bool Returns the value of property no-checkout.
     */
    public function getNoCheckout() : bool
    {
        return $this->noCheckout;
    }

    /**
     * Sets the bare option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function bare(bool $value = true) : CloneCommand
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
     * Sets the mirror option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function mirror(bool $value = true) : CloneCommand
    {
        $this->mirror = $value;
        return $this;
    }

    /**
     * Gets the value of property mirror.
     * @return bool Returns the value of property mirror.
     */
    public function getMirror() : bool
    {
        return $this->mirror;
    }

    /**
     * Sets the origin option value. Spaces are not allowed.
     * @param string $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function origin(string $value = null) : CloneCommand
    {
        OptionValidator::validNoSpace(self::OPTION_ORIGIN, $value);
        $this->origin = $value;
        return $this;
    }

    /**
     * Gets the value of property origin.
     * @return string|null Returns the value of property origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the branch option value.
     * @param string $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function branch(string $value = null) : CloneCommand
    {
        OptionValidator::validNoSpace(self::OPTION_BRANCH, $value);
        $this->branch = $value;
        return $this;
    }

    /**
     * Gets the value of property branch.
     * @return string|null Returns the value of property branch or null.
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Sets the upload-pack option value.
     * @param string|null $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function uploadPack(string $value = null) : CloneCommand
    {
        $this->uploadPack = $value;
        return $this;
    }

    /**
     * Gets the value of property upload-pack.
     * @return string|null Returns the value of property upload-pack or null.
     */
    public function getUploadPack()
    {
        return $this->uploadPack;
    }

    /**
     * Sets the reference option value.
     * @param string|null $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function reference(string $value = null) : CloneCommand
    {
        $this->reference = $value;
        return $this;
    }

    /**
     * Gets the value of property reference.
     * @return string|null Returns the value of property reference or null.
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Sets the dissociate option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function dissociate(bool $value = true) : CloneCommand
    {
        $this->dissociate = $value;
        return $this;
    }

    /**
     * Gets the value of property dissociate.
     * @return bool Returns the value of property dissociate.
     */
    public function getDissociate() : bool
    {
        return $this->dissociate;
    }

    /**
     * Sets the separate-git-dir option value.
     * @param string|null $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function separateGitDir(string $value = null) : CloneCommand
    {
        $this->separateGitDir = $value;
        return $this;
    }

    /**
     * Gets the value of property separateGitDir.
     * @return string|null Returns the value of property separateGitDir or null.
     */
    public function getSeparateGitDir()
    {
        return $this->separateGitDir;
    }

    /**
     * Sets the depth option value. Depth cannot be negative.
     * @param int $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function depth(int $value = 0) : CloneCommand
    {
        $this->depth = max(0, $value);  // depth cannot be negative
        return $this;
    }

    /**
     * Gets the value of property depth.
     * @return int Returns the value of property depth.
     */
    public function getDepth() : int
    {
        return $this->depth;
    }

    /**
     * Sets the single-branch option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function singleBranch(bool $value = true) : CloneCommand
    {
        ($this->singleBranch = $value) && $this->noSingleBranch = false;
        return $this;
    }

    /**
     * Gets the value of property single-branch.
     * @return bool Returns the value of property single-branch.
     */
    public function getSingleBranch() : bool
    {
        return $this->singleBranch;
    }

    /**
     * Sets the no-single-branch option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function noSingleBranch(bool $value = true) : CloneCommand
    {
        ($this->noSingleBranch = $value) && $this->singleBranch = false;
        return $this;
    }

    /**
     * Gets the value of property no-single-branch.
     * @return bool Returns the value of property no-single-branch.
     */
    public function getNoSingleBranch() : bool
    {
        return $this->noSingleBranch;
    }

    /**
     * Sets the recursive option value.
     * @param bool $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function recursive(bool $value = true) : CloneCommand
    {
        $this->recursive = $value;
        return $this;
    }

    /**
     * Gets the value of property recursive.
     * @return bool Returns the value of property recursive.
     */
    public function getRecursive() : bool
    {
        return $this->recursive;
    }

    /**
     * Sets an array of config options.
     * @param array $values The config options.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function configs(array $values) : CloneCommand
    {
        foreach ($values as $value) {
            if (is_string($value)) {
                $this->config($value);
            }
        }
        return $this;
    }

    /**
     * Sets a config option value or clears all config values.
     * @param string|null $value The option value.
     * @return CloneCommand Returns itself for method chaining.
     */
    public function config(string $value = null) : CloneCommand
    {
        OptionValidator::validNoSpace(self::OPTION_CONFIG, $value);
        if ($value === null) {
            $this->configClear();
        } else {
            $this->config[] = $value;
        }

        return $this;
    }

    /**
     * Gets the config options.
     * @return array The config options values.
     */
    public function getConfig() : array
    {
        return $this->config;
    }

    /**
     * Converts the command to string.
     * @return string Returns the command as a string.
     */
    public function __toString()
    {
        $str = self::ACTION;
        // --- template ---
        $str .= OptionFormatter::formatPath(self::OPTION_TEMPLATE, $this->template);
        // --- local|no-local ---
        $str .= OptionFormatter::formatBoolWithCounterpart(self::OPTION_LOCAL, $this->local, self::OPTION_NO_LOCAL,
            $this->noLocal);
        // --- shared ---
        $str .= OptionFormatter::formatBool(self::OPTION_SHARED, $this->shared);
        // --- no-hardlinks ---
        $str .= OptionFormatter::formatBool(self::OPTION_NO_HARDLINKS, $this->noHardlinks);
        // --- quiet ---
        $str .= OptionFormatter::formatBool(self::OPTION_QUIET, $this->quiet);
        // --- no-checkout ---
        $str .= OptionFormatter::formatBool(self::OPTION_NO_CHECKOUT, $this->noCheckout);
        // --- bare ---
        $str .= OptionFormatter::formatBool(self::OPTION_BARE, $this->bare);
        // --- mirror ---
        $str .= OptionFormatter::formatBool(self::OPTION_MIRROR, $this->mirror);
        // --- origin ---
        $str .= OptionFormatter::formatString(self::OPTION_ORIGIN, $this->origin);
        // --- branch ---
        $str .= OptionFormatter::formatString(self::OPTION_BRANCH, $this->branch);
        // --- upload-pack ---
        $str .= OptionFormatter::formatPath(self::OPTION_UPLOAD_PACK, $this->uploadPack);
        // --- reference ---
        $str .= OptionFormatter::formatPath(self::OPTION_REFERENCE, $this->reference);
        // --- dissociate ---
        $str .= OptionFormatter::formatBool(self::OPTION_DISSOCIATE, $this->dissociate);
        // --- separate-git-dir ---
        $str .= OptionFormatter::formatPath(self::OPTION_SEPARATE_GIT_DIR, $this->separateGitDir);
        // --- depth ---
        $str .= OptionFormatter::formatPositiveInteger(self::OPTION_DEPTH, $this->depth);
        // --- single-branch|no-single-branch ---
        $str .= OptionFormatter::formatBoolWithCounterpart(self::OPTION_SINGLE_BRANCH, $this->singleBranch,
            self::OPTION_NO_SINGLE_BRANCH, $this->noSingleBranch);
        // --- recursive ---
        $str .= OptionFormatter::formatBool(self::OPTION_RECURSIVE, $this->recursive);
        // --- config ---
        $str .= OptionFormatter::formatArray(self::OPTION_CONFIG, $this->config);
        // --- source ---
        $str .= ' ' . escapeshellarg($this->source);
        // --- destination ---
        ($this->destination !== '') && $str .= ' ' . escapeshellarg($this->destination);

        return $str;
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
     * Gets the command's repo context.
     * @return Repo The repo context.
     */
    public function getRepo() : Repo
    {
        return $this->repo;
    }

    /**
     * Clears all config options.
     * @return CloneCommand Returns itself for method chaining.
     */
    protected function configClear() : CloneCommand
    {
        $this->config = [];
        return $this;
    }
}
