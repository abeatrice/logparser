# Log Parse

## Description
 - Read an access log file
 - Resolve Country and State from IP address (IE MaxMind GeoLite2 Free)
 - Translate useragent to device type (Mobile, Desktop, Tablet) and Browser (Safari, Chrome, etc)
 - Combine new Geo & Device fields with existing fields on access log file and output/export a CSV

## Requirements
 - Docker
 - docker-compose

## Install
```sh
$ docker-compose up -d --build
```

### Enter bash shell
```
$ docker-compose exec logparser bash
```

### Build and Run
```sh
$ docker build -t logparser . && docker run -it logparser bin/console
```

### List commands
```sh
$ docker-compose exec logparser bin/console
```

### Run Log Parse
```sh
$ docker-compose exec logparser bin/console app:parse
```

### Run Tests
```sh
$ docker-compose exec logparser bin/phpunit
```
