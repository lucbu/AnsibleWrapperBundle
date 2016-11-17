<?php

namespace Lucbu\AnsibleWrapperBundle\Builder;

use Lucbu\AnsibleWrapperBundle\Process\AnsiblePlaybookProcess;
use Lucbu\AnsibleWrapperBundle\Exception\AnsiblePlaybookProcessException;

/**
 * Class AnsiblePlaybookProcessBuilder
 * @package Lucbu\AnsibleWrapperBundle\Service
 */
class AnsiblePlaybookProcessBuilder extends AbstractProcessBuilder implements AnsiblePlaybookProcessBuilderInterface {

    private $ansiblePlaybookBin = 'ansible-playbook';

    /**
     * @inheritdoc
     */
    public function __construct($playbookFile) {
        if (!empty($playbookFile) && (is_string($playbookFile) || is_callable([
              $playbookFile,
              '__toString'
            ]))
        ) {
            $arguments = [$this->ansiblePlaybookBin, strval($playbookFile)];
        }
        else {
            throw new AnsiblePlaybookProcessException(sprintf('The playbook file provided can\'t be used.'));
        }
        parent::__construct($arguments);
    }

    /**
     * @inheritdoc
     */
    public static function createBuilder($playbookFile) {
        return new static ($playbookFile);
    }

    /**
     * @inheritdoc
     */
    public function getAnsiblePlaybookProcess() {
        return new AnsiblePlaybookProcess($this->getProcess());
    }

    /**
     * @inheritdoc
     * @return AnsiblePlaybookProcessBuilder
     */
    public function getAbstractProcess() {
        return $this->getAnsiblePlaybookProcess();
    }

    /**
     * Ask for vault password.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function askVaultPass() {
        $newArguments = ['--ask-vault-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Don't make any changes; instead, try to predict some of the changes that may occur.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function check() {
        $newArguments = ['--check'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * When changing (small) files and templates, show the differences in those files; works great with --check.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function diff() {
        $newArguments = ['--diff'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Set additional variables as key=value or YAML/JSON.
     *
     * @param string|array $extraVars
     * @return AnsiblePlaybookProcessBuilder
     */
    public function extraVars($extraVars) {
        if(is_array($extraVars)) {
            $extraVars = json_encode($extraVars);
        }
        $newArguments = ['--extra-vars', $extraVars];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Clear the fact cache.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function flushCache() {
        $newArguments = ['--flush-cache'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run handlers even if a task fails.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function forceHandlers() {
        $newArguments = ['--force-handlers'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify number of parallel processes to use (default=5).
     *
     * @param string $forks
     * @return AnsiblePlaybookProcessBuilder
     */
    public function forks($forks = "5") {
        $newArguments = ['--forks', $forks];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Show this help message and exit.
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function limit($subset) {
        $newArguments = ['--limit', $subset];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Outputs a list of matching hosts; does not execute anything else.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function listHosts() {
        $newArguments = ['--list-hosts'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * List all available tags.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function listTags() {
        $newArguments = ['--list-tags'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * List all tasks that would be executed.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function listTasks() {
        $newArguments = ['--list-tasks'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Specify path(s) to module library (default=None).
     *
     * @param string $modulePath
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function newVaultPasswordFile($newVaultPasswordFile) {
        $newArguments = ['--new-vault-password-file', $newVaultPasswordFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Output file name for encrypt or decrypt; use - for stdout.
     *
     * @param string $outputFile
     * @return AnsiblePlaybookProcessBuilder
     */
    public function output($outputFile) {
        $newArguments = ['--output', $outputFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Only run plays and tasks whose tags do not match these values.
     *
     * @param string $skipTags
     * @return AnsiblePlaybookProcessBuilder
     */
    public function skipTags($skipTags) {
        $newArguments = ['--skip-tags', $skipTags];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Start the playbook at the task matching this name.
     *
     * @param string $startAtTask
     * @return AnsiblePlaybookProcessBuilder
     */
    public function startAtTask($startAtTask) {
        $newArguments = ['--start-at-task', $startAtTask];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * One-step-at-a-time: confirm each task before running.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function step() {
        $newArguments = ['--step'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Perform a syntax check on the playbook, but do not execute it.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function syntaxCheck() {
        $newArguments = ['--syntax-check'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Only run plays and tasks tagged with these values.
     *
     * @param string $tags
     * @return AnsiblePlaybookProcessBuilder
     */
    public function tags($tags) {
        $newArguments = ['--tags', $tags];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Vault password file.
     *
     * @param string $vaultPasswordFile
     * @return AnsiblePlaybookProcessBuilder
     */
    public function vaultPasswordFile($vaultPasswordFile) {
        $newArguments = ['--vault-password-file', $vaultPasswordFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Verbose mode (-vvv for more, -vvvv to enable connection debugging).
     * @return AnsiblePlaybookProcessBuilder
     */
    public function verbose() {
        $newArguments = ['--verbose'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Show program's version number and exit Connection Options:  control as whom and how to connect to hosts.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function version() {
        $newArguments = ['--version'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for connection password.
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function privateKey($privateKeyFile) {
        $newArguments = ['--private-key', $privateKeyFile];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Connect as this user (default=None).
     *
     * @param string $remoteUser
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function sshExtraArgs($sshExtraArgs) {
        $newArguments = ['--ssh-extra-args', $sshExtraArgs];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with sudo (nopasswd) (deprecated, use become).
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function sudoUser($sudoUser = "root") {
        $newArguments = ['--sudo-user', $sudoUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with su (deprecated, use become).
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function suUser($suUser = "root") {
        $newArguments = ['--su-user', $suUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Run operations with become (does not imply password prompting).
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
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
     * @return AnsiblePlaybookProcessBuilder
     */
    public function becomeUser($becomeUser = "root") {
        $newArguments = ['--become-user', $becomeUser];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for sudo password (deprecated, use become).
     * @return AnsiblePlaybookProcessBuilder
     */
    public function askSudoPass() {
        $newArguments = ['--ask-sudo-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for su password (deprecated, use become).
     * @return AnsiblePlaybookProcessBuilder
     */
    public function askSuPass() {
        $newArguments = ['--ask-su-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

    /**
     * Ask for privilege escalation password.
     * @return AnsiblePlaybookProcessBuilder
     */
    public function askBecomePass() {
        $newArguments = ['--ask-become-pass'];
        $this->addArguments($newArguments);
        return $this;
    }

}
