<!DOCTYPE html>
<html>
<head>
	<title>Laravel ATS</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
	<style type="text/css">
		/*table, th, td{
			padding: 5px;
		}*/

		/*a:link{
			color: white;
		}*/

		a:visited{
			color: gray;
		}

		div#bioTable_length{
			text-align: left;
		}

		div#bioTable_info{
			text-align: left;
		}
	</style>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="assets/js/datatables.min.js"></script>
</head>
<body>
	<div class="container">
		<h4 style="text-align: center; color: firebrick;">INFORMASI</h4>
		<hr>
		<!-- Button trigger modal -->
		<div>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBiodata">
		 Tambah
			</button>
		</div>
		<span id="form_result" style="margin: 2px;"></span>
		<div style="text-align: center;">
			<table class="table table-bordered table-hover" id="bioTable">
				<thead style="background-color: firebrick; color: white;">
					<tr>
						<td>Nama Lengkap</td>
						<!-- td>Tanggal Lahir</td>
						<td>Jenis Kelamin</td>
						<td>Hobi</td> -->
						<td>Aksi</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal tambah -->
		<div class="modal fade" id="modalBiodata" tabindex="-1" role="dialog" aria-labelledby="formdataLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Input Biodata</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form id="formBiodata">
		      	@csrf
		      	<div class="modal-body">
					<table>
						<tr>
							<td>Nama Lengkap</td>
							<td>:</td>
							<td>
								<input type="text" id="nama_lengkap" name="nama_lengkap">
							</td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td>
								<input type="text" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off">
							</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>:</td>
							<td>
								<select id="jenis_kelamin" name="jenis_kelamin">
									<option value="">-Pilih-</option>
									@foreach($genders as $gender) <!-- perulangan array -->
									<option value="{{ $gender->gender }}">{{ $gender->gender }}</option>
									@endforeach
									<!-- <option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option> -->
								</select>
							</td>
						</tr>
						<tr>
							<td>Hobi</td>
							<td>:</td>
							<td>
								@foreach($hobbys as $hobby)
								<input type="checkbox" value="{{ $hobby->hobi }}" name="hobi[]">{{ $hobby->hobi }} 
								@endforeach
							</td>
						</tr>
					</table>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		        	<button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
		      	</div>
			  </form>
		    </div>
		  </div>
		</div>

		<!-- Modal Detail -->
		<div id="modalDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Detail Biodata</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      	<div class="modal-body">
	      	<input type="hidden" name="id_detail">
				<table>
					<tr>
						<td>Nama Lengkap</td>
						<td>:</td>
						<td id="nama_lengkap_detail"></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>:</td>
						<td id="tanggal_lahir_detail"></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td id="jenis_kelamin_detail">
						</td>
					</tr>
					<tr>
						<td>Hobi</td>
						<td>:</td>
						<td id="hobi_detail">
						</td>
					</tr>
				</table>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	      	</div>
		    </div>
		  </div>
		</div>

		<!-- modal popup untuk edit -->
		<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="formEdit">
	      	@csrf
	      	<div class="modal-body">
	      	<input type="hidden" name="id_edit" id="id_edit">
				<table>
					<tr>
						<td>Nama Lengkap</td>
						<td>:</td>
						<td>
							<input type="text" id="nama_lengkap_edit" name="nama_lengkap_edit">
						</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>:</td>
						<td>
							<input type="text" id="tanggal_lahir_edit" name="tanggal_lahir_edit" autocomplete="off">
						</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td>
							<select id="jenis_kelamin_edit" name="jenis_kelamin_edit">
								<option value="">-PILIH-</option>
								@foreach($genders as $gender) <!-- perulangan array -->
								<option value="{{ $gender->gender }}">{{ $gender->gender }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>Hobi</td>
						<td>:</td>
						<td>
							@foreach($hobbys as $hobby)
							<input type="checkbox" value="{{ $hobby->hobi }}" name="hobi_edit[]">{{ $hobby->hobi }} 
							@endforeach
						</td>
					</tr>
				</table>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	        	<button type="submit" class="btn btn-primary">Update</button>
	      	</div>
			</form>
		    </div>
		  </div>
		</div>

		<!-- modal popup delete -->
		<div class="modal fade" id="modal_delete">
			<div class="modal-dialog">
				<div class="modal-content" style="margin-top: 100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<h4 class="modal-title" style="text-align: center;">Yakin mau diapus?</h4>
					</div>
					<div class="modal-footer" style="margin: 0px; border-top: 0px; text-align: center;">
						<button class="btn btn-danger" id="delete_button">Delete</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

	<!-- div penutup class container -->
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
 		$("#tanggal_lahir").datepicker({
     		autoclose: true,
     		format: 'yyyy-mm-dd'
     		//todayHighlight: true,
  		});

  		$("#tanggal_lahir_edit").datepicker({
     		autoclose: true,
     		format: 'yyyy-mm-dd'
     		//todayHighlight: true,
  		});

 		$('#bioTable').DataTable({
 			processing : true,
 			serverside : true,
 			ajax:{
 				url: "/informasi",
 			},
 			columns:[
 				{
 					data : 'nama_lengkap',
 					name : 'nama_lengkap'
 				},
 				// {
 				// 	data : 'tanggal_lahir',
 				// 	name : 'tanggal_lahir'
 				// },
 				// {
 				// 	data : 'jenis_kelamin',
 				// 	name : 'jenis_kelamin'
 				// },
 				// {
 				// 	data : 'hobi',
 				// 	name : 'hobi'
 				// },
 				{
 					data : 'action',
 					name : 'action',
 					orderable : false
 				}
 			]
 		});

		$('#modalBiodata').on('hidden.bs.modal', function(e){
			$('#nama_lengkap').val('');
			$('#tanggal_lahir').val('');
			$('#jenis_kelamin').val('');
			$('input[type=checkbox').prop('checked', false);	
		});

		$('#ModalEdit').on('hidden.bs.modal', function(e){
			$('#nama_lengkap_edit').val('');
			$('#tanggal_lahir_edit').val('');
			$('#jenis_kelamin_edit').val('');
			$('input[type=checkbox').prop('checked', false);	
		});

		// edit
		$("#formBiodata").on("submit", function(event){
			event.preventDefault();
			// if($("$action").val() == "add") {
				$.ajax({
					url:"/biodata/add",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success:function(data){
						var html ='';
						$("#modalBiodata").modal('hide');
						if (data.errors) {
							html = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
							for(var count =0; count < data.errors.length; count++){
								html+='<p>'+data.errors[count]+'<p>';
							}

							html+='</div>';
						}
						if (data.success) {
							html ='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+data.success+'</div>';
							// $("#bioTable")[0].reset();
							$("#bioTable").DataTable().ajax.reload();
						}
						$("#form_result").html(html);
					}
				});
			// }
		});



		// update
		$("#formEdit").on("submit", function(event){
			event.preventDefault();
			// if($("$action").val() == "add") {
				$.ajax({
					url:"/biodata/update",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success:function(data){
						var html ='';
						$("#ModalEdit").modal('hide');
						if (data.errors) {
							html = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
							for(var count =0; count < data.errors.length; count++){
								html+='<p>'+data.errors[count]+'<p>';
							}

							html+='</div>';
						}
						if (data.success) {
							html ='<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+data.success+'</div>';
							// $("#bioTable")[0].reset();
							$("#bioTable").DataTable().ajax.reload();
						}
						$("#form_result").html(html);
					}
				});
			// }
		});

		// edit
		$(document).on('click','.edit',function(){
			var id = $(this).attr('id');
			// alert(id);
			$.ajax({
				url:"/biodata/"+id+"/edit",
				dataType: "json",
				success:function(html){
					$("#id_edit").val(html.data.id);
					$("#nama_lengkap_edit").val(html.data.nama_lengkap);
					$("#tanggal_lahir_edit").val(html.data.tanggal_lahir);
					$("#jenis_kelamin_edit").val(html.data.jenis_kelamin);
 
					var arrayValues = html.data.hobi.split(',');
					$.each(arrayValues, function(i, val){
						$("input[value='" + val + "']").prop('checked', true);
					});


					// $("#hidden_id").val(html.data.id);
					// $("#.title-form").text("Edit New Record");
					// $("#action").val("edit");
					// $("#action_button").text("Edit");
					$("#ModalEdit").modal("show");
				}
			});
		});

		// detail
		$(document).on('click','.detail',function(){
			var id = $(this).attr('id');
			// alert(id);
			$.ajax({
				url:"/biodata/"+id+"/edit",
				dataType: "json",
				success:function(html){
					$("#nama_lengkap_detail").text(html.data.nama_lengkap);
					$("#tanggal_lahir_detail").text(html.data.tanggal_lahir);
					$("#jenis_kelamin_detail").text(html.data.jenis_kelamin);
					$("#hobi_detail").text(html.data.hobi);

					$("#modalDetail").modal("show");
				}
			});
		});

		// delete
		var id_delete;
		$(document).on('click','.delete',function(){
			id_delete = $(this).attr('id');
			$('#modal_delete').modal('show');
		});

		// action delete
		$("#delete_button").click(function(){
			$.ajax({
				url:"/biodata/destroy/"+id_delete,
				beforeSend:function(){
					$("#delete_button").text('Deleting...');
				},
				success:function(){
					setTimeout(function(){
						$("#modal_delete").modal('hide');
						$("#delete_button").text('OK');
						$("#bioTable").DataTable().ajax.reload();
					},500);
				}
			});
		});
	});
</script>
</html>