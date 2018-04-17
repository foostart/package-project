<!-- CATEGORY LIST -->
<div class="form-group">
    <?php $project_name = $request->get('project_titlename') ? $request->get('project_name') : @$project->project_name ?>

    {!! Form::label('category_id', trans('project::project_admin.project_categoty_name').':') !!}
    {!! Form::select('category_id', @$categories, @$project->category_id, ['class' => 'form-control']) !!}
</div>
<!-- /CATEGORY LIST -->