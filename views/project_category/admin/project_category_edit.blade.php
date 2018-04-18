@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('project::project_admin.page_edit') }}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($project->project_category_id) ? '<i class="fa fa-pencil"></i>'.trans('project-admin.form.edit') : '<i class="fa fa-users"></i>'.trans('project-admin.form.add') !!}
                    </h3>
                </div>
                <!-- ERRORS NAME  -->
                {{-- model general errors from the form --}}
                @if($errors->has('project_category_name') )
                    <div class="alert alert-danger">{!! $errors->first('project_category_name') !!}</div>
                @endif
                <!-- /END ERROR NAME -->
                
                <!-- LENGTH NAME  -->
                @if($errors->has('name_unvalid_length') )
                    <div class="alert alert-danger">{!! $errors->first('name_unvalid_length') !!}</div>
                @endif
                <!-- /END LENGTH NAME -->

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- project CATEGORIES ID -->
                            <h4>{!! trans('project-admin.form.heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_project_category.post', 'id' => @$project->project_category_id],  'files'=>true, 'method' => 'post'])  !!}

                            <!--END project CATEGORIES ID  -->

                            <!-- project NAME TEXT-->
                            @include('project::project_category.elements.text', ['name' => 'project_category_name'])
                            <!-- /END project NAME TEXT -->
                            
                            {!! Form::hidden('id',@$project->project_category_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_project_category.delete',['id' => @$project->id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Delete
                            </a>
                            <!-- DELETE BUTTON -->

                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-4'>
            @include('project::project.admin.project_search')
        </div>

    </div>
</div>
@stop