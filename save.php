<?php

session_start();

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/lib/CsrfProtector.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if (!CsrfProtector::validate(filter_input(INPUT_POST, '_token'))) {
  header('Content-Type: text/plain; charset=UTF-8', true, 400);
  die('CSRF validation failed.');
}

try {
    $dbh = new PDO(getenv('DSN'), getenv('DB_USER'), getenv('DB_PASSWORD'));
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    die('Databse connection error');
}

$params = [
    'ua' => filter_input(INPUT_POST, 'userAgent'),
    'ua_http' => filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'),
    'math_tan' => filter_input(INPUT_POST, 'mathTan'),
    'memo' => filter_input(INPUT_POST, 'memo'),
];
$implode = function($glue, $params) {
    return implode($glue, array_keys($params));
};
$statement = "INSERT INTO tan ({$implode(',', $params)}) VALUES (:{$implode(',:', $params)});";
$stmt = $dbh->prepare($statement);
$stmt->execute($params);
