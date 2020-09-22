<?php

declare(strict_types = 1);

namespace Example\Model;

use Mini\Model\Model;

/**
 * Example data.
 */
class ExampleModel extends Model
{
    /* Data Members of class */
    private $created;
    private $code;
    private $description;
    
    /* Constructor to initialize data members of class */
    public function __construct($created,$code,$description){
        $this->created=$created;
        $this->code=$code;
        $this->description=$description;
    }
    
    /* Setter Methods for private data to access it in controller */
     public function setCreated($created){
         $this->created=created;
     }
     public function setCode($code){
        $this->code=code;
    }
    public function setDescription($description){
        $this->description=description;
    }


    /**
     * Get example data by ID.
     *
     * @param int $id example id
     *  
     * @return array example data
     */
    public function get(int $id): array
    {
        $sql = '
            SELECT
                example_id AS "id",
                created,
                code,
                description
            FROM
                ' . getenv('DB_SCHEMA') . '.master_example
            WHERE
                example_id = ?';

        /** My Code to store table data in object */
            $obj=mysql_fetch_object($sql);
        /* ************************************** */

        return $this->db->select([
            'title'  => 'Get example data',
            'sql'    => $obj,
            'inputs' => [$id]
        ]);
    }

    /**
     * Create an example.
     *
     * @param string $created     example created on
     * @param string $code        example code
     * @param string $description example description
     *  
     * @return int example id
     */
    public function create(): int
    {
        $sql = '
            INSERT INTO
                ' . getenv('DB_SCHEMA') . '.master_example
            (
                created,
                code,
                description
            )
            VALUES
            (?,?,?)';

        $id = $this->db->statement([
            'title'  => 'Create example',
            'sql'    => $sql,
            'inputs' => [
                $this->created,
                $this->code,
                $this->description
            ]
        ]);

        $this->db->validateAffected();

        return $id;
    }
}
