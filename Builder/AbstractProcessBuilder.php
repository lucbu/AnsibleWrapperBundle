<?php

namespace Lucbu\AnsibleWrapperBundle\Builder;
use Lucbu\AnsibleWrapperBundle\Process\AbstractProcess;
use Symfony\Component\Process\ProcessBuilder as SymfonyProcessBuilder;

/**
 * Class ProcessBuilder
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
abstract class AbstractProcessBuilder extends SymfonyProcessBuilder {

    /**
     * @inheritdoc
     */
    public function __construct($arguments = array())
    {
        parent::__construct($arguments);
    }

    /**
     * Add an array of new arguments to the process.
     *
     * @param array $newArguments
     *    The array of new arguments.
     */
    protected function addArguments(array $newArguments){
        foreach ($newArguments as $newArgument) {
            $this->add($newArgument);
        }
    }

    /**
     * @return AbstractProcess
     *   The abstract process.
     */
    abstract public function getAbstractProcess();

}
