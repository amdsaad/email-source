@extends('spark::layouts.app')



@section('content')

<home :user="user" inline-template>

    <div class="container">

        <!-- Application Dashboard -->

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="panel panel-default">

                    <!-- <div class="panel-heading">Dashboard</div> -->

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



                        <!-- You are logged in! -->

                    </div>

                </div>

            </div>

        </div>







{{--         Form for email--}}



<div class="row justify-content-center">

    <!-- <div class="col-md-12">

     <div class="panel-heading">

            <h4>Mail</h4>

        </div>

    </div> -->

    <div class="col-md-8" style="background: white;border: 1px solid #dddd;">

       <!-- 

        <div class="panel-heading">

            <h4>Mail</h4>

        </div> -->

        <div id="#aapp" class="panel-body " style="padding: 50px 80px;">

            <form class="form-horizontal" method="GET" action="{{ route('send_ticket_mail') }}">

                {{ csrf_field() }}

                <?php 

                    if(count($errors) > 0){

                        // print_r($errors);die; 

                    }

                ?>



                <!-- <div class="form-group">

                    <label for="leadsProInfo" class="col-md-4 control-label" >Leads Pro Info</label>

                    <div class="col-md-6">

                        <textarea style="width: 540px; height: 400px;"id="leadsProInfo" type="text" class="form-control" name="leadsProInfo" v-on:input="populateForm($event.target.value)" required autofocus></textarea>

                    </div>

                </div> -->

                <div class="form-group  {{ $errors->has('subject') ? 'has-error' : ''}}">

                    <label for="subject" class="col-md-12 control-label">Subject</label>

                    <div class="col-md-12">

                        <input id="subject" type="text" class="form-control" name="subject" required value="{{ (old('subject')) ? old('subject') : 'Quote For Your Upcoming Move' }}">

                        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>



                <div class="form-group  {{ $errors->has('employeeName') ? 'has-error' : ''}}">

                    <label for="employeeName" class="col-md-12 control-label">Employee Name</label>

                    <div class="col-md-12">

                        <input id="employeeName" type="text" class="form-control" name="employeeName" required autofocus value="{{  old('employeeName') }}">

                        {!! $errors->first('employeeName', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>



                <div class="form-group  {{ $errors->has('customerName') ? 'has-error' : ''}}">

                    <label for="customerName" class="col-md-12 control-label">Customer Name</label>

                    <div class="col-md-12">

                        <input id="customerName" type="text" class="form-control" name="customerName" value="{{  old('customerName') }}" required>

                        {!! $errors->first('customerName', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>

                <div class="form-group  {{ $errors->has('customerEmail') ? 'has-error' : ''}}">

                    <label for="customerEmail" class="col-md-12 control-label">Customer Email</label>

                    <div class="col-md-12">

                        <input id="customerEmail" type="email" class="form-control" name="customerEmail" value="{{  old('customerEmail') }}" required>

                        {!! $errors->first('customerEmail', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>

                <div class="form-group  {{ $errors->has('customerPhone') ? 'has-error' : ''}}">

                    <label for="customerPhone" class="col-md-12 control-label">Customer Phone Number</label>

                    <div class="col-md-12">

                        <input id="customerPhone" type="text" class="form-control" name="customerPhone" value="{{  old('customerPhone') }}" required>

                        {!! $errors->first('customerPhone', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>								

                <div class="form-group  {{ $errors->has('estimatedWeight') ? 'has-error' : ''}}">

                    <label for="estimatedWeight" class="col-md-12 control-label">Estimated Weight</label>

                    <div class="col-md-12">

                        <input id="estimatedWeight" type="number" class="form-control" name="estimatedWeight" value="{{  old('estimatedWeight') }}" required >

                        {!! $errors->first('estimatedWeight', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>

                <div class="form-group  {{ $errors->has('costPerPound') ? 'has-error' : ''}}">

                    <label for="costPerPound" class="col-md-12 control-label">Cost Per Pound</label>

                    <div class="col-md-12">

                        <input id="costPerPound" type="decimal" class="form-control" name="costPerPound"  value="{{  old('costPerPound') }}" required >

                        {!! $errors->first('costPerPound', '<p class="help-block">:message</p>') !!}

                    </div>

                </div>
                @if(count($extra_fields) > 0)
                @foreach($extra_fields as $key => $field)
                <div class="form-group">
                    <label class="col-md-12 control-label" for="{{ $field->field_name }}">{{ $field->field_name }}</label>

					@if($field->field1_type != 'null')
                    <div class="col-md-12 ">
                        @if($field->field1_type == 'radio')
                              <label><input type="radio" check
                               name="extra[value1][{{ $key }}]" value="yes">Yes</label>
                               <label><input type="radio"  check
                               name="extra[value1][{{ $key }}]" value="no">No</label>
                        @else
							@if($field->field_name == 'Scale Fee')
							<input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" value="Standard">								
								
							@elseif($field->field_name == 'Storage')
							<input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]" value="Included">		
							
							@else
							<input type="{{ $field->field1_type }}" class="form-control" required="" name="extra[value1][{{ $key }}]">		
								
							@endif							
                        @endif
					</div>
					@endif

					<br/>
                    <div class="col-md-12 ">
                        @if($field->field_type == 'radio')
                              <label><input type="radio" check
                               name="extra[value][{{ $key }}]" value="yes">Yes</label>
                               <label><input type="radio"  check
                               name="extra[value][{{ $key }}]" value="no">No</label>
                        @else
							@if($field->field_name == 'Scale Fee')
								<input type="{{ $field->field_type }}" class="form-control" required="" name="extra[value][{{ $key }}]" value="50.00">
								
							@else
								<input type="{{ $field->field_type }}" class="form-control" required="" name="extra[value][{{ $key }}]">
								
							@endif							
                        @endif
                        <input type="hidden" class="form-control" required="" name="extra[key][{{ $key }}]" value="{{ $field->field_name }}">
                        <input type="hidden" class="form-control" required="" name="extra[type][{{ $key }}]" value="{{ $field->field_type }}">
                        <input type="hidden" class="form-control" required="" name="extra[type1][{{ $key }}]" value="{{ $field->field1_type }}">
					</div>
					
					
                </div>
                @endforeach
                @endif

                <div class="form-group  {{ $errors->has('movingdate') ? 'has-error' : ''}}">

                    <label for="movingdate1" class="col-md-12 control-label">Possible Moving Date</label>

                    <div class="col-md-12">

                        <input id="movingdate1" type="text" class="form-control" name="movingdate1" required value="{{ (old('movingdate1')) ? old('movingdate1') : '' }}">

                        {!! $errors->first('movingdate1', '<p class="help-block">:message</p>') !!}

                    </div>
                    <br/>
                    <div class="col-md-12">

                        <input id="movingdate2" type="text" class="form-control" name="movingdate2" required value="{{ (old('movingdate2')) ? old('movingdate2') : 'N.A.' }}">

                        {!! $errors->first('movingdate2', '<p class="help-block">:message</p>') !!}

                    </div>					
					
                </div>

                <div class="form-group  {{ $errors->has('leadInfo') ? 'has-error' : ''}}">

                    <label for="leadInfo" class="col-md-12 control-label">Lead Info</label>

                    <div class="col-md-12">

						<textarea rows = "5" cols = "60" name = "leadInfo" id="leadInfo" class="form-control">
							{{ (old('leadInfo')) ? old('leadInfo') : '' }}
						 </textarea>

                        {!! $errors->first('leadInfo', '<p class="help-block">:message</p>') !!}

                    </div>
					
                </div>


                <div class="form-group">

                    <div class="col-md-12">

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

    </div>

</home>

@endsection

@section('customscripts')

<script>

    window.addEventListener('load', function () {

        new Vue({

            el: '#aapp',

            data: {

                leadsInfo: '',

                lead: '',

                array: '',

                arry: '',



                movingInfo: {

                    leadId: '',

                    cName: '',

                    pNumber: '',

                    email: '',

                    movingFromCountry: '',

                    movingFromState: '',

                    movingFromCity: '',

                    movingFromZip: '',

                    movingToCountry: '',

                    movingToState: '',

                    movingToCity: '',

                    movingToZip: '',

                    moveDate: '',

                    moveSize: '',

                    storageDuration: '',

                    carTransport: '',

                    vehicleYear: '',

                    vehicleMake: '',

                    vehicleModel:''

                },

            },

            methods: 

            {

                    populateForm: function(pass) 

                    {

                        arry = pass.split('\n');

                        



                        this.movingInfo.cName = this.parseLeads(arry[1]);

                        this.movingInfo.email = this.parseLeads(arry[3]);

                        this.movingInfo.movingFromCity = this.parseLeads(arry[7]);

                        this.movingInfo.movingToCity = this.parseLeads(arry[12]);

                       

                    },

                    parseLeads: function(a) {



                        var b = a.split(':'); 

                        var c = b[1];



                        return c; 

                    }



                    





            }

        });

    });

</script>

@endsection

