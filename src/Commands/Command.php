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

namespace axelitus\FluGit\Commands;

use axelitus\FluGit\Repo;

/**
 * Interface Command
 * @package axelitus\FluGit\Commands
 */
interface Command
{
    /**
     * Compiles the command and returns an executable git command.
     * @return GitCommand An executable git command.
     */
    public function compile() : GitCommand;

    /**
     * Gets the command's repo context.
     * @return Repo The repo context.
     */
    public function getRepo() : Repo;

    /**
     * Converts the command to string.
     * @return string Returns the command as a string.
     */
    public function __toString();
}
