# Instal dependency

when unzip the fail need to run the next commands for install, make sure you have installed PHP ^8, node, and mysql and compose.

## Installation

use the [composer](https://getcomposer.org/) for install all packages for laravel, all the packages needed are on composer.json file.

```bash
composer install
```

then need [node](https://nodejs.org/en) with [npm](https://www.npmjs.com/) for install the dependencies for Jquery that need que project, all packages needed are on package.json file.

```bash
npm install
```

## Environment variable

in the project have a env.example, change the name for .env, and add the information for connect to the database, and then run the nex command, for the application work normaly.
```bash
php artisan key:generate
```

## Migration

you need run the artisan command for migrate the database seed the database with information about the project

```bash
php artisan migrate --seed
php artisan migrate --seed --database=sqlite
```

need run the two command because on the sqlite work for verify the functionality of the project.

# run the testing
after the migration for verify all packages are installed, you can run this command

```bash
php artisan testing
```

then on the bash will show you the next messange

```bash
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true                                                                                                                          0.01s  

   PASS  Tests\Feature\DatabaseTest
  ✓ if model task exist                                                                                                                        0.40s  

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response                                                                                              0.09s  

   PASS  Tests\Feature\TaskTest
  ✓ view task page                                                                                                                             0.09s  
  ✓ create task page                                                                                                                           0.03s  
  ✓ edit task page                                                                                                                             0.03s  
  ✓ can create task from webpage                                                                                                               0.05s  
  ✓ can update task                                                                                                                            0.04s  
  ✓ error name priority create                                                                                                                 0.04s  
  ✓ sorting task works dow to up                                                                                                               0.04s  
  ✓ sorting task works up to down                                                                                                              0.03s  
  ✓ can delete task                                                                                                                            0.03s  

  Tests:    12 passed (17 assertions)
  Duration: 1.17s
```

if you see the bash with all tests passed, it's meens the application will works fine.

# deploy application
before put on live the application you need build the assets, you should run the next command

```bash
npm run build
```
after the command you can put live the application with command
```bash
php artisan serve
```

you will can see the application on http://localhost/, si necesita un puerto en especifico puede agregar ``--port={port}`` en el command
