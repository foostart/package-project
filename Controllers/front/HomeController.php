<?php

namespace Foostart\Project\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Category\Library\Controllers\FooController;
use Foostart\Project\Models\Project;
use Foostart\Project\Models\Project_member;
use Foostart\Category\Models\Category;
use Foostart\Project\Validators\ProjectValidator;
use Foostart\Category\Controllers\Admin\CategoryAdminController;
use Foostart\Category\Controllers\Admin\ContextAdminController;
use Foostart\Project\Repositories\SearchUserRepository;
    

class HomeController extends Controller
{
    public $obj_item = NULL;
    public $obj_category = NULL;
    public $obj_member = NULL;
    public $statuses = NULL;
    public $positions = NULL;
    public $leader_position = NULL;
    public $menu = NULL;
    public function __construct() {
        // models
        $this->obj_item = new Project(array('perPage' => 10));
        $this->obj_category = new Category();
        $this->obj_member = new Project_member();
        $this->menu = new CategoryAdminController();

        // validators
        $this->obj_validator = new ProjectValidator();

        // set language files
        $this->plang_admin = 'project-admin';
        $this->plang_front = 'project-front';

        // package name
        $this->package_name = 'package-project';
        $this->package_base_name = 'project';

        // root routers
        $this->root_router = 'projects';

        $this->data_view['status'] = $this->obj_item->getPluckStatus();
        $this->data_view['position'] = $this->obj_item->getPluckPositions();

        // page views
        $this->page_views = [
            'front' => [
                'home' => $this->package_name.'::front.'.$this->package_base_name.'-about',
            ]
            
        ];
    }

    public function mainMenu(Request $request)
    {
        $main_menu = $this->menu->index($request);
        return $main_menu;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $items = $this->obj_item->selectItems($params);
        // display view
        $this->data_view = array_merge($this->data_view,array(
            'items' => $items,
            'request' => $request,
            'params' => $params,
            'statuses' => $this->statuses,
            'positions' => $this->positions,
        ));
        return view($this->page_views['front']['home'], $this->data_view);
    }

}