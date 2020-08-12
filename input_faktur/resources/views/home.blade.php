@extends('master')

@section('content')

<style type="text/css">
   #firstRow tr:hover{
        background-color: black !important;
    }
    #firstRow tr:hover{
        color: white !important;
    }
</style>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="post" action="{{url('delete_data_pembelian')}}">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" id="pembelian_id" name="pembelian_id">

          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Delete Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
              <p>Do you really want to delete these records? This process cannot be undone.</p>
          </div>
          
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-primary" type="button" data-dismiss="modal"  style="background-color: black;">Cancel</button>

            <button class="btn btn-primary"  style="background-color: red;">Delete</button>
          </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exportModal" role="dialog" aria-labelledby="exportModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="post" action="{{url('export_data')}}">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" id="pembelian_id" name="pembelian_id">

          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Export Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <div class="form-group">
                <label for="item_name">Tahun</label>
                <select  style="width: 435px" class="js-example-basic-single" name="year">
                  <?php for ($i=2015; $i < 2020; $i++) { ?>
                    <option value="{{$i}}">{{$i}}</option>

                  <?php } ?>
                
                </select>
              </div>
              <p>This Process Might take a few minutes, Do you want to continue?</p>
               
          </div>
          

          
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-primary" type="button" data-dismiss="modal"  style="background-color: black;">Cancel</button>

            <button class="btn btn-primary"  style="background-color: red;">Start</button>
          </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="insertModal"  role="dialog" aria-labelledby="insertModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="dataForm" method="post" action="">
            {{ csrf_field() }}
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
               
                 <div class="form-group">
                  <label for="item_name">Nama Barang</label>
                  <select id="nama_barang" style="width: 435px" class="js-example-basic-single" name="nama_barang">
                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="item_name">QTY</label>
                   <input value="{{ old('qty') }}" required type="text" id="qty" name="qty" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="item_name">Mata Uang</label>
                  <select style="width: 435px" class="js-example-basic-single" id="kode_mata_uang" name="kode_mata_uang">
                    <?php foreach ($mata_uang as $key => $mt): ?>
                      <option value="{{$mt->id}}">{{$mt->kode_mata_uang}}</option>
                    <?php endforeach ?>
                  </select>
                </div>
                 <div class="form-group">
                  <label for="item_name">Harga Beli</label>
                   <input value="{{ old('harga_beli') }}" id="harga_beli" required type="text" name="harga_beli" class="form-control" value="">
                </div>
               
                 <div class="form-group">
                  <label for="item_name">Tanggal PIB</label>
                   <input autocomplete="off" style=""  required value="{{ old('tgl_pib') }}"  id="datepicker" name="tgl_pib" />
                </div>
                 <div class="form-group">
                  <label for="item_name">Nomor PIB</label>
                   <input value="{{ old('no_pib') }}" required type="text" id="no_pib" name="no_pib" class="form-control" value="">
                </div>
                

          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-primary"  style="background-color: black;">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div>
    @if (session('status'))
     <div class="alert alert-success">
         {{ session('status') }}
      </div>
    @endif
    @if (session('error'))
     <div class="alert alert-danger">
         {{ session('error') }}
      </div>
    @endif
    @if($errors->has('nama_barang'))
     <div class="alert alert-danger">
         {{ $errors->first('nama_barang') }}
      </div>
    @endif
    @if($errors->has('qty'))
     <div class="alert alert-danger">
         {{ $errors->first('qty') }}
      </div>
    @endif
    @if($errors->has('kode_mata_uang'))
     <div class="alert alert-danger">
         {{ $errors->first('kode_mata_uang') }}
      </div>
    @endif
    @if($errors->has('harga_beli'))
     <div class="alert alert-danger">
         {{ $errors->first('harga_beli') }}
      </div>
    @endif
    @if($errors->has('tgl_pib'))
     <div class="alert alert-danger">
         {{ $errors->first('tgl_pib') }}
      </div>
    @endif
    @if($errors->has('no_pib'))
     <div class="alert alert-danger">
         {{ $errors->first('no_pib') }}
      </div>
    @endif

      
<div id="loading-container" style="text-align: center;">
    <button class="btn btn-primary" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      Loading...
    </button>
</div>
<table style="display: none;" 
      data-toggle="table"
        data-height="0"
        data-pagination="true"
        data-pagination-loop="false"
        data-search="true"
        data-striped="true" 
        class="table" id="myTable">
 <thead id="firstRow" class="black white-text">
    <tr>
      <th scope="col">Tanggal PIB</th>
      <th scope="col">Nomor PIB</th>
      <th scope="col">Item ID</th>
      <th scope="col">Item Name</th>
      <th scope="col">QTY</th>
      <th scope="col">Kode Mata Uang</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
   
  </tbody>
</table>


@endsection

@section('custom_js')

<script type="text/javascript">
  var run = false;
    $( document ).ready(function() {
        $("#myTable").show();
        $("#loading-container").hide();
        if(run==false){
          $(".fixed-table-toolbar").append("<div class='float-left btn-group search'><button style='background-color:#000000;margin-right:10px;' data-toggle='modal' data-target='#insertModal' data-btnsrc='add' data-title='Input New Data Pembelian' data-link='{{url('add_new_data_pembelian')}}' class='btn btn-primary'>Add New Data</button></div><div class='float-left btn-group search'><button style='background-color:#000000;' data-toggle='modal' data-target='#exportModal' class='btn btn-primary'>Export Data</button></div>");
          run=true;
        }
         $('.js-example-basic-single').select2();
         $('#nama_barang').select2({
           ajax: {
            url: "{{url('api/get_item')}}",
            dataType: 'json',
            type: 'GET',
            delay: 250,
            data: function (params) {
                      var query = {
                          search: params.term,
                      }

                      // Query parameters will be ?search=[term]&type=public
                      return query;
            },
          }
        });
         $('#myTable').DataTable( {
            "ajax": '{{url("")}}/api/data_pembelian',
             responsive: true,
            processing: true,
            serverSide: true,
            "columns": [
              { "data": "tgl_pib" },
              { "data": "no_pib" },
              { "data": "item_id" },
              { "data": "item_name" },
              { "data": "qty" },
              { "data": "kode_mata_uang" },
              { "data": "harga_beli" },
              { "data": "action" },
            ]
        } );
         $('#datepicker').datepicker({
            showOtherMonths: true
          }).on('change', function(){
            if($("#datepicker").val()!="" && $("#datepicker2").val()!="" && $("#datepicker").val()!=null && $("#datepicker2").val()!=null){
                  var date_from = $("#datepicker").val().split("/");
              var date_from2 = $("#datepicker2").val().split("/");
                  $("#jumlah").val(workingDaysBetweenDates(date_from[2]+"-"+date_from[0]+"-"+date_from[1],date_from2[2]+"-"+date_from2[0]+"-"+date_from2[1]));
               }
          });
          $('.search-input').hide();
          $("input[type='search']").val("{{old('no_pib')}}").trigger($.Event("keyup", { keyCode: 13 }));
         


          $('#insertModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var link = button.data('link') 
            var title = button.data('title') 
            var btnsrc = button.data('btnsrc')

            var itemid=0;
            var matauang=0;
            var nopib="";
            var qty="";
            var tglpib="";
            var harga_beli="";

            var modal = $(this)
             if(btnsrc=='edit'){
              var itemid = button.data('itemid')
              var matauang = button.data('matauang')
              var nopib = button.data('nopib')
              var qty = button.data('qty')
              var tglpib = button.data('tglpib')
              var harga_beli = button.data('hargabeli')
              // 
              // Fetch the preselected item, and add to the control
              var namaBarang = $('#nama_barang');
              $.ajax({
                  type: 'GET',
                  url: "{{url('api/get_item')}}/" + itemid
              }).then(function (data) {
                  // create the option and append to Select2
                  var obj = JSON.parse(data);
                  var option = new Option(obj.text, obj.id, true, true);
                  namaBarang.append(option).trigger('change');
                  // manually trigger the `select2:select` event
                  namaBarang.trigger({
                      type: 'select2:select',
                      params: {
                          data: data
                      }
                  });
              });

              // 
              modal.find('.modal-body #qty').val(qty)
              modal.find('.modal-body #kode_mata_uang').val(matauang).change()
              modal.find('.modal-body #harga_beli').val(harga_beli)
              modal.find('.modal-body #no_pib').val(nopib)
              modal.find('.modal-body #datepicker').val(tglpib)

            }else{
              modal.find('.modal-body #nama_barang').val("{{ old('nama_barang') }}").change()
              modal.find('.modal-body #qty').val("{{ old('qty') }}")
              modal.find('.modal-body #kode_mata_uang').val("{{ old('kode_mata_uang') }}").change()
              modal.find('.modal-body #harga_beli').val("{{ old('harga_beli') }}")
              modal.find('.modal-body #no_pib').val("{{ old('no_pib') }}")
              modal.find('.modal-body #datepicker').val("{{ old('tgl_pib') }}")

            }
            
           
            modal.find('.modal-header .modal-title').text(title)
            modal.find('#dataForm').attr('action',link)
        });
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var pembelian_id = button.data('id') 
            $('#pembelian_id').val(pembelian_id)

            var modal = $(this)

        });

    });
   
    function redirectExportData(){
      location.href = "{{url('export_data')}}"
    }


</script>

@endsection
