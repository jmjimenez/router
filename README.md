# Router API
This app is a Router API. Users can add routes and ask which is the proper gateway to access an specific ip address.

Let´s walk through some examples:

| API request                                                | Goal                                                 | Response         |
| ---------------------------------------------------------- | :--------------------------------------------------: | --------------:  |
| [POST] /route?ip=192.168.0.0&netmask=24&gateway=172.16.0.1 | Add new gateway 172.16.0.1 for subnet 192.168.0.0/24 | ok               |
| [POST] /route?ip=192.168.1.0&netmask=24&gateway=172.16.0.2 | Add new gateway 172.16.0.2 for subnet 192.168.1.0/24 | ok               | 
| [GET] /gateway?ip=192.168.0.1                              | Find gateway to reach ip 192.168.0.1                 | 172.16.0.1       |
| [GET] /gateway?ip=192.168.1.1                              | Find gateway to reach ip 192.168.1.1                 | 172.16.0.2       |
| [GET] /gateway?ip=192.168.2.1                              | Find gateway to reach ip 192.168.2.1                 | error: not found |

# New features to add

We need to add some new features to this project. You can add one, two ... or all of them. It´s up to you.

Please, try to tag any commit with the feature you want to implement (like '[FEATURE_01] first commit')

You can even improve our current project. Feel yourself at home. We are looking forward you share your ideas with us.

## FEATURE_01: Delete route

Implement a new API entry point [DELETE] /route?ip=xxxx&gateway=yyyy
- If this route exists, then it will be removed from the router and the reponse will be 'ok'
- If this route does not exist, then the response will be 'error: route not found'

## FEATURE_02: List current routes

Implemente a new API entry point [GET] /route. It should return the list of current routes.

## FEATURE_03: Modify existing route

The current implementation does not prevent the user to add the same route twice. We want to prevent this.

It the user tries to add the same route, the gateway of the new request will overwrite the existing one.

## FEATURE_04: Prevent overlapping routes

Our current implementation has a flow: user can add routes that overlap between them (for example: 192.168.1.0/24 and 192.168.0.0/16)

If the route to add overlaps with an existing route, then the response will be: 'error: this route overlaps with xxxxx' and the route will not be added
# Docker environment

This project includes a working docker environment. It can be configured using the following files:

##  /.env

- Configure what will be the name of the host using NGINX_HOST
- Select which php version to use using PHP_VERSION. Currently, the only possible value is latest

## /ect/php/php.ini

- Configure your host ip address in etc/php/php.ini (xdebug.remote_host) to activate XDEBUG debug

## /docker/php/latest/Dockerfile and /docker-compose.yml

- php container includes a ssh server. You can ssh to this container using the port 2200 of your docker host (defined in docker-compose.yml) with user:password root:root (defined in Dockerfile)

## /docker-compose.yml

- The project can be accessed from port 8888 of your docker host (defined in docker-compose.yml)


