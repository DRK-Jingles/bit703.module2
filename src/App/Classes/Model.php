<?php
namespace BIT703\Classes;
 
/*
 * Abstract class to give connectivity 
 * for a model to the database.
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */
abstract class Model
{
    /*
     * The PHP Data Objects (\PDO) extension 
     * defines a lightweight, consistent interface 
     * for accessing databases in PHP. 
     * 
     * @return void
     */
    protected $database_object;
    protected $prepared_statement;
 
    public function __construct()
    {
        global $codeception_testing;
        $this->database_object = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

        if(true === $codeception_testing){
            $this->startTransaction();
        }
    }

    /**
     * Stores our requests as a transaction
     * which can be rolled back
     * if there is an issue
     * 
     * @return void
     */
    public function startTransaction()
    {
        $this->database_object->beginTransaction();
    }
 
    /**
     * This is a wrapper function 
     * that tells PDO to prepare our query
     * 
     * @param string $query Our query string
     * @return void
     */
    public function prepare($query)
    {
        $this->prepared_statement = $this->database_object->prepare($query);
    }
 
    /**
     * Here we bind parameters to the query string
     * which separates the data from our string, 
     * preventing SQL injection
     * 
     * The type parameter helps ensure the statement 
     * will handle data types effectively
     * 
     * Thanks to the data type switch case, 
     * we do not need to pass this in 
     * 
     * @param mixed $param The query string parameter that the value will fill
     * @param mixed $value The value being submitted
     * @param mixed $type The data type being submitted
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                    default:
                    $type = \PDO::PARAM_STR;
            }
        }
        $this->prepared_statement->bindValue($param, $value, $type);
    }
 
    /**
     * This will run our query 
     * against the database
     * 
     * @return void
     */
    public function execute()
    {
        $this->prepared_statement->execute();
    }
 
    /**
     * This is used for 
     * sets of selected results
     * 
     * @return array An array of results
     */
    public function resultSet()
    {
        $this->execute();
        return $this->prepared_statement->fetchAll(\PDO::FETCH_ASSOC);
    }
 
    /**
     * Fetch the ID of the 
     * latest insertion
     * 
     * @return int The ID of the new insert
     */
    public function lastInsertId()
    {
        return $this->database_object->lastInsertId();
    }
 
    /**
     * Returns the next result 
     * in a set of results, 
     * generally used for sinlge results
     * 
     * @return mixed the next result
     */
    public function single()
    {
        $this->execute();
        return $this->prepared_statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Allows developers to
     * commit a query during
     * transactions
     * 
     * @return void
     */
    public function commit()
    {
        $this->database_object->commit();
    }
}