<?php namespace Foostart\Project\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Project\Controllers\Admin\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Project\Models\ProjectsCategories;
/**
 * Validators
 */
use Foostart\project\Validators\ProjectCategoryAdminValidator;

class ProjectCategoryAdminController extends Controller {

    public $data_view = array();

    private $obj_project_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_project_category = new ProjectsCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_project_category = $this->obj_project_category->get_project_categories($params);

        $this->data_view = array_merge($this->data_view, array(
            'project_categories' => $list_project_category,
            'request' => $request,
            'params' => $params
        ));
        return view('project::project_category.admin.project_category_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $project = NULL;
        $project_id = (int) $request->get('id');


        if (!empty($project_id) && (is_int($project_id))) {
            $project = $this->obj_project_category->find($project_id);

        }

        $this->data_view = array_merge($this->data_view, array(
            'project' => $project,
            'request' => $request
        ));
        return view('project::project_category.admin.project_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new ProjectCategoryAdminValidator();

        $input = $request->all();

        $project_id = (int) $request->get('id');

        $project = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($project_id) && is_int($project_id)) {

                $project = $this->obj_project_category->find($project_id);
            }

        } else {
            if (!empty($project_id) && is_int($project_id)) {

                $project = $this->obj_project_category->find($project_id);

                if (!empty($project)) {

                    $input['project_category_id'] = $project_id;
                    $project = $this->obj_project_category->update_project_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('project::project_admin.message_update_successfully'));
                    return Redirect::route("admin_project_category.edit", ["id" => $project->project_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('project::project_admin.message_update_unsuccessfully'));
                }
            } else {

                $project = $this->obj_project_category->add_project_category($input);

                if (!empty($project)) {

                    //Message
                    $this->addFlashMessage('message', trans('project::project_admin.message_add_successfully'));
                    return Redirect::route("admin_project_category.edit", ["id" => $project->project_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('project::project_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'project' => $project,
            'request' => $request,
        ), $data);

        return view('project::project_category.admin.project_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $project = NULL;
        $project_id = $request->get('id');

        if (!empty($project_id)) {
            $project = $this->obj_project_category->find($project_id);

            if (!empty($project)) {
                  //Message
                $this->addFlashMessage('message', trans('project::project_admin.message_delete_successfully'));

                $project->delete();
            }
        } else {

        }

        $this->data_view = array_merge($this->data_view, array(
            'project' => $project,
        ));

        return Redirect::route("admin_project_category");
    }

}