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
    private $id;
    private $created;
    private $code;
    private $description;
    
    /* Constructor to initialize data members of class */
    public function __construct($id,$created,$code,$description){
        $this->id=$id;
        $this->created=$created;
        $this->code=$code;
        $this->description=$description;
    }
    
    /* Setter Methods for private data to access it in controller */
    public function setId($id){
        $this->id=id;
    }
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
     * @return object example data
     */
    public function get(int $id): object
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

       $data=$this->db->select([
            'title'  => 'Get example data',
            'sql'    => $sql,
            'inputs' => [$id]
        ]);
        $obj=(object) $data;
        return $obj;

    }

    /**
     * Create an example.
     *
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
