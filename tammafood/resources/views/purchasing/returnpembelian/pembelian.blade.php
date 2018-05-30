@extends('main')
@section('content')
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left" style="font-family: 'Raleway', sans-serif;">
                        <div class="page-title">Return Pembelian</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" style="font-family: 'Raleway', sans-serif;">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ url('/home') }}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li><i></i>&nbsp;Purchasing&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Return Pembelian</li>
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
                              <li class="active"><a href="#alert-tab" data-toggle="tab">Return Pembelian</a></li>
                            <!-- <li><a href="#note-tab" data-toggle="tab">2</a></li>
                            <li><a href="#label-badge-tab-tab" data-toggle="tab">3</a></li> -->
                        </ul>
                        <div id="generalTabContent" class="tab-content responsive" >
                            <div id="alert-tab" class="tab-pane fade in active">
                            <div class="row">
                           <div class="col-lg-12">





    <div class="pull-right" style="margin-bottom: 10px;">
    <a href="{{ url('purchasing/returnpembelian/tambah_pembelian') }}"><button type="button" class="btn btn-box-tool" title="Tambahkan Data Item">
                               <i class="fa fa-plus" aria-hidden="true">
                                   &nbsp;
                               </i>Tambah Data
                            </button></a>
    </div>
          <div class="table-responsive">
            <table class="table tabelan table-hover table-bordered" width="100%" cellspacing="0" id="data">
                          <thead>
                            <tr>
                              <th class="wd-15p">No.</th>
                              <th class="wd-15p">No. Return</th>
                              <th class="wd-15p">Tanggal Return</th>
                              <th class="wd-15p">Jumlah Return</th>
                              <th class="wd-15p">Status</th>
                              <th class="wd-15p">Aksi</th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>1111</td>
                              <td>31/12/2017</td>
                              <td>1</td>
                              <td><span class="badge badge-success">Sampai</span></td>
                             <td class="text-center">
                               <div class="">
                               <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                               <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                              </div>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>1112</td>
                              <td>31/12/2017</td>
                              <td>21</td>
                              <td><span class="badge badge-success">Sampai</span></td>
                             <td class="text-center">
                               <div class="">
                               <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                               <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                              </div>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>1113</td>
                              <td>30/12/2018</td>
                              <td>1</td>
                              <td><span class="badge badge-danger">Belum Sampai</span></td>
                             <td class="text-center">
                              <div class="">
                               <a href="#" class="btn btn-warning btn-sm" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                               <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                              </div>
                              </td>
                            </tr>
                          </tbody>


            </table>
          </div>

                    </div>
                        </div>

                                    </div>
                                         </div>
                            </div>
@endsection