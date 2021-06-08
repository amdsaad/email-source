@extends('spark::layouts.app')

@section('content')

<home :user="user" inline-template>

   <div class="container">

      <!-- Application Dashboard -->

      <div class="row justify-content-center">

         <div class="col-md-8">

            <div class="panel panel-default">

               <div class="panel-heading">Template</div>

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

      <div class="row justify-content-center" >

         <div class="col-md-8"  style="background: white;border: 1px solid #dddd;">

            <div id="#app" class="panel-body" style="padding: 50px 80px;">

               <form  class="form-horizontal" method="post" action="{{ route('save_template') }}">
                  {{ csrf_field() }}
                  <div class="form-group  {{ $errors->has('title') ? 'has-error' : ''}}">

                     <label for="title" class="col-md-12 control-label">Title</label>

                     <div class="col-md-12">

                        <input id="title" type="text" class="form-control" name="title" required  value="{{   ($data) ? $data->title : ''  }}">

                        {!! $errors->first('title', '

                        <p class="help-block">:message</p>

                        ') !!}

                     </div>

                  </div>  


                  <div class="form-group  {{ $errors->has('email_template_token') ? 'has-error' : ''}}">

                     <label for="email_template_token" class="col-md-12 control-label">Email template token</label>

                     <div class="col-md-12">

                        <input id="email_template_token" type="text" class="form-control" name="email_template_token" required  value="{{   ($data) ? $data->email_template_token : ''  }}">

                        {!! $errors->first('email_template_token', '

                        <p class="help-block">:message</p>

                        ') !!}

                     </div>

                  </div>

                  <!-- <div class="form-group  {{ $errors->has('background_color') ? 'has-error' : ''}}">

                     <label for="background_color" class="col-md-12 control-label">Background Color</label>

                     <div class="col-md-12">

                        <select name="background_color" id="background_color" class="form-control">

                        <option @if($data && $data->background_color == "white") selected="" @endif  value="white">White</option>

                        <option @if($data && $data->background_color == "red") selected="" @endif   value="red">Red</option>

                        <option @if($data && $data->background_color == "blue") selected="" @endif  value="blue">Blue</option>

                        <option @if($data && $data->background_color == "pink") selected="" @endif  value="pink">Pink</option>

                        </select>

                        {!! $errors->first('background_color', '

                        <p class="help-block">:message</p>

                        ') !!}

                     </div>

                  </div> -->

                 



                  
<!-- 
                  <div class="form-group  {{ $errors->has('description') ? 'has-error' : ''}}">

                     <label for="description" class="col-md-4 control-label">Template</label>

                     <br>

                     <div style="padding: 0px 20px;">

                         <span class="badges">{customerName}</span>

                        <span class="badges">{first500}</span>

                        <span class="badges">{estimatedWeight}</span>

                        <span class="badges">{estimatedWeightCharges}</span>

                        <span class="badges">{origin}</span>

                        <span class="badges">{originSurcharge}</span>

                        <span class="badges">{scaleFee}</span>

                        <span class="badges">{fuelCharge}</span>

                        <span class="badges">{originSurchargeCost}</span>

                        <span class="badges">{customFee}</span>

                        <span class="badges">{storageDuratoin}</span>

                        <span class="badges">{storageIncluded}</span>

                        <span class="badges">{total}</span>

                     </div>

                     <div class="col-md-12">

                        <textarea id="description" type="text" class="form-control" name="description" required >{{ ($data) ? $data->description : ''  }}</textarea>

                        {!! $errors->first('description', '

                        <p class="help-block">:message</p>

                        ') !!}

                     </div>
 -->
                  <!-- </div> -->

                  @if($data)

                  <input type="hidden" name="template_id" id="template_id" value="{{ $data->id }}">

                  @else

                  <input type="hidden" name="template_id" id="template_id" value="0">

                  @endif

                  <div class="form-group">

                     <div class="col-md-12">

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

                     </div>

                  </div>

               </form>

            </div>

         </div>

      </div>

   </div>

</home>

@endsection

@section('customcss')

 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

<style type="text/css">

  #cke_32, #cke_17, #cke_37, #cke_70, #cke_24, #cke_89, #cke_91{

    display: none !important;

  }

  .badges {

    background: #213125;

    color: #ffff;

    padding: 0px 10px 2px 10px;

    border-radius: 25px;

    font-size: 12px;

    font-weight: 900;

  }

  .badges:nth-child(2n+1) {

    background: #797974;

    color: #ffff;

    padding: 0px 10px 2px 10px;

    border-radius: 25px;

    font-size: 12px;

    font-weight: 900;

  }

  .badges:nth-child(3n+1) {

    background: #503535;

    color: #ffff;

    padding: 0px 10px 2px 10px;

    border-radius: 25px;

    font-size: 12px;

    font-weight: 900;

  }

</style>

@endsection



@section('customscripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

   $(function(){

       CKEDITOR.replace('description');

   });

</script>

@endsection