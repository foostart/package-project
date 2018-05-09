<?php
return [

    //Number of worlds
    'length' => [
        'project_name' => [
            'min' => 10,
            'max' => 255,
        ],
        'project_overview' => [
            'min' => 10,
            'max' => 255,
        ],
        'project_description' => [
            'min' => 255,
            'max' => 0,//unlimit
        ],
    ],
    'per_page' => 1,

    /*
    |-----------------------------------------------------------------------
    | ENVIRONMENT
    |-----------------------------------------------------------------------
    | 0: Development
    | 1: Production
    |
    */
    'env' => 0,
    'load_from' => 'package-project::',

    /*
    |-----------------------------------------------------------------------
    | LANGUAGES
    |-----------------------------------------------------------------------
    | vi
    | en
    |
    */
    'langs' => [
        'en' => 'English',
        'vi' => 'Vietnam'
    ],


    /*
    |-----------------------------------------------------------------------
    | Permissions
    |-----------------------------------------------------------------------
    | List
    | Edit
    | Add
    | Select
    |
    */
    'permissions' => [
        'list_all' => ['_superadmin', '_user-editor'],
        'list_by_context' => [],
        'edit' => ['_superadmin', '_user-editor'],
        'add' => ['_superadmin', '_user-editor'],
        'delete' => ['_superadmin', '_user-editor'],
    ],




    
    /*
      |--------------------------------------------------------------------------
      | ITEM STATUS
      |--------------------------------------------------------------------------
      | @public = 99
      | @in_trash = 55 delete from list
      | @draft = 11 auto save
      | @unpublish = 33
     */
    'status' => [
        'list' => [
            99 => 'Publish',
            33 => 'Unpublish',
            55 => 'In trash',
            11 => 'Draft',
        ],
        'color' => [
            11 => '#ef4832',
            33 => '#000000',
            55 => '#a8aac2',
            99 => '#5bc0de'
        ]
    ],




    



    
    /*
      |--------------------------------------------------------------------------
      | ITEM POSITON 
      |--------------------------------------------------------------------------
      | @leader = 10
      | @css = 12
      | @html = 32
      | @sql = 41
     */
    'position' => [
        'list' => [
            10 => 'Leader',
            12 => 'CSS',
            32 => 'HTML',
            41 => 'SQL',
        ]
    ],
];