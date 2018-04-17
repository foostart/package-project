<!-- PROJECT NAME -->
<div class="form-group">
    <?php $project_category_name = $request->get('project_titlename') ? $request->get('project_name') : @$project->project_category_name ?>
    {!! Form::label($name, trans('project::project_admin.name').':') !!}
    {!! Form::text($name, $project_category_name, ['class' => 'form-control', 'placeholder' => trans('project::project_admin.name').'']) !!}
</div>
<!-- /PROJECT NAME -->