                              <div class="modal-body">
                                
                                <div class="col-md-12 col-sm-12 col-xs-12 tamma-bg" style="margin-bottom: 20px; padding-bottom:15px;padding-top:15px; ">

                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td>Proses</td>
                                        <td>
                                          <input type="text" name="totalAmount" readonly="true" id="totalPayment" 
                                          class="form-control total" style="text-align: right;" value="0">
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table class="table" id="tablePayment">
                                    <tbody class="mc">
                                      <tr>
                                        <td>
                                            <select name="sp_method[]" class="form-control getPayment">
                                              <?php $__currentLoopData = $dataPayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option class="<?php echo e($data->pm_name); ?>" value="<?php echo e($data->pm_id); ?>"><?php echo e($data->pm_name); ?></option>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                        </td>
                                        <td>
                                          <input type="text" name="sp_nominal[]" id="bayar" value="" class="i_price form-control total bandingPayment totPayment" onkeyup="updateKembalian()" style="text-align: right;" onkeyup="rege(event,'i_price');" onblur="setRupiah(event,'i_price')" onclick="setAwal('event','i_price')" onkeydown="warna()">
                                        </td>
                                        <td>
                                         <button type="button" class="btn btn-info" onclick="tambahPayment()"><i class="glyphicon glyphicon-plus"></i></button> <button type="button" class="btn btn-danger hapus" disabled ><i class="glyphicon glyphicon-minus"></i></button>
                                        </td>
                                      </tr>
                                      </tbody>
                                  </table>
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td>Total Pembayaran</td>
                                        <td>
                                          <input type="text" readonly="true" class="form-control" id="totPembayaran" style="text-align: right;" 
                                          value="0">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>Kembalian</td>
                                        <td>
                                          <input type="text" name="s_kembalian" value="0" id="kembalian" readonly="true" class="form-control kembalianFinal" style="text-align: right;" onkeyup="tetepNul()">
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div> 
<script>
//   function tetepNul(){
//     // alert('d');
// if ($('.kembalianFinal').val().length <= 10000) {
//   $('.kembalianFinal').css('color','red');
// }
// } 
</script>                     