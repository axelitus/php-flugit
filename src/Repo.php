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
    public function __construct(string $path)
    {
        if (!is_dir($path)) {
            throw new RuntimeException(
                sprintf(
                    'Directory "%s" does not exist',
                    $path
                )
            );
        }

        $this->path = realpath($path);
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
     * @return InitCommand The newly created command.
     */
    public function init() : InitCommand
    {
        return new InitCommand();
    }
}
