<?php

namespace Foostart\Project\Controlers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Project\Models\Projects;

class ProjectUserController extends Controller
{
    public $data = array();
    public function __construct() {

    }

    public function index(Request $request)
    {

        $obj_project = new Projects();
        $projects = $obj_project->get_projects();
        $this->data = array(
            'request' => $request,
            'projects' => $projects
        );
        return view('project::project.index', $this->data);
    }

}