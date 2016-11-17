<?php

namespace Lucbu\AnsibleWrapperBundle\Process;

use \Symfony\Component\Process\Process;

abstract class AbstractProcess {

    /**
     * @var Process
     */
    private $process;

    public function __construct(Process $process) {
        $this->process = $process;
    }

    /**
     * @return Process
     */
    public function getProcess() {
        return $this->process;
    }

    /**
     * @param Process $process
     */
    public function setProcess($process) {
        $this->process = $process;
    }

}