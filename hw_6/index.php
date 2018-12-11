<?php

require './vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

$dotenv = new Dotenv();
$dotenv->load('./.env');

$DB = new DB;

$DB->addConnection([
	'driver'    => 'mysql',
	'host'      => $_ENV['DB_HOST'],
	'username'  => $_ENV['DB_USER'],
	'password'  => $_ENV['DB_PASSWORD'],
	'database'  => $_ENV['DB_NAME'],
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
]);
$DB->setAsGlobal();
$DB->bootEloquent();

DB::schema()->dropIfExists('products');
DB::schema()->dropIfExists('categories');

DB::Schema()->create('products', function (Blueprint $table) {
    $table->increments('id');
    $table->string('title');
    $table->string('url');
    $table->integer('category_id');
    $table->float('price')->default(1);
    $table->string('photo')->default('');
    $table->text('description');
    $table->timestamps();
});

DB::schema()->create('categories', function (Blueprint $table) {
    $table->increments('id');
    $table->string('title');
    $table->text('description');
    $table->string('url');
    $table->timestamps();
});

echo 'Таблицы в базе данных созданы';