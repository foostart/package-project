<?php

namespace Foostart\Project\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model {

    protected $table = 'projects';
    public $timestamps = false;
    protected $fillable = [
        'project_name',
        'category_id'
    ];
    protected $primaryKey = 'project_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_projects($params = array()) {
        $eloquent = self::orderBy('project_id');

        //project_name
        if (!empty($params['project_name'])) {
            $eloquent->where('project_name', 'like', '%'. $params['project_name'].'%');
        }

        $projects = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $projects;
    }



    /**
     *
     * @param type $input
     * @param type $project_id
     * @return type
     */
    public function update_project($input, $project_id = NULL) {

        if (empty($project_id)) {
            $project_id = $input['project_id'];
        }

        $project = self::find($project_id);

        if (!empty($project)) {

            $project->project_name = $input['project_name'];
            $project->category_id = $input['category_id'];

            $project->save();

            return $project;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_project($input) {

        $project = self::create([
                    'project_name' => $input['project_name'],
                    'category_id' => $input['category_id'],
        ]);
        return $project;
    }
}
