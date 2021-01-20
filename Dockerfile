FROM centos:7.8.2003

# Install apache
RUN yum -y update && \
    yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm \
    yum install -y epel-release && \
    yum-config-manager --enable remi-php71 && \
    yum install -y httpd \
    php \
    php-mysqlnd \
    httpd-tools \
    unzip \
    zip \
    pdo \
    pdo_mysql \
    yum-utils \
    cronie

# Instal Dependencies and Extensions
RUN yum --enablerepo=remi,remi-php71 install -y \
    php-xml \
    php-intl \
    php-mbstring \
    php-zip \
    zip \
    php-mysql

RUN yum -y install nodejs

# Install Mod_pageSpeed
RUN yum -y install https://dl-ssl.google.com/dl/linux/direct/mod-pagespeed-stable_current_x86_64.rpm

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Update Apache Configuration
COPY httpd/vhost.conf /etc/httpd/conf/httpd.conf

ENV APP_HOME /var/www/html

WORKDIR $APP_HOME

# Change UID of Apache in Centos
RUN usermod -u 1000 apache && groupmod -g 1000 apache

# Copy and chown source
COPY --chown=apache:apache . $APP_HOME

# Set the group ID (setgid) on the $APP_HOME
RUN chmod g+s $APP_HOME

RUN chmod -R o+w $APP_HOME/tmp

RUN chmod -R o+w /var/lib/php

RUN chown -R apache /var/lib/php

RUN chmod -R 775 /var/lib/php

RUN yum clean all

EXPOSE 80

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]