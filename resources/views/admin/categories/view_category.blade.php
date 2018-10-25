@extends('layouts.adminLayout.admin_design')


@section('content')



<div id="content">
  	<div id="content-header">
	<div id="breadcrumb"> 
		<a href="index.html" title="Go to Home" class="tip-bottom">
			<i class="icon-home"></i> 
			Home
		</a> 
		<a href="#">Catégories</a> 
		<a href="#" class="current">Voir une catégorie</a> 
	</div>

    <h1>Catégories</h1>

    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ session('flash_message_error') }}</strong>
        </div>
    @endif 

    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ session('flash_message_success') }}</strong>
        </div>
    @endif  

  	</div>
  	<div class="container-fluid">

    	<hr>

    	<div class="row-fluid">
      		<div class="span12">
		        <div class="widget-box">
		          	<div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
		            	<h5>Voir Categories</h5>
		          	</div>

		          	<div class="widget-content nopadding">
			            <table class="table table-bordered data-table">
			              	<thead>
			                	<tr>
			                  		<th>ID</th>
			                  		<th>Nom</th>
			                  		<th>URL</th>
			                  		<th>Actions</th>
			                	</tr>
			              	</thead>
			              	<tbody>
				              	@foreach($categories as $c)
				              	<tr class="gradeX">
				              		<td>{{ $c->id }}</td>
				              		<td>{{ $c->name }}</td>
				              		<td>{{ $c->url }}</td>
				              		<td>
										<a href="{{ url('/admin/edit-category/'.$c->id) }}" class="btn btn-primary btn-mini">Editer</a> 
										<a href="{{ url('/admin/delete-category/'.$c->id) }}" id="delCat" class="btn btn-danger btn-mini">Supprimer</a>				              	
									</td>
				              	</tr>
				              	@endforeach
			              	</tbody>
			            </table>
		          	</div>
		        </div>
      		</div>
    	</div>
  	</div>
</div>

@endsection