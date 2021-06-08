@extends('spark::layouts.app')
@section('content')
<home :user="user" inline-template>
   <div class="container">
      <!-- Application Dashboard -->
      <div class="row justify-content-center">
         @include('left_bar')
         <div class="col-md-9">
            <div class="panel panel-default">
               <div class="panel-heading">SMTP Settings</div>
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
            <div class="row justify-content-center">
               <div class="col-md-12" style="background: white;border: 1px solid #dddd;">
                  <div class="panel-body" style="padding: 50px 80px;">
                     @if(!Auth::user()->checkGoogleSMTP() && !Auth::user()->checkCustomSMTP())
                     <div class="row">
                        <div class="col-lg-12 text-center">
                           <a class="btn btn-danger " href="{{ url('/oauth/gmail') }}"><i class="fa fa-google"></i> Login With Google</a>
                        </div>
                     </div>
                     <hr>
                      <div class="row">
                        <div class="col-lg-12 text-center">
                           <span style="border-radius: 66px;border: 1px solid rgb(10, 10, 10);padding: 8px 6px;">OR</span>
                        </div>
                     </div>
                     <hr>
                     @endif 
                     @if(Auth::user()->checkGoogleSMTP())
                     <div class="row">
                        <div class="col-md-12">
                           <h5 class="pull-left">Google SMTP Enabled</h5>
                           <h5 class="pull-right"><a href="#" data-href="{{ url('remove-google-account') }}" class="btn btn-danger btn-sm remove-smtp-acc">Remove This Account</a></h5>
                           
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <table class="table table-bordered table-responsive" style="width: 100%">
                              <tr>
                                 <td>Google Account : </td>
                                 <td>{{ Auth::user()->checkGoogleSMTP()->email }}</td>
                              </tr>

                               <tr>
                                 <td>Token : </td>
                                 <td>{{ Auth::user()->checkGoogleSMTP()->access_token }}</td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     @else
                     <form class="form-horizontal" method="POST" action="{{ route('save_smpt_settings') }}">
                        {{ csrf_field() }}
                        <?php 
                           if(count($errors) > 0){
                               // print_r($errors);die; 
                           }
                           ?>
                        <div class="form-group  {{ $errors->has('driver') ? 'has-error' : ''}}">
                           <label for="driver" class="col-md-12 control-label">driver</label>
                           <div class="col-md-12">
                              <input id="driver" type="text" class="form-control" name="driver" required  value="{{   ($customData) ? $customData->driver : ''  }}">
                              {!! $errors->first('driver', '
                              <p class="help-block">:message</p>
                              ') !!}
                           </div>
                        </div>
                        <div class="form-group  {{ $errors->has('host') ? 'has-error' : ''}}">
                           <label for="host" class="col-md-12 control-label">Host</label>
                           <div class="col-md-12">
                              <input id="host" type="text" class="form-control" name="host" required  value="{{   ($customData) ? $customData->host : ''  }}">
                              {!! $errors->first('host', '
                              <p class="help-block">:message</p>
                              ') !!}
                           </div>
                        </div>
                        <div class="form-group  {{ $errors->has('port') ? 'has-error' : ''}}">
                           <label for="port" class="col-md-12 control-label">Port</label>
                           <div class="col-md-12">
                              <input id="port" type="text" class="form-control" name="port" required  value="{{   ($customData) ? $customData->port : ''  }}">
                              {!! $errors->first('port', '
                              <p class="help-block">:message</p>
                              ') !!}
                           </div>
                        </div>
                        <div class="form-group  {{ $errors->has('pwd') ? 'has-error' : ''}}">
                           <label for="pwd" class="col-md-12 control-label">Pwd</label>
                           <div class="col-md-12">
                              <input id="pwd" type="text" class="form-control" name="pwd" required  value="{{   ($customData) ? $customData->pwd : ''  }}">
                              {!! $errors->first('pwd', '
                              <p class="help-block">:message</p>
                              ') !!}
                           </div>
                        </div>
                        <div class="form-group  {{ $errors->has('fromname') ? 'has-error' : ''}}">
                           <label for="fromname" class="col-md-12 control-label">Fromname</label>
                           <div class="col-md-12">
                              <input id="fromname" type="text" class="form-control" name="fromname" required  value="{{   ($customData) ? $customData->fromname : ''  }}">
                              {!! $errors->first('fromname', '
                              <p class="help-block">:message</p>
                              ') !!}
                           </div>
                        </div>
                        <div class="form-group  {{ $errors->has('username') ? 'has-error' : ''}}">
                           <label for="username" class="col-md-12 control-label">Username</label>
                           <div class="col-md-12">
                              <input id="username" type="text" class="form-control" name="username" required  value="{{   ($customData) ? $customData->username : ''  }}">
                              {!! $errors->first('username', '
                              <p class="help-block">:message</p>
                              ') !!}
                           </div>
                        </div>
                        <div class="form-group  {{ $errors->has('encryption') ? 'has-error' : ''}}">
                           <label for="encryption" class="col-md-12 control-label">Encryption</label>
                           <div class="col-md-12">
                              <input id="encryption" type="text" class="form-control" name="encryption" required  value="{{   ($customData) ? $customData->encryption : ''  }}">
                              {!! $errors->first('encryption', '
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
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</home>
@endsection
@section('customscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script type="text/javascript">
    $(function(){
        $('body').on('click', '.remove-smtp-acc', function(e){
            e.preventDefault();
            if (confirm("Are you sure ?")) {
                var delete_url = $(this).data('href');
                window.location.href = delete_url;
            }
        });
    });
</script>
@endsection