<?php

namespace Lucbu\AnsibleWrapperBundle\Service;

/**
 * Interface AnsibleMessageFormatterInterface
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
interface AnsibleMessageFormatterInterface {

  /**
   * @param $output string
   *   The output of the ansible.
   * @return array
   *   The array corresponding to the output.
   */
  public function getAnsibleOutputAsAnArray($output);


  /**
   * @param $output string
   *   The output of the ansible.
   * @return string
   *   The clean message corresponding to the output.
   */
  public function getAnsibleCleanMessageFromOutput($output);

  /**
   * @param $outputArray array
   *   The output of the ansible.
   * @return string
   *   The clean message corresponding to the array output.
   */
  public function getAnsibleCleanMessageFromArray(array $outputArray);
}