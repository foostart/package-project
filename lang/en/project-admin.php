<?php

return [

    "package_name" => 'Project',
    "package_description" => 'Project package is for initial',
    "order" => '#',
    "operations" => 'Operations',
    'project_category_name_label' => 'Project category name:',
    /**
     * Page
     */

    'page_list' => 'List of projects',
    'page_add' => 'Add new item',
    'page_edit' => 'Update project item',
    'page_search' => 'Project page search',
    'page_category'=> 'List categories of project',

    /**
     * Form
     */
    'form_heading' => 'General data',
    'form_add' => 'Add new project item',
    'form_edit' => 'Update project item',
    'name' => 'Name',
    'project_required_name' => 'Required name',
    'required' => 'is required',
    'search' => 'Search',
    'project_name_label' => 'Project name:',
    'project_name_placeholder' => 'project name',
    'Project_category_name'=> 'Project category name',

    /**
     * Message
     */
    'message_update_successfully' => 'Update project item successfully',
    'message_add_successfully' => 'Add new project item successfully',
    'message_delete_successfully' => 'Delete project item successfully',
    'message_find_failed' => 'No results found.',

    /**
     * Validator message
     */
    'title_unvalid_length' => 'Unvalid lenght title. Allow from: <b>:TITLE_MIN_LENGTH</b> to <b>:TITLE_MAX_LENGTH</b>.',

    'project_name' => 'Project name',

    /**
     * Validator message
     */
    'delete_confirm' => 'Are you sure to delete this item?',

    /**
     *
     */
    'tab_overview' => 'Overview',
    'tab_attributes' => 'Attributes',


    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////////CATEGORIES///////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    'page_category_list' => 'Categories',
    'project_category_add_button' => 'Add new project category',
    'project_categoty_id' => 'Category ID',
    'project_categoty_name' => 'Category name',





    /***********************************************************************
    |-----------------------------------------------------------------------
    | MAIN MENU ADMIN
    |-----------------------------------------------------------------------
    | Top menu
    |
    */
    'menus' => [
        'top-menu'   => 'Projects',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | SIDEBARS
    |-----------------------------------------------------------------------
    | project siderbar
    |
    */
    'page' => [
        'list' => 'List of projects',
        'add' => 'Add new item',
        'edit' => 'Update project item',
        'search' => 'Project page search',
        'category'=> 'List categories of project',
        'category-list' => 'Categories',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | TABLES
    |-----------------------------------------------------------------------
    | table projet
    | table category
    |
    */
    'table' => [
        "package_name" => 'Project',
        "package_description" => 'Project package is for initial',
        "order" => '#',
        "id"    => 'Project ID',
        'title' => 'Project title',
        "operations" => 'Operations',
        'project-category-name-label' => 'Project category name:',
        'project-categoty-id' => 'Category ID',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | SEARCHS
    |-----------------------------------------------------------------------
    | search
    |
    */
    'search' => [
        'project_name_label' => 'Project name:',
        'project_name_placeholder' => 'project name',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | BUTTONS
    |-----------------------------------------------------------------------
    | button
    |
    */
    'button' => [
        'search' => 'Search',
        'add-category'  => 'Add new project category',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | MESSAGES
    |-----------------------------------------------------------------------
    | Message
    |
    */
    'message' => [
        'update-successfully' => 'Update project item successfully',
        'add-successfully' => 'Add new project item successfully',
        'delete-successfully' => 'Delete project item successfully',
        'find-failed' => 'No results found.',
        'confirm-delete'    => 'Are you sure to delete this item?',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | FORMS
    |-----------------------------------------------------------------------
    | form
    |
    */
    'form' => [
        'heading' => 'General data',
        'add' => 'Add new project item',
        'edit' => 'Update project item',
        'name' => 'Name',
        'project_required_name' => 'Required name',
        'required' => 'is required',
        'search' => 'Search',
        'project_name_label' => 'Project name:',
        'project_name_placeholder' => 'project name',
        'project-category-name'=> 'Project category name',
    ],





    /***********************************************************************
    |-----------------------------------------------------------------------
    | TABS
    |-----------------------------------------------------------------------
    | tabs
    |
    */
    'tab' => [
        'overview' => 'Overview',
        'attributes' => 'Attributes',
    ],
];