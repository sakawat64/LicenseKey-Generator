@extends('../layout.app')
@section('title')
    {{$title}}
@endsection
@section('css')
    <style>
        .auth-inner {
            margin-top: 0px !important;
        }
    </style>
@endsection
@section('content')
    <form method="POST" action="{{route('register_store')}}">
        @csrf
        <h3>Register</h3>
        <div class="col-md-12">
         <div class="row">
             <div class="col-md-6">
               <label>First Name</label>
               <input type="text" name="first_name" class="form-control" required placeholder="Provide First Name"/>
            </div>
             <div class="col-md-6">
                 <label>Last Name</label>
                 <input type="text" name="last_name" class="form-control" required placeholder="Provide Last Name"/>
             </div>
             <div class="col-md-6">
                 <label>Name of Organization</label>
                 <input type="text" name="organization_name" class="form-control" required placeholder="Provide Organization Name"/>
             </div>
             <div class="col-md-6">
                 <label>Street</label>
                 <input type="text" name="street" class="form-control" required placeholder="Provide Street"/>
             </div>
             <div class="col-md-6">
                 <label>City</label>
                 <input type="text" name="city" class="form-control" required placeholder="Provide City"/>
             </div>
             <div class="col-md-6">
                 <label>Email</label>
                 <input type="email" name="email" class="form-control" required placeholder="Provide Email"/>
             </div>
             <div class="col-md-6">
                 <label>Mobile Number</label>
                 <input type="text" name="mobile_number" class="form-control" required placeholder="Provide Mobile Number"/>
             </div>
             <div class="col-md-6">
                 <label>Password</label>
                 <input type="password" name="password" id="txtNewPassword" class="form-control" required placeholder="Password"/>
             </div>
             <div class="col-md-6">
                 <label>Confirm Password</label>
                 <input type="password" name="password_confirmation" id="txtConfirmPassword" class="form-control" required placeholder="Confirm Password"/>
                 <span id="CheckPasswordMatch"></span>
             </div>
         </div>
            <br>
            <div class="col-md-4 offset-4">
                <button class="btn btn-primary btn-block">Login</button>
                <a href="{{route('login')}}">Already have an account?</a>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).on('keyup','#txtConfirmPassword', function()
        {
            let password = $("#txtNewPassword").val();
            let confirmPassword = $("#txtConfirmPassword").val();

            if (password != confirmPassword)
            {
                $("#CheckPasswordMatch").css("color", "red");
                $("#CheckPasswordMatch").html("*Passwords does not match!");
            }
            else{
                $("#CheckPasswordMatch").css("color", "green");
                $("#CheckPasswordMatch").html("Passwords match.");
            }
        });
    </script>
@endsection
