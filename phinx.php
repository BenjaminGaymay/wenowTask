<?php
/**
 * Phinx configuration file
 */

$dbConfig = \Symfony\Component\Yaml\Yaml::parseFile("config.yaml")['db'];
return [
    "paths" => [
        "migrations" => "db/migrations"
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "local",
        "local" => [
            "adapter" => "mysql",
            "host" => $dbConfig['host'],
            "name" => $dbConfig['database'],
            "user" => $dbConfig['user'],
            "pass" => $dbConfig['password'],
            "port" => $dbConfig['port']
        ]
    ]
];
