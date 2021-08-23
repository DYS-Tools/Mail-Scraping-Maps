# Mail-Scraping-Maps 

Welcome to Mail Scraping Maps project!

## Technology 

This architecture proposes a reutilisable code and easy to maintain. It also provides good practice like MVC layout and object oriented.

The Blitz application works with the symfony framework ( 5.0.5 ).

- Symfony
- Docker (Configure your environment)
- Ansible (Deploy with ansible folder)
- GitlabCI (CI/CD)

### Use this project 

-  clone this project on your environment 
-  configure your variable environment
-  run `composer install`
-  run `php bin/console d:d:c`
-  run `php bin/console d:m:m`
-  run `php bin/console d:f:l -n`

## Run webpack in dev

- yarn install
- yarn build ( for generate public/build folders)

##### For Docker run :

run this project with docker containers (docker-compose included in this repository )
```
docker-compose up -d
```
## Deployment

##### For Ansible, create your ansible/hosts.ini and run:
```
ansible-playbook ansible/playbook.yml -i ansible/hosts.ini --ask-vault-pass
```

#### This website is available in "..."

## Testing 

For generate a coverage-html ( available in /public/data/index.html )

```
php bin/phpunit --coverage-html public/data 
```

Testing Symfony Website

```
php bin/phpunit
```

if you want to modify this project,
the following links you may be useful

1. https://symfony.com/doc/current/index.html#gsc.tab=0
2. https://www.docker.com/
3. https://docs.ansible.com/ansible/latest/index.html

## Other information 

Standard :
1. PSR2 ( https://www.php-fig.org/psr/psr-2/ )


## HELP 

[ProxyCrawl](https://proxycrawl.com/blog/how-to-scrape-data-from-google-maps/)
