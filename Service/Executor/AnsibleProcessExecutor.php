<?php

namespace Lucbu\AnsibleWrapperBundle\Service\Executor;
use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Lucbu\AnsibleWrapperBundle\Event\AnsibleProcessFinishEvent;
use Lucbu\AnsibleWrapperBundle\Event\AnsibleProcessNewOutputEvent;
use Lucbu\AnsibleWrapperBundle\Event\AnsibleProcessStartEvent;
use Lucbu\AnsibleWrapperBundle\Exception\AnsibleProcessException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class AnsibleProcessExecutor
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
class AnsibleProcessExecutor extends AbstractProcessExecutor implements AnsibleProcessExecutorInterface {

    protected $ansibleBinDirectory;

    protected $ansibleUser;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * AnsibleProcessExecutor constructor.
     * @param string|object $ansibleUser
     *   The user that can run ansible bin.
     * @param string|object $ansibleBinDirectory
     *   The directory where the ansible bin is.
     * @param EventDispatcherInterface $eventDispatcher
     *   The EventDispatcher.
     */
    public function __construct($ansibleUser, $ansibleBinDirectory, EventDispatcherInterface $eventDispatcher) {
        parent::__construct($ansibleUser, $ansibleBinDirectory);

        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function executeAnsibleProcess(AnsibleProcess $ansibleProcess) {
        $this->prepareProcess($ansibleProcess);
        $process = $ansibleProcess->getProcess();
        $output = '';
        $eventDispatcher = $this->eventDispatcher;
        $this->eventDispatcher->dispatch(AnsibleProcessStartEvent::NAME, new AnsibleProcessStartEvent($ansibleProcess));
        $status = AnsibleProcessFinishEvent::STATUS_OK;
        try {
            $process->mustRun(
                // Callback used on each output sent by the process
              function ($type, $buffer) use ($eventDispatcher, $ansibleProcess, $status) {
                  // Setting the status of the output
                  $statusLine = AnsibleProcessNewOutputEvent::STATUS_ERROR;
                  if (!Process::ERR === $type) {
                      $statusLine = AnsibleProcessNewOutputEvent::STATUS_OK;
                  }
                  // Dispatch the event of new output
                  $eventDispatcher->dispatch(AnsibleProcessNewOutputEvent::NAME, new AnsibleProcessNewOutputEvent($ansibleProcess, $statusLine, $buffer));
              }
            );
        } catch (ProcessFailedException $e) {
            $status = AnsibleProcessFinishEvent::STATUS_ERROR;
            throw new AnsibleProcessException($e->getMessage());
        } finally {
            $eventDispatcher->dispatch(AnsibleProcessNewOutputEvent::NAME, new AnsibleProcessFinishEvent($ansibleProcess, $status));
        }

        return $output;
    }
}