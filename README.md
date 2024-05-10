# Getting started

Welcome to my Take-home-test!

## Installation

Installation by docker:

Clone the repository

    git clone git@github.com:HallanOliveira/take_home_test.git

Switch to the repo folder

    cd take_home_test

Copy the example docker-compose file

    cp docker-compose-exemple.yml docker-compose.yml

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Build the docker image

    docker-compose up -d --build

Generate a new application key

    docker exec -i take_home_test_api_1 php artisan key:generate

Clean the application env cache

    sudo docker exec -i take_home_test_api_1 php artisan optimize

End! Your API is available at localhost:3002.

## Help

If you have any questions, please send a message to hallan_douglas@hotmail.com.

Thanks!