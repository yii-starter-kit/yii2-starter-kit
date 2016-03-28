# Please see the online documentation at
# https://docs.vagrantup.com.

# OPTIONS
require 'yaml'
options = YAML.load_file File.join(File.dirname(__FILE__), 'vagrant/vagrant.yaml')
domains = [
    "carspending-v2.dev",
    "backend.carspending-v2.dev",
    "storage.carspending-v2.dev"
]
packages = [
    "php7.0",
    "php7.0-cli",
    "php7.0-common",
    "php7.0-curl",
    "php7.0-fpm",
    "php7.0-gd",
    "php7.0-intl",
    "php7.0-json",
    "php7.0-mcrypt",
    "php7.0-mysql",
    "php7.0-opcache",
    "php7.0-readline",
    "php-xdebug",
    "nginx",
    "mysql-server-5.6",
    "git"
]

Vagrant.configure(2) do |config|
  config.vm.post_up_message = "Done! Now you can access site at http://carspending-v2.dev"
  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = options['vm']['memory']
    vb.cpus = options['vm']['cpus']
  end

  config.vm.box = "ubuntu/trusty64"
  config.vm.hostname = domains[0]
  config.vm.network "private_network", ip: options['network']['ip']
  config.vm.synced_folder "./", "/var/www",
    id: "vagrant-root",
    :nfs => false,
    owner: "www-data",
    group: "www-data",
    :mount_options => ['dmode=775', 'fmode=775']

  # Port Forwardings
  config.vm.network :forwarded_port, host: 80, guest: 80
  config.vm.network :forwarded_port, host: 3306, guest: 3306

  config.vm.provision :hostmanager
  config.hostmanager.enabled            = true
  config.hostmanager.manage_host        = true
  config.hostmanager.ignore_private_ip  = false
  config.hostmanager.include_offline    = true
  config.hostmanager.aliases            = domains

  config.vm.provision "shell", path: "./vagrant/vagrant.sh", args: [
    packages.join(" "),
    options['github']['token'],
    options['system']['swapsize']
  ]

  config.vm.provision "shell", inline: "service nginx restart", run: "always"
end