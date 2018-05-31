<div class="modal fade in" id="tambah" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Transfer Item</h4>
      </div>
    <div class="modal-body">
        <form action="get" id="save_request">
                <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:5px;padding-top:20px; ">

                    <div class="col-md-4 col-sm-3 col-xs-12"> 
                  
                      <label class="tebal">No Transfer</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                            <input id="no-nota" readonly="true" name="ri_nomor" class="form-control input-sm" type="text">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                          <label class="tebal" name="admin">Admin</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-user"></i>
                          <input id="" readonly="true" name="admin" class="form-control input-sm" value="{{Auth::user()->m_name}}" type="text"> 
                          <input id="" readonly="true" name="ri_admin" class="form-control input-sm" value="1" type="hidden">      
                        </div>                           
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                          <label class="tebal">Tanggal</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-envelope"></i>
                          <input readonly="true" name="ri_tanggal" class="form-control input-sm" value="30-05-2018" type="text">
                        </div>                                
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-12">
                      
                          <label class="tebal">Ket</label>
                      
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="glyphicon glyphicon-envelope"></i>
                          <input id="" name="ri_keterangan" class="form-control input-sm" type="text">
                        </div>                                
                      </div>
                    </div>
                </div>
            <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:20px;padding-top:20px; ">
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   <label class="control-label tebal">Masukan Kode / Nama</label>
                      <div class="input-group input-group-sm" style="width: 100%;">
                          <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><input id="rnamaitem" name="rnamaitem" class="form-control ui-autocomplete-input" autocomplete="off" type="text">
                          <input id="rkode" name="rsd_item" class="form-control" type="hidden">
                          <input id="code" class="form-control" type="hidden">                                      
                          <input id="rdetailnama" name="rnama" class="form-control" type="hidden">                                     
                          
                      </div>
                  </div>        
                  <div class="col-md-6 col-sm-6 col-xs-12">
                   <label class="control-label tebal">Masukan Jumlah</label>
                      <div class="input-group input-group-sm" style="width: 100%;">
                         <input id="rqty" name="rqty" class="form-control" type="number">
                      </div>
                  </div>
            </div> 
          </form>
            <div class="table-responsive">
              <table class="table tabelan table-hover table-bordered data-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama Item</th>
                    <th>Jumlah</th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="button" onclick="simpanTransfer()">Simpan</button> 
      </div>
  </div>
    
  </div>
</div>