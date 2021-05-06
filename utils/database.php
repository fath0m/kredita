<?php

/*
 * Utility file for accessing the global database connection (one per request)
 */

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "sqlite:" . __DIR__ . "/../database.sqlite";
$db = new PDO($dsn);
$db->exec('PRAGMA foreign_keys = ON;');

/**
 * Get database instance.
 *
 * @return PDO
 */
function get_db(): PDO
{
    global $db;

    return $db;
}

/**
 * Execute database query.
 *
 * @param string $query
 * @param array $data
 * @return PDOStatement
 */
function exec_query(string $query, array $data = []): PDOStatement
{
    $stmt = get_db()->prepare($query);
    $stmt->execute($data);

    return $stmt;
}