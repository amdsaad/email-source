@extends('spark::layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      @include('left_bar')
      <div class="col-md-9">
         <div class="panel panel-default">
            <div class="panel-heading">Extra Field</div>
         </div>
         <div class="row justify-content-center">
            <div class="col-md-12" style="background: white;border: 1px solid #dddd;">
               <div class="panel-body" style="padding: 50px 80px;">
                  <div class="col-xs-12">
                      <div class="notif-box">
                        
                     </div>
                  </div>
                  <div class="row">
                        <ul id="field" class="sortable col-lg-12" style="list-style: none;">
                     @if(count($data) > 0)

                     @foreach($data as $row)
                     <li class="ui-state-default">
                        <div class="single-field row" data-id="{{ $row->id }}"><div class="col-lg-1" style="vertical-align: middle;text-align: center;margin-top: 35px;"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><div class="col-lg-5 form-group"><label for="field_name">Field Name</label><input id="field_name" name="field_name" type="text" placeholder="" value="{{ $row->field_name }}" class="form-control input-md"></div>
						<!--new code starts-->
                        <div class=" col-lg-2 form-group"><label for="action_name1">Middle Col.</label>
                           <select class="form-control" name="field1_type" id="field1_type">
                              <option @if($row->field1_type == 'null') selected="selected" @endif  value="null"></option>
							  <option @if($row->field1_type == 'text') selected="selected" @endif  value="text">Text</option>
                              <option @if($row->field1_type == 'number') selected="selected" @endif value="number">Number</option>
                              <option @if($row->field1_type == 'radio') selected="selected" @endif  value="radio">Yes-No field</option>
                           </select></div>
						<!--new code ends-->
						
                        <div class=" col-lg-2 form-group"><label for="action_name">Right Col.</label>
                           <select class="form-control" name="field_type" id="field_type">
                              <option @if($row->field_type == 'text') selected="selected" @endif  value="text">Text</option>
                              <option @if($row->field_type == 'number') selected="selected" @endif value="number">Number</option>
                              <option @if($row->field_type == 'radio') selected="selected" @endif  value="radio">Yes-No field</option>
                           </select></div>
                        <div class="form-group actionBx col-md-2" style="display: flex;margin-top: 37px;"><label></label><button data-id="{{ $row->id }}" class="saveBtn form-control input-md badge badge-info"><i class="fa fa-pencil"></i></button><button type="edit" class="form-control input-md badge badge-danger remove-me" data-id="{{ $row->id }}"> <i class="fa fa-trash"></i></button></div></div>
                     </li>
                     @endforeach

                     @else
                        <li class="ui-state-default">                        
                        <div class="single-field row"><div class="col-lg-1" style="vertical-align: middle;text-align: center;margin-top: 35px;"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><div class="col-lg-5 form-group"><label for="field_name">Field Name</label><input id="field_name" name="field_name" type="text" placeholder="" class="form-control input-md"></div>

						<div class=" col-lg-2 form-group"><label for="action_name1">Field 1 Type</label><select class="form-control" name="field1_type" id="field1_type"><option value="null"></option><option value="text">Text</option><option value="number">Number</option><option value="radio">Yes-No field</option></select></div>
						
						
						<div class=" col-lg-2 form-group"><label for="action_name">Field 2 Type</label><select class="form-control" name="field_type" id="field_type"><option value="text">Text</option><option value="number">Number</option><option value="radio">Yes-No field</option></select></div>
						
						<div class="form-group actionBx col-md-2" style="display: flex;margin-top: 37px;"><label></label><button data-id="0" class="saveBtn form-control input-md badge badge-info"><i class="fa fa-save"></i></button><button type="add" class="form-control input-md badge badge-danger remove-me"> <i class="fa fa-trash"></i></button></div></div>
                     </li>
                     @endif
                  </ul>
                     <div class="form-group">
                        <button id="add-more" name="add-more" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
   var _token = "{{ Session::token() }}";
   $(document).ready(function () {

      $( ".sortable" ).sortable({
         update: function() {
            sort_field();
         },
      });

      function sort_field() {
         var arr = [];
         $('.single-field').each(function(){
            var id = $(this).data('id');
            if(id != "undefined"){
               arr.push(id);
            }
         });
         if(arr.length > 0){
            $.ajax({
              type: "POST",
              url: "{{ url('sorted-extra-field-frm') }}",
              data: {
                  'arr': arr,
                  "_token": "{{ csrf_token() }}",
              },
              
              cache: false,
              success: function(data) {
                  var data = JSON.parse(data);
                  if (data.status == 0) {
                      $('.notif-box').html(data.message);
                  } else {
                      if (data.status == 1) {
                          $(_this).closest('.single-field').find('.actionBx').remove();
                          $('.notif-box').html(data.message);
                      } else {
                          $('.notif-box').html(data.message);
                      }
                  }
              }
            });
         }
      }
       $("#add-more").click(function(e){
           e.preventDefault();
           var field_html='<li class="ui-state-default"><div class="single-field row"><div class="col-lg-1" style="vertical-align: middle;text-align: center;margin-top: 35px;"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><div class="col-lg-5 form-group"><label for="field_name">Field Name</label><input id="field_name" name="field_name" type="text" placeholder="" class="form-control input-md"></div><div class=" col-lg-2 form-group"><label for="action_name1">Field Type</label><select class="form-control" name="field1_type" id="field1_type"><option value="null" ></option><option value="text" >Text</option><option value="number" >Number</option><option value="radio">Yes-No field</option></select></div><div class=" col-lg-2 form-group"><label for="action_name">Field Type</label><select class="form-control" name="field_type" id="field_type"><option value="text" >Text</option><option value="number" >Number</option><option value="radio">Yes-No field</option></select></div><div class="form-group actionBx col-md-2" style="display: flex;margin-top: 37px;"><label></label><button data-id ="0" class="saveBtn form-control input-md badge badge-info"><i class="fa fa-save"></i></button><button type="add" class="form-control input-md badge badge-danger remove-me"> <i class="fa fa-trash"></i></button></div></div></li>';
            $('#field').append(field_html);
       });


      $('body').on('click', '.remove-me', function(e){
         e.preventDefault();
         var _this = this;
         var type = $(this).attr('type');
         if(type == 'add'){
            $(this).closest('.single-field').remove();
         }else{
            var id =  $(this).data('id');
            if(confirm('Are you sure?')){
                $.ajax({
                 type: "POST",
                 url: "{{ url('delete-extra-field-frm') }}",
                 data: {
                  "_token": "{{ csrf_token() }}",
                   'id' : id
                 },
                 cache: false,
                 success: function(data){
                  var data = JSON.parse(data);
                  if(data.status == 0){
                     $('.notif-box').html(data.message);
                  }else{
                      $(_this).closest('.single-field').remove();
                     $('.notif-box').html(data.message);
                  }
                 }
               });
            }

         }
      });

      $('body').on('click', '.saveBtn', function(e){
         e.preventDefault();
         var _this = this;
         var field_name = $(this).closest('.single-field').find('#field_name').val();
         var field_type = $(this).closest('.single-field').find('#field_type').val();
         var field1_type = $(this).closest('.single-field').find('#field1_type').val();
         var id =  $(this).data('id');
         $.ajax({
           type: "POST",
           url: "{{ url('save-extra-field-frm') }}",
           data: {
            'field_name' :field_name,
            'field_type' : field_type,
            'field1_type' : field1_type,
			"_token": "{{ csrf_token() }}",
             'id' : id
           },
           cache: false,
           success: function(data){
            var data = JSON.parse(data);
            if(data.status == 0){
               $('.notif-box').html(data.message);
            }else{
               if(data.status == 1){
                  $(_this).closest('.single-field').find('.actionBx').remove();
                  $('.notif-box').html(data.message);
               }else{
                  $('.notif-box').html(data.message);
               }
            }
           }
         });
      })
   });
</script>
@endsection
@section('customcss')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection