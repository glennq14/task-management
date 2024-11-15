<?php
namespace App\Class;

final class Db
{
    private $sqlite3;
    private $tableName;
    private $database;

    public function __construct()
    {
        global $appdir;
        $database = getenv('DB_DATABASE');
        $this->sqlite3  = new \sqlite3("{$appdir}/database/{$database}");
    }

    /**
     * Select query to get all records and or single record by ID
     */
    public function select($table, $id = 0, $fields = [], $orderby = [])
    {
        $column = '*';
        $where  = '';

        if ( ! empty($fields) && count($fields) > 1 ) {
            $column = implode(',', $fields);    
        } else if ( count($fields) == 1 ) {
            $column = current($fields);
        }

        $sql = "SELECT {$column} FROM {$table}";
        
        if ( $id !== 0 ) {
            $sql .= " WHERE id={$id}";
            return $this->sqlite3->querySingle($sql, true);
        } else {
            if ( ! empty($orderby) ) {
                $order = [];
                foreach ($orderby as $key => $val) {
                    $order[] = "{$key} $val";
                }
                $sql .= ' ORDER BY ' . implode(',', $order);
            }
            $results = $this->sqlite3->query($sql);
        }

        $data = [];
        while ( $row = $results->fetchArray() ) {
            $rowData = [];
            foreach ( $row as $key => $val ) {
                if ( ! is_numeric($key) ) {
                    $rowData[$key] = $val;
                }
            }
            $data[] = $rowData;
        }

        return $data;
    }

    /**
     * Insert record
     */
    public function insert($table, $fields = [])
    {
        if ( empty($fields) ) {
            return false;
        }
    
        $columns = [];
        $values  = [];
        foreach ( $fields as $key => $value ) {
            $columns[] = $key;
            $values[]  = $value;
        }

        $sql = 'INSERT INTO ' . $table.'(' . implode(',', $columns) . ') VALUES("' . implode('","', $values) . '")';
        return $this->sqlite3->exec($sql);
    }

    /**
     * Update single record
     */
    public function update($table, $id = 0, $fields = [])
    {   
        if ( ! empty($fields) ) {
            $column = [];
            foreach ($fields as $key => $value) {
                $column[] = sprintf('%s="%s"', $key, $value);
            }
            $update = implode(',', $column);
            
            return $this->sqlite3->exec(sprintf("UPDATE %s SET %s WHERE id=%d", $table, $update, $id));
        }

        return false;
    }

    /**
     * Delete single record
     */
    public function delete($table, $id = 0)
    {
        if ( $id !== 0 ) { 
            return $this->sqlite3->exec("DELETE FROM {$table} WHERE id={$id}");
        }

        return false;
    }

    public function query($sql)
    {
        return $this->sqlite3->exec($sql);
    }

}