
@if( ! $projects->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('project::project_admin.order') }}</td>
            <th style='width:10%'>Project ID</th>
            <th style='width:50%'>Project title</th>
            <th style='width:20%'>{{ trans('project::project_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $projects->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($projects as $project)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $project->project_id !!}</td>
            <td>{!! $project->project_name !!}</td>
            <td>
                <a href="{!! URL::route('admin_project.edit', ['id' => $project->project_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_project.delete',['id' =>  $project->project_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
		{{ trans('project::project_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $projects->appends($request->except(['page']) )->render() !!}
</div>