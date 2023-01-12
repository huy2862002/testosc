@extends('layoutAdmin.main')
@section('content')
<div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Department
                    <span class="d-block text-muted pt-2 font-size-sm">List</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Add New Department</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Department Name </th>
                        <th>Mail Alias</th>
                        <th>Department Lead</th>
                        <th>EmployeeID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Added time </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <h2 style="color: #999999;">Đang load ...</h2>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function() {
        $.ajax({
            url: 'https://people.zoho.com/people/api/forms/P_Employee/getRecordByID',
            method: 'POST',
            data: {"recordId":"425479000015827885"},
            headers: "Authorization:Zoho-oauthtoken 1000.b8ab17ad0dbaa1b1b4090b09adb4d55b.518f201124819d3e9115de939355d222",
            success: function(res) {
                console.log(res.data);
            },
            error: function(e) {
                console.log(e)
            }
        })
    });
</script>

@endsection