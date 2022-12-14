<?php use App\Http\Controllers\HelpersController as Helpers; 

$haveaccessadd = Helpers::checkaccess('config', 'add');
$haveaccessdelete = Helpers::checkaccess('config', 'delete');

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="fa fa-fogs"></i>
            {{ __('Config') }} <?php if($haveaccessadd): ?> 
            <button type="button" id="btnAdd" class="btn btn-sm btn-success m-2" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus me-2"></i>Create Config
            </button> <?php endif; ?>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="table-responsive">
                        <table id="datastable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Name" name="nama"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Content" name="content"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Ket" name="ket"></td>
                                    <td>
                                        <select name="active" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                            <option value="">-- Status Active --</option>
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox" class="checkall" name="checkall"></th>
                                    <th class="align-center">Nama</th>
                                    <th class="align-center">Content</th>
                                    <th class="align-center">Ket</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="align-center">Nama</th>
                                    <th class="align-center">Content</th>
                                    <th class="align-center">Ket</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- view modal -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">


        <div class="modal-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Main Info</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <dl class="row mb-0" id="datauser-1"></dl>
            </div>

        </div>
        </div>

        <div class="modal-footer">
        <button id="closeModal" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        @if ($haveaccessadd) :
            <span id="editvbtn" data-attid="" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Modal Edit Config</span>
        @endif

        @if ($haveaccessdelete) :
            <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
            <button onClick="undeleteyesshow()" data-attid="" data-deleteval="0" id="undeletevbtn" class="btn btn-success btn-sm"></a>
        @endif
        </div>
        </div>
    </div>
</div>

@if ($haveaccessadd) :
<!-- add modal -->
<div class="modal fade" id="viewad" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLongTitle"></h5>
                <button type="button" class="close-modal btn btn-sm btn-danger close closeModalad" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- nama, content, flag_ket, flag_delete -->
                        <form id="smbtn">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-at me-2"></i></span>
                                <input type="text" id="nama" name="nama" class="form-control inpt-cst-add" required placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group mb-12" for="content">Content</label>
                                <textarea name="content" class="form-control inpt-cst-add" required id="content" cols="30" rows="10"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-at me-2"></i></span>
                                <input type="text" id="flag_ket" name="flag_ket" class="form-control inpt-cst-add" placeholder="Flag" aria-label="Flag" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <select name="active" class="form-control inpt-cst-add" id="active" required>
                                    <option value="">-- Status Active --</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                            </div>
                            <div class="input-group mb-3" style="float: right; text-align: right; right: 0; width: 158px;">
                                <button type="button" class="btn btn-secondary btn-sm closeModalad" data-dismiss="modal">Close</button>
                                <button type="submit" id="addvbtn" data-attid="" class="btn btn-success btn-sm"></button>
                                <input type="hidden" id="id_config" class="inpt-cst-add" name="id_config">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@section('script')
<script type="text/javascript">
    var url = "{{ asset('/api/config/getdata') }}";
    function searcAjax(a, skip = 0){
        console.log(a);
        if($(a).val().length > global_length_src || skip == 1) 
        {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#datastable').DataTable().ajax.url(url+"?"+getparam).load();
        }
        else {
            $('#datastable').DataTable().ajax.url(url).load();
        } 
    }

    $("#btnAdd").click(function(){
        clearInput("inpt-cst-add");
        $("#ModalLongTitle").html("Add Config");
        $('#viewad').modal('show');
        $("#addvbtn").html('<i class="fa fa-plus"></i> Add Config');
    });

    $("#smbtn").submit(function(e){
        e.preventDefault();

        test = '@csrf';
        token = $(test).val();
        var id_config = $("#id_config").val();
        var nama = $("#nama").val();
        var content = $("#content").val();
        var flag_ket = $("#flag_ket").val();
        var active = $("#active").val();        

        var url = "{{ asset('api/config/insertdata') }}";
        if(id_config != '')
            var url = "{{ asset('api/config/updatedata') }}/"+id_config;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id_config : id_config,
                nama : nama,
                content : content,
                flag_ket : flag_ket,
                active : active,
                _token: token,
            },
            success: function (response) {
                // return response()->json(['data' => ['success'], 'status' => '200'], 200);
                if(response.data[0] == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Save',
                        html:'Your data has been <b>Saved</b>'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Not Save',
                        html:'Upss !!! Your data <b>Not Saved</b>'
                    });
                }

                var url = "{{ asset('/api/config/getdata') }}";
                $('#datastable').DataTable().ajax.url(url).load();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#editvbtn").click(function(){
        idx = $('#deletevbtn').attr('data-attid');
        clearInput("inpt-cst-add");
        $("#ModalLongTitle").html("Edit Config t");
        $("#addvbtn").html('<i class="fa fa-edit"></i> Edit Config');
        var url = "{{ asset('/api/config/getdatabyid/') }}"+'/'+idx;
        test = '@csrf';
        token = $(test).val();
        $.ajax({
            url: url,
            type: "GET",
            data: {
                id : idx,
                _token: token,
            },
            success: function (response) {
                $("#nama").val(response.data[0].nama);
                $("#content").val(response.data[0].content);
                $("#flag_ket").val(response.data[0].flag_ket);
                $("#id_config").val(response.data[0].id);
                $("#active").val(response.data[0].active);
                $('#viewad').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });



    });

    $(".closeModalad").click(function(){
        $("#viewad").modal('hide');
    });

    $(document).ready(function(){
        
        var table = $('#datastable').DataTable({
            ajax: url,
            columnDefs: [
                {
                    'targets': 5,
                    'searchable':false,
                    'orderable':false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                        return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[5]+')">details</span>';
                }
                }, 
                
                {
                    'targets': 4,
                    'searchable':false,
                    'orderable':false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta)
                    {
                        if(full[4] == 1)
                            return '<span class="btn btn-success btn-sm">Active</span>';
                        else 
                        return '<span class="btn btn-warning btn-sm">Non Active</span>';
                    }
                }, 
                {
                    'targets': 0,
                    'searchable':false,
                    'orderable':false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta)
                    {
                        return '<input type="checkbox" class="ckc" name="checkid['+full[5]+']" value="' + $('<div/>').text(data).html() + '">';
                    } 
                }
            ],
            searching: false,
        }); 


        $("#closeModal").click(function(){
            $("#view").modal('hide');
        });

    });

    function showdetail(idx)
    {
        $('#deletevbtn').html('<i class="fa fa-trash"></i>Modal Delete Config');
        $('#undeletevbtn').html('<i class="fa fa-repeat"></i>Modal Undelete Config');

        $('#deletevbtn').attr('data-attid', idx);
        $('#undeletevbtn').attr('data-attid', idx);

        $('#addvbtn').attr('data-attid', idx);
        

        $('#view').modal('show');
        test = '@csrf';
        token = $(test).val();

        var url = "{{ asset('/api/config/getdatabyid/') }}"+'/'+idx;
        $.ajax({
            url: url,
            type: "get",
            data: 
            {
                id : idx,
                _token: token
            },
            success: function (response) 
            {
                console.log(response);
                var dhtml = '';
                if(response.data[0].flag_delete == 0)
                {
                    $('#deletevbtn').show();
                    $('#undeletevbtn').hide();
                }

                if(response.data[0].flag_delete == 1)
                {
                    $('#deletevbtn').hide();
                    $('#undeletevbtn').show();
                }

                $.each(response.data[0], function(i, item) 
                {
                    if(i != 'id') 
                    {
                        if(i == 'flag_delete' && item == 0) 
                        {
                            item = '<span id="activspan" style="color: #198754">Active</span>';
                        } 
                        if(i == 'flag_delete' && item == 1) 
                        {
                            item = '<span id="activspan" style="color: #dc3545">Deleted</span>';
                        }

                        if(i == 'active' && item == 1) 
                        {
                            item = '<span id="activspan" style="color: #198754">Active</span>';
                        } 

                        if(i == 'active' && item == 0) 
                        {
                            item = '<span id="activspan" style="color: #dc3545">Non Active</span>';
                        }

                        dhtml += '<dt class="col-sm-4">'+i+'</dt>';
                        dhtml += '<dt class="col-sm-8">'+item+'</dt>';
                    }
                
            });

            $("#datauser-1").html(dhtml);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

    }




    function deleteyesshow()
    {
        $('#deletevbtn').hide();
        idx = $('#deletevbtn').attr('data-attid');
        test = '@csrf';
        token = $(test).val();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) 
            {
                var url = "{{ asset('/api/config/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id : idx,
                        _token: token
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            html:'Your file has been <b>Deleted</b>'
                        });

                        var url = "{{ asset('/api/config/getdata') }}";
                        $('#datastable').DataTable().ajax.url(url).load();
                        $('#undeletevbtn').show();
                        $("#activspan").html('Deleted');
                        $("#activspan").css('color', '#dc3545');
                    },

                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        alert('something wrong');
                        console.log(textStatus, errorThrown);
                    }
                });

            } else {
                $('#deletevbtn').show();
            }
        });
    }

    function undeleteyesshow()
    {
        $('#undeletevbtn').hide();
        idx = $('#undeletevbtn').attr('data-attid');
        test = '@csrf';
        token = $(test).val();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, undelete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ asset('/api/config/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "post",
                    data: 
                    {
                        id : idx,
                        _token: token,
                        undeleted : 1
                    },
                    success: function (response) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Undeleted',
                            html:'Your file has been <b>Undeleted</b>'
                        });

                        var url = "{{ asset('/api/config/getdata') }}";
                        $('#datastable').DataTable().ajax.url(url).load();
                        $('#deletevbtn').show();
                        $("#activspan").html('Active');
                        $("#activspan").css('color', '#198754');
                    },

                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        console.log(textStatus, errorThrown);
                    }
                });

            } else {
                $('#undeletevbtn').show();
            }
        })
    }

    
</script>

@endsection    
</x-app-layout>



