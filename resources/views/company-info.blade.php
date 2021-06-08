@extends('spark::layouts.app')

@section('content')

<home :user="user" inline-template>

   <div class="container">

      <!-- Application Dashboard -->

      <div class="row justify-content-center">

         @include('left_bar')

         <div class="col-md-9">

            <div class="panel panel-default">
               <div class="panel-heading">Company Information</div>

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

            <div class="row ">

               <div class="col-md-12" style="background: white;border: 1px solid #dddd;">

                  <div class="panel-body" style="padding: 50px 80px;">

                     <form  enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('save_company_info') }}">

                        {{ csrf_field() }}

                        <div class="row">

                           <div class="col-md-2">

                              @if($companyData)

                              <img style="height: 100px; width:90px; border:1px solid #DDD;" src="{{ url('uploads/'.$companyData->logo) }}">

                              @else

                              <div style="height: 100px; width:90px; border:1px solid #DDD;"></div>

                              @endif

                           </div>

                           <div class="col-lg-8">

                              <div class="form-group  {{ $errors->has('logo') ? 'has-error' : ''}}">

                                 <label for="logo" class="col-md-12 control-label">logo</label>

                                 <div class="col-md-12">

                                 <input id="logo" type="file" name="logo">

                                 {!! $errors->first('logo', '

                                    <p class="help-block">:message</p>

                                    ') !!}

                                 </div>

                              </div>

                           </div>

                        </div>

                           <hr>

                        

                        <div class="form-group  {{ $errors->has('name') ? 'has-error' : ''}}">

                           <label for="name" class="col-md-12 control-label">Name</label>

                           <div class="col-md-12">
                            @if((old('name')))
                              <input id="name" type="text" class="form-control" name="name"  value="{{  (old('name')) ? old('name') : ''  }}">
                            @else
                              <input id="name" type="text" class="form-control" name="name"  value="{{  ($companyData) ? $companyData->name : ''  }}">
                            @endif

                              {!! $errors->first('name', '

                              <p class="help-block">:message</p>

                              ') !!}

                           </div>

                        </div>

                        <div class="form-group  {{ $errors->has('email') ? 'has-error' : ''}}">

                           <label for="email" class="col-md-12 control-label">Email</label>

                           <div class="col-md-12">
                            @if(old('email'))
                              <input id="email" type="text" class="form-control" name="email"  value="{{  (old('email')) ? old('email') : ''  }}">
                            @else
                              <input id="email" type="text" class="form-control" name="email"  value="{{  ($companyData) ? $companyData->email : ''  }}">
                            @endif

                              {!! $errors->first('email', '

                              <p class="help-block">:message</p>

                              ') !!}

                           </div>

                        </div>

                        <div class="form-group  {{ $errors->has('mobile') ? 'has-error' : ''}}">

                           <label for="mobile" class="col-md-12 control-label">Mobile</label>

                           <div class="col-md-12">
                              @if(old('mobile'))
                                <input id="mobile" type="text" class="form-control" name="mobile"  value="{{  (old('mobile')) ? old('mobile') : ''  }}">
                              @else
                                <input id="mobile" type="text" class="form-control" name="mobile"  value="{{  ($companyData) ? $companyData->mobile : ''  }}">
                              @endif
                              {!! $errors->first('mobile', '

                              <p class="help-block">:message</p>

                              ') !!}

                           </div>

                        </div>

                        <div class="form-group  {{ $errors->has('toll_free_no') ? 'has-error' : ''}}">

                           <label for="toll_free_no" class="col-md-12 control-label">Toll Free Number</label>

                           <div class="col-md-12">
                              @if(old('toll_free_no'))
                                <input id="toll_free_no" type="text" class="form-control" name="toll_free_no"  value="{{  (old('toll_free_no')) ? old('toll_free_no') : ''  }}">
                              @else
                                <input id="toll_free_no" type="text" class="form-control" name="toll_free_no"  value="{{   ($companyData) ? $companyData->toll_free_no : ''  }}">
                              @endif
                              {!! $errors->first('toll_free_no', '

                              <p class="help-block">:message</p>

                              ') !!}

                           </div>

                        </div>

                        <div class="form-group  {{ $errors->has('website') ? 'has-error' : ''}}">

                           <label for="website" class="col-md-12 control-label">Website</label>

                           <div class="col-md-12">
                            @if(old('website'))
                                <input id="website" type="text" class="form-control" name="website"  value="{{  (old('website')) ? old('website') : ''  }}">
                              @else
                              <input id="website" type="text" class="form-control" name="website"  value="{{  ($companyData) ? $companyData->website : ''  }}">
                              @endif
                              {!! $errors->first('website', '

                              <p class="help-block">:message</p>

                              ') !!}

                           </div>

                        </div>

                        <div class="form-group  {{ $errors->has('address') ? 'has-error' : ''}}">

                           <label for="address" class="col-md-12 control-label">Position</label>

                           <div class="col-md-12">
                            @if(old('address'))
                                <input id="address" type="text" class="form-control" name="address"  value="{{  (old('address')) ? old('address') : ''  }}">
                            @else
                            <input id="address" type="text" class="form-control" name="address"  value="{{   ($companyData) ? $companyData->address : ''  }}">
                            @endif
                              {!! $errors->first('address', '

                              <p class="help-block">:message</p>

                              ') !!}

                           </div>

                        </div>
                        

                        <div class="form-group  {{ $errors->has('company_info') ? 'has-error' : ''}}">

                              <label for="company_info" class="col-md-4 control-label">Company Info</label>

                              <div class="col-md-12">
                                 @if(old('address'))
                                 <textarea id="company_info" type="text" class="form-control" name="company_info" required >{{ (old('address')) ? old('address') : ''  }}</textarea>
                                @else
                                 <textarea id="company_info" type="text" class="form-control" name="company_info" required >{{ ($companyData) ? $companyData->company_info : ''  }}</textarea>

                                 @endif

                                 {!! $errors->first('company_info', '

                                 <p class="help-block">:message</p>

                                 ') !!}

                              </div>

                        </div>

                        <div class="form-group">

                           <div class="col-md-12">

                              <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>

                           </div>

                        </div>

                     </form>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</home>

@endsection

@section('customcss')

<style type="text/css">

   .help-block{

      color: red;

      font-weight: 500;

      font-size: 13px;

   }

</style>

@endsection

@section('customscripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script type="text/javascript">

   $(function(){

      CKEDITOR.config.toolbarGroups = [

          { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },

          { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },

          { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },

          { name: 'forms' },

          '/',

          { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },

          { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ] },

          { name: 'links' },

          { name: 'insert' },

          '/',

          { name: 'styles' },

          { name: 'colors' },

          { name: 'tools' },

          { name: 'others' },

          { name: 'about' }

      ];

       CKEDITOR.replace('company_info');

   });

</script>

@endsection