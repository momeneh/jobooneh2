@if( Session::has('message'))
    <div class="flash alert-info">
        <p>{{Session::get('message')}}</p>
    </div>
@endif
@if( Session::has('error'))
    <div class="flash alert-warning">
        <p>{{Session::get('error')}}</p>
    </div>
@endif
@if( $errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
