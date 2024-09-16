@if($errors->any())
  <div class="alert alert-danger" role="alert">
    <h5 class="m-0 fw-semibold mb-1" style="color: #721c24">Não foi possivel realizar esta ação.</h5>
    <ul class="list-unstyled m-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
