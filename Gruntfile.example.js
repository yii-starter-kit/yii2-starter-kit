module.exports = function(grunt) {

    grunt.initConfig({
        pkg: 'yii2-starter-kit',
        sshconfig:{
            prod:{
                host: 'example.com',
                username: 'root',
                port: 22,
                agent: process.env.SSH_AUTH_SOCK
            }
        },
        sshexec:{
            deploy:{
                update:{
                    command: [
                        'cd /var/www',
                        'git pull origin master',
                        'composer update',
                        '/usr/bin/php environments/' + grunt.option('env') + '/console/yii migrate --interactive=0',
                    ].join(' && '),
                    options:{
                        config: grunt.option('env')
                    }
                },
                release:{
                    command: [
                        'cd /var/www' // Create realease command
                    ].join(' && '),
                    options:{
                        config: grunt.option('env')
                    }
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-ssh');
    grunt.registerTask('deploy', ['sshexec:deploy']);

};