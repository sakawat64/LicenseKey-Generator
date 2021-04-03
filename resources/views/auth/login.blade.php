@extends('../layout.app')
@section('title')
    {{$title}}
@endsection
@section('content')
        <form method="POST" action="{{route('check_login')}}">
            @csrf
            <h3>Login</h3>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" required placeholder="Provide Mobile Number"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Provide Password"/>
            </div>
            <button class="btn btn-primary btn-block">Login</button>
            <a href="{{route('register')}}">Need Register?</a>
        </form>
@endsection
@section('js')
@endsection
