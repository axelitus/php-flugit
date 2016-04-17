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

namespace axelitus\FluGit;

use axelitus\FluGit\Commands\Workspace\InitCommand;
use RuntimeException;

/**
 * Class Repo
 * @package axelitus\FluGit
 */
class Repo
{
    /**
     * @var string The repo's path.
     */
    protected $path;

    /**
     * Repo constructor. Creates a new Repo instance.
     * @param string $path The path to the repo.
     */
    public function __construct(string $path = '')
    {
        $this->path = $path;
    }

    /**
     * Sets the repo's path.
     * @param string $path The path to the repo.
     */
    public function setPath(string $path)
    {
        $this->setPath($path);
    }

    /**
     * Gets the repo's path.
     * @return string Returns the repo's path.
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * Creates a git init command.
     * @param string $destination The destination path.
     * @return InitCommand The newly created command.
     */
    public function init(string $destination = '') : InitCommand
    {
        return new InitCommand($this, $destination);
    }
}
