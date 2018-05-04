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
      <table class="table table-striped table-bordered" id="table-search">
       <thead>
        <tr>
         <th>{!! trans('project-admin.fields.user-id') !!}</th>
         <th>{!! trans('project-admin.fields.first-name') !!}</th>
         <th>{!! trans('project-admin.fields.last-name') !!}</th>
         <th class="text-center">{!! trans('project-admin.fields.choose') !!}</th>
        </tr>
        <tr id='tr_template' style='display: none;'>
              <td>[1]</td>
              <td>[2]</td>
              <td>[3]</td>
              <td class='text-center'>[4]</td>
          </tr>
       </thead>
       <tbody>
          
       </tbody>
      </table>
      {!! Form::hidden('user_id_member', '', ['id' => 'selectedMember']) !!}
      <h3 id="a" align="center">{!! trans('project-admin.fields.member') !!}</h3>
      <blockquote class="quote-card">
          <p>{!! trans('project-admin.descriptions.remove-member') !!}</p>
      </blockquote>
      <ul id="listSelectMember">
       
      </ul>
     </div>
    </div>    
   </div>
 </body>
</html>

<script>
  var listSearch = [];
  var selectMemberArray = [];

$(document).ready(function(){
  var listSelectMember = document.getElementById('listSelectMember');

  function fetch_member_data(query = '')
    {
      $.ajax({
      url:"{{ route('projects.search') }}",
      method:'GET',
      data:{query:query},
      dataType:'json',
      success:function(data)
        {
          $('#total_records').text(data.total_data);
          var list_id = [];
          $("#table-search > tbody > tr").remove();
          var table = document.getElementById("table-search").getElementsByTagName('tbody')[0];
          
          listSearch = data.data;
          for(var i = 0 ; i < data.data.length; i++)
          {
            var item = data.data[i];
            var tr_template = $("thead").children()[1].outerHTML;
            
            // replace string
            tr_template = tr_template.replace('[1]', item.user_id);
            tr_template = tr_template.replace('[2]', item.first_name);
            tr_template = tr_template.replace('[3]', item.last_name);
            tr_template = tr_template.replace('[4]', "<div id='mem_"+i+"'><i class='fa fa-plus-circle' aria-hidden='true' style='cursor:pointer;'></i></div>");
            tr_template = tr_template.replace("id='tr_template' style='display: none;'", "");

            // add to tbody
            $("tbody").append(tr_template);
            $("tbody tr:last").removeAttr('id').css('display', 'table-row');
          

            $('#mem_'+ i +'').click(function(){
              // var parents = $(this).parents('tr')
              var item_index = $(this).attr('id').replace('mem_', '');

              if(jQuery.inArray(listSearch[Number(item_index)], selectMemberArray) === -1) {
                selectMemberArray.push(listSearch[Number(item_index)]);
                reRenderListMember();
              }
            });

          }
          
        }
      })
    }

  $(document).on('keyup', '#search', function(){
    var query = $(this).val();
    fetch_member_data(query);
  });

  function reRenderListMember()
  {
    listSelectMember.innerHTML = "";
    $("#selectedMember").val('');
    
    selectMemberArray.forEach(function(item, index) {
      listSelectMember.innerHTML =  listSelectMember.innerHTML + "<li class='click_me' index='"+index+"'>" + item.first_name + " " + item.last_name + "</li>";
      
      $(".click_me").click(function() {
          var index = $(this).attr('index');
          selectMemberArray.splice(index, 1);
          reRenderListMember();
      });
    
      $("#selectedMember").val($("#selectedMember").val() + item.user_id + ",");
    });

  }


});
</script>