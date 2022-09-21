<?php use App\Http\Controllers\HelpersController as Helpers; 
$haveaccessadd = Helpers::checkaccess('purchaseorders', 'add');
$haveaccessdelete = Helpers::checkaccess('purchaseorders', 'delete');
?>
@section('css')

@endsection



<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="fa fa-plus"></i>
            {{ __('Purchase Orders') }} <?php if($haveaccessadd): ?> 
            <button type="button" id="btnAdd" class="btn btn-sm btn-success m-2" data-toggle="modal" data-target="#addUser">
                <i class="fa fa-plus me-2"></i>Create Purchase Orders   
            </button> <?php endif; ?>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- table --}}
                    <div class="table-responsive">
                        <table id="datastable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="No Purchase Order" name="no_purchase_order"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Nama Produk" name="products_id"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Catatan" name="deskripsi_po"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="Jumlah" name="jumlah_produk"></td>
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
                                    <th class="align-center">No Purchase Order</th>
                                    <th class="align-center">Nama Produk</th>
                                    <th class="align-center">Catatan</th>
                                    <th class="align-center">Jumlah</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="align-center">No Purchase Order</th>
                                    <th class="align-center">Nama Produk</th>
                                    <th class="align-center">Catatan</th>
                                    <th class="align-center">Jumlah</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{-- table --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" style="background: rgba(0, 0, 0, 0.7);" id="viewad" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex right-content-lg-start">
                    <h5 class="modal-title" id="ModalLongTitle"></h5>
                    <button type="button" class="close-modal btn btn-sm btn-danger close closeModalad" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="smbtn" enctype="multipart/form-data"> 
                                <dl class="row mb-0">
                                <dt class="col-sm-4">Nama Paket</dt>
                                <dd class="col-sm-8">: 
                                    <input type="text" name="nama_paket" id="nama_paket" class="form-group nama_paket">
                                <dt class="col-sm-4"></dt>
                                <dd class="col-sm-8">: 
                                    <input type="text" name="nama" id="produkid" class="form-group produkid">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button>
                                <div id="produk_list"></div>
                                <input type="hidden" name="user_group" id="user_group">
                                <div class="d-flex justify-content-end">
                                    <div class="control-group after-add-more">
                                    
                                        <div class="copy control-group"></div>
                                    </div>
                                </div></dd>

                                </dl>

                                <table id="listProdukTable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="align-center">Thumbnails</th>
                                            <th class="align-center">Nama</th>
                                            <th class="align-center">Satuan</th>
                                            {{-- <th class="align-center">Kategori</th>
                                            <th class="align-center">Brand</th>
                                            <th class="align-center">Supplier</th> --}}
                                            <th>Qty</th>
                                            {{-- <th>Bagus</th>
                                            <th>Jelek</th> --}}
                                            {{-- <th>Action</th>                                            --}}
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th class="align-center">Thumbnails</th>
                                            <th class="align-center">Nama</th>
                                            <th class="align-center">Satuan</th>
                                            {{-- <th class="align-center">Kategori</th>
                                            <th class="align-center">Brand</th>
                                            <th class="align-center">Supplier</th> --}}
                                            <th>Qty</th>
                                            {{-- <th>Bagus</th>
                                            <th>Jelek</th> --}}
                                            {{-- <th>Action</th>                          --}}
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm closeModalad" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="addvbtn" data-attid="" class="btn btn-success btn-sm"></button>
                                </div>
                            </form>
                            {{--  --}}
                        </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')

<script type="text/javascript">

    // FUNCTION SECARA GLOBAL
    $(".closeModalad").click(function() 
    {
    $("#viewad").modal('hide');
    });
    // FUNCTION SECARA GLOBAL
    

    // // DATA TABLE UNTUK HALAMAN DEPAN
    var url = "{{ asset('/api/purchaseorders/getdata') }}";
    function searcAjax(a, skip = 0) {
        if ($(a).val().length > global_length_src || skip == 1) {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#datastable').DataTable().ajax.url(url + "?" + getparam).load();
        }else{
            $('#datastable').DataTable().ajax.url(url).load();
        }
    }
    // // DATA TABLE UNTUK HALAMAN DEPAN

    // // TAMPIL PADA HALAMAN TABLE
    $(document).ready(function() {
        var table = $('#datastable').DataTable({
            ajax: url,
            columnDefs: [{
                'targets': 2,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function(data, type, full, meta) {
                    return '<span class="btn btn-info btn-sm" onclick="showdetail(' + full[2] + ')">details</span>';
                }
            }, ],
            searching: false,
        });
    
        $("#closeModal").click(function() {
            $("#view").modal('hide');
        });
    });
    // // TAMPIL PADA HALAMAN TABLE


    // // UNTUK MEMBUKA MODAL ADD
    $("#btnAdd").click(function() 
    {
        clearInput("inpt-cst-add");
        $('#viewad').modal('show');
        $('#showProduk').show();
    
        // tambahan
        $("#produkid").val("");
        $('#produk_list').html("");
        $('#user_group').hide();
        $('.copy').html("");
        $(".control-group after-add-more").html("");
        // tambahan
    
        $("#ModalLongTitle").html("Purchase Orders Tambah"); // title MODAL CREATE
        $("#addvbtn").html('<i class="fa fa-plus"></i> Add Purchase Orders');
    });
    // // UNTUK MEMBUKA MODAL ADD

    $('#produkid').keyup(function() {
        var path = "{{ asset('/api/purchaseorders/search') }}"; // url untuk Request Search
        var query = $(this).val();  
        
        if(query != '')  
        {
            $.ajax({
                url: path,  
                method:"GET",  
                data:{query:query},  
                success:function(data) 
                {
                    htmls1 = '<select class="list-unstyled form-control form-group col-sm-8" id="id_user" name="selectproduct" onchange="table(this)">';
                        // console.log(htmls1);

                    $.each(data, function (key, item) {
                        // console.log(key,item.id);
                        htmls1 += "<option value=\""+item.id+"\">"+item.nama+"</option>";
                    });

                    htmls1 += '<option value="" selected>-- Select option --</option></select>';
                    $('#produk_list').html(htmls1);  
                    // console.log(htmls1);

                } 
            });
        }

        if (query == '') {
            $('#produk_list').html('<select class="list-unstyled form-control"><option value="">-- Select option --</option></select>')  
        }
        else{
            $('#produk_list').html('<select class="list-unstyled form-control"><option value="">-- Select option --</option></select>')     
        }
    });
    
    // // FORM SUBMIT

    // // FORM SUBMIT

    function table(a) 
    {
        id = $(a).val();
        var hidden = $("#user_group").val();
        var tampung = hidden + ' , ' + id;
        // console.log(tampung);

        nama = $("#id_user option:selected").text();
        const pattern = new RegExp('(' + id + ')', 'gm');
        let m;
        if(m = pattern.exec(hidden) == null) 
        {
            $("#user_group").val(tampung);
        }
        var url = "{{ asset('/api/purchaseorders/getdata') }}/"+id;

        $('#listProduKTable').DataTable().ajax.url(url).load();
        // console.log(urlApa);
    }

    $(document).ready(function() 
    {
        // Untuk DataTable Produk saaat Create
        var table = $('#listProdukTable').DataTable({
            // ajax: url,
            columnDefs: [
                {
                    'targets': 1,
                    'name': 'image',
                    'data': 'image',
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        console.log(full[1]);
                        return '<img src=\'/images/uploads/Thumbnail-' + full[1] + '\' width=\"100\" height=\"100\" alt=\"Thumbnails\" onclick="imagePreviewNih(\'' + full[1] + '\')" class="imagePreviewNih">'; 
                    }
                },

                {
                    'targets': 2,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        console.log(full[2]);
                        return '<tbody>' + full[2] + '</tbody>';
                    }
                },
    
                // {
                //     'targets': 4,
                //     'searchable': false,
                //     'orderable': false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         // console.log(full[7]);
                //         return '<input type="number" class="form-control inpt-cst-add mb-2" name="no_purchase_order" id="no_purchase_order" aria-describedby="" placeholder="No Purchase Order" aria-describedby="basic-addon1">';
                //     }
                // },
    
                // {
                //     'targets': 5,
                //     'searchable': false,
                //     'orderable': false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         // console.log(full[8]);
                //         return '<input type="number" class="form-control inpt-cst-add mb-2" name="no_purchase_order" id="no_purchase_order" aria-describedby="" placeholder="No Purchase Order" aria-describedby="basic-addon1">';
    
                //     }
                // },
    
                // {
                //     'targets': 6,
                //     'searchable': false,
                //     'orderable': false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         // console.log(full[9]);
                //         return '<input type="number" class="form-control inpt-cst-add mb-2" name="no_purchase_order" id="no_purchase_order" aria-describedby="" placeholder="No Purchase Order" aria-describedby="basic-addon1">';
                //     }
                // },
    
                // {
                //     'targets': 7,
                //     'searchable': false,
                //     'orderable': false,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         // console.log(full[10]); [10] ID di modul produk
                //         return '<input type="checkbox" class="ckc" name="checkid[' + full[10] + ']" value="' + $('<div/>').text(data).html() + '">';
    
                //     }
                // },
            ],
            // searching: false,
        });
    
        // $("#closeModal").click(function() {
        //     $("#view").modal('hide');
        // });
    });


    
    function kurangininput(a) 
    { 
        var tampung = $("#user_group").val();
        tampung = tampung.replace(", "+a, "");
        $("#user_group").val(tampung);
    }




</script>
@endsection 
</x-app-layout>