# How to Install Nginx with ModSecurity on Ubuntu
Adding ModSecurity module to Ubuntu Nginx deb package.

## What is ModSecurity? ##
ModSecurity is an open source web application firewall (WAF) which provides real-time monitoring, logging, and access control.
It protects websites from hackers by using a set of regular expression rules to filter out commonly known exploits.

## Installing required packages ##
apt-get update
apt-get install dpkg-dev build-essential zlib1g-dev libpcre3 libpcre3-dev unzip open-vm-tools lynx vim curl psmisc patch rcconf rsync equivs

## Install Nginx dependencies ##
apt-get build-dep nginx

## Re-package Nginx with ModSecurity ##
mkdir -p /usr/src/nginx
cd /usr/src/nginx

Get Nginx package:
apt-get source nginx

cd nginx-x.x.x/debian/modules

## Download ModSecurity module from nginx_refactoring branch ##
Some additional packages to install
apt-get install gcc make automake autoconf libtool
apt-get install apache2-dev libcurl4-openssl-dev

wget https://github.com/SpiderLabs/ModSecurity/archive/nginx_refactoring.zip
unzip nginx_refactoring.zip
cd ModSecurity-nginx_refactoring/
./autogen.sh
./configure --enable-standalone-module
make

## Adding ModSecurity module to Nginx ##
Edit the Nginx rules file:
vim /usr/src/nginx/nginx-x.x.x/debian/rules

Add the following to line to all blocks before other modules
--add-module=$(MODULESDIR)/ModSecurity-nginx_refactoring/nginx/modsecurity \

## Build the packages ##
cd /usr/src/nginx/nginx-x.x.x/
dpkg-buildpackage -b

## Install new .deb packages ##
dpkg -i nginx-extras.deb nginx_common.deb nginx_x.x.x.deb

## Prevent package update ##
vim /etc/apt/preferences.d/nginx

Package: nginx
Pin: version x.x.x
Pin-Priority: 1001
