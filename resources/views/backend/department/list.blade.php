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
                        <th>Department Name</th>
                        <th>Mail Alias</th>
                        <th>Department Lead</th>
                        <th>Added by</th>
                        <th>Added time</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <td><h2>Loading ...</h2></td>
                    </tr>
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
        "url": "{{route('department.index')}}",
        "method": "GET",  
        success:function(res){        
            console.log(res);
            HandleData(res);
            
        },error:function(e){
            console.log("error");
        }
        })

        function HandleData(data) {
            let url = window.location.origin;
            const format = new Intl.NumberFormat('en');
            let html = data.map(function(value, key) {
                return `
                <tr>
                <td>${value[0].Department}</td>
                <td>${value[0].MailAlias}</td>
                <td>${value[0].Department_Lead}</td>
                <td>${value[0].AddedBy}</td>
                <td>${value[0].AddedTime}</td>
            </tr>`
            })
            $('#tbody').html(html)


            $('#kt_datatable').after ('<div id="nav"></div>');  
    var rowsShown = 10;  
    var rowsTotal = $('#kt_datatable tbody tr').length;  
    var numPages = rowsTotal/rowsShown;  
    for (i = 0;i < numPages;i++) {  
        var pageNum = i + 1;  
        $('#nav').append ('<a style="border:1px solid #999999; padding:9px" href="#" rel="'+i+'">'+pageNum+'</a> ');  
    }  
    $('#kt_datatable tbody tr').hide();  
    $('#kt_datatable tbody tr').slice (0, rowsShown).show();  
    $('#nav a:first').addClass('active');  
    $('#nav a').bind('click', function() {  
    $('#nav a').removeClass('active');  
   $(this).addClass('active');  
        var currPage = $(this).attr('rel');  
        var startItem = currPage * rowsShown;  
        var endItem = startItem + rowsShown;  
        $('#kt_datatable tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).  
        css('display','table-row').animate({opacity:1}, 300);  
    });  
        }

        
    });
</script>
@endsection