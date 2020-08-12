<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.black{
			background-color: black;
		}
		.white-text{
			color: white;
		}
		
		.active{
			font-weight: 700;
		}
		#myInput {
		  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
		  background-position: 10px 12px; /* Position the search icon */
		  background-repeat: no-repeat; /* Do not repeat the icon image */
		  width: 100%; /* Full-width */
		  font-size: 16px; /* Increase font-size */
		  padding: 12px 20px 12px 40px; /* Add some padding */
		  border: 1px solid #ddd; /* Add a grey border */
		  margin-bottom: 12px; /* Add some space below the input */
		}

		#myTable {
		  border-collapse: collapse; /* Collapse borders */
		  width: 100%; /* Full-width */
		  border: 1px solid #ddd; /* Add a grey border */
		  font-size: 18px; /* Increase font-size */
		}

		#myTable th, #myTable td {
		  text-align: left; /* Left-align text */
		  padding: 12px; /* Add padding */
		}

		#myTable tr {
		  /* Add a bottom border to all table rows */
		  border-bottom: 1px solid #ddd;
		}

		#myTable tr.header, #myTable tr:hover {
		  /* Add a grey background color to the table header and on hover */
		  background-color: #f1f1f1;
		}
	</style>


	
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.css')}}">
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/gijgo.min.js')}}" type="text/javascript"></script>
	<link href="{{asset('css/gijgo.min.css')}}" rel="stylesheet" type="text/css" />

	<script src="{{asset('js/jquery.form.js')}}"></script> 
	<script type="text/javascript" src="{{asset('js/date_format.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
	  
	<script type="text/javascript" charset="utf8" src="{{asset('js/jquery.dataTables.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/datetime-moment.js')}}"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{asset('css/bootstrap-table.min.css')}}">

	<!-- Latest compiled and minified JavaScript -->
	<script src="{{asset('js/bootstrap-table.min.js')}}"></script>
	<!-- Latest compiled and minified Locales -->
	<script src="{{asset('js/bootstrap-table-id-ID.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap2.min.js')}}"  crossorigin="anonymous"></script>
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
	<script src="{{asset('js/select2.min.js')}}"></script>
	<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script src="http://malsup.github.com/jquery.form.js"></script> 
    @yield('custom_js')

</head>
<body style="">
	<div style="padding: 100px;">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">GCP</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item {{(\Request::route()->getName()=='home'||\Request::route()->getName()=='')?'active':''}}">
		        <a class="nav-link " href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item {{\Request::route()->getName()=='inventory'?'active':''}}">
		        <a class="nav-link " href="{{url('inventory')}}">Inventory</a>
		      </li>
		      
		      
		    </ul>
		  </div>
		</nav>
		<div >
			@yield('content')
		</div>
	</div>
</body>
	


</html>