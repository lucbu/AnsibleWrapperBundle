<?php

namespace Lucbu\AnsibleWrapperBundle\Service\Executor;

use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Lucbu\AnsibleWrapperBundle\Event\AnsiblePlaybookProcessFinishEvent;
use Lucbu\AnsibleWrapperBundle\Event\AnsiblePlaybookProcessNewOutputEvent;
use Lucbu\AnsibleWrapperBundle\Event\AnsiblePlaybookProcessStartEvent;
use Lucbu\AnsibleWrapperBundle\Exception\AnsiblePlaybookProcessException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class AnsiblePlaybookProcessExecutor
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
class AnsiblePlaybookProcessExecutor extends AbstractProcessExecutor implements AnsiblePlaybookProcessExecutorInterface {
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * AnsiblePlaybookProcessExecutor constructor.
     * @param string|object $ansiblePlaybookUser
     *   The user that can run ansible bin.
     * @param string|object $ansiblePlaybookBinDirectory
     *   The directory where the ansible bin is.
     * @param EventDispatcherInterface $eventDispatcher
     *   The EventDispatcher.
     */
    public function __construct($ansiblePlaybookUser, $ansiblePlaybookBinDirectory, EventDispatcherInterface $eventDispatcher) {
        parent::__construct($ansiblePlaybookUser, $ansiblePlaybookBinDirectory);
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function executeAnsiblePlaybookProcess(AnsiblePlaybookProcess $ansiblePlaybookProcess) {
        $this->prepareProcess($ansiblePlaybookProcess);
        set_time_limit(0);
        $process = $ansiblePlaybookProcess->getProcess();
        $output = '';
        $eventDispatcher = $this->eventDispatcher;
        $this->eventDispatcher->dispatch(AnsiblePlaybookProcessStartEvent::NAME, new AnsiblePlaybookProcessStartEvent($ansiblePlaybookProcess));
        $status = AnsiblePlaybookProcessFinishEvent::STATUS_OK;
        try {
            $process->mustRun(
                // Callback used on each output sent by the process
              function ($type, $buffer) use ($eventDispatcher, $ansiblePlaybookProcess, $status) {
                  // Setting the status of the output
                  $statusLine = AnsiblePlaybookProcessNewOutputEvent::STATUS_ERROR;
                  if (!Process::ERR === $type) {
                      $statusLine = AnsiblePlaybookProcessNewOutputEvent::STATUS_OK;
                  }
                  // Dispatch the event of new output
                  $eventDispatcher->dispatch(AnsiblePlaybookProcessNewOutputEvent::NAME, new AnsiblePlaybookProcessNewOutputEvent($ansiblePlaybookProcess, $statusLine, $buffer));
              }
            );
            $output = $process->getOutput();
        } catch (ProcessFailedException $e) {
            $status = AnsiblePlaybookProcessFinishEvent::STATUS_ERROR;
            throw new AnsiblePlaybookProcessException($e->getMessage());
        } finally {
            set_time_limit(get_cfg_var('max_execution_time'));
            $eventDispatcher->dispatch(AnsiblePlaybookProcessNewOutputEvent::NAME, new AnsiblePlaybookProcessFinishEvent($ansiblePlaybookProcess, $status));
        }

        return $output;
    }
}