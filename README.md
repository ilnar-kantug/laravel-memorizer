# Keep In Mind

## Laravel framework project

Service that provides functionality to create memorization flash cards and repeat them in a way you want.<br />

Project site url - [keep-in-mind.ru](http://keep-in-mind.ru/)

- Database
    - [x] migrations
    - [x] factories
    - [x] seeds
    - [x] full dummy database

![alt text](https://github.com/ilnar-kantug/laravel-memorizer/blob/master/storage/project_proto/DB_schema.jpeg "Database")

- Pages scheme ([sketch pdf](https://github.com/ilnar-kantug/laravel-memorizer/blob/master/storage/project_proto/prototype.pdf))<br />
    - Frontend side:
        - [x] Home(landing)
        - [x] Registration
        - [x] Login
        - [x] Dashboard
        - [x] Pack - session page
        - [ ] Pack - creating page
        - [ ] Pack - updating page
        - [ ] Cards
        - [ ] Card - creating page
        - [ ] Card - updating page
        - [ ] Profile
    - Admin side:
        - [ ] Dashboard
        - [ ] ...


Server structure:
```
46.17.44.59     NGINX balancer
185.22.152.14   node1 - PHP, NGINX
185.22.152.198  node2 - PHP, NGINX
46.17.44.60     MYSQL master
46.17.44.62     MYSQL slave
46.17.44.121    REDIS
uploaded files on Selectel CDN
```
---
Current project is developed only for educational purposes, that's why technological stack is redundant.