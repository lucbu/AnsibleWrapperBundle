<?php

namespace Lucbu\AnsibleWrapperBundle\Builder;

use Lucbu\AnsibleWrapperBundle\Process\AnsibleProcess;
use Lucbu\AnsibleWrapperBundle\Exception\AnsibleProcessException;

/**
 * Class AnsibleProcessBuilder
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
class AnsibleProcessBuilder extends AbstractProcessBuilder implements AnsibleProcessBuilderInterface {

    private $ansibleBin = 'ansible';

    /**
     * @inheritdoc
     */
    public function __construct($hostPattern) {
        if (!empty($host_pattern) && (is_string($hostPattern) || is_callable([
              $hostPattern,
              '__toString'
            ]))
        ) {
            $arguments = [$this->ansibleBin, strval($hostPattern)];
        }
        else {
            throw new AnsibleProcessException(sprintf('The host pattern provided can\'t be used.'));
        }
        parent::__construct($arguments);
    }

    /**
     * @inheritdoc
     */
    public static function create($hostPattern) {
        return new static ($hostPattern);
    }

    /**
     * @inheritdoc
     */
    public function getAnsibleProcess() {
        return new AnsibleProcess($this->getProcess());
    }

    /**
     * @inheritdoc
     * @return AnsibleProcessBuilder
     */
    public function getAbstractProcess() {
        return $this->getAnsibleProcess();
    }

    /**
     * Module arguments.
     *
     * @param string $moduleArgs
     * @return AnsibleProcessBuilder
     */
    public function args($moduleArgs) {
        $newArguments = ['--args', $moduleArgs];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for vault password.
     * @return AnsibleProcessBuilder
     */
    public function askVaultPass() {
        $newArguments = ['--ask-vault-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run asynchronously, failing after X seconds (default=N/A).
     *
     * @param string $seconds
     * @return AnsibleProcessBuilder
     */
    public function background($seconds) {
        $newArguments = ['--background', $seconds];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Don't make any changes; instead, try to predict some of the changes that may occur.
     * @return AnsibleProcessBuilder
     */
    public function check() {
        $newArguments = ['--check'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * When changing (small) files and templates, show the differences in those files; works great with --check.
     * @return AnsibleProcessBuilder
     */
    public function diff() {
        $newArguments = ['--diff'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Set additional variables as key=value or YAML/JSON.
     *
     * @param string $extraVars
     * @return AnsibleProcessBuilder
     */
    public function extraVars($extraVars) {
        $newArguments = ['--extra-vars', $extraVars];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify number of parallel processes to use (default=5).
     *
     * @param string $forks
     * @return AnsibleProcessBuilder
     */
    public function forks($forks = "5") {
        $newArguments = ['--forks', $forks];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Show this help message and exit.
     * @return AnsibleProcessBuilder
     */
    public function help() {
        $newArguments = ['--help'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify inventory host path (default=/etc/ansible/hosts) or comma separated host list..
     *
     * @param string $inventory
     * @return AnsibleProcessBuilder
     */
    public function inventoryFile($inventory = "/etc/ansible/hosts") {
        $newArguments = ['--inventory-file', $inventory];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Further limit selected hosts to an additional pattern.
     *
     * @param string $subset
     * @return AnsibleProcessBuilder
     */
    public function limit($subset) {
        $newArguments = ['--limit', $subset];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Outputs a list of matching hosts; does not execute anything else.
     * @return AnsibleProcessBuilder
     */
    public function listHosts() {
        $newArguments = ['--list-hosts'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Module name to execute (default=command).
     *
     * @param string $moduleName
     * @return AnsibleProcessBuilder
     */
    public function moduleName($moduleName = "command") {
        $newArguments = ['--module-name', $moduleName];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify path(s) to module library (default=None).
     *
     * @param string $modulePath
     * @return AnsibleProcessBuilder
     */
    public function modulePath($modulePath) {
        $newArguments = ['--module-path', $modulePath];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * New vault password file for rekey.
     *
     * @param string $newVaultPasswordFile
     * @return AnsibleProcessBuilder
     */
    public function newVaultPasswordFile($newVaultPasswordFile) {
        $newArguments = ['--new-vault-password-file', $newVaultPasswordFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Condense output.
     * @return AnsibleProcessBuilder
     */
    public function oneLine() {
        $newArguments = ['--one-line'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Output file name for encrypt or decrypt; use - for stdout.
     *
     * @param string $outputFile
     * @return AnsibleProcessBuilder
     */
    public function output($outputFile) {
        $newArguments = ['--output', $outputFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Set the poll interval if using -B (default=15).
     *
     * @param string $pollInterval
     * @return AnsibleProcessBuilder
     */
    public function poll($pollInterval = "15") {
        $newArguments = ['--poll', $pollInterval];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Perform a syntax check on the playbook, but do not execute it.
     * @return AnsibleProcessBuilder
     */
    public function syntaxCheck() {
        $newArguments = ['--syntax-check'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Log output to this directory.
     *
     * @param string $tree
     * @return AnsibleProcessBuilder
     */
    public function tree($tree) {
        $newArguments = ['--tree', $tree];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Vault password file.
     *
     * @param string $vaultPasswordFile
     * @return AnsibleProcessBuilder
     */
    public function vaultPasswordFile($vaultPasswordFile) {
        $newArguments = ['--vault-password-file', $vaultPasswordFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Verbose mode (-vvv for more, -vvvv to enable connection debugging).
     * @return AnsibleProcessBuilder
     */
    public function verbose() {
        $newArguments = ['--verbose'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Show program's version number and exit.
     * @return AnsibleProcessBuilder
     */
    public function version() {
        $newArguments = ['--version'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for connection password.
     * @return AnsibleProcessBuilder
     */
    public function askPass() {
        $newArguments = ['--ask-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Use this file to authenticate the connection.
     *
     * @param string $privateKeyFile
     * @return AnsibleProcessBuilder
     */
    public function privateKey($privateKeyFile) {
        $newArguments = ['--private-key', $privateKeyFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Use this file to authenticate the connection.
     *
     * @param string $privateKeyFile
     * @return AnsibleProcessBuilder
     */
    public function keyFile($privateKeyFile) {
        $newArguments = ['--key-file', $privateKeyFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Connect as this user (default=None).
     *
     * @param string $remoteUser
     * @return AnsibleProcessBuilder
     */
    public function user($remoteUser) {
        $newArguments = ['--user', $remoteUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Connection type to use (default=smart).
     *
     * @param string $connection
     * @return AnsibleProcessBuilder
     */
    public function connection($connection = "smart") {
        $newArguments = ['--connection', $connection];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Override the connection timeout in seconds (default=10).
     *
     * @param string $timeout
     * @return AnsibleProcessBuilder
     */
    public function timeout($timeout = "10") {
        $newArguments = ['--timeout', $timeout];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify common arguments to pass to sftp/scp/ssh (e.g. ProxyCommand).
     *
     * @param string $sshCommonArgs
     * @return AnsibleProcessBuilder
     */
    public function sshCommonArgs($sshCommonArgs) {
        $newArguments = ['--ssh-common-args', $sshCommonArgs];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify extra arguments to pass to sftp only (e.g. -f, -l).
     *
     * @param string $sftpExtraArgs
     * @return AnsibleProcessBuilder
     */
    public function sftpExtraArgs($sftpExtraArgs) {
        $newArguments = ['--sftp-extra-args', $sftpExtraArgs];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify extra arguments to pass to scp only (e.g. -l).
     *
     * @param string $scpExtraArgs
     * @return AnsibleProcessBuilder
     */
    public function scpExtraArgs($scpExtraArgs) {
        $newArguments = ['--scp-extra-args', $scpExtraArgs];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify extra arguments to pass to ssh only (e.g. -R).
     *
     * @param string $sshExtraArgs
     * @return AnsibleProcessBuilder
     */
    public function sshExtraArgs($sshExtraArgs) {
        $newArguments = ['--ssh-extra-args', $sshExtraArgs];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with sudo (nopasswd) (deprecated, use become).
     * @return AnsibleProcessBuilder
     */
    public function sudo() {
        $newArguments = ['--sudo'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Desired sudo user (default=root) (deprecated, use become).
     *
     * @param string $sudoUser
     * @return AnsibleProcessBuilder
     */
    public function sudoUser($sudoUser = "root") {
        $newArguments = ['--sudo-user', $sudoUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with su (deprecated, use become).
     * @return AnsibleProcessBuilder
     */
    public function su() {
        $newArguments = ['--su'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with su as this user (default=root) (deprecated, use become).
     *
     * @param string $suUser
     * @return AnsibleProcessBuilder
     */
    public function suUser($suUser = "root") {
        $newArguments = ['--su-user', $suUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with become (does not imply password prompting).
     * @return AnsibleProcessBuilder
     */
    public function become() {
        $newArguments = ['--become'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Privilege escalation method to use (default=sudo), valid choices: [ sudo | su | pbrun | pfexec | runas | doas | dzdo ].
     *
     * @param string $becomeMethod
     * @return AnsibleProcessBuilder
     */
    public function becomeMethod($becomeMethod = "sudo") {
        $newArguments = ['--become-method', $becomeMethod];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations as this user (default=root).
     *
     * @param string $becomeUser
     * @return AnsibleProcessBuilder
     */
    public function becomeUser($becomeUser = "root") {
        $newArguments = ['--become-user', $becomeUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for sudo password (deprecated, use become).
     * @return AnsibleProcessBuilder
     */
    public function askSudoPass() {
        $newArguments = ['--ask-sudo-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for su password (deprecated, use become).
     * @return AnsibleProcessBuilder
     */
    public function askSuPass() {
        $newArguments = ['--ask-su-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for privilege escalation password.
     * @return AnsibleProcessBuilder
     */
    public function askBecomePass() {
        $newArguments = ['--ask-become-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

}
