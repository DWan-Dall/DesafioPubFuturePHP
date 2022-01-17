<?php
/**
 * Created by PhpStorm.
 * User: daiane
 * Date: 04/01/2022
 * Time: 11:19
 */

class Conexao
{
    public static $instance;

    public static function getInstance() {

        if (self::$instance === null) {

            try {
                self::$instance = new PDO("mysql:host=localhost;port='3306';dbname=DesafioPubFuturePHP", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            } catch (PDOException $e) {
                die("Erro: {$e->getMessage()}");
            }
        }

        return self::$instance;
    }
}