<?php

namespace Lucbu\AnsibleWrapperBundle\Service\Executor;

use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Lucbu\AnsibleWrapperBundle\Exception\AnsiblePlaybookProcessException;

/**
 * Interface AnsiblePlaybookProcessExecutorInterface
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
interface AnsiblePlaybookProcessExecutorInterface {

    /**
     * Launch the AnsiblePlaybookProcess with the user given.
     *
     * @param AnsiblePlaybookProcess $ansiblePlaybookProcess
     *    The process to launch.
     * @return string
     *    The output given by the process.
     * @throws AnsiblePlaybookProcessException
     *    In case an error during the execution.
     */
    public function executeAnsiblePlaybookProcess(AnsiblePlaybookProcess $ansiblePlaybookProcess);
}