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
            ->exec('yamllint .');
    }

    /**
     * Runs unit tests on the codebase
     */
    public function testUnit()
    {
        $this->say('This project has no unit tests; this is a demonstration task');
    }

    /**
     * Runs integration tests on the codebase
     */
    public function testIntegration()
    {
        $this->say('This project has no integration tests; this is a demonstration task');
    }

    /**
     * Runs smoke tests on the codebase
     */
    public function testSmoke()
    {
        $this->say('This project has no smoke tests; this is a demonstration task');
    }

    /**
     * Runs stress tests on the codebase
     */
    public function testStress()
    {
        $this->say('This project has no stress tests; this is a demonstration task');
    }

    /**
     * Compiles the static site
     */
    public function applicationCompile()
    {
        return $this->taskExec('hugo');
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

        return $this->taskDockerBuild('.')
            ->args([
                "--file=" 
                . self::CONTAINER_PATH 
                . DIRECTORY_SEPARATOR 
                . $opts['container'] 
                . DIRECTORY_SEPARATOR 
                . 'Dockerfile'
                ])
            ->tag($containerName . ':' . $refspec)
            ->tag($containerName . ':latest' );
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

        return $this->taskExecStack('docker')
            ->stopOnFail()
            ->exec('docker push ' . $containerName . ':' . $refspec)
            ->exec('docker push ' . $containerName . ':latest');
    }

    /**
     * Pushes a change to a given environment
     * 
     * @option environment The environment to push to. Should be one of "testing", "canary" or "production"
     */
    public function deploy($opts = ['environment' => 'testing'])
    {
        $this->say('This project does not deploy with this yet, though it would deploy to ' . $opts['environment']);
    }

    /**
     * Rolls back a change to a given environment to the previous version of that change.
     */
    public function rollback()
    {
        $this->say('This project does not rollback yet');
    }
}
