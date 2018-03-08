# Requirements

Assume that you don't have php7 and nginx on your machine

1- install docker for your OS .

2- install composer .

# Install instructions
 
1- run the following commands for docker `cd docker` then `docker-compose up`

2- `docker ps` to check if our images are up or not

3- Open docker container

`docker exec -it docker_php7_fpm_1 /bin/bash`

4- run `composer install`

5- open the following link : `http://localhost:8081` (it will list all Hotels retrieved)

6- to search in hotels (example) : `http://localhost:8081?name=HotelName&priceFrom=100&priceTo=200`

only three search filters are available (name & priceFrom & priceTo)

7- to sort the results add query parameter (sortBy) and the two options valid for sorting are (name & price)

example : `http://localhost:8081?sortBy=price` or `http://localhost:8081?sortBy=name` 

# Test Cases

1- Open docker container 

`docker exec -it docker_php7_fpm_1 /bin/bash`

2- Run test cases .

`./vendor/bin/phpunit  Tests/*`