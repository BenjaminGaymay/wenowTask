# Welcome to test case

You will be required to do one of the three tasks listed at the end of this document.

The environment is based on a classic AMP stack: Apache server, MySQL database and PHP as a backend language. It is assumed that you are able to set it up yourself.

In this environment there is a lightweight framework (only a bit heavier than Python's Flask): [Fat Free Framework](https://fatfreeframework.com/3.6/home). Feel free to explore its quick start guide, but you should also be able to do the job by looking at what is already done.

## Installation guide

1. Navigate to your document root folder (it should be `/var/www/html`).
2. Clone this repository: `git clone https://github.com/pgrzego/phpTaskForCandidates.git`
3. Navigate to newly created directory: `cd phpTaskForCandidates`
4. Create a MySQL database (depending on your local set up you can do it using [phpMyAdmin](https://www.phpmyadmin.net/), [MySQL Workbench](https://dev.mysql.com/downloads/workbench/), or [manually](https://www.a2hosting.com/kb/developer-corner/mysql/managing-mysql-databases-and-users-from-the-command-line)).
5. Update the configuration file `config.yaml` with the information about the database.
6. Install dependencies with composer ([make sure you have it installed](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)): `composer install`
7. Insert database data with phinx: `phinx migrate`

## Tasks to perform

There are three tables defined in the database:

![DB UML](http://www.plantuml.com/plantuml/png/LP11QyGW48Nl_eeflMoWI-zBaFIolw3tCDLPCbIDw6H9AFtlDR59jnxa3RxtFfak2oQPl5DFbcuS20G_79tc1ep3d666jeNJ-ylpzVfMJWDQ7zQOs6DQ-azQra0xwRbzdRGQs19uac6qkGvPAD4eIwIibAe8C_g8WIatyAK0s9Ohe2VrlJlkDB1n_mmrjFJR41qAvIBG2DyVWf8uFgP-YshASXOCXbOv9HGUGv7R7dgBijNivClb3mXdHpSvQzW_NbvBuSegwa0SlfrQRHq5MzRy0m00)

Choose one of the tasks listed below:

1. List all companies. For each company write the following info: `company name`, `total number of active vehicles`, `total number of inactive vehicles`.
2. List all vehicles. For each vehicle write the following info: `plates`, `company name`, `active`.
3. List all vehicles. For each vehicle write the following info: `plates`, `active`, `total number of trips`, `total distance`, `total duration`.

Each task requires you to:

1. Define a URL to your page (in the example case it is `/sample`)
2. Create a controller class that implements the `ControllerInterface`
3. Define a route in the `index.php` file
4. Update href path in the `app/views/index.html` file

You can see how a similar task is done by looking at the `app/controllers/SampleController` class and the `app/views/sample-view.html` file.

Once you are happy with the result, zip your folder (you can exclude the `vendor` directory) and mail it to me. Alternatively, you can choose to [fork this repository](https://guides.github.com/activities/forking/) and send me a pull request.

Get ready to describe your idea on how the task was done. No matter if you will be able to finish the work on time or not, this will always be an important part of the task.

*Good luck!*