<?php

namespace Lucbu\AnsibleWrapperBundle\Service\Executor;

use Lucbu\AnsibleWrapperBundle\Process\AbstractProcess;

abstract class AbstractProcessExecutor {

    protected $user;

    protected $workingDirectory;

    /**
     * AbstractProcessExecutor constructor.
     * @param string|object|null $user
     *   The user who will run process.
     * @param string|object $workingDirectory
     *   The directory where the process should be execute.
     */
    public function __construct($user, $workingDirectory){
        $this->setUser($user);
        $this->setWorkingDirectory($workingDirectory);
    }

    /**
     * @param string|object|null $user
     */
    private function setUser($user) {
        // Check if the user can be set as an argument to sudo
        if(!empty($user) && (is_string($user) || is_callable([$user, '__toString']))) {
            $this->user = $user;
        }else {
            $this->user = null;
        }
    }

    /**
     * @param mixed $workingDirectory
     */
    private function setWorkingDirectory($workingDirectory) {
        if((is_string($workingDirectory) || is_callable([$workingDirectory, '__toString']))) {
            $this->workingDirectory = $workingDirectory;
        }else {
            $this->workingDirectory = null;
        }
    }

    /**
     * @param AbstractProcess $process
     *   The Process to prepare.
     */
    protected function prepareProcess(AbstractProcess $process) {
        $actualProcess = $process->getProcess();
        $actualProcess->setTimeout(null);
        if(!is_null($this->user)) {
            // TODO: I'm pretty sure this is not ok.
            $actualProcess->setCommandLine("'sudo' '--user' '" . $this->user . "' " . $actualProcess->getCommandLine());
        }
        $actualProcess->setWorkingDirectory($this->workingDirectory);
    }
}