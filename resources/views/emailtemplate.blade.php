@extends('spark::layouts.app')

@section('content')



<home :user="user" inline-template>

    <div class="container">

        <!-- Application Dashboard -->

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="panel panel-default">

                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        @if (session('status'))

                            <div class="alert alert-success">

                                {{ session('status') }}

                            </div>

                        @endif

                        @if(session()->has('success_message'))

                            <div class="alert alert-success">

                                {{ session()->get('success_message') }}

                            </div>

                        @endif



                        @if(session()->has('error_message'))

                            <div class="alert alert-danger">

                                {{ session()->get('error_message') }}

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>







{{--         Form for email--}}



        <div class="row justify-content-center" style="background: white;border: 1px solid #dddd;">

            <div class="col-md-12">



                <div class="panel-body" style="padding: 30px 5px;">

                    <div class="row">

                        <div class="col-md-12  form-group">

                            <a href="{{ url('template/add') }}" class="btn btn-primary float-right">Add New</a>

                        </div>

                    </div>

                    <div class="table">

                    <table class="table table-bordered text-center">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>

                                  Template

                                </th>


                                <th>

                                  Token

                                </th>

                                <th>Make Default</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @if(count($data) > 0)

                            @foreach($data as $k => $row)
                            <tr>
                                <td>{{ $k + 1 }}</td>

                                <td>{{ $row->title }}</td>
                                 <td>{{ $row->email_template_token }}</td>
                                 <td>
                                  @if(!$row->user_id)

                                    @if($row->checkTemplateIsActive())

                                      <a href="{{ url('template/set_admin_default/'.$row->id) }}" class="btn btn-sm btn-primary make_primary_btn"><i class="fa fa-check"></i> Set Default</a>

                                      @else

                                       <span>Active</span>

                                    @endif

                                  @else

                                     @if($row->status == "Active")

                                        <span>Active</span>

                                      @else

                                      <a href="{{ url('template/set_default/'.$row->id) }}" class="btn btn-sm btn-primary make_primary_btn"><i class="fa fa-check"></i> Set Default</a>

                                      @endif

                                  @endif

                                 </td>

                                <td>

                             <!--    <a href="#" class="btn btn-sm btn-success detailBtn" data-temp="{{ $row->description }}"><i class="fa fa-asterisk"></i> Detail</a> -->

                                <a href="{{ url('template/add/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>

                                @if($row->user_id)
                                <a href="{{ url('template/delete/'.$row->id) }}" class="btn btn-sm btn-danger delete_btn"><i class="fa fa-trash"></i> Delete</a>

                                @endif

                                </td>

                            </tr>

                            @endforeach

                            @else

                            <tr>

                                <td class="text-center" colspan="12">No records !</td>

                            </tr>

                            @endif

                        </tbody>

                    </table>

                </div>



                <div class="row">

                    <div class="col-md-12  form-group">

                    {!! $data->render() !!}    

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</home>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <div class="modal-body">

            ...

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            <button type="button" class="btn btn-primary">Save changes</button>

          </div>

        </div>

      </div>

    </div>





<div id="dialog" title="Template Preview" style="display: none;">

  <p class="preview-temp"></p>

</div>

@endsection

@section('customcss')

<!-- <link rel="stylesheet" type="text/css" href="{{ url('plugins/bootstrap/css/bootstrap.css') }}"> -->

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <style type="text/css">

 .ui-widget-overlay{

    background-color: black;

    background-image: none;

    opacity: 0.9;

    z-index: 1040;    

}

 </style>

@endsection

@section('customscripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    $(function(){

        // $('#exampleModal').modal('show');

        $('body').on('click', '.delete_btn, .make_primary_btn', function(e){

            e.preventDefault();

            if (confirm("Are you sure ?")) {

                var delete_url = $(this).attr('href');

                window.location.href = delete_url;

            }

        });





        $( "#dialog" ).dialog({

          width: 900,

          autoOpen: false,

          // show: {

          //   effect: "blind",

          //   duration: 1000

          // },

          // hide: {

          //   effect: "blind",

          //   duration: 1000

          // }

        });



        $( function() {

            $('body').on('click', '.detailBtn', function(e){

                e.preventDefault();

                var detail = $(this).data('temp');

                $('.preview-temp').html(detail);

                $('#dialog').dialog( "open" );

                

            });



        });

        

    });

</script>



@endsection

