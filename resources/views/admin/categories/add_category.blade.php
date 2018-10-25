@extends('layouts.adminLayout.admin_design')


@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Catégories</a> <a href="#" class="current">Ajouter une catégorie</a> </div>
    <h1>Ajouter une catégorie</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Ajouter une catégorie</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/add-category') }}" name="add_category" id="add_category" novalidate="novalidate">
            	{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Nom</label>
                <div class="controls">
                  <input type="text" name="name" id="name">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Sous-catégorie</label>
                <div class="controls">
                  <select name="parent_id" style="width:220px">
                    <option value="0">Catégorie Initial</option>
                    @foreach($levels as $l)
                      <option value="{{ $l->id }}">{{ $l->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                	<textarea name="description" id="description"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Valider" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection