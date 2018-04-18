<!--ADD PROJECT CATEGORY ITEM-->
<div class="row margin-bottom-12">
    <div class="col-md-12">
        <a href="{!! URL::route('admin_project_category.edit') !!}" class="btn btn-info pull-right">
            <i class="fa fa-plus"></i>{{trans('project-admin.button.add-category')}}
        </a>
    </div>
</div>
<!--/END ADD PROJECT CATEGORY ITEM-->

@if( ! $project_categories->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>
                {{ trans('project-admin.table.order') }}
            </td>

            <th style='width:10%'>
                {{ trans('project-admin.table.project-categoty-id') }}
            </th>

            <th style='width:50%'>
                {{ trans('project-admin.form.project-category-name') }}
            </th>

            <th style='width:20%'>
                {{ trans('project-admin.table.operations') }}
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $project_categories->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($project_categories as $project_category)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <!--/END COUNTER-->

            <!--PROJECT CATEGORY ID-->
            <td>
                {!! $project_category->project_category_id !!}
            </td>
            <!--/END PROJECT CATEGORY ID-->

            <!--PROJECT CATEGORY NAME-->
            <td>
                {!! $project_category->project_category_name !!}
            </td>
            <!--/END PROJECT CATEGORY NAME-->

            <!--OPERATOR-->
            <td>
                <a href="{!! URL::route('admin_project_category.edit', ['id' => $project_category->project_category_id]) !!}">
                    <i class="fa fa-edit fa-2x"></i>
                </a>
                <a href="{!! URL::route('admin_project_category.delete',['id' =>  $project_category->project_category_id, '_token' => csrf_token()]) !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o fa-2x"></i>
                </a>
                <span class="clearfix"></span>
            </td>
            <!--/END OPERATOR-->
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <!-- FIND MESSAGE -->
    <span class="text-warning">
        <h5>
            {{ trans('project::project_admin.message_find_failed') }}
        </h5>
    </span>
    <!-- /END FIND MESSAGE -->
@endif
<div class="paginator">
    {!! $project_categories->appends($request->except(['page']) )->render() !!}
</div>