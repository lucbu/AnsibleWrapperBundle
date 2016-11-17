<?php

namespace Lucbu\AnsibleWrapperBundle\Event;

use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AnsibleProcessNewOutputEvent
 * @package Lucbu\AnsibleWrapperBundle
 */
class AnsibleProcessNewOutputEvent extends Event {

    const NAME = 'ansible_process.new_output', STATUS_ERROR = 1, STATUS_OK = 0;

    /**
     * @var AnsibleProcess
     */
    protected $process;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $line;

    /**
     * AnsibleProcessNewOutputEvent constructor.
     *
     * @param AnsibleProcess $process
     *   The process that has new output.
     * @param $status
     *   The status of the output.
     * @param $line
     *   The line that correspond to the new output
     */
    public function __construct(AnsibleProcess $process, $status = self::STATUS_OK, $line) {
        $this->process = $process;
        $this->status = $status;
        $this->line = $line;
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