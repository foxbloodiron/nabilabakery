<div class="modal fade" id="edit_stock" role="dialog">
  <div class="modal-dialog" style="width:400px;">
    
      
        <div class="modal-content">
          <div class="modal-header" style="background-color: #e77c38;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: white;">Edit Stock</h4>
          </div>

          <div class="modal-body">

            <input type="hidden" class="i_id" name="i_id" id="i_id">

            <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="margin-bottom: 15px;padding: 15px; ">
              <div class="col-md-4 col-sm-4 col-xs-12">
                <label class="tebal">Nama Item</label>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-group">  
                  <input type="text" class="form-control input-sm i_name" readonly="" name="i_name" id="i_name">
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <label class="tebal">Stock</label>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-group">  
                  <input type="text" class="form-control input-sm s_qty" maxlength="10" name="s_qty" id="s_qty">
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <label class="tebal">Harga Baru</label>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-group">  
                  <input type="number" class="form-control input-sm harga" name="harga" id="harga">
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <label class="tebal">Keterangan</label>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-group">  
                  <textarea type="text" class="form-control ket" name="ket" id="ket"></textarea>
                </div>
              </div>
            </div>
            
          </div>
      
          <div class="modal-footer" style="border-top: none; text-align: center;">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" onclick="updateStock()">Update</button>
          </div>
        </div>
    
  </div>
</div>