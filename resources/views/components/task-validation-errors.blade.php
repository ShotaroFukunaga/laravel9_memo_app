@props(['errors'])

@if($errors->any())
  <div class="alert alert-warning alert-dismissible">
  {{--エラーの表示--}}
    <ul>
      @foreach($errors -> all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
