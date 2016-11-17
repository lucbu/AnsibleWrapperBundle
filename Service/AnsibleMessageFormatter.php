<?php

namespace Lucbu\AnsibleWrapperBundle\Service;

/**
 * Class AnsibleMessageFormatter
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
class AnsibleMessageFormatter implements AnsibleMessageFormatterInterface {

  public function getAnsibleOutputAsAnArray($output) {
    return json_encode($output);
  }

  public function getAnsibleCleanMessageFromOutput($output) {
    return $this->getAnsibleCleanMessageFromArray($this->getAnsibleOutputAsAnArray($output));
  }

  public function getAnsibleCleanMessageFromArray(array $outputArray) {
    // TODO : Set comprehensive message from array
    return json_decode($outputArray);
  }
}