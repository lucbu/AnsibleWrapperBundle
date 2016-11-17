# Ansible Wrapper Bundle

## Introduction

This bundle provide a Wrapper and tools for Ansible 2.

It can configurate and execute the commands (ansible, ansible-playbook), fire event, reformat error message.

I'm not an expert, so, please feel free to send pull requests.

## Prerequisite

* Ansible 2 (Installation tutorial [here](http://docs.ansible.com/ansible/intro_installation.html))
* Symfony 2.8 ([https://symfony.com/](https://symfony.com/))
* sudo (=> Unix I guess)

##Installation

Install it with :

    composer require lucbu/ansible-wrapper-bundle

Add the bundle to kernel :

    new Lucbu\AnsibleWrapperBundle\LucbuAnsibleWrapperBundle(),

You can create a user that will be used to launch ansible/ansible-playbook command.
    
    useradd ansible-launcher

Then add the right for your http user to launch command with the user below using visudo (in the sudoers file):

    www-data ALL=(ansible-launcher) NOPASSWD: /usr/local/bin/ansible
    www-data ALL=(ansible-launcher) NOPASSWD: /usr/local/bin/ansible-playbook

You should add this line in ansible.cfg behind "[defaults]"

    stdout_callback = json

Add this in your configuration (config.yml):

    lucbu_ansible_wrapper:
      ansible:
        user: 'ansible-launcher'    #The user that will launch ansible command
        dir: '/usr/local/bin'       #The folder where is located 'ansible'
      ansible_playbook:
        user: 'ansible-launcher'    #The user that will launch ansible-playbook command
        dir: '/usr/local/bin'       #The folder where is located 'ansible-playbook'
        
## Use

Playbook File (/tmp/ansible/addfile.yml):

    -
        hosts: all
        tasks:
          - file: path=/tmp/{{ filename }} state=touch mode="u=rw,g=r,o=r"


In the controller:

    $playbookFile = '/tmp/ansible/addfile.yml';
    $vars = ['filename'=>'test'];
    $hostFile = '/tmp/hostfile.yml';

    $process = AnsiblePlaybookProcessBuilder::createBuilder($playbookFile)
      // Add the vars to command
      ->extraVars($vars)
      // Set the InventoryFile
      ->inventoryFile($hostFile)
      // SSH connecting with user "root"
      ->user('root')
      // Create the process
      ->getAnsiblePlaybookProcess();

    $cmd_line = $process->getProcess()->getCommandLine();
    
    try {
        // Executing code (and firing start/new output/finish events)
        $output = $this->container->get('lucbu_ansible_wrapper.ansible_playbook_process_executor')->executeAnsiblePlaybookProcess($process);
    } catch (\Exception $e) {
        $output = $e->getMessage();
    }

## TODO

* Reformat error message (AnsibleMessageFormatter) (to an object?)
* Clean the AbstractProcessExecutor?