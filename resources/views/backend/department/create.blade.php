@extends('layoutAdmin.main')
@section('content')
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Department
                        <span class="d-block text-muted pt-2 font-size-sm">Add New</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{ route('admin.department.index') }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>List Department</a>
                    <!--end::Button-->
                </div>
            </div>

            <div class="card-body" style="display: grid;grid-template-columns:1fr 1fr;grid-gap:20px">
                <div class="form-group row">
                    <label class="col-2 col-form-label yiel">Department Name <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input class="form-control line_i" name="Department" type="text" value="" />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Mail Alias</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="MailAlias" type="text" value="" />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Department Lead</label>
                    <div class="col-10">
                        <select class="form-control line_i" name="Department_Lead" id="Department_Lead">
                            <option selected disabled value="">Select Department Lead</option>
                            @foreach ($employees as $e)
                                <option value="{{ $e[0]['Zoho_ID'] }}">
                                    {{ $e[0]['EmployeeID'] . ' - ' . $e[0]['FirstName'] . ' ' . $e[0]['LastName'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Parent Department</label>
                    <div class="col-10">
                        <select class="form-control line_i" name="Parent_Department" id="Parent_Department">
                            <option selected disabled value="">Select Parent Department</option>
                            @foreach ($departments as $d)
                                <option value="{{ $d[0]['Zoho_ID'] }}">{{ $d[0]['Department'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">isC1/Là khối</label>
                    <div class="col-10">
                        <input class="form-control line_i" name="isDivision" type="text" value="" />

                    </div>
                </div>
                <div class="form-group row">

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
        $(function() {
            $('#sub').on('click', function() {

                $.ajax({
                    "url": "{{ route('department.create') }}",
                    "method": "POST",
                    data: {
                        'Department': $("input[name = 'Department']").val(),
                        'MailAlias': $("input[name = 'MailAlias']").val(),
                        'Department_Lead': $("select[name = 'Department_Lead']").val(),
                        'Parent_Department': $("select[name = 'Parent_Department']").val(),
                        'isDivision': $("input[name = 'isDivision']").val()
                    },
                    success: function(res) {
                        console.log(res);
                        if (res['response']['status'] == 0) {
                            alert(res['response']['result']['message']);
                        } else {
                            var errors = res['response']['errors'];
                            if (errors.length > 1) {
                                errors.forEach(element => {
                                    alert(Object.values(element['message'])[0]);
                                });
                            } else {
                                if (errors['code'] == 7023) {
                                    alert(errors['message']);
                                } else {
                                    alert(Object.values(errors['message'])[0]);
                                }
                            }
                        }
                    },
                    error: function() {
                        alert('errors');
                    }
                })
            })
        });
    </script>
@endsection
