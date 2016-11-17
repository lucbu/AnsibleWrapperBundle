<?php

namespace Lucbu\AnsibleWrapperBundle\Service\Executor;

use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Lucbu\AnsibleWrapperBundle\Exception\AnsibleProcessException;

/**
 * Interface AnsibleProcessExecutorInterface
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
interface AnsibleProcessExecutorInterface {

    /**
     * Launch the AnsibleProcess with the user given
     *
     * @param AnsibleProcess $ansibleProcess
     *    The process to launch
     * @return string
     *    The output given by the process
     * @throws AnsibleProcessException
     *    In case an error during the execution
     */
    public function executeAnsibleProcess(AnsibleProcess $ansibleProcess);
}