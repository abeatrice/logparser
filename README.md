# Nginx Access Log Parser

## Description
Read an nginx access log file and output a csv for all fields combined with extracted country & state from ip address and device type & browser from useragent.

## Requirements
 - Docker
 - docker-compose

## External Libs
 - [maxmind geolite2](https://dev.maxmind.com/geoip/geoip2/geolite2/)
 - [log-parser](https://github.com/kassner/log-parser)
 - [UserAgentParser](https://github.com/ThaDafinser/UserAgentParser)

## Run Dockerhub Image
```sh
# Navigate to gobankingrates.com.access.log file location on the host machine directory
$ docker run --rm \
    -v `pwd`:/logs \
    -v `pwd`:/app/output \
    abeatrice/logparser app parse /logs/gobankingrates.com.access.log
# The current directory will be populated with the output file: access.csv
```

## Install and Run Locally
```sh
# Get the source
$ git clone https://github.com/abeatrice/logparser.git
$ cd logparser

# Build the image
$ docker build -t logparser .

# Navigate to gobankingrates.com.access.log file location on the host machine directory

# Example run command
# The output file: access.csv will be placed on the host machine's specified output file dir location
$ docker run --rm \
    -v `pwd`:/logs \
    -v `pwd`:/app/output \
    logparser app parse /logs/gobankingrates.com.access.log

# Example cli output
# [2021-02-18 22:26:14] parsing file: /logs/gobankingrates.com.access.log
# [2021-02-18 22:26:37] /logs/gobankingrates.com.access.log parsed and csv built in 22 second(s).

# Command Breakdown:
# docker run --rm : call docker cli to run the image
# -v `pwd`:/logs : mount the host machine's access log directory to the image's /logs directory
# -v `pwd`:/app/output : mount the host machine's output csv directory to the image's /app/output directory
# logparser app parse : call the cli command in the image to parse a file
# /logs/gobankingrates.com.access.log : the log to parse

# Additional Example
# If the host machine's access log is here /var/log/nginx/access.log and the desired output file location is pwd
$ docker run --rm -v /var/log/nginx:/logs -v `pwd`:/app/output logparser app parse /logs/access.log
```

### Local Development
```sh
$ git clone https://github.com/abeatrice/logparser.git
$ cd logparser
# build container
$ docker-compose up -d --build
# enter container
$ docker-compose exec logparser bash
# execute from host
$ docker-compose exec logparser app parse ./logs/gobankingrates.com.access.log
# stop running container
$ docker-compose down
```

### Run Tests
```sh
$ docker-compose up -d --build
$ docker-compose exec logparser bin/phpunit
$ docker-compose down
```
