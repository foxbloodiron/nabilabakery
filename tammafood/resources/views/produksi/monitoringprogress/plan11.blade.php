
              <div class="row" style="padding-left: 30px; padding-bottom: 10px">
                
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <label class="tebal">Tanggal</label>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="form-group" style="display: ">
                    <div class="input-daterange input-group">
                      <input id="tanggal1" class="form-control input-sm datepicker2 " name="tanggal" type="text" value="{{ date('d-m-Y') }}">
                      <span class="input-group-addon">-</span>
                      <input id="tanggal2" class="input-sm form-control datepicker2" name="tanggal" type="text" value="{{ date('d-m-Y') }}">
                    </div>
                  </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-3 row">
                  <button class="btn btn-primary btn-sm btn-flat fa fa-search" type="button" onclick="cariTanggal({{ count($plan) > 0 ? $plan[0]->pp_item : 0}})">
                  </button>
                  <button class="btn btn-info btn-sm btn-flat fa fa-undo" type="button" onclick="refresh({{ count($plan) > 0 ? $plan[0]->pp_item : 0 }})">
                  </button>
                </div>
                  
              </div>
              
              <div class="row">
                <h4 id="judul-plan" style="padding-bottom: 5px">Tes</h4>
                <button type="button" class="btn btn-info pull-right" onclick="tambahPlan()" style="margin-bottom: 5px; margin-right: 10px"><i class="glyphicon glyphicon-plus"></i></button>
              </div>
                
              <div class="table-responsive">
                <table class="table tabelan table-bordered table-hover" id="tablePlan">
                  <thead>
                    <th style="width:20%;">Tanggal</th>
                    <th>Jumlah Rencana Produksi</th>
                    <th style="width:20%;">Status SPK</th>
                    <th style="width:13%; text-align: center;">Aksi</th>
                  </thead>
                  <tbody>

                    <?php $x=0; ?>
                    
                    @foreach($plan as $pn)     
                    <tr>
                      <input type="hidden" name="pp_item" value="{{ $pn->pp_item }}">
                      <input type="hidden" name="pp_id" value="{{ $pn->pp_id }}">
                      @if($pn->pp_isspk == 'N')
                      <?php echo $x;$x++; ?>
                      <td> 
                        <input id="tanggal1" class="form-control datepicker3" name="tanggal" type="text" value="{{ date('d-m-Y', strtotime($pn->pp_date)) }}">
                      </td>
                      <td>
                        <input name="pp_qty" type="number" class="form-control" style="text-align:right;"
                        value="{{ $pn->pp_qty }}">
                      </td>
                      <td>
                        <i class="fa fa-times"></i>  Rencana
                      </td>
                      <td>
                        <!--   -->
                        <button type="button" class="btn btn-danger hapus" onclick="hapusPlan(this)"><i class="glyphicon glyphicon-minus"></i></button>
                      </td>
                      @endif
                      
                      @if($pn->pp_isspk == 'Y')
                      <td> 
                        <input id="tanggal1" class="form-control datepicker3" name="tanggal" type="text" value="{{ date('d-m-Y', strtotime($pn->pp_date)) }}" readonly="">
                      </td>
                      <td>
                        <input name="pp_qty" type="number" class="form-control" style="text-align:right;"
                        value="{{ $pn->pp_qty }}" readonly="">
                      </td>
                      <td>
                        <i class="fa fa-check"></i>  SPK
                      </td>
                      <td>
                       <!--  <button type="button" class="btn btn-info" onclick="tambahPlan()"><i class="glyphicon glyphicon-plus"></i></button>  -->
                      </td>
                      @endif
                      
                      @if($pn->pp_isspk == 'P')
                      <td> 
                        <input id="tanggal1" class="form-control datepicker3" name="tanggal" type="text" value="{{ date('d-m-Y', strtotime($pn->pp_date)) }}" readonly="">
                      </td>
                      <td>
                        <input name="pp_qty" type="number" class="form-control" style="text-align:right;"
                        value="{{ $pn->pp_qty }}" readonly="">
                      </td>
                      <td>
                        <i class="fa fa-check"></i>  Produksi
                      </td>
                      <td>
                        <button type="button" class="btn btn-info" onclick="tambahPlan()"><i class="glyphicon glyphicon-plus"></i></button> 
                      </td>
                      @endif
                      

                    </tr>
                    @endforeach
                    <input type="hidden" name="rowPlan" id="rowPlan" value="{{$x}}">
                     
                 </tbody>
                </table>
              </div>

              <div style="border-top: 1px solid #444;">
                <table  style="margin-top: 15px" class="tebal">
                  <tr style="margin-top: 10px">
                    <td width="100px">Produksi</td>
                    <td style="text-align: right">{{ $spk['P'] }}</td>
                  </tr>
                  <tr style="margin-top: 10px">
                    <td>SPK</td>
                    <td style="text-align: right">{{ $spk['Y'] }}</td>
                  </tr>
                  <tr style="margin-top: 10px">
                    <td>Rencana</td>
                    <td style="text-align: right">{{ $spk['N'] }}</td>
                  </tr>
                  <tr style="border-top: 1px solid #444; margin-top: 10px">
                    <td>Total</td>
                    <td style="text-align: right">{{ $spk['P'] + $spk['N'] + $spk['Y'] }}</td>
                  </tr>
                </table>
              </div>


<script type="text/javascript">

    tablePlan=$('#tablePlan').DataTable();
                          
    $('.datepicker2').datepicker({
        format:"dd-mm-yyyy"
      });    

    $('.datepicker2').on('changeDate', function(ev){
      $(this).datepicker('hide');
    });

function tambahPlan() {         
  var Hapus = '<button type="button" class="btn btn-danger hapus" onclick="hapusPlan(this)"><i class="glyphicon glyphicon-minus"></i></button>';
  var x=$("#rowPlan").val();
  console.log(x);
  


      tablePlan.row.add([
        '<input type="text" name="tanggal" class="form-control datepicker3" value="{{ date('d-m-Y') }}">',
        '<input type="number" name="pp_qty'+x+'" class="form-control" style="text-align:right;">',
        '<i class="fa fa-times"></i>  Rencana',
        Hapus
        ]);
      tablePlan.draw();
  x++;
  $("#rowPlan").val(x);
  console.log(x);
    $('.datepicker3').datepicker({
      autoclose: true,
      format:"dd-mm-yyyy",
      endDate: 'today',
      defaultDate: new Date()
      });
    
  }

function hapusPlan(a){
  var par = a.parentNode.parentNode;
  tablePlan.row(par).remove().draw(false);
   }

</script>