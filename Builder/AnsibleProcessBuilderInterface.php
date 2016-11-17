<?php

namespace Lucbu\AnsibleWrapperBundle\Builder;

use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Symfony\Component\Process\Exception\LogicException;

/**
 * Interface AnsibleProcessBuilderInterface
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
interface AnsibleProcessBuilderInterface {

    /**
     * AnsibleProcessBuilder constructor.
     *
     * @param string|object $hostPattern
     *    The host-pattern.
     * @throw AnsibleProcessException
     */
    public function __construct($hostPattern);

    /**
     * Creates a AnsibleProcessBuilder instance.
     *
     * @param string $hostPattern
     *    The host-pattern.
     * @return AnsibleProcessBuilder
     */
    public static function create($hostPattern);

    /**
     * Creates a Symfony\Component\Process\Process instance add it to AnsibleProcess process and returns it.
     *
     * @return AnsibleProcess
     *
     * @throws LogicException In case no arguments have been provided
     */
    public function getAnsibleProcess();
}