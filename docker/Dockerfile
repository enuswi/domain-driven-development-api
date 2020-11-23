FROM centos:centos7

COPY ./apache/vhosts.conf /etc/httpd/conf.d/
COPY ./php/php.ini /etc/php.d/

# !!! Don't `yum update` because of keeping centos version
# RUN yum -y update

# For checksum error
RUN yum -y install yum-plugin-ovl

# Setup repository
RUN yum -y install yum-utils
# remi-php74
RUN rpm --import https://rpms.remirepo.net/RPM-GPG-KEY-remi
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN yum-config-manager --enable remi-php74

# Install PHP
RUN yum -y install php php-devel php-mbstring php-pdo php-gd php-xml php-mcrypt php-pgsql
RUN yum -y install php-pear
RUN yum -y install php-zip

RUN yum -y install gcc
RUN yum -y install make
RUN yum -y install which
RUN yum -y install sudo
RUN yum -y install less

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('sha384', 'composer-setup.php') === 'c31c1e292ad7be5f49291169c0ac8f683499edddcfd4e42232982d0fd193004208a58ff6f353fde0012d35fdd72bc394') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php \
  && php -r "unlink('composer-setup.php');" \
  && mv composer.phar /usr/local/bin/composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# Install Node.js
#RUN curl -sL https://rpm.nodesource.com/setup_12.x | bash - \
#  && yum -y install nodejs

# Install XDebug
RUN yum -y install php-pecl-xdebug
RUN php -i | grep xdebug
RUN cp -ap /etc/php.d/15-xdebug.ini /etc/php.d/15-xdebug.ini.old
RUN echo 'xdebug.remote_autostart = On' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.remote_enable = On' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.remote_host = host.docker.internal' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.remote_port = 9901' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.remote_log=/tmp/xdebug.log' >> /etc/php.d/15-xdebug.ini

RUN systemctl enable httpd
CMD ["/usr/sbin/httpd", "-DFOREGROUND"]

WORKDIR /var/www/html
