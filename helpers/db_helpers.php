<?php declare(strict_types=1);

/**
 * Connect to the database.
 * 
 * The function expects an array with the following keys:
 * - host
 * - username
 * - password
 * - database
 * Optional keys:
 * - port    (default: 3306)
 * - charset (default: 'utf8mb4')
 *
 * @param  array   $config
 * @return mysqli|bool
 */
function db_connect(array $config)   // OK
{
    $db = mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database'],
        $config['port'] ?? 3306
    );

    if (mysqli_connect_errno($db)) {

        // Eigentlich würde man hier den Error in einem Logfile speichern
        // und eine Exception werfen oder einen error_triggern
        // trigger_error('ERROR MESSAGE', E_USER_NOTICE);

        echo "Ooops! Something went wrong.";
        return false;
    }

    mysqli_set_charset($db, $config['charset'] ?? 'utf8mb4');

    return $db;
};


/**
 * Disconnect from the database.
 *
 * @param  mysqli   $db
 * @return bool
 */
function db_disconnect(mysqli $db) : bool
{
    return mysqli_close($db);
}


/**
 * Escape a given string for safe use within queries.
 *
 * @param  mysqli   $db
 * @param  string   $string
 * @return string
 */
function db_escape(mysqli $db, string $string) : string
{
    return mysqli_escape_string($db, $string);
};


/**
 * Fire an SQL query to the database.
 * 
 * The function returns the result either as an
 * mysqli result set (for SELECTs) or as a
 * boolean (for INSERTs, UPDATEs and DELETEs)
 *
 * @param  mysqli   $db
 * @param  string   $sql
 * @return mysqli_result|bool
 */
function db_query(mysqli $db, string $sql)
{
    // TODO: This does not work with redirects
    if (defined('SHOW_QUERIES') && SHOW_QUERIES) {
        echo "<p><pre>$sql</pre></p>";
    }

    $result = mysqli_query($db, $sql);

    $success = db_handle_errors($db);

    if (!$success) {
        return false;
    }

    return $result;
};


/**
 * Check a given database connection for errors.
 * 
 * Errors are reported as a PHP WARNING.
 *
 * @param  mysqli   $db
 * @param  int      $error_level = E_USER_WARNING
 * @return bool
 */
function db_handle_errors(mysqli $db, int $error_level = E_USER_WARNING) : bool
{
    if ($errno = mysqli_errno($db)) {

        $message = "Error $errno: " . mysqli_error($db);
        trigger_error($message, $error_level);

        return false;
    }

    return true;
}


/**
 * Pull all rows from a mysqli result set.
 * 
 * The function returns an array.
 *
 * @param  mysqli_result $result
 * @return array
 */
function db_fetch_data(mysqli_result $result) : array
{
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}


/**
 * Fire a select query to the database.
 * 
 * The result is returned as an array.
 * 
 * CAUTION: In contrast to db_get, db_delete, db_insert,
 *          and db_update, this function db_select,
 *          does NOT automatically escape its variable.
 *          This means, that you have to sanitize any
 *          user input in $sql youself!
 *
 * @param  mysqli   $db
 * @param  string   $sql
 * @return array
 */
function db_select(mysqli $db, string $sql) : array
{
    $result = db_query($db, $sql);

    if (!$result) {
        return [];
    }

    $data = db_fetch_data($result);

    mysqli_free_result($result);

    return $data;
};


/**
 * Get a single row by id.
 * 
 * The result is returned as an array.
 *
 * @param  mysqli   $db
 * @param  string   $table
 * @param  int      $id
 * @return array
 */
function db_get(mysqli $db, string $table, int $id)
{
    $id = (int) $id;

    return db_select($db, "SELECT * FROM $table WHERE id = $id")[0] ?? [];
};


/**
 * Delete a single row by id.
 * 
 * Returns true on success, false on failure.
 *
 * @param  mysqli   $db
 * @param  string   $table
 * @param  int      $id
 * @return bool
 */
function db_delete(mysqli $db, string $table, int $id) : bool
{
    $sql = "DELETE FROM $table WHERE id = " . (int) $id;
    
    return db_query($db, $sql);
};


/**
 * Prepares a value for use within a query.
 * Booleans are cast to integer.
 * Strings are properly escaped and enclosed in single quotes.
 *
 * @param  mysqli   $db
 * @param  mixed    $value
 * @return mixed
 */
function db_prepare($db, $value)
{
    if (is_bool($value)) {
        return (int) $value;
    }

    if (is_string($value)) {
        return "'" . db_escape($db, $value) . "'";
    }

    return $value;
}


/**
 * Insert a row into a database table.
 * 
 * The function expects an associative array with the
 * keys being the table columns and the values being
 * the corresponding values in the database.
 * 
 * The function returns the id of the inserted record
 * or 0 if the insert failed.
 *
 * @param  mysqli   $db
 * @param  string   $table
 * @param  array    $data
 * @return int
 */
function db_insert(mysqli $db, string $table, array $data) : int
{
    foreach ($data as $key => $value) {
        $keys[] = '`' . $key . '`';
        $values[] = db_prepare($db, $value);
    }

    $keys = implode(', ', $keys);
    $values = implode(', ', $values);

    $sql = "INSERT INTO `$table` ($keys) VALUES ($values)";
    $success = db_query($db, $sql);

    if (!$success) {
        return 0;
    }

    return mysqli_insert_id($db);
}


/**
 * Update a single row in the database.
 * 
 * The function expects the id of the row and
 * an associative array with the keys being the
 * table columns and the values being the
 * corresponding values in the database.
 * 
 * The function returns true on success,
 * false otherwise
 *
 * @param  mysqli   $db
 * @param  string   $table
 * @param  int      $id
 * @param  array    $data
 * @return bool
 */
function db_update(mysqli $db, string $table, int $id, array $data) : bool
{
    foreach ($data as $key => $value) {

        $value = db_prepare($db, $value);
        $pairs[] = "`$key` = $value";
    }
    
    $pairs = implode(', ', $pairs);
    $sql = "UPDATE `$table` SET $pairs WHERE `id` = " . (int) $id;

    return db_query($db, $sql);
}
