OpalCrm is a new customer relationship management system (CRM) which purpose is to help you keep track of your customers, tasks etc. OpalCrm a self-hosted platform based on Laravel 5.4 PHP Framework.


php-5.6 or above
MySQL-5.6 or above
Laravel - 5.4

Prerequisites of OS, software versions (php, MySQL.,apache .):::
INSTALLATION OF LARAVEL USING COMPOSER ::
STEPS ::
NOTE :- If you are using centOS. please using yum instead of apt-get. (Ubuntu)

1. Use the following command to update the package lists for upgrades for packages that need upgrading, as well as new packages that have just come to the repositories.
    - sudo apt-get update
    - sudo apt-get dist-upgrade
2. enable the Apache mod_rewrite module
    - sudo a2enmod rewrite
3. To know your mysql password
    - cat /etc/motd.tail
4. To change your password
    - mysqladmin -u root -p'password' password newpassword
5. To install Composer, run these commands:
    - curl -sS https://getcomposer.org/installer | php
    - sudo mv composer.phar /usr/local/bin/composer
6. Now Extract the downloaded zip file  and copy the code folder in /var/www/html .
7. Apache vHost PHP Files Check Apache virtual hosts that come out of the box. Available ones are in sites-available while enabled ones are symlinked from sites-available to sites-enabled. We'll create new virtual host at /etc/apache2/sites-available/my_app.conf:
    - sudo nano ../etc/apache2/sites-available/my_app.conf
  and past this:
        <VirtualHost *:80>
            ServerName my-site.com
            ServerAlias Xxx.ZxZ.1X7.XxX #your server ip
    
            DocumentRoot /var/www/your-project-name/public
            <Directory /var/www/your-project-name/public>
                # Don't show directory index
                Options -Indexes +FollowSymLinks +MultiViews
    
                # Allow .htaccess files
                AllowOverride All
    
                # Allow web access to this directory
                Require all granted
            </Directory>
    
            # Error and access logs
            ErrorLog ${APACHE_LOG_DIR}/my-site.error.log
            # Possible values include: debug, info, notice, warn, error, crit,
            # alert, emerg.
            LogLevel warn
            CustomLog ${APACHE_LOG_DIR}/my-site.access.log combined
        </VirtualHost>
8. Now Enable the Virtual Host using Apache's tool that comes with the Ubuntu package of Apache2
    # Symlink it to sites-enabled directory
    - sudo a2ensite my_app
    # Reload Apache so the new configuration is loaded
    - sudo service apache2 reload
9. Create an empty database in mysql.
10. Copy the .env.example to .env and insert the Database config in the env file
11. Run the following commands in your project directory.
    - composer install
    - php artisan migrate
    - php artisan db:seed (which will insert some dummy data for login).
12. Run the configured domain in your browser and login with the following commands.
    -  admin@admin.com /admin123
13. If you have any errors in installation please check in the Code folder storage/logs/laravel.log file.


INSTALLATION OF LARAVEL USING HOMESTEAD ::
Laravel Homestead is an official, pre-packaged Vagrant box that provides you a wonderful development environment without requiring you to install PHP, a web server, and any other server software on your local machine. No more worrying about messing up your operating system.
Homestead runs on any WINDOWS, MAC, or LINUX system, and includes the Nginx web server, PHP 7.2, PHP 7.1, PHP 7.0, PHP 5.6, MySQL, PostgreSQL, Redis, Memcached, Node, and all of the other goodies you need to develop amazing Laravel applications



STEPS::

1. Before launching your Homestead environment, you must install VirtualBox 5.2 as well as Vagrant. All of these software packages provide  easy-to-use visual installers for all popular operating systems.
    FOR VIRTUALBOX :: https://www.virtualbox.org/wiki/Downloads
    FOR VAGRANT :: https://www.vagrantup.com/downloads.html
2. Once VirtualBox and Vagrant have been installed, you should add the laravel/homestead box to your Vagrant installation. "vagrant box add laravel/homestead" --- use this command in your terminal. It will take a few minutes to download the box, depending on your Internet connection speed
3. You can install Homestead by simply cloning the repository in your "home" directory. using the below commands in your terminal.
    - cd ~
    - git clone https://github.com/laravel/homestead.git Homestead
4. Once you have cloned the Homestead repository, Use the below commands for creating the Homestead configuration file.
    - cd Homestead
    - bash init.sh
5. You must add the "domains" for your Nginx sites to the hosts file on your machine.On Mac and Linux, this file is located at /etc/hosts. On Windows, it is located at C:\Windows\System32\drivers\etc\hosts. The lines you add to this file will look like the following:
    - 192.168.10.10 homestead.test
6. Run the following command in your Homestead Directory.Vagrant will boot the virtual machine and automatically configure your shared folders and Nginx sites.
    - vagrant up.
7. Once your vagrant machine is running sucessfully. Now Extract the downloaded zip file in your "home" directory in "Code" folder.
8. Create an empty database in mysql.
9. Copy the .env.example to .env and insert the Database config
10. Run the following commands in your project directory.
    - composer install
    - php artisan migrate
    - php artisan db:seed (which will insert somw dummy data for login).
11. Configure your project domain in hosts file as below.
    - 192.168.10.10 opalcrm.kloud.com
12. Run the configured domain in your browser and login with the following commands.
    -  admin@admin.com /admin123