
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i>{!! trans('project-admin.page.search') !!}</h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_project_category','method' => 'get']) !!}

        <!--TITLE-->
		<div class="form-group">
            {!! Form::label('project_category_name',trans('project-admin.table.project-category-name-label')) !!}
            {!! Form::text('project_category_name', @$params['project_category_name'], ['class' => 'form-control', 'placeholder' => trans('project-admin.table.project-category-name-label')]) !!}
        </div>

        {!! Form::submit(trans('project-admin.button.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




