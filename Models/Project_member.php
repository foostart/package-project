<?php namespace Foostart\Project\Models;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class Project_member extends FooModel {

    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

    }

    public function setConfigs() {

        //table name
        $this->table = 'project_member';

        //list of field in table
        $this->fillable = [
            'project_id',
            'user_id',
        ];

        //list of fields for inserting
        $this->fields = [
            'project_id' => [
                'name' => 'project_id',
                'type' => 'Int',
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => 'Int',
            ], 
        ];

        //check valid fields for inserting
        // $this->valid_insert_fields = [
        //     'project_name',
        //     'user_id',
        //     'category_id',
        //     'user_full_name',
        //     'updated_at',
        //     'project_overview',
        //     'project_description',
        //     'project_image',
        //     'project_files',
        //     'project_status',
        //     'leader',
        // ];

        //check valid fields for ordering
        // $this->valid_ordering_fields = [
        //     'project_name',
        //     'updated_at',
        //     $this->field_status,
        // ];
        // //check valid fields for filter
        // $this->valid_filter_fields = [
        //     'keyword',
        //     'project_status',
        // ];

        //primary key
        $this->primaryKey = 'id';

        //the number of items on page
        $this->perPage = 10;

        //item status
        // $this->field_status = 'project_status';

        $this->timestamps = false;

    }

    /**
     * Gest list of items
     * @param type $params
     * @return object list of categories
     */
    public function selectItems($params = array()) {

        //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo);

        //select fields
        $elo = $this->createSelect($elo);

        //order filters
        $elo = $this->orderingFilters($params, $elo);

        //paginate items
        $items = $this->paginateItems($params, $elo);

        return $items;
    }

    /**
     * Get a member by {id}
     * @param ARRAY $params list of parameters
     * @return OBJECT member
     */
    public function selectItem($params = array(), $key = NULL) {


        if (empty($key)) {
            $key = $this->primaryKey;
        }
       //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo, FALSE);

        //select fields
        $elo = $this->createSelect($elo);

        //id
        $elo = $elo->where($this->primaryKey, $params['id']);

        //first item
        $item = $elo->first();

        return $item;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function joinTable(array $params = []){
        return $this;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function searchFilters(array $params = [], $elo, $by_status = TRUE){

        //filter
        if ($this->isValidFilters($params) && (!empty($params)))
        {
            foreach($params as $column => $value)
            {
                if($this->isValidValue($value))
                {
                    switch($column)
                    {
                        case 'project_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.project_id', '=', $value);
                            }
                            break;
                        case 'user_id':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . 'user_id', '=', $value);
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } /*elseif ($by_status) {

            $elo = $elo->where($this->table . '.'.$this->field_status, '=', $this->status['publish']);

        }*/

        return $elo;
    }

    /**
     * Select list of columns in table
     * @param ELOQUENT OBJECT
     * @return ELOQUENT OBJECT
     */
    public function createSelect($elo) {

        $elo = $elo->select($this->table . '.*',
                            $this->table . '.id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params = [], $elo) {
        $items = $elo->paginate($this->perPage);

        return $items;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @param INT $id is primary key
     * @return type
     */
    public function updateItem($project_id, $arrUserID) {

        Project_member::where('project_id',$project_id)->delete();
        foreach ($arrUserID as $id)
        {
            $data = [
                'user_id' => $id,
                'project_id' => $project_id
            ];

            $this->insertItem($data);
        }
    }


    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT member
     */
    public function insertItem($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);

 
        $item = self::create($dataFields);

        $key = $this->primaryKey;
        $item->id = $item->$key;

        return $item;
    }

/**
 * 
 */
    public function insertBulk($project_id, $arrUserID)
    {
        foreach ($arrUserID as $id)
        {
            $data = [
                'user_id' => $id,
                'project_id' => $project_id
            ];

            $this->insertItem($data);
        }
    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem($input = [], $delete_type) {

        $item = $this->find($input['id']);

        if ($item) {
            switch ($delete_type) {
                case 'delete-trash':
                    return $item->fdelete($item);
                    break;
                case 'delete-forever':
                    return $item->delete();
                    break;
            }

        }

        return FALSE;
    }

    /**
     * @param id of project
     * @return list member of project
     */
    public function getMembersOfProject($project_id)
    {
       
        $members = self::where('project_id',$project_id)
                    ->select("user_id")
                    ->with('UserProfile')
                    ->get();
        return $members;
    }

    /**
     * Eloquent relationship
     * 1 user => n project_member
     */
    public function UserProfile()
    {
        return $this->hasOne("LaravelAcl\Authentication\Models\UserProfile", "user_id", "user_id");
    }

}