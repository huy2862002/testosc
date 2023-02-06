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
                    <a href="{{ route('admin.department.create') }}" class="btn btn-success font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
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
                </div>
            </div>
            <div class="card-body" style="display: grid;grid-template-columns:1fr 1fr 1fr">
                <div></div>
                <div></div>
                <div style="display: grid;grid-template-columns: 6fr 1fr;grid-gap:6px">
                    <input class="form-control" placeholder="Enter Department Name" type="text" name="key" />
                    <button id="btn_search" class="btn btn-warning">Search</button>
                </div>

            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                    <thead id="thead">
                        <tr>
                            <th>Department Name</th>
                            <th>Department Lead</th>
                            <th>Mail Alias</th>
                            <th>Parent Department</th>
                            <th>Added by</th>
                            <th>Added time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
            <div class="card-body" id="loading">
                <div class="loader">
                    <div class="face">
                        <div class="circle"></div>
                    </div>
                    <div class="face">
                        <div class="circle"></div>
                    </div>
                </div>
                <h4 style="text-align: center; margin-top:31px">Loading</h4><br>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            //Call api
            $.ajax({
                "url": "{{ route('department.index') }}",
                "method": "GET",
                success: function(res) {
                    $('#loading').remove();
                    console.log(res.length);
                    if (res.length > 0) {
                        console.log(res);
                        HandleData(res);
                    } else {
                        HandleEmpty();
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            })
            // Render data
            function HandleData(data) {
                let url = '{{ config('constants.linkLocal') }}';
                console.log(url);
                const format = new Intl.NumberFormat('en');
                let html = data.map(function(value, key) {

                    return `
                <tr>
                <td>${value[0].Department}</td>
                <td>${value[0].Department_Lead}</td>
                <td>${value[0].MailAlias}</td>
                <td>${value[0].Parent_Department}</td>
                <td>${value[0].AddedBy}</td>
                <td>${value[0].AddedTime}</td>
              
                <td>
                <a class="btn-confirm" data-title="Are you sure you want to delete this record ?" title="Delete" style="margin-right: 1px; cursor: pointer" data-url="${url+'/admin/department/delete/'+ value[0].Zoho_ID}"><span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Files/Deleted-file.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"/>
                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                <path d="M10.5857864,13 L9.17157288,11.5857864 C8.78104858,11.1952621 8.78104858,10.5620972 9.17157288,10.1715729 C9.56209717,9.78104858 10.1952621,9.78104858 10.5857864,10.1715729 L12,11.5857864 L13.4142136,10.1715729 C13.8047379,9.78104858 14.4379028,9.78104858 14.8284271,10.1715729 C15.2189514,10.5620972 15.2189514,11.1952621 14.8284271,11.5857864 L13.4142136,13 L14.8284271,14.4142136 C15.2189514,14.8047379 15.2189514,15.4379028 14.8284271,15.8284271 C14.4379028,16.2189514 13.8047379,16.2189514 13.4142136,15.8284271 L12,14.4142136 L10.5857864,15.8284271 C10.1952621,16.2189514 9.56209717,16.2189514 9.17157288,15.8284271 C8.78104858,15.4379028 8.78104858,14.8047379 9.17157288,14.4142136 L10.5857864,13 Z" fill="#000000"/>
                </g>
                </svg><!--end::Svg Icon--></span></a>
                <a title="Update" href="${url+'/admin/department/edit/'+ value[0].Zoho_ID}"><span class="svg-icon svg-icon-warning svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Design/Pen-tool-vector.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M11,3 L11,11 C11,11.0862364 11.0109158,11.1699233 11.0314412,11.2497543 C10.4163437,11.5908673 10,12.2468125 10,13 C10,14.1045695 10.8954305,15 12,15 C13.1045695,15 14,14.1045695 14,13 C14,12.2468125 13.5836563,11.5908673 12.9685588,11.2497543 C12.9890842,11.1699233 13,11.0862364 13,11 L13,3 L17.7925828,12.5851656 C17.9241309,12.8482619 17.9331722,13.1559315 17.8173006,13.4262985 L15.1298744,19.6969596 C15.051085,19.8808016 14.870316,20 14.6703019,20 L9.32969808,20 C9.12968402,20 8.94891496,19.8808016 8.87012556,19.6969596 L6.18269936,13.4262985 C6.06682778,13.1559315 6.07586907,12.8482619 6.2074172,12.5851656 L11,3 Z" fill="#000000"/>
                <path d="M10,21 L14,21 C14.5522847,21 15,21.4477153 15,22 L15,23 L9,23 L9,22 C9,21.4477153 9.44771525,21 10,21 Z" fill="#000000" opacity="0.3"/>
                </g>
                </svg><!--end::Svg Icon--></span></a>
                </td>
                </tr>`
                })
                $('#tbody').html(html)

                // Paginate
                $('#nav').remove();
                $('#kt_datatable').after('<div id="nav"></div>');
                var rowsShown = 12;
                var rowsTotal = $('#kt_datatable tbody tr').length;
                var numPages = rowsTotal / rowsShown;
                for (i = 0; i < numPages; i++) {
                    var pageNum = i + 1;
                    $('#nav').append('<a style="border:1px solid #999999; padding:9px" href="#" rel="' + i + '">' +
                        pageNum + '</a> ');
                }
                $('#kt_datatable tbody tr').hide();
                $('#kt_datatable tbody tr').slice(0, rowsShown).show();
                $('#nav a:first').addClass('active');
                $('#nav a').bind('click', function() {
                    $('#nav a').removeClass('active');
                    $(this).addClass('active');
                    var currPage = $(this).attr('rel');
                    var startItem = currPage * rowsShown;
                    var endItem = startItem + rowsShown;
                    $('#kt_datatable tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
                    css('display', 'table-row').animate({
                        opacity: 1
                    }, 300);
                });
            }

            // Empty record

            function HandleEmpty() {
                $('#kt_datatable').after(' <div class="card-body" id="notfound"></div>');
                html = `
                <h3 style="text-align:center">No records found</h3>
                </tr>`
                $('#notfound').append(html)
            }

            // Search department name

            $('#btn_search').on('click', function() {
                var key = $('input[name="key"]').val();
                $('#nav').remove();
                $('#tbody').remove();
                $('#notfound').remove();
                $('#kt_datatable').after(' <div class="card-body" id="loading"></div>');
                var html = `
                <h4 style="text-align: center">Loading ...</h4><br>
                <div class="loader">
                    <div class="face">
                        <div class="circle"></div>
                    </div>
                    <div class="face">
                        <div class="circle"></div>
                    </div>
                </div>
                           `;
                $('#loading').append(html)
                $.ajax({
                    "url": "{{ route('department.index') }}",
                    "method": "GET",
                    data: {
                        'key': key
                    },
                    success: function(res) {
                        console.log(res.length);
                        $('#loading').remove();
                        $('#thead').after(' <tbody id="tbody"></tbody>');
                        if (res.length > 0) {
                            HandleData(res);
                        } else {
                            HandleEmpty();
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            })
        });
    </script>
@endsection
