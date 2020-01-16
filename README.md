# application-development-with-docker
Application development with docker, hands on lesson
by eduards
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
docker run -it --rm ubuntu

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
docker run -it --rm -v "$(pwd)/scripts/:/scripts" php:7  ls -la /scripts

# run php script inside php container
docker run -it --rm -v "$(pwd)/scripts/:/scripts" php:7 php /scripts/calculate.php 

# view contents of python script
cat scripts/calculate.py

# add script to container with -v command
docker run -it --rm -v "$(pwd)/scripts/:/scripts" python:3  ls -la /scripts

# run php script inside php container
docker run -it --rm -v "$(pwd)/scripts/:/scripts" python:3 python /scripts/calculate.py 

# try edit these scripts with vim and test new output
vim scripts/calculate.php
vim scripts/calculate.py

# to edit text press "a"
# to exit and save ESC then SHIFT+ZZ
# to quit ESC then type :q and ENTER

~~~

# 6. deploying services with docker compose

~~~sh
# change folder to services
cd services
ls -la

# deploy mysql service
cd mysql
ls -la
cat docker-compose.yml
cat Makefile 
make run

# lets review output of current containers
docker ps -a

# access db using UI, teacher shows example
...

# data will be saved after restart
make down
make run


# deploy redis service
cd ..
cd redis
ls -la
cat Makefile 
cat docker-compose.yml
make run # install make if required

# lets review output of current containers
docker ps -a


~~~

## 7. Build custom application docker image
~~~sh
cd ../..
cd custom-image

# why we need to create custom image?
docker run -it --rm python:3

# Python 3.8.1 (default, Jan  3 2020, 22:44:00) 
# [GCC 8.3.0] on linux
# Type "help", "copyright", "credits" or "license" for more information.
# >>> import redis
# Traceback (most recent call last):
#   File "<stdin>", line 1, in <module>
# ModuleNotFoundError: No module named 'redis'
# >>> 

# inspect dockerfile 
cat Dockerfile

# build image
docker build -t python-redis .

# rebuild image all layers
docker build -t python-redis --no-cache=true .

# view our new image
docker images

~~~


## 8. Run custom image and connect to services

~~~sh
# edit python script and add your ip address

# get my external ip
curl ifconfig.me

# edit script
vim script.py

# to edit text press "a"
# to exit and save ESC then SHIFT+ZZ
# to quit ESC then type :q and ENTER

# rebuild image all layers
docker build -t python-redis --no-cache=true .

# execute script multiple times
docker run -it --rm python-redis python /root/script.py

# access redis cli to view added key values
docker exec -it redis_redis_1 redis-cli

# run this in redis-cli
127.0.0.1:6379> get counter

~~~


## 9. Git code changes example

~~~sh

# edit some files
vim README.md

# view changes files
git status

# add changed files to be commited
git add README.md

# commit changes
git commit -m "i have updated README.md"

# push to 
git push

# get new changes
git pull 

# review changes in github 

~~~


## TODO

~~~sh

# create wordpress docker-compose
cd ..
cd wordpress
ls -la
cat Makefile 
make run
docker ps -a


# deploy portainer service and explore it
cd ..
cd portainer
ls -la
cat Makefile 
make run
docker ps -a

# run addition language script

# talk about linux commands for debugin connectivity to apps

# check if port available
telnet 0.0.0.0 80

# show inside linux what ports are used by what services
netstat -tulpn
ss -tulwn

# scan server for open ports
nmap -sT -O localhost # fingerprint
nmap -p0-65535 localhost # scan port range

~~~
