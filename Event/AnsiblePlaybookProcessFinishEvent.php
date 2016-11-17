<?php

namespace Lucbu\AnsibleWrapperBundle\Event;

use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AnsiblePlaybookProcessFinishEvent
 * @package Lucbu\AnsibleWrapperBundle
 */
class AnsiblePlaybookProcessFinishEvent extends Event {

    const NAME = 'ansible_playbook_process.finish', STATUS_ERROR = 1, STATUS_OK = 0;

    /**
     * @var AnsiblePlaybookProcess
     */
    protected $process;

    /**
     * @var int
     */
    protected $status;

    /**
     * AnsibleProcessFinishEvent constructor.
     *
     * @param AnsiblePlaybookProcess $process
     *   The process that finished.
     * @param $status
     *   The status of the process.
     */
    public function __construct(AnsiblePlaybookProcess $process, $status = self::STATUS_OK) {
        $this->process = $process;
        $this->status = $status;
    }

    /**
     * Return the process that finished
     *
     * @return AnsiblePlaybookProcess
     */
    public function getProcess() {
        return $this->process;
    }

    /**
     * Return the status code.
     *
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }
}