<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Triassic
 *
 * MongoDB driver for CodeIgniter
 *
 * @package     CodeIgniter
 * @author      Trassic Dev Team
 * @copyright   Copyright (c) 2008 - 2011, Triassic, Inc.
 * @license     http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * MongoDB Database Adapter Class
 *
 * Note: _DB is an extender class that the app controller
 * creates dynamically based on whether the active record
 * class is being used or not.
 *
 * @package     CodeIgniter
 * @subpackage  Drivers
 * @category    Database
 * @author      Trassic Dev Team
 * @link        http://codeigniter.com/user_guide/database/
 */
class CI_DB_mongodb_driver extends CI_DB {

    var $dbdriver = 'mongodb';

    // The character used for escaping
    var $_escape_char = '`';

    // clause and character used for LIKE escape sequences - not used in MongoDB
    var $_like_escape_str = '';
    var $_like_escape_chr = '';

    /**
     * The syntax to count rows is slightly different across different
     * database engines, so this string appears in each driver and is
     * used for the count_all() and count_all_results() functions.
     */
    var $_count_string = 'SELECT COUNT(*) AS ';
    var $_random_keyword = ' RAND()'; // database specific random keyword

    // whether SET NAMES must be used to set the character set
    var $use_set_names;

    var $mongo_database;

    var $mongo_reserved_id = '_id';
    
    /**
     * Non-persistent database connection
     *
     * @access  private called by the base class
     * @return  resource
     */
    function db_connect()
    {
        if ($this->port != '')
        {
            $this->hostname .= ':'.$this->port;
        }

        return new MongoClient();
    }

    // --------------------------------------------------------------------

    /**
     * Persistent database connection
     *
     * @access  private called by the base class
     * @return  resource
     */
    function db_pconnect()
    {
        if ($this->port != '')
        {
            $this->hostname .= ':'.$this->port;
        }

        return new MongoClient();
    }

    // --------------------------------------------------------------------

    /**
     * Reconnect
     *
     * Keep / reestablish the db connection if no queries have been
     * sent for a length of time exceeding the server's idle timeout
     *
     * @access  public
     * @return  void
     */
    function reconnect()
    {
        // @todo - add support if needed
    }

    // --------------------------------------------------------------------

    /**
     * Select the database
     *
     * @access  private called by the base class
     * @return  resource
     */
    function db_select()
    {
        $client = $this->conn_id;
        $this->mongo_database = $client->selectDB($this->database);
        return $this->mongo_database;
    }

    // --------------------------------------------------------------------

    /**
     * Set client character set
     *
     * @access  public
     * @param   string
     * @param   string
     * @return  resource
     */
    function db_set_charset($charset, $collation)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Version number query string
     *
     * @access  public
     * @return  string
     */
    function _version()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Execute the query
     *
     * @access  private called by the base class
     * @param   string  an SQL query
     * @return  resource
     */
    function _execute($sql)
    {
        // @todo - add support if needed
        return $sql;
    }

    // --------------------------------------------------------------------

    /**
     * Prep the query
     *
     * If needed, each database adapter can prep the query string
     *
     * @access  private called by execute()
     * @param   string  an SQL query
     * @return  string
     */
    function _prep_query($sql)
    {
        // @todo - add support if needed
        return $sql;
    }

    // --------------------------------------------------------------------

    /**
     * Begin Transaction
     *
     * @access  public
     * @return  bool
     */
    function trans_begin($test_mode = FALSE)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Commit Transaction
     *
     * @access  public
     * @return  bool
     */
    function trans_commit()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Rollback Transaction
     *
     * @access  public
     * @return  bool
     */
    function trans_rollback()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Escape String
     *
     * @access  public
     * @param   string
     * @param   bool    whether or not the string will be used in a LIKE condition
     * @return  string
     */
    function escape_str($str, $like = FALSE)
    {
        // @todo - add support if needed
        return $str;
    }

    // --------------------------------------------------------------------

    /**
     * Affected Rows
     *
     * @access  public
     * @return  integer
     */
    function affected_rows()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Insert ID
     *
     * @access  public
     * @return  integer
     */
    function insert_id()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * "Count All" query
     *
     * Generates a platform-specific query string that counts all records in
     * the specified database
     *
     * @access  public
     * @param   string
     * @return  string
     */
    function count_all($table = '')
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * List table query
     *
     * Generates a platform-specific query string so that the table names can be fetched
     *
     * @access  private
     * @param   boolean
     * @return  string
     */
    function _list_tables($prefix_limit = FALSE)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Show column query
     *
     * Generates a platform-specific query string so that the column names can be fetched
     *
     * @access  public
     * @param   string  the table name
     * @return  string
     */
    function _list_columns($table = '')
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Field data query
     *
     * Generates a platform-specific query so that the column data can be retrieved
     *
     * @access  public
     * @param   string  the table name
     * @return  object
     */
    function _field_data($table)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * The error message string
     *
     * @access  private
     * @return  string
     */
    function _error_message()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * The error message number
     *
     * @access  private
     * @return  integer
     */
    function _error_number()
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Escape the SQL Identifiers
     *
     * This function escapes column and table names
     *
     * @access  private
     * @param   string
     * @return  string
     */
    function _escape_identifiers($item)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * From Tables
     *
     * This function implicitly groups FROM tables so there is no confusion
     * about operator precedence in harmony with SQL standards
     *
     * @access  public
     * @param   type
     * @return  type
     */
    function _from_tables($tables)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Insert statement
     *
     * Generates a platform-specific insert string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the insert keys
     * @param   array   the insert values
     * @return  string
     */
    function _insert($table, $keys, $values)
    {
        return TRUE;
    }

    // --------------------------------------------------------------------


    /**
     * Replace statement
     *
     * Generates a platform-specific replace string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the insert keys
     * @param   array   the insert values
     * @return  string
     */
    function _replace($table, $keys, $values)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Insert_batch statement
     *
     * Generates a platform-specific insert string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the insert keys
     * @param   array   the insert values
     * @return  string
     */
    function _insert_batch($table, $keys, $values)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------


    /**
     * Update statement
     *
     * Generates a platform-specific update string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the update data
     * @param   array   the where clause
     * @param   array   the orderby clause
     * @param   array   the limit clause
     * @return  string
     */
    function _update($table, $values, $where, $orderby = array(), $limit = FALSE)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------


    /**
     * Update_Batch statement
     *
     * Generates a platform-specific batch update string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the update data
     * @param   array   the where clause
     * @return  string
     */
    function _update_batch($table, $values, $index, $where = NULL)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------


    /**
     * Truncate statement
     *
     * Generates a platform-specific truncate string from the supplied data
     * If the database does not support the truncate() command
     * This function maps to "DELETE FROM table"
     *
     * @access  public
     * @param   string  the table name
     * @return  string
     */
    function _truncate($table)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Delete statement
     *
     * Generates a platform-specific delete string from the supplied data
     *
     * @access  public
     * @param   string  the table name
     * @param   array   the where clause
     * @param   string  the limit clause
     * @return  string
     */
    function _delete($table, $where = array(), $like = array(), $limit = FALSE)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Limit string
     *
     * Generates a platform-specific LIMIT clause
     *
     * @access  public
     * @param   string  the sql query string
     * @param   integer the number of rows to limit the query to
     * @param   integer the offset value
     * @return  string
     */
    function _limit($sql, $limit, $offset)
    {
        // @todo - add support if needed
        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Close DB Connection
     *
     * @access  public
     * @param   resource
     * @return  void
     */
    function _close($conn_id)
    {
        $client = $this->conn_id;
        $client->close();
    }

    // --------------------------------------------------------------------
    // OVERWRITE
    // --------------------------------------------------------------------
    function query($sql, $binds = FALSE, $return_object = TRUE)
    {
        return $sql;
    }

    function escape($str)
    {
        return $str;
    }

    // Active Record

    /**
     * Insert
     *
     * @param   string  the table to insert data into
     * @param   array   an associative array of insert values
     * @return  object
     */
    function insert($table = '', $set = NULL)
    {
        $collection = $this->mongo_database->selectCollection($table);
        return $collection->insert($set);    
    }

    /**
     * Get_Where
     *
     * Allows the where clause, limit and offset to be added directly
     *
     * @param   string  the where clause
     * @param   string  the limit clause
     * @param   string  the offset clause
     * @return  object
     */
    public function get_where($table = '', $where = null, $limit = null, $offset = null)
    {
        $result = array();
        $collection = $this->mongo_database->selectCollection($table);
        foreach ($where as $key => $value) {
            if ($key == '_id')
            {
                $where['_id'] = new MongoId($value);
            }
        }
        $cursor = $collection->find($where);
        foreach ($cursor as $doc) 
        {
            $result[] = $doc;
        }
        return $result;
    }

    /**
     * Delete
     *
     * Compiles a delete string and runs the query
     *
     * @param   mixed   the table(s) to delete from. String or array
     * @param   mixed   the where clause
     * @param   mixed   the limit clause
     * @param   boolean
     * @return  object
     */
    public function delete($table = '', $where = '', $limit = NULL, $reset_data = TRUE)
    {
        $collection = $this->mongo_database->selectCollection($table);
        foreach ($where as $key => $value) {
            if ($key == '_id')
            {
                $where['_id'] = new MongoId($value);
            }
        }
        return $collection->remove($where);    
    }

    /**
     * Update
     *
     * Compiles an update string and runs the query
     *
     * @param   string  the table to retrieve the results from
     * @param   array   an associative array of update values
     * @param   mixed   the where clause
     * @return  object
     */
    public function update($table = '', $set = NULL, $where = NULL, $limit = NULL)
    {
        $collection = $this->mongo_database->selectCollection($table);
        foreach ($where as $key => $value) {
            if ($key == '_id')
            {
                $where['_id'] = new MongoId($value);
            }
        }
        $newData = array('$set' => $set);
        return $collection->update($where, $newData);
    }

}


/* End of file mysql_driver.php */
/* Location: ./system/database/drivers/mysql/mysql_driver.php */