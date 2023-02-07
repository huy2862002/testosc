@extends('layoutAdmin.main')
@section('content')
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Account
                        <span class="d-block text-muted pt-2 font-size-sm">Infomation</span>
                    </h3>
                </div>
            </div>
            <div class="card-body" style="display: grid;grid-template-columns:1fr 1fr;grid-gap:20px">
                <div class="form-group row">
                    <label class="col-2 col-form-label yiel">First Name</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="firstName" type="text" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Last Name</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="lastName" type="text" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">EmailID</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="emailID" type="text" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Gender</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="gender" type="text" value="" />
                    </div>
                </div>
               <div class="form-group row">
                    <label class="col-2 col-form-label">BirthDay</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="birthDay" type="text" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Role</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="role" type="text" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-password-input" class="col-2 col-form-label"></label>
                    <div class="col-10">
                        <button id="sub" type="submit" class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajax({
            "url": "{{ route('auth.accountApi') }}",
            "method": "POST",
            headers: {
                'Authorization': "Bearer " + "{{session()->get('token')}}",
            },
            success: function(res) {
            console.log(res.FirstName);
                $("input[name = 'firstName']").val(res.FirstName);
                $("input[name = 'lastName']").val(res.LastName);
                $("input[name = 'emailID']").val(res.EmailID);
                $("input[name = 'gender']").val(res.Gender);
                $("input[name = 'birthDay']").val(res.Date_of_birth);
                 $("input[name = 'role']").val(res.Role);
            },
            error: function(e) {
                console.log('e');
            }
        })
    </script>
@endsection
