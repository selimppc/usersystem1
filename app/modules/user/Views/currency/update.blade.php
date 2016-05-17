@extends('admin::layouts.master')
@section('sidebar')
    @include('admin::layouts.sidebar')
@stop

@section('content')

        <!-- page start-->
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all user in this page<br> and add new user, update, delete from this page</em>"></span>
            </div>

            <div class="panel-body">


                {!! Form::model($currency_old, ['method' => 'PATCH', 'route'=> ['update-currency', $currency_old->id],'id'=>'update']) !!}
                @include('user::currency._form')

                <div class="save-margin-btn">
                    {!! Form::submit('Update Changes', ['id'=>'btn-disabled','class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                    <a href="{{route('view-currency')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Back</a>
                </div>
                {!! Form::close() !!}
                {{--<span class="pull-right">{!! str_replace('/?', '?',  $currency->appends(Input::except('page'))->render() ) !!} </span>--}}
            </div>
        </div>
    </div>
</div>
<!-- page end-->

@stop