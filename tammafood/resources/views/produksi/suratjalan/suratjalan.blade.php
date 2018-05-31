@extends('main')
@section('content')
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Pembuatan Surat Jalan</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Produksi&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Pembuatan Surat Jalan</li>
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
                            <li class="active"><a href="#alert-tab" data-toggle="tab">Pembuatan Surat Jalan</a></li>
                            <!-- <li><a href="#penerimaan_transfer" data-toggle="tab">Penerimaan Transfer</a></li> -->
                            <!-- <li><a href="#label-badge-tab" data-toggle="tab">3</a></li> -->
                          </ul>
                          
                          <div id="generalTabContent" class="tab-content responsive">
                              <!-- alert tab -->
                              @include('produksi.suratjalan.tab_suratjalan')
                              <!-- /div alert-tab -->

                              <!-- div penerimaan_transfer -->
                                <div id="penerimaan_transfer" class="tab-pane fade">
                                  <div class="row">
                                    <div class="panel-body">
                                      <!-- Isi content -->we
                                    </div>
                                  </div>
                                </div><!-- /div penerimaan_transfer -->

                                <!-- div label-badge-tab -->
                                <div id="label-badge-tab" class="tab-pane fade">
                                  <div class="row">
                                    <div class="panel-body">
                                      <!-- Isi content -->we
                                    </div>
                                  </div>
                                </div><!-- /div label-badge-tab -->

                          </div>
                    
            </div>
          </div>

@endsection
@section("extra_scripts")

@endsection