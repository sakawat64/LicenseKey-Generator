@extends('../layout.app')
@section('title')
    {{$title}}
@endsection
@section('css')
    <style>
        .auth-inner {
            margin-top: 10px !important;
        }
    </style>
@endsection
@section('content')
    <a href="{{route('logout')}}">Logout</a>
    <form method="POST" action="" id="show_details">
        @csrf
            <h3>Create License</h3>
            <div id="user_details">
            </div>
            <div class="form-group">
                <label>Client ID</label>
                <input type="text" name="user_id" id="user_id" class="form-control" required placeholder="Provide User ID"/>
            </div>
            <div class="form-group">
                <label>License Key</label>
                <input type="text" name="license_key" id="license_key" class="form-control"/>
            </div>
            <button class="btn btn-primary btn-block">Save</button>
            <div class="form-group">
                <label>License For</label>
                <select class="form-control" name="duration" id="duration">
                    <option value="3">3 Month</option>
                    <option value="6">6 Month</option>
                    <option value="12">12 Month</option>
                </select>
            </div>
            <a id="create_key" class="btn btn-success">Create Key</a>
        <br>
           <a href="{{route('active_key')}}" style="float:right">Active Key</a>
    </form>
@endsection
@section('js')
    <script>
        var htmltext;
        $("#show_details").on('submit',function(event)
        {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{URL::to('user-details')}}",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    let license = data.license.license_key ? data.license.license_key : "";
                    htmltext = '<div style="border:1px solid black"><div class="form-group"><label>First Name: &nbsp;</label><span>'+data.user.first_name+'</span></div>' +
                        '<div class="form-group"><label>Last Name: &nbsp;</label><span>'+data.user.last_name+'</span></div>' +
                        '<div class="form-group"><label>Organization Name: &nbsp;</label><span>'+data.user.organization_name+'</span></div>' +
                        '<div class="form-group"><label>Street: &nbsp;</label><span>'+data.user.street+'</span></div>' +
                        '<div class="form-group"><label>City: &nbsp;</label><span>'+data.user.city+'</span></div>' +
                        '<div class="form-group"><label>Email: &nbsp;</label><span>'+data.user.email+'</span></div>' +
                        '<div class="form-group"><label>Mobile Number: &nbsp;</label><span>'+data.user.mobile_number+'</span></div>'+
                    '<div class="form-group"><label>License Key: &nbsp;</label><span>'+license+'</span></div></div>'
                    $('#user_details').html(htmltext);
                }
            });
        });
        $(document).on('click', '#create_key', function()
        {
            let user_id = $('#user_id').val();
            let duration = $('#duration').val();
            if(user_id)
            {
                $.ajax({
                    type: 'POST',
                    url: "{{URL::to('create-license-key')}}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id : user_id,
                        duration: duration
                    },
                    success: function(data){
                        if(data != false)
                        {
                            $('#license_key').val(data);
                        }
                        else
                        {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Invalid User!!',
                            })
                        }
                    }
                });
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill up client id!',
                })
            }
        });
    </script>
@endsection
