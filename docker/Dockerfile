FROM centos:centos7

COPY ./apache/vhosts.conf /etc/httpd/conf.d/
COPY ./php/php.ini /etc/php.d/

# !!! Don't `yum update` because of keeping centos version
# RUN yum -y update

# For checksum error
RUN yum -y install yum-plugin-ovl

# Setup repository
RUN yum -y install yum-utils
# remi-php74 -> remi-php80
RUN rpm --import https://rpms.remirepo.net/RPM-GPG-KEY-remi
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm
##RUN yum-config-manager --enable remi-php74
RUN yum-config-manager --enable remi-php80

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
  && php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
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
#RUN echo 'xdebug.remote_autostart = On' >> /etc/php.d/15-xdebug.ini
#RUN echo 'xdebug.remote_enable = On' >> /etc/php.d/15-xdebug.ini
#RUN echo 'xdebug.remote_host = host.docker.internal' >> /etc/php.d/15-xdebug.ini
#RUN echo 'xdebug.remote_port = 9901' >> /etc/php.d/15-xdebug.ini
#RUN echo 'xdebug.remote_log=/tmp/xdebug.log' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.mode=debug' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.start_with_request=yes' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.client_host=host.docker.internal' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.client_port=9901' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.log=/tmp/xdebug.log' >> /etc/php.d/15-xdebug.ini
RUN echo 'xdebug.idekey=PHPSTORM' >> /etc/php.d/15-xdebug.ini

RUN systemctl enable httpd
CMD ["/usr/sbin/httpd", "-DFOREGROUND"]

WORKDIR /var/www/html
