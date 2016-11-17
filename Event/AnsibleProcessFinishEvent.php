<?php

namespace Lucbu\AnsibleWrapperBundle\Event;

use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AnsibleProcessFinishEvent
 * @package Lucbu\AnsibleWrapperBundle
 */
class AnsibleProcessFinishEvent extends Event {

    const NAME = 'ansible_process.finish', STATUS_ERROR = 1, STATUS_OK = 0;

    /**
     * @var AnsibleProcess
     */
    protected $process;

    /**
     * @var int
     */
    protected $status;

    /**
     * AnsibleProcessFinishEvent constructor.
     *
     * @param AnsibleProcess $process
     *   The process that finished.
     * @param $status
     *   The status of the process.
     */
    public function __construct(AnsibleProcess $process, $status = self::STATUS_OK) {
        $this->process = $process;
        $this->status = $status;
    }

    /**
     * Return the process that finished
     *
     * @return AnsibleProcess
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