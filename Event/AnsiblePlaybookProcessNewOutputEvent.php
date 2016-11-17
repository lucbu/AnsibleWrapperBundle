<?php

namespace Lucbu\AnsibleWrapperBundle\Event;

use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AnsiblePlaybookProcessNewOutputEvent
 * @package Lucbu\AnsibleWrapperBundle
 */
class AnsiblePlaybookProcessNewOutputEvent extends Event {

    const NAME = 'ansible_playbook_process.new_output', STATUS_ERROR = 1, STATUS_OK = 0;

    /**
     * @var AnsiblePlaybookProcess
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
     * @param AnsiblePlaybookProcess $process
     *   The process that has new output.
     * @param $status
     *   The status of the output.
     * @param $line
     *   The line that correspond to the new output
     */
    public function __construct(AnsiblePlaybookProcess $process, $status = self::STATUS_OK, $line) {
        $this->process = $process;
        $this->status = $status;
        $this->line = $line;
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