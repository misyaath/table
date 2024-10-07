## Introduction

This is the backend for data analytic app. users able to create , view , sort ,filter and analyze their data with this application and They can add large data via CSV and other methods 

## Versions 
![alt text](https://badgen.net/badge/Laravel/10.10/red)

![alt text](https://badgen.net/badge/PHP/8.3/blue)

![alt text](https://badgen.net/badge/MySql/8.0.30/red)

![alt text](https://badgen.net/badge/Nginx/1.23.1/red)

![alt text](https://badgen.net/badge/Redis/6.0/red)

## Project Setup

it's does not have a Frontend its only have api endpoints to test or view 

before run project 
Check .env.example to all enviroment varieable for applications. Please copy and paste in your .env file change if anythig need to in your local setup 
```sh
.env.example
```

```sh
docker compose build
docker compose up -d
```

If there any permission issue please run with sudo privilege 

```sh
sudo docker compose build
sudo docker compose up -d
```


To Run Php unit test got to php docker terminal run

```sh

php artisan test

```

**Worker automatically run queue when up docker**

All codes are in `/src/domain` and check api endpoints in `api.yaml` file for api documentation 
Or Api documentation with swagger UI `https://localhost/api-doc/`

## Code Structure

+ Applications : All of the business logic Like Agregates/ Agregate root
+ DataTransferObjects: Its DTO for data and maintain the data intergratiy 
+ Repository: Repository will have database code with command and query of the domain  
+ Models or Entities
+ Value objects: All of the domain values 
+ Observer and Events of the Domain 
+ Service Layers like Http Request and other 
+ And also will consists Factories also to create complex objects

  
Thanks 
