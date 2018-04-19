<?php namespace Foostart\Project\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Project\Models\Project;

use Illuminate\Support\MessageBag as MessageBag;

class ProjectValidator extends FooValidator
{

    protected $obj_project;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'project_name' => ["required"],
            'project_overview' => ["required"],
            'project_description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_project = new Project();

        // language
        $this->lang_front = 'project-front';
        $this->lang_admin = 'project-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'project_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'project_overview.required'      => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.overview')]),
                'project_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
            ];
        });


    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        //Check length
        $_ln = self::$configs['length'];

        $params = [
            'name' => [
                'key' => 'project_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['project_name']['min'],
                'max' => $_ln['project_name']['max'],
            ],
            'overview' => [
                'key' => 'project_overview',
                'label' => trans($this->lang_admin.'.fields.overview'),
                'min' => $_ln['project_overview']['min'],
                'max' => $_ln['project_overview']['max'],
            ],
            'description' => [
                'key' => 'project_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['project_description']['min'],
                'max' => $_ln['project_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['project_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['project_overview'], $params['overview']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['project_description'], $params['description']) ? $flag : FALSE;

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-project');
        return $configs;
    }

}