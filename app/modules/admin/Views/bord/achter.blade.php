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
                <span class="panel-title">{{ $pageTitle }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all user in this page<br> and add new department, update, delete from this page</em>"></span>
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'store-achtergrond', 'id' => 'achter']) !!}
                <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('shoort_bord', 'SOORT BORD', ['class' => 'control-label']) !!}
                            {!! Form::Select('shoort_bord',array('banner'=>'Banner','banner_met_grip'=>'Banner Met Grip','acm_mm'=>'ACM (Maxmetal)','acm_mmhd'=>'ACM (Maxmetal HD) '),@Input::get('shoort_bord')? Input::get('shoort_bord') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('lengte_bord', 'LENGTE BORD', ['class' => 'control-label']) !!}
                            {!! Form::input('lengte_bord','lengte_bord',@Input::get('lengte_bord')? Input::get('lengte_bord') : null,['class' => 'form-control','placeholder'=>'Enter lengte bord (numbers only)','required','title'=>'Enter lengte bord']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('breedte_bord', 'BREEDTE BORD', ['class' => 'control-label']) !!}
                            {!! Form::input('breedte_bord','breedte_bord',@Input::get('breedte_bord')? Input::get('breedte_bord') : null,['class' => 'form-control','placeholder'=>'Enter breedte bord (numbers only)','required','title'=>'Enter breedte bord']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('acm_spuiten', 'ACM Spuiten ?', ['class' => 'control-label']) !!}
                            {!! Form::Select('acm_spuiten',array('ja'=>'Ja','nee'=>'Nee'),@Input::get('acm_spuiten')? Input::get('acm_spuiten') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                </div>

                {{-------------Installation-----------------------------------------------------------------------------}}
                <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t" id="installation" style="display: none">
                    <p>&nbsp;</p>
                    <div class="panel-heading">
                        <span class="panel-title" style="margin-left: -13px;">Installation</span>&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all user in this page<br> and add new department, update, delete from this page</em>"></span>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('location', 'LOCATIE', ['class' => 'control-label']) !!}
                            {!! Form::Select('location',isset($inst_list['locatie_list'])?$inst_list['locatie_list']:'',@Input::get('location')? Input::get('location') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('background', 'ACHTERGROND', ['class' => 'control-label']) !!}
                            {!! Form::Select('background',isset($inst_list['achtergrond_list'])?$inst_list['achtergrond_list']:'',@Input::get('background')? Input::get('background') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::label('workheight', 'WERKHOOGTE', ['class' => 'control-label']) !!}
                            {!! Form::Select('workheight',isset($inst_list['werkhoogte_list'])?$inst_list['werkhoogte_list']:'',@Input::get('workheight')? Input::get('workheight') : null,['class'=>'form-control ','required']) !!}
                        </div>
                    </div>
                </div>

                {{--<input type="checkbox" name="myCheck" id="myCheck" onclick="check();" checked="" value="true">--}}
                @if(isset($check_value))
                    {!!  Form::checkbox('myCheck', 1, true) !!}
                @else
                    {!!  Form::checkbox('myCheck', 0, false) !!}
                @endif
                <strong>Installatie?</strong>

                <div class="form-margin-btn" style="margin-left:92%">
                    {!! Form::submit('Bereken', ['class' => 'btn btn-info','data-placement'=>'top']) !!}&nbsp;
                    {{--<a href="{{route('bord')}}" class="pull-right btn btn-info" data-placement="top" data-content="click close button for close this entry form">Bereken</a>--}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@if(isset($data))
    <div class="row">
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"><h4 class="text-center">Material List</h4></span>
                </div>
                <div class="panel-body">
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <thead>
                            <th>Materiaal</th>
                            <th>Aantal</th>
                            <th>Eenheid</th>
                            </thead>
                            <tbody>
                            @if(isset($data['materiaal_list_details']))
                                @foreach($data['materiaal_list_details'] as $materiaal)
                                    <tr class="gradeX">
                                        <td>{{$materiaal['label']}}</td>
                                        <td>{{$materiaal['aantal']}}</td>
                                        <td>{{$materiaal['eenheid']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"><h5 class="text-center">3D CHANNEL LETTERS</h5></span>
                </div>
                <div class="panel-body">
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <tr>
                                <th>Price</th>
                                <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['srd']['price'])?number_format($data['materiaal_amount']['srd']['price'], 2, '.', ''):''}}
                                </td>
                                <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['usd']['price'])?number_format($data['materiaal_amount']['usd']['price'], 2, '.', ''):''}}
                                </td>
                                <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['euro']['price'])?number_format($data['materiaal_amount']['euro']['price'], 2, '.', ''):''}}
                                </td>
                            </tr>
                            <tr>
                                <th>Tax (10.0%)</th>
                                <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['srd']['tax'])?number_format($data['materiaal_amount']['srd']['tax'], 2, '.', ''):''}}
                                </td>
                                <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['usd']['tax'])?number_format($data['materiaal_amount']['usd']['tax'], 2, '.', ''):''}}
                                </td>
                                <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['euro']['tax'])?number_format($data['materiaal_amount']['euro']['tax'], 2, '.', ''):''}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['srd']['subtotal'])?number_format($data['materiaal_amount']['srd']['subtotal'], 2, '.', ''):''}}
                                </td>
                                <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['usd']['subtotal'])?number_format($data['materiaal_amount']['usd']['subtotal'], 2, '.', ''):''}}
                                </td>
                                <td>$&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{isset($data['materiaal_amount']['euro']['subtotal'])?number_format($data['materiaal_amount']['euro']['subtotal'], 2, '.', ''):''}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!---------------------Installation----------------------------------->
        @if(isset($data['installment_amount']))
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><h5 class="text-center">INSTALLATION</h5></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-primary">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <tr>
                                    <th>Price</th>
                                    <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['srd']['price'])?number_format($data['installment_amount']['srd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['usd']['price'])?number_format($data['installment_amount']['usd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['euro']['price'])?number_format($data['installment_amount']['euro']['price'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tax (8.0%)</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['srd']['tax'])?number_format($data['installment_amount']['srd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['usd']['tax'])?number_format($data['installment_amount']['usd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['euro']['tax'])?number_format($data['installment_amount']['euro']['tax'], 2, '.', ''):''}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['srd']['subtotal'])?number_format($data['installment_amount']['srd']['subtotal'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['usd']['subtotal'])?number_format($data['installment_amount']['usd']['subtotal'], 2, '.', ''):''}}
                                    </td>
                                    <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['installment_amount']['euro']['subtotal'])?number_format($data['installment_amount']['euro']['subtotal'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><h5 class="text-center">TOTAAL</h5></span>
                    </div>
                    <div class="panel-body">
                        <div class="table-primary">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <tr>
                                    <th>Price</th>
                                    <td>SRD &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['srd']['price'])?number_format($data['final_amount']['srd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['usd']['price'])?number_format($data['final_amount']['usd']['price'], 2, '.', ''):''}}
                                    </td>
                                    <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['euro']['price'])?number_format($data['final_amount']['euro']['price'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tax (10.0%)</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['srd']['tax'])?number_format($data['final_amount']['srd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['usd']['tax'])?number_format($data['final_amount']['usd']['tax'], 2, '.', ''):''}}
                                    </td>
                                    <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['euro']['tax'])?number_format($data['final_amount']['euro']['tax'], 2, '.', ''):''}}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>SRD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['srd']['total'])?number_format($data['final_amount']['srd']['total'], 2, '.', ''):''}}
                                    </td>
                                    <td>$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['usd']['total'])?number_format($data['final_amount']['usd']['total'], 2, '.', ''):''}}
                                    </td>
                                    <td>&euro; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        {{isset($data['final_amount']['euro']['total'])?number_format($data['final_amount']['euro']['total'], 2, '.', ''):''}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    {{----------------------Total------------------------}}
    @endif

<!-- page end-->

<script src="assets/bitd/js/jquery.min.js"></script>
<!--script for this page only-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });

    </script>
@endif




<script>

    //document.onload = function() {
    $(function () {
        $("#achter").validate({
            rules: {
                name: {
                    required: true,
                },
                password: {
                    required: true,
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                max: {
                    required: true,
                    maxlength: 4
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $("#achter").validate({
            rules: {
                name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                last_name: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                number: {
                    required: "(Please enter your phone number)",
                    number: "(Please enter valid phone number)"
                },
                last_name: {
                    required: "This is custom message for required",
                    minlength: "This is custom message for min length"
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
            errorPlacement: function (error, element) {
                $(element)
                        .closest("form")
                        .find("label[for='" + element.attr("id") + "']")
                        .append(error);
            },
            errorElement: "span",
        });
    });
    //}
</script>

<script>
    window.onload = function() {
        $("input:checkbox").change(function () {
            var ischecked = $(this).is(':checked');
            if (!ischecked) {
                $('#installation').hide();
            } else {
                $('#installation').show();
            }
        });

        var ischecked = $("input:checkbox").val();
        if (ischecked == 0) {
            $('#installation').hide();
        } else {
            $('#installation').show();
        }
    }



</script>

@stop