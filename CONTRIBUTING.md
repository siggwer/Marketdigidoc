# Contributing

This file describes how to contribute to ToDoList App. When contributing to this repository, you can first discuss the change you wish to make via issue.

Please note that we have rules, please follow them in all your interactions with the project.

## Clone the project

First, you have to [clone](https://github.com/siggwer/Marketdigidoc.git) the project in your local machine.

## Install the project

Then, run `composer update` command to install dependencies.  

And run `composer prepare` to install database and create fixtures.

For more information see readme.md

Before starting your changes, create a new branch.

Please respect the naming convention: feature/name_of_the_modification

## Do your changes

You can now do your changes to the code or add a new feature.  
After coding, please make PHPUnit tests to test your code, and run all the tests with `vendor/bin/phpunit` command to be sure your changes work and do not create failing with our tests.  

If it is ok, you can submit a pull request, and wait for it to be accepted by the staff.

## Some rules to respect

Using welcoming and inclusive language  
Being respectful of differing viewpoints and experiences  
Accepting constructive criticism  


We respect some PSR rules, please respect PSR-1, PSR-12 and PSR-4. Please use  PHPCSFIXER / PHPCS / PHPCBF` to check it.  
This application is developped with Symfony framework 4.4, please check the [Best Practises](https://symfony.com/doc/4.4/best_practices.html)

Thank you and good code :)