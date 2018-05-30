@extends('main')

@section('content')
<!--BEGIN PAGE WRAPPER-->
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
            <div class="page-title">Data Jabatan</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li><i></i>&nbsp;HRD&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Data Jabatan</li>
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
                    <li class="active"><a href="#alert-tab" data-toggle="tab">Data Jabatan</a></li>
                    <!-- <li><a href="#note-tab" data-toggle="tab">2</a></li>
                    <li><a href="#label-badge-tab" data-toggle="tab">3</a></li> -->
                  </ul>
                  <div id="generalTabContent" class="tab-content responsive">

                    <div id="alert-tab" class="tab-pane fade in active">

                      <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                          <div class="col-md-12 col-sm-12 col-xs-12" align="right" style="margin-bottom: 10px;">

                            <a href="{{ url('hrd/datajabatan/tambah_jabatan') }}" ><button type="button" class="btn btn-box-tool" title="Tambahkan Data Item">
                               <i class="fa fa-plus" aria-hidden="true"/>
                                 &nbsp;</i>Tambah Data</button></a>

                          <div class="table-responsive">
                            <table class="table tabelan table-hover table-bordered"  width="100%" cellspacing="0" id="data">
                              <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan Jabatan</th>
                                    <th>Tunjangan Kehadiran</th>
                                    <th>Tunjangan Makan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                              <tbody>
                                <tr>
                                   <td>00001</td>
                                   <td>DIREKTUR</td>
                                   <td style="text-align: right">Rp 200,000.00</td>
                                   <td style="text-align: right">Rp 40,000.00</td>
                                   <td style="text-align: right">Rp 40,000.00</td>
                                   <td style="text-align: right">Rp 10,000.00</td>
                                   <td class="text-center">
                                       <div class="dropdown">
                                         <a href="{{ url('hrd/datajabatan/edit_jabatan') }}" class="btn btn-warning"> <em class="fa fa-pencil"></em> </a>
                                         <a href="#" class="btn btn-danger" onclick="klik()"> <em class="fa fa-trash-o"></em> </a>
                                       </div>
                                   </td>
                               </tr>


                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /div alert-tab -->

                    <!-- div note-tab -->
                    <div id="note-tab" class="tab-pane fade">
                      <div class="row">
                        <div class="panel-body">
                          <!-- Isi Content -->
                        </div>
                      </div>
                    </div><!--/div note-tab -->

                    <!-- div label-badge-tab -->
                    <div id="label-badge-tab" class="tab-pane fade">
                      <div class="row">
                        <div class="panel-body">
                          <!-- Isi content -->
                        </div>
                      </div>
                    </div><!-- /div label-badge-tab -->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
