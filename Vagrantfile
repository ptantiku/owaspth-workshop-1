# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network "public_network"
  # config.vm.synced_folder "../data", "/vagrant_data"
  #
  config.vm.provider "virtualbox" do |vb|
    vb.name = "owaspth-workshop-1"

    vb.gui = false
    vb.memory = "1024"
  end

  # such as FTP and Heroku are also available. See the documentation at
  # https://docs.vagrantup.com/v2/push/atlas.html for more information.
  # config.push.define "atlas" do |push|
  #   push.app = "YOUR_ATLAS_USERNAME/YOUR_APPLICATION_NAME"
  # end

  config.vm.provision "shell", inline: <<-SHELL
    echo 'root:password' | chpasswd
    apt-get update
    apt-get install -y python
  SHELL
end