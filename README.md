# DMS Inventory Manager [![Build Status](https://travis-ci.org/Dallas-Makerspace/Inventory.svg?branch=master)](https://travis-ci.org/Dallas-Makerspace/Inventory) [![License](https://img.shields.io/github/license/Dallas-Makerspace/Inventory.svg?style=flat-square)](https://github.com/Dallas-Makerspace/Inventory/blob/master/LICENCE) [![Coverage Status](https://coveralls.io/repos/github/Dallas-Makerspace/Inventory/badge.svg?branch=master)](https://coveralls.io/github/Dallas-Makerspace/Inventory?branch=master)
[![Release](https://img.shields.io/github/tag/Dallas-Makerspace/Inventory.svg?style=flat-square)](https://github.com/Dallas-Makerspace/Inventory/tags)

Find a copy of the latest build at [Docker Hub](https://hub.docker.com/r/dallasmakerspace/Inventory/).

## About This Application

The application was initially created by Andrew LeCody, using the [CakePHP framework](http://www.cakephp.org "CakePHP - the rapid development PHP framework") and is released under the [GNU Affero General Public License](http://www.gnu.org/licenses/agpl.html).

## Installation

Installing this application is fairly easy, just follow these steps:

1. Download the latest version with git (`git clone https://github.com/Dallas-Makerspace/Inventory.git`)
2. In the app/config directory, rename core.php.default and database.php.default to core.php and database.php respectively.
3. Modify the `core.php` and `database.php` files to suit your environment.
4. Run `docker build -t dallas-makerspace/inventory:latest . && docker stack deploy -c docker-compose.yml dms-inventory` with the latest version of docker and docker with your DOCKER_HOST pointed to `communitygrid.dallasmakerspace.org` or `localhost`.
