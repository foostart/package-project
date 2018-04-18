<?php

namespace Foostart\Project\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsCategories extends Model {

    protected $table = 'projects_categories';
    public $timestamps = false;
    protected $fillable = [
        'project_category_name'
    ];
    protected $primaryKey = 'project_category_id';

    public function get_project_categories($params = array()) {
        $eloquent = self::orderBy('project_category_id');

        if (!empty($params['project_category_name'])) {
            $eloquent->where('project_category_name', 'like', '%'. $params['project_category_name'].'%');
        }
        $projects_category = $eloquent->paginate(10);
        return $projects_category;
    }

    /**
     *
     * @param type $input
     * @param type $project_id
     * @return type
     */
    public function update_project_category($input, $project_id = NULL) {

        if (empty($project_id)) {
            $project_id = $input['project_category_id'];
        }

        $project = self::find($project_id);

        if (!empty($project)) {

            $project->project_category_name = $input['project_category_name'];

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
    public function add_project_category($input) {

        $project = self::create([
                    'project_category_name' => $input['project_category_name'],
        ]);
        return $project;
    }

    /**
     * Get list of projects categories
     * @param type $category_id
     * @return type
     */
     public function pluckSelect($category_id = NULL) {
        if ($category_id) {
            $categories = self::where('project_category_id', '!=', $category_id)
                    ->orderBy('project_category_name', 'ASC')
                ->pluck('project_category_name', 'project_category_id');
        } else {
            $categories = self::orderBy('project_category_name', 'ASC')
                ->pluck('project_category_name', 'project_category_id');
        }
        return $categories;
    }

}
