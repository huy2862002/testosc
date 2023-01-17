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
                    <a style="margin-right: 12px" href="{{ route('admin.department.create') }}"
                        class="btn btn-warning font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Add New Department</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="{{ route('admin.department.index') }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                    <label class="col-2 col-form-label yiel">Department Name</label>
                    <div class="col-10">
                        <input class="form-control line_des" name="Department" type="text"
                            value="{{ $department['Department'] }}" />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Mail Alias</label>
                    <div class="col-10">
                        <input class="form-control line_des" name="MailAlias" type="text"
                            value="{{ $department['MailAlias'] }}" />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Department Lead</label>
                    <div class="col-10">
                        <select class="form-control line_des" name="Department_Lead" id="Department_Lead">
                            <option selected disabled value="">Select Department Lead</option>
                            @foreach ($employees as $e)
                                <option @if ($department['Department_Lead.ID'] == $e[0]['Zoho_ID']) selected @endif value="{{ $e[0]['Zoho_ID'] }}">
                                    {{ $e[0]['EmployeeID'] . ' - ' . $e[0]['FirstName'] . ' ' . $e[0]['LastName'] }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Parent Department</label>
                    <div class="col-10">
                        <select class="form-control line_des" name="Parent_Department" id="Parent_Department">
                            <option selected disabled value="">Select Parent Department</option>
                            @foreach ($departments as $d)
                                <option @if ($department['Parent_Department.ID'] == $d[0]['Zoho_ID']) selected @endif value="{{ $d[0]['Zoho_ID'] }}">
                                    {{ $d[0]['Department'] }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">isC1/Là khối</label>
                    <div class="col-10">
                        <input class="form-control line_des" name="isDivision" type="text"
                            value="{{ $department['isDivision'] }}" />

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
                console.log();

                $.ajax({
                    "url": "{{ route('department.update', $id) }}",
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
                            console.log();
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
