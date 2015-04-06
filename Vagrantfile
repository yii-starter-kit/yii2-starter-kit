# The most common configuration options are documented and commented below.
# For a complete reference, please see the online documentation at
# https://docs.vagrantup.com.

# OPTIONS
ip = "192.168.33.10"
domains = ["yii2-starter-kit.dev","backend.yii2-starter-kit.dev","storage.yii2-starter-kit.dev"]
packages = [
    "php5-cli",
    "php5-fpm",
    "php5-intl",
    "php5-gd",
    "php5-mysql",
    "php5-curl",
    "nginx",
    "mysql-server-5.6"
]
folder = "/var/www"

Vagrant.configure(2) do |config|
  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = "512"
    vb.cpus = "1"
  end

  config.vm.box = "ubuntu/trusty64"

  config.vm.hostname = domains[0]
  config.vm.network "private_network", ip: ip

  config.vm.synced_folder "./", folder, id: "vagrant-root", :nfs => false, owner: "www-data", group: "www-data"

  config.vm.provision :hostmanager
  config.hostmanager.enabled            = true
  config.hostmanager.manage_host        = true
  config.hostmanager.ignore_private_ip  = false
  config.hostmanager.include_offline    = true
  config.hostmanager.aliases            = domains


  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell" do |s|
    s.path = "vagrant.sh"
    s.args = [packages.join(" "), folder]
  end
end