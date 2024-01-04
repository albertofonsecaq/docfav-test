<?php

require 'vendor/autoload.php';
define('BASE_PATH', realpath(dirname(__FILE__)));


use database\migrations\UserMigration;
use repositories\UserRepository;
use entities\User;


//run migration
$userMigration = new UserMigration();
$userMigration->up();

$repository = new UserRepository();



//regiter user
//$user = new User("abifonseca","abifonseca@gmail.com","1234");
//$repository->store($user);

//delete user
//$userIds = [7,8,9,10,11,12];
//foreach ($userIds as $id)
//    $repository->delete($id);



