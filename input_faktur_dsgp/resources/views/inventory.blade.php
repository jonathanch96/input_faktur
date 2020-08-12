@extends('master')

@section('content')
<!-- <select class="js-example-basic-single" name="state">
  <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option>
</select> -->

<style type="text/css">
   #firstRow tr:hover{
        background-color: black !important;
    }
    #firstRow tr:hover{
        color: white !important;
    }
</style>
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="post" action="{{url('add_new_item')}}">
            {{ csrf_field() }}
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Input New Item</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
           
                <div class="form-group">
                  <label for="usr">Nama Barang</label>
                  <input type="text" class="form-control" name="item_name">
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
       @if($errors->has('item_name'))
     <div class="alert alert-danger">
         {{ $errors->first('item_name') }}
      </div>
    @endif
<div id="loading-container" style="text-align: center;">
    <button class="btn btn-primary" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      Loading...
    </button>
</div>
<table style="display: none;" data-toggle="table"
        data-height="0"
        data-pagination="true"
        data-pagination-loop="false"
        data-search="true"
        data-striped="true" 
        class="table" id="myTable">
  <thead id="firstRow" class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item Name</th>
      <th scope="col">Tanggal Di Buat</th>
      <th scope="col">Tanggal Di Update</th>
    </tr>
  </thead>
  <tbody>
  

   
  </tbody>
</table>

@endsection

@section('custom_js')
<script type="text/javascript">
    // In your Javascript (external .js resource or <script> tag)
   /* $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });*/


</script>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>
<script type="text/javascript">
    $( document ).ready(function() {
        $("#myTable").show();
        $('.search-input').hide();

        $("#loading-container").hide();
        $(".fixed-table-toolbar").append("<div class='float-left btn-group search'><button style='background-color:#000000;' data-toggle='modal' data-target='#insertModal' class='btn btn-primary'>Add New Data</button></div>");
        $("#myTable").DataTable( {
            "ajax": '{{url("")}}/api/inventory',
            responsive: true,
            processing: true,
            serverSide: true,
            "columns": [
              { "data": "id" },
              { "data": "nama_barang" },
              { "data": "created_at" },
              { "data": "updated_at" },
            ],
           
        } );
    });

</script>


@endsection
