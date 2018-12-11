# React + Symfony 4 guild manager for Star Wars Galaxy of Heroes 

![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/CodeMiner84/Swgoh-guild-manager/badges/quality-score.png?b=master) 
[![Build Status](https://scrutinizer-ci.com/g/CodeMiner84/Swgoh-guild-manager/badges/build.png?b=master)](https://scrutinizer-ci.com/g/CodeMiner84/Swgoh-guild-manager/build-status/master)

# https://swgoh-manager.com

### INSTALATION

* Download project from my repository.
* ```cd swgoh-manager ```
* ```composer install```
* ```bin/console doctrine:database:create```
* ```bin/console doctrine:schema:update --force```
* ```bin/console doctrine:fixtures:load```
* ```yarn install``` or ```npm install``` if You don't have yarn
* ```php bin/console doctrine:migrations:migrate```

### RUN PROJECT
Simply start php server and run application on http://localhost:3000
```bash
php bin/console server:run
```
Also run this command to build all assets
```bash
yarn run encore production
```
or add project public folder to Your vhost configuration if You depends on you local server.

###INSTALL ASSETS
This command needs to be execute each time new character release (also on application init)
```bash
php bin/console swgoh:fetch:characters
```

#### Commands
Add this command to crontab to execute every 5minutes or execute it manually in some special cases
```bash
swgoh:cron
```

- Fetch all characters (specially execute if new character will be released)
```bash
php bin/console swgoh:fetch:characters
```

- Fetch all guild users squad
```bash
swgoh:guild:users <code> <uuid>
```

Add a short description for your command
```bash
swgoh:users:characters
```

To fetch specific user mods
```bash
swgoh:mods:user USER_CODE
```
USER_CODE is getting from account table, uuid field

To fetch specific user characters
```bash
swgoh:user:characters USER_CODE
```
USER_CODE is getting from account table, uuid field


To fetch all users characters from existing guilds in guild table
```bash
swgoh:all:user:characters
```

Fetch all users from guild
```bash
swgoh:guild:users GUILD_CODE GUILD_UUID
```
