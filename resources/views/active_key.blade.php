@extends('../layout.app')
@section('title')
    {{$title}}
@endsection
@section('content')
        <h3>Login</h3>
        <div class="form-group">
            <label>Enter License Key</label>
            <input type="text" name="license_key" id="license_key" class="form-control" required placeholder="Provide License Key"/>
        </div>
        <button class="btn btn-primary btn-block" id="save">Save</button>
        <a href="{{route('home')}}">Home</a>
@endsection
@section('js')
<script>
    $(document).on('click', '#save', function()
    {
        let license_key = $('#license_key').val();
        if(license_key)
        {
            $.ajax({
                type: 'POST',
                url: "{{URL::to('active-key')}}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    license_key : license_key,
                },
                success: function(data){
                    if(data != false)
                    {
                        let date = formatDate(data);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Congratulations!! Your License Has Been Activated. It will work till '+date,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid License Key!',
                            footer: '<a href="#">Why do I have this issue?</a>'
                        })
                    }
                }
            });
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill up license key',
            })
        }
    });
    function formatDate (input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1], day = datePart[2];

        return day+'/'+month+'/'+year;
    }
</script>
@endsection
