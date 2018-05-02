<!DOCTYPE html>
<html>
 <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 </head>
 <body>
  <br />
   <div class="panel panel-default">
    <div class="panel-heading">{!! trans('project-admin.labels.search') !!}</div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="{!! trans('project-admin.labels.member') !!}" />
     </div>
     <div class="table-responsive">
      <h3 align="center">{!! trans('project-admin.labels.total-data') !!}<span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>{!! trans('project-admin.fields.user-id') !!}</th>
         <th>{!! trans('project-admin.fields.first-name') !!}</th>
         <th>{!! trans('project-admin.fields.last-name') !!}</th>
         <th>{!! trans('project-admin.fields.choose') !!}</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>
      <h3 align="center">{!! trans('project-admin.fields.member') !!}<span id="total_records"></span></h3>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>{!! trans('project-admin.fields.user-id') !!}</th>
                <th>{!! trans('project-admin.fields.first-name') !!}</th>
                <th>{!! trans('project-admin.fields.last-name') !!}</th>
            </tr>
            </thead>
            <div class="result">

            </div>
        </table>
     </div>
    </div>    
   </div>
 </body>
</html>

<script>
$(document).ready(function(){

 fetch_member_data();

 function fetch_member_data(query = '')
 {
  $.ajax({
   url:"{{ route('projects.search') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_member_data(query);
 });
});
</script>