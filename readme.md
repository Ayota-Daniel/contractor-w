# Contractor

Contractor est un site permet d'établir des contrats entre 2 ou plusieurs parties par rapport à un accord à passer

## Environement de développement

### pré-requis

* PHP 8.1.5
* Composer
* symfony CLI
* Docker
* Docker-compose

vous pouvez vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande suivante (de la Symfony CLI) :

'''bash
* symfony console check:requirements
'''

### Lancer L'environement de développement

'''bash
* docker-compose up -d
* symfony serve -d
'''
### Creer la base de donnees

'''bash
* symfony console make:migration
* symfony console doctrine:migrations:migrate
'''

### Compiler en continue le css de tailwind

'''bash
* npx tailwindcss -i ./assets/styles/app.css -o ./public/build/app1.css --watch    
'''