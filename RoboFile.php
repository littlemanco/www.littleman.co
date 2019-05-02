<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Runs lints over the codebase
     * 
     * @option files A space separated list of files to lint
     */
    public function lint()
    {   
        $this->taskExecStack()
            ->stopOnFail()
            ->exec('yamllint .')
            ->run();
    }
}
