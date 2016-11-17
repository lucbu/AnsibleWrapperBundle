<?php

namespace Lucbu\AnsibleWrapperBundle\Event;

use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AnsibleProcessStartEvent
 * @package Lucbu\AnsibleWrapperBundle
 */
class AnsibleProcessStartEvent extends Event {

    const NAME = 'ansible_process.start';

    /**
     * @var AnsibleProcess
     */
    protected $process;

    /**
     * AnsibleProcessFinishEvent constructor.
     *
     * @param AnsibleProcess $process
     *   The process that started.
     */
    public function __construct(AnsibleProcess $process) {
        $this->process = $process;
    }

    /**
     * Return the process that started
     *
     * @return AnsibleProcess
     */
    public function getProcess() {
        return $this->process;
    }
}