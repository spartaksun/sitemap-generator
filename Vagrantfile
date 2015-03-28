# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.require_version ">= 1.6"

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "hashicorp/precise32"
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"
  config.vm.network "forwarded_port", guest: 80, host: 8888
  config.vm.synced_folder ".", "/vagrant",
        owner: "www-data", group: "www-data"

  config.vm.provision :ansible do |a|
     a.playbook = "playbooks/provision.yml"
     a.limit = "all"
  end
end