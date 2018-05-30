@extends('main')
@section('content')
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Stock Opname</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Inventory&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Stock Opname</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="page-content fadeInRight">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-12">

                                <div class="col-md-12">
                                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                    </div>
                                </div>

                                <ul id="generalTab" class="nav nav-tabs">
                                  <li class="active"><a href="#alert-tab" data-toggle="tab">Daftar Stock Opname</a></li>
                                  <li><a href="#note-tab" data-toggle="tab">History Stock Opname</a></li>
                                 <!--  <li><a href="#label-badge-tab" data-toggle="tab">Belanja Harian</a></li> -->
                                </ul>

                                <div id="generalTabContent" class="tab-content responsive">

                                  <!-- Div #alert-tab -->
                                  @include('inventory.stockopname.daftar')
                                  <!-- End Div #alert-tab -->

                                  <!-- Div #note-tab -->
                                  @include('inventory.stockopname.history')
                                  <!-- End Div #note-tab -->

                                  <!-- Div #label-badge-tab -->
                                  <div id="label-badge-tab" class="tab-pane fade">
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!-- Isi Content -->
                                      </div>
                                    </div>
                                  </div>
                                  <!-- End Div #label-badge-tab -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

@endsection
