@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <form method="GET" action="{{ route('g-send-mail-search') }}">
        <div class="row justify-content-left">
            <div class="col-md-8 font-weight-bold mb-2">
                <i class="fa fa-plus-square"></i>  Filter
            </div>
            <div class="col-md-8 font-weight-bold mb-2" id="filterContent">
                <div class="col-md-8 font-weight-bold mb-2">
                Subject/Customer Name/Email: <input type="text" id="id" name="id" value="{{old('id')}}">
                </div>
                <div class="col-md-8 font-weight-bold mb-2">
                Status: <select id="status" name="status">
                    <option value="all" {{old('status') == 'all' ? "selected":""}}>All</option>
                    <option value="0" {{old('status') == '0' ? "selected":""}}>Sent</option>
                    <option value="2" {{old('status') == '2' ? "selected":""}}>Accepted</option>
                    <option value="3" {{old('status') == '3' ? "selected":""}}>Rejected</option>
                    <option value="1" {{old('status') == '1' ? "selected":""}}>Waiting</option>
                    <option value="4" {{old('status') == '4' ? "selected":""}}>Negotiate</option>
                </select>
                </div>
                <div class="col-md-8 font-weight-bold mb-2">
                Price:
                Min <input type="number" name="price-min" id="price-min" value="{{old('price-min')?old('price-min'):"0"}}" min="0" max="10000">
                Max <input type="number" name="price-max" id="price-max" value="{{old('price-max')?old('price-max'):"10000"}}" min="0" max="10000">
                </div>
                <input type="submit" class="btn btn-xs btn-primary"/>

            </div>
        </div>
        </form>
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


<div class="row cont-bx">
    @if(count($data) > 0)
    @foreach($data as $value)
       <div class="col-sm-4" style="font-size: 14px;line-height: 13px;">
           <div class="box">
              <a href="#"><h2> {{ $value->subject }} </h2> </a>
              <i style="font-size:12px;"><span  class="fa fa-calendar"></span> {{ date('d-m-y', strtotime($value->created_at)) }}</i>
              <h6><span style="font-weight:900; font-size:12px;">{{ $value->customerName . " (" .$value->customerEmail.")" }}</span></h6>
           
              <hr>
              <p> Estimated Weight :  {{ $value->estimatedWeight }} </p> 
              <p> Cost Per Pound :  {{ $value->costPerPound }}</p>
               <p> Total :  {{ $value->total }}
                   @if($value->status==2)
                       &nbsp;&nbsp;Final Amount : {{$value->final_amount}}
                   @endif
               </p>

              <hr>
              <?php $color_arr = [0 => 'blue', 1 => 'yellow', 2 => 'green', 3 => 'red', 4 => 'black']; ?>
              <?php $status_arr = [0 => 'Sent', 1 => 'Waiting', 2 => 'Accepted', 3 => 'Rejected', 4 => 'negotiate']; ?>
              <p>Status  : <b style="color: {{ $color_arr[$value->status] }};">{{ $status_arr[$value->status] }}</b></p>
              <hr>
                          
                <div class="text-center">
                    <a class="btn btn-primary btn-lg btn-block" href="{{ url('g-sent-mail-details/'.$value->id) }}"> <i class="fa fa-eye"></i> View</a>
                </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="col-sm-12">
        <h1 class="text-center">No Mail Found</h1>
    </div>
    @endif
       
</div>
<div class="row">
    <div class="col-sm-12">
        <hr>
        <div class="text-center">
            {!! $data->render() !!}
        </div>
    </div>
    </div>
    </div>
</home>
@endsection
@section('customcss')
<style>
    .cont-bx .box {
        background: #FFF;
        border: 2px solid #bbb7b7;
        padding: 20px 10px;
        box-shadow: 0px 2px 18px 5px #bbb7b7;
        margin-bottom:15px;
    }
    
    .cont-bx .box h2 {
        font-size: 15px;
        color: #80b951;
        font-weight: 700;
    }
    .unread-bordered{
        border : 2px solid #d45a5a !important;
    }
</style>
@endsection

@section('customscripts')
@endsection
