<?php

namespace Lucbu\AnsibleWrapperBundle\Builder;
use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Symfony\Component\Process\Exception\LogicException;

/**
 * Interface AnsiblePlaybookProcessBuilderInterface
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
interface AnsiblePlaybookProcessBuilderInterface {

    /**
     * AnsibleProcessBuilder constructor.
     *
     * @param string|object $playbookFile
     *    The playbook file.
     * @throw AnsiblePlaybookProcessException
     */
    public function __construct($playbookFile);

    /**
     * Creates a AnsibleProcessBuilder instance.
     *
     * @param string $playbookFile
     *    The playbook file.
     * @return AnsiblePlaybookProcessBuilder
     */
    public static function createBuilder($playbookFile);


    /**
     * Creates a Symfony\Component\Process\Process instance add it to AnsiblePlaybookProcess process and returns it.
     *
     * @return AnsiblePlaybookProcess
     *
     * @throws LogicException In case no arguments have been provided
     */
    public function getAnsiblePlaybookProcess();
}