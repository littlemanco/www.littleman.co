<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    const CONTAINER_PATH = 'build/containers';
    const CONTAINER_NAMESPACE = 'gcr.io/littleman-co/www-littleman-co';

    /**
     * Runs lints over the codebase
     *
     * @option files A space separated list of files to lint
     */
    public function lint()
    {
        return $this->taskExecStack()
            ->stopOnFail()
            ->exec('yamllint .')
            ->run();
    }

    /**
     * Runs unit tests on the codebase
     */
    public function testUnit()
    {
        $this->say('This project has no unit tests; this is a demonstration task');
    }

    /**
     * Builds containers. Available containers are those at the path "build/containers"
     *
     * @option container The container to build
     */
    public function containerBuild($opts = ['container' => 'web'])
    {
        $refspec       = exec('git rev-parse --short HEAD');
        $containerName = self::CONTAINER_NAMESPACE . '--' . $opts['container'];

        $this->taskDockerBuild(self::CONTAINER_PATH . DIRECTORY_SEPARATOR . $opts['container'])
            ->tag($containerName . ':' . $refspec)
            ->tag($containerName . ':latest' )
            ->run();
    }

    /**
     * Pushes containers
     * 
     * @option container The container to push upstream
     */
    public function containerPush($opts = ['container' => 'web'])
    {
        $refspec       = exec('git rev-parse --short HEAD');
        $containerName = self::CONTAINER_NAMESPACE . '--' . $opts['container'];

        $this->taskExec('docker')
            ->args(['push', $containerName . ':' . $refspec])
            ->run();
        $this->taskExec('docker')
            ->args(['push', $containerName . ':latest'])
            ->run();
    }
}