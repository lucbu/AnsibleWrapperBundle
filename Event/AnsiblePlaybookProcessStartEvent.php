<?php

namespace Lucbu\AnsibleWrapperBundle\Event;

use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AnsiblePlaybookProcessStartEvent
 * @package Lucbu\AnsibleWrapperBundle
 */
class AnsiblePlaybookProcessStartEvent extends Event {

    const NAME = 'ansible_playbook_process.start';

    /**
     * @var AnsiblePlaybookProcess
     */
    protected $process;

    /**
     * AnsiblePlaybookProcessFinishEvent constructor.
     *
     * @param AnsiblePlaybookProcess $process
     *   The process that started.
     */
    public function __construct(AnsiblePlaybookProcess $process) {
        $this->process = $process;
    }

    /**
     * Return the process that started
     *
     * @return AnsiblePlaybookProcess
     */
    public function getProcess() {
        return $this->process;
    }
}