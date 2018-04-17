
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('project::project_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_project_category','method' => 'get']) !!}

        <!--TITLE-->
		<div class="form-group">
            {!! Form::label('project_category_name',trans('project::project_admin.project_category_name_label')) !!}
            {!! Form::text('project_category_name', @$params['project_category_name'], ['class' => 'form-control', 'placeholder' => trans('project::project_admin.project_category_name')]) !!}
        </div>

        {!! Form::submit(trans('project::project_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




