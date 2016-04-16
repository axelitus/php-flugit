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

use RuntimeException;

/**
 * Class GitCommand
 * @package axelitus\FluGit\Commands
 */
class GitCommand
{
    /**
     * @var Command The git command that can be executed in a repo.
     */
    protected $command;

    /**
     * GitCommand constructor. Creates a new GitCommand instance.
     * @param Command $command A git command that can be executed in the repo's context.
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Prepares the git command for execution.
     * @param Command $command The command to prepare.
     * @return string The prepared git command.
     */
    protected function prepare(Command $command) : string
    {
        $path = $command->getRepo()->getPath();
        $git = 'git -C ' . $path . ' ' . $this->command;
        return $git;
    }

    /**
     * Executes the git command.
     * @return string[] Returns the output of the command.
     */
    public function execute() : array
    {
        $git = $this->prepare($this->command);
        exec($git, $output, $exitCode);
        if ($exitCode !== 0) {
            throw new RuntimeException(implode("\r\n", $output));
        }
        return $output;
    }
}
