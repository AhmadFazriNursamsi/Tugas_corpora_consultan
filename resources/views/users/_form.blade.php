@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
@endsection
<div class="card-body">
    <form role="form" action="{{url('users/').'/'.$datas['urls']}}" method="post" id="formm">
      {{ csrf_field() }}
      <div class="box-body">

        <div class="row">
        	<div class="col-md-4">
        		<h2 class="btn btn-sm btn-primary">Main Info</h2>
	    		<div class="col-md-10">
		            <div class="form-group">
		              <label for="name" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">Name <span class="red-required">*</span></label>
		              <input type="text" name="name" value="<?php if(isset($users->name)) echo $users->name;?>" class="form-control form-control-sm" required id="name" placeholder="Name">
		                
		                @if ($errors->has('name'))
		                    <span class="help-block">
		                        <strong style="color: red;">{{ $errors->first('name') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></strong>
		                    </span>
							
		                @endif
		            </div>
		        </div> <!--col-md-4-->
		        
		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
		              <label for="username" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">Username <span class="red-required">*</span></label>
		              <input type="text" name="username" value="<?php if(isset($users->username)) echo $users->username;?>" class="form-control form-control-sm" required id="username" placeholder="Username">
		                
		                @if ($errors->has('username'))
		                    <span class="help-block">
		                        <strong style="color: red;">{{ $errors->first('username') }}</strong>
		                    </span>
		                @endif
		            </div>
		        </div> <!--col-md-4-->

		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
		              <label for="email" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">Email <span class="red-required">*</span></label>
		              <input type="email" name="email" value="<?php if(isset($users->email)) echo $users->email;?>" class="form-control form-control-sm" required id="email" placeholder="Email">
		                
		                @if ($errors->has('email'))
		                    <span class="help-block">
		                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
		                    </span>
		                @endif
		            </div>
		        </div> <!--col-md-4-->

		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} has-feedback">
		              <label for="mobile" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">Mobile <span class="red-required">*</span></label>
		              <input type="text" name="mobile" value="<?php if(isset($users->mobile)) echo $users->mobile;?>" class="form-control form-control-sm" required id="mobile" placeholder="Mobile">
		                
		                @if ($errors->has('mobile'))
		                    <span class="help-block">
		                        <strong style="color: red;" >{{ $errors->first('mobile') }}</strong>
		                    </span>
		                @endif
		            </div>
		        </div> <!--col-md-4-->
		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('id_division ') ? ' has-error' : '' }} has-feedback">
		              <label for="id_division" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">Division <span class="red-required">*</span></label>
		              <select id="id_division" class="form-control form-control-sm src_class_user" name="id_division" required onchange="check_access(this)">
		                    <option value="0" {{ (old("id_division") == 0 ? "selected":"") }}>-- select Division --</option>
		                    <?php foreach ($datas['divisions'] as $key => $post) :?>
		                        <option value="<?= $post->id_division?>" <?php if(isset($division->id_division) && $division->id_division == $post->id_division) echo "selected";?>><?= $post->division_name?></option>
		                    <?php endforeach;?>
		              </select>
		            </div>
		        </div><!--col-md-4-->
		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('id_role ') ? ' has-error' : '' }} has-feedback">
		              <label for="id_role" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">role <span class="red-required">*</span></label>
		              <select id="id_role" class="form-control form-control-sm" name="id_role" required>
		                    <option value="0" {{ (old("id_role") == 0 ? "selected":"") }}>-- select role --</option>
		                    <?php foreach ($datas['roles'] as $key => $post) :?>
		                        <option value="<?= $post->id_role?>" <?php if(isset($users->id_role) && $users->id_role == $post->id_role) echo "selected";?>><?= $post->role_name?></option>
		                    <?php endforeach;?>
		              </select>
		            </div>
		        </div><!--col-md-4-->

				<div class="col-md-10">

				</div>

		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
		              <label for="password" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">password <span class="red-required">*</span></label>
		              <input type="password" name="password" value="" class="form-control form-control-sm" id="password" placeholder="password">
		                
		                @if ($errors->has('password'))
		                    <span class="help-block">
		                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
		                    </span>
		                @endif
		            </div>
		        </div> <!--col-md-4-->

				<div class="col-md-10">
					<input type="hidden" name="table_group" id="table_group">
		            <div class="form-group{{ $errors->has('id_role ') ? ' has-error' : '' }} has-feedback">
		              <label for="id_role" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">warehouse <span class="red-required">*</span></label>
		              <select id="id_gudang" multiple class="form-control form-control-sm " name="id_gudang" required onchange="table(this)">  
						<option value="" {{ (old("id_role") == 0 ? "selected":"") }}>-- select warehouse --</option>
						  <?php foreach ($datas['gudang'] as $key => $post) :?>
		                        <option value="{{ $post[2] }}">{{ $post[1] }}</option>
		                    <?php endforeach;?>
		              </select>
		            </div>
		        </div>
				<div class="col-md-10 mt-3">
					<div class="table-option">
						<table class="table table-striped" id="table_add">
								<tr>
								<th></th>
								<th class="align-center">warehouse</th>
								<th class="align-center">Delete</th>
						
								</tr>
								
			
					  </table>
					</div>
				</div>

		        <div class="col-md-10">
		            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }} has-feedback">
		              <label for="active" style="background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0;">active <span class="red-required">*</span></label>
		              	<input type="radio" id="active" name="active" value="1" <?php if((isset($users->active) && $users->active == 1) || !isset($users->active)) echo "checked";?> >
						<label for="active">Active</label><br>
						<input type="radio" id="not_active" name="active" value="0" <?php if(isset($users->active) && $users->active == 0) echo "checked";?>>
						<label for="not_active">Not Active</label><br>
		            </div>
		        </div> <!--col-md-4-->


		
		        <hr>
		    </div><!--col-md-6-->


		    <div class="col-md-6">
	    		<h2 class="btn btn-sm btn-primary">User Access</h2>

	    		<dl class="row mb-0" id="datauser-2">
	    			<?php foreach ($datas['user_access'] as $key => $post) :?>
				    <dt class="col-sm-12" style="border: 1px solid #DDD; background: #b2d9ff; width: 100%; padding: 5px; margin: 5px 0; margin-top:15px; margin-bottom:15px;">
				    	<input type="checkbox" class="form-check-input" id="endt-{{$post->name_access}}" onclick="checkpart('{{$post->name_access}}')">  || 
				    	<label style="font-size: 18px" class="form-check-label" for="endt-{{$post->name_access}}"><?= $post->name_access?></label>
				    </dt>
				    <div class="col-sm-2">
				    	<input type="hidden" name="eCheck1[{{$post->name_access}}][view]" value="0">
					    <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-view" name="eCheck1[{{$post->name_access}}][view]" value="1">
					    <label class="form-check-label" for="{{$post->name_access}}-view">view</label>
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="eCheck1[{{$post->name_access}}][add]" value="0">
					    <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-add" name="eCheck1[{{$post->name_access}}][add]" value="1">
					    <label class="form-check-label" for="{{$post->name_access}}-add">add</label>
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="eCheck1[{{$post->name_access}}][edit]" value="0">
					    <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-edit" name="eCheck1[{{$post->name_access}}][edit]" value="1">
					    <label class="form-check-label" for="{{$post->name_access}}-edit">edit</label>
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="eCheck1[{{$post->name_access}}][delete]" value="0">
					    <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-delete" name="eCheck1[{{$post->name_access}}][delete]" value="1">
					    <label class="form-check-label" for="{{$post->name_access}}-delete">delete</label>
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="eCheck1[{{$post->name_access}}][import]" value="0">
					    <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-import" name="eCheck1[{{$post->name_access}}][import]" value="1">
					    <label class="form-check-label" for="{{$post->name_access}}-import">import</label>
					</div>
					<div class="col-sm-2">
						<input type="hidden" name="eCheck1[{{$post->name_access}}][export]" value="0">
					    <input type="checkbox" class="form-check-input eCheck1 ec-{{$post->name_access}}" id="{{$post->name_access}}-export" name="eCheck1[{{$post->name_access}}][export]" value="1">
					    <label class="form-check-label" for="{{$post->name_access}}-export">export</label>
					</div>
					<?php endforeach;?>

			    	
				</dl>


		    </div><!--col-md-6-->

        </div> <!-- row -->

      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <div class=" pull-right">
        	<br>
          <button type="submit" class="btn btn-info btn-sm" style="position: fixed; bottom: 46px; right: 46px;"><i class="fa fa-send" aria-hidden="true"></i> Submit</button>
        </div>
      </div>
    </form>
</div>

<script type="text/javascript">
	function checkpart(a){
		if($("#endt-"+a).is(':checked')) {
			$(".ec-"+a).each(function(){
			    $(this).attr('checked', true);
			});
		} else {
			$(".ec-"+a).each(function(){
			    $(this).attr('checked', false);
			});
		}
	}

function check_access(a){
	iddivisi =$(a).val();
    test = '@csrf';
    token = $(test).val();
    var url = "{{ asset('/api/usersaccess2') }}/" + iddivisi;
    $.ajax({
        url: url,
        type: "get",
        success: function (response) {
           	$.each(JSON.parse(response.data.default_access), function(i, item) {
            	$.each(item, function(i2, item2) {
					if(item2 == 1)
						$("#"+i+'-'+i2).attr('checked', true);
					else 
					$("#"+i+'-'+i2).attr('checked', false);
            	});
            
          	});
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('something wrong');
            console.log(textStatus, errorThrown);
        }
    });
}
    function table(a) { 
		id = $(a).val();
		var hidden = $("#table_group").val();
		var tampung = hidden + ', ' + id;
		nama = $( "#id_user option:selected" ).text();
		const pattern = new RegExp('(' + id + ')', 'gm');
		let m;
		var table3 = document.querySelector("#table_add tbody");
		if(m = pattern.exec(hidden) == null) {
			$("#table_group").val(tampung);
		}
		var url = "{{ asset('/api/tablegudang/getdata') }}/" +id ;
			$.ajax({
				url: url,
				type: "GET",
				success: function(response) {
					data = response.data;
					var htmlinput = '<tr class="" id="row-'+response.data[0][2]+'">\
					<td>'+response.data[0][0]+'</td>\
					<td>'+response.data[0][1]+'</td>\
					<td class="  dt-body-center"><span class="btn btn-danger deletee btn-sm" onclick="kurangininput('+data[0][2]+')"><i class="bi bi-trash-fill"></i></span></td>\
					</tr>';
					const regex = new RegExp('(row-' + id + ')', 'gm');
					let m;
					if(regex.exec(table3.innerHTML) == null)
						table3.innerHTML = table3.innerHTML + htmlinput;
					else {
						Swal.fire({
							icon: 'error',
							html:'<b>warehouse already exists</b>'
						});
					}
				}
			});
	}

	function kurangininput(a) { 
		var tampung = $("#table_group").val();
		tampung = tampung.replace(", "+a, "");
		$("#table_group").val(tampung);
		var rowid = '#row-'+a;
	    $('#table_add').DataTable();
		$("#row-"+a).remove();
		Swal.fire({
				icon: 'success',
				title: 'Berhasil',
				html:'Data Berhasil <b>Dihapus</b>'
			});
	}

</script>