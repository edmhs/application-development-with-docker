# application-development-with-docker
Application development with docker, hands on lesson

## 1. Start 
~~~sh
# SSH into server
ssh ubuntu@129.129.192.192

# clone git repository
git clone https://github.com/edmhs/application-development-with-docker.git

# change directory to repository
cd application-development-with-docker

# view files in folder
ls -la
~~~

## 2. Install recquired packages for this tutorial

~~~sh
# install docker
# https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04

sudo apt update
sudo apt install apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"
sudo apt update
apt-cache policy docker-ce
sudo apt install docker-ce
sudo systemctl status docker

# add docker user to sudoers, logout and login CTRL+D to exit
sudo usermod -aG docker ${USER}

# install docker compose
# https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-18-04
sudo curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
docker-compose --version

~~~


## 3. basic docker usage

~~~sh

# access ubuntu docker
docker run -it ubuntu

# access centos docker container with different versions
docker run -it centos
docker run -it centos:7

# command to run inside container to see what linux you are inside
cat /etc/*-release

# lets see what 
docker ps -a

# clean-up of containers
docker container prune
docker ps -a

# lets look at images that we have downloaded in this server
docker images

# lets start container and remove it after we quit
docker run -it -rm ubuntu

~~~


## 4. running different programming languages and versions

~~~sh

# running python commandline
docker run -it --rm python:2

# run command inside python2
>>> hello = "eduards"
>>> print hello

# running python commandline python3
docker run -it --rm python:3

# run command inside python3
>>> hello = "eduards"
>>> print hello
>>> print(hello)

# running python commandline php
docker run -it --rm php

php > $i = 5;
php > echo $i;

# execut command inside container and quit, at this example we get php version from php cli command
docker run -it --rm php php -v
docker run -it --rm php:5 php -v
docker run -it --rm php:7.2 php -v
~~~

## 5. executing local scipts with different languages

~~~sh

# list scripts that we have in scripts folder
ls -la scripts

# view contents of php script
cat scripts/calculate.php

# mount scripts folder to container with -v command
docker run -it --rm -v "$(PWD)/scripts/:/scripts" php:7  ls -la /scripts

# run php script inside php container
docker run -it --rm -v "$(PWD)/scripts/:/scripts" php:7 php /scripts/calculate.php 

# view contents of python script
cat scripts/calculate.py

# add script to container with -v command
docker run -it --rm -v "$(PWD)/scripts/:/scripts" python:3  ls -la /scripts

# run php script inside php container
docker run -it --rm -v "$(PWD)/scripts/:/scripts" python:3 python /scripts/calculate.py 

~~~

# 6. deploying services with docker compose

~~~sh
# change folder to services
cd services
ls -la


~~~