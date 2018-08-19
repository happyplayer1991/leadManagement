<?php foreach ($scrollText as $scroll) {} ?>
@if(count($scrollText)>0)
    <marquee behaviour="scroll" direction="left" style="background-color: #4096ec;;color: white;font-weight: bold;height: 35px;
     padding-top: 7px; width: 70%; margin-left: 25%;  border-radius: 25px;">{{$scroll->announcement}}</marquee>
@endif
@extends('layouts.master')
@section('heading')
    Settings
@stop

@section('content')

    <div class="col-md-12">
        <div class="card">

            <div class="card-content">
                <ul class="nav nav-pills nav-pills-primary">
                    <li class="active">
                        <a href="#overallsettings" data-toggle="tab" aria-expanded="true">Overall Settings</a>
                    </li>
                    <li class="">
                        <a href="#manageroles" data-toggle="tab" aria-expanded="false">Manage Roles</a>
                    </li>
                    <li class="">
                        <a href="#products" data-toggle="tab" aria-expanded="false">Products</a>
                    </li>
                    <li class="">
                        <a href="#integrations" data-toggle="tab" aria-expanded="false">Integrations</a>
                    </li>
                    <li class="">
                        <a href="#tax" data-toggle="tab" aria-expanded="false">Tax</a>
                    </li>  
                    @if(Entrust::hasRole('administrator'))
                     <li class="">
                        <a href="#targets" data-toggle="tab" aria-expanded="false">Targets and Pilpeline</a>
                    </li>
                    @endif
                    <li class="">
                        <a href="#currency" data-toggle="tab" aria-expanded="false">Currency</a>
                    </li>
                    <li class="">
                        <a href="#sms" data-toggle="tab" aria-expanded="false">SMS</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="overallsettings">
                            @include('settings.index')
                    </div>
                    <div class="tab-pane " id="manageroles">
                            @include('roles.index')
                    </div>
                    <div class="tab-pane " id="products">
                            @include('product.index')
                    </div>
                    <div class="tab-pane " id="integrations">
                            @include('integrations.index')
                    </div>
                    <div class="tab-pane " id="tax">
                            @include('taxs.index')
                    </div>


<div class="tab-pane " id="targets"> 






                        <div class="card">

                            
                            <div class="content">
                                
                                <div class="body"> 
                                    <form method="post" action="/target">
                                        {{csrf_field()}}






 <?php
    $months = array("January", "February", "March","April","May","June","July","August","September","October","November","December");

    ?>
    @foreach($months as $value)
     
    <div class="form-group" id="targets">
                                        <label class="control-label" style="margin-left:12px;margin-right:220px;margin-top: 1%;font-size:15px ">{{$value}}<font color=""></font></label>
                                        <!-- <input type="number" class="form-control" name="{{$value}}" id="months"  min="0"> -->
                                         <input type="text" class="form-control" name="{{$value}}" id="months" step="any" placeholder="0000" style="margin-left:12px;margin-right:220px;margin-top: 1%;width:900px">
            </div>

    @endforeach
    
    
                                    <!-- <form method="post" action="/store">
                                    <div class="form-group">
                                        <label class="control-label">January<font color=""></font></label>
                                        <input type="number" class="form-control" name="january" id="january" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">February<font color=""></font></label>
                                        <input type="number" class="form-control" name="february" id="february" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">March</label>
                                        <input type="number" class="form-control" name="march" id="march" min="0">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">April<font color=""></font></label>
                                        <input type="number" class="form-control" name="april" id="april" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">May<font color=""></font></label>
                                        <input type="number" class="form-control" name="may" id="may" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">June</label>
                                        <input type="number" class="form-control" name="june" id="june" min="0">
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">July</label>
                                        <input type="number" class="form-control" name="July" id="july" min="0">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">August</label>
                                        <input type="number" class="form-control" name="august" id="august" min="0">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">September</label>
                                        <input type="number" class="form-control" name="september" id="september" min="0">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">October</label>
                                        <input type="number" class="form-control" name="october" id="october" min="0">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">November</label>
                                        <input type="number" class="form-control" name="november" id="november" min="0">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">December</label>
                                        <input type="number" class="form-control" name="december" id="december" min="0">
                                        
                                    </div> -->


                                     <div class="form-group form-button">
                                        <button type="submit" class="btn btn-primary" style="margin-left:12px;margin-right:220px;">Save</button>
                                    </div>
                                    </form>
                                </div>
                        </div>
                    </div> 
                </div>
               




                    
                    <div class="tab-pane " id="currency">
                        <div class="card">
                            <form action="/currency" method="post" id="currency-form">
                            <label class="label-control" style="margin-left: 3%;margin-top: 2%">Currency <font color="red">*</font></label>
                            <div class="card-content">
                                @if(count($c)>0)
                                <div class="col-md-4">
                                @foreach($c as $cu)
                                <input type="text" class="form-control" value="{{$cu->value}}" id="currency" name="currency" readonly="true">
                                </div>
                                @endforeach
                                @else
                                <label class="label-control" style="margin-left: 1%;margin-top: 2%;color: blue;"><font color="blue">*</font>Currency once selected cannot be changed</font></label>
                                <div class="form-group label-floating">
                                <div class="col-md-4">
                                <select class="selectpicker" data-live-search="true" data-style="select-with-transition" data-size="7" name="currency" id="currency">
                                <option ></option>
                                @foreach($currency as $curr)
                                    <option value="{{$curr->currency_code}}({{$curr->symbol}})" data-symbol="{{$curr->symbol}}">{{$curr->currency_code}}({{$curr->symbol}})</option>
                                @endforeach
                                </select>
                                </div>
                                 <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"  name="save" value="save">Save</button>
                            </div>
                            </div>
                            @endif
                            </div>
                            </form>
                            <div>
                            </div>
                        </div>
                        <div class="card-content">
                                    <div class="form-group label-floating">
                                    <!-- <div class="col-md-4"> -->
                                        <label class="label-control"><font>Selected Currency&nbsp;&nbsp;</font></label>
                                        @if(count($c) > 0)
                                        @foreach($c as $cu)
                                        {{$cu->value}}
                                        @endforeach
                                        @else
                                        You haven't Selected Any Currency
                                        @endif
                                    </div>
                                <!-- </div> -->
                                </div>
                    </div>
                    <div class="tab-pane " id="sms">
                        <div class="card">
                            <div class="card-content">
                                <h4>SMS Gateway Details</h4>
                                <form action="/sms" method="post" id="gateway-form">
                                    <textarea type="text" class="form-control" value="" id="smsgate" name="SMS Gateway Details" readonly="true">
                                    </textarea>

                                </form>

                            </div>
                            <div class="pull-right">
                                <input type="submit" value="submit" class="btn btn-primary" >
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop