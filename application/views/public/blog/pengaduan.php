<section id="partner" class="home-section paddingbot-60">	
	<div class="container ">
		<div class="row">
		<div class="col-md-12 my_text">
				<div id="content">
					<div class="judul text-center">
						<h1 class="h-bold">
							Pengaduan
						</h1>
					</div>
				</div>
				<div class="isi">
					<div class="row">
						<div class="col-md-12">
							<form role="form" class="lead" id="form" method="POST" action="#">
								<h3>Data Pasien</h3>
								<hr>
								<div class="col-sm-12">
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12 col-sm-4 col-md-4">
												<label>Nomr</label>
											</div>
											<div class="col-xs-12 col-sm-4 col-md-4">
												<div class="input-group">
												<input type="text" name="pengaduan_nomr" maxlength="6" id="nomr" class="form-control input-md">
												<span class="input-group-btn">
													<button class="btn btn-success" type="button" onclick="cariPasien()">Cari</button>
												</span>
												</div>
												
												
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Nama Pasien</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="pengaduan_namapasien" maxlength="6" id="pengaduan_namapasien" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Alamat Pasien</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<textarea class="form-control" name="pengaduan_alamatpasien" id="pengaduan_alamatpasien"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Tanggal Lahir Pasien</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="pengaduan_tgllahir"   id="pengaduan_tgllahir" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Tempat Pasien Dirawat</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="pengaduan_tempatrawat" id="pengaduan_tempatrawat" class="form-control input-md">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Status Pasien</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="radio" name="pengaduan_jenislayanan"  id="rawat_inap" value="Rawat Inap"> Rawat Inap<br>
												<input type="radio" name="pengaduan_jenislayanan"  id="rawat_jalan" value="Rawat Jalan"> Rawat Jalan<br>
												<input type="radio" name="pengaduan_jenislayanan"  id="igd" value="IGD"> IGD
											</div>
										</div>
									</div>
								</div>
								<h3>Pelapor</h3>
								<hr>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Nama Pelapor</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="pengaduan_namapelapor" maxlength="6" id="pengaduan_namapelapor" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>No Telp</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="pengaduan_notelp" id="pengaduan_notelp" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Email</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<input type="text" name="pengaduan_email" id="pengaduan_email" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Hubungan Dengan Pasien</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<select class="form-control" name="pengaduan_hubungan">
													<option value="Diri Sendiri">Disi Sendiri</option>
													<option value="Keluarga">Keluarga</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label>Kronologis</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<textarea class="form-control" name="pengaduan_kronologis"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-4 col-md-4">
											<label></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<div class="form-group">
												<button class="btn btn-skin btn-lg" type="button" onclick="kirimPengaduan()">Simpan</button>
											</div>
										</div>
									</div>
								</div>
								
							</form>
						</div>
						
					</div>
					
				</div>
			</div>
			
		</div>
	</div>

	
</section>	
<script type="text/javascript">
	function cariPasien(){
		var nomr=$('#nomr').val();
		var url="<?php echo base_url() ."welcome/pasien?nomr="; ?>" + nomr;
		console.log(url);
		$.ajax({
			url 	: url,
			type 	: "GET",
			dataType: "json",
			data 	: {get_param : 'value'},
			success : function(data){
				//console.log(data);
				if(data==null){
					alert("Data anda tidak ditemukan, \n namun anda masih tetap bisa melanjutkan pengaduan \n Kami akan mengecek kembali data anda");
					$('#pengaduan_namapasien').val("");
					$('#pengaduan_alamatpasien').val("");
					$('#pengaduan_tgllahir').val("");
					$('#pengaduan_namapasien').prop('readonly', false);
					$('#pengaduan_alamatpasien').prop('readonly', false);
					$('#pengaduan_tgllahir').prop('readonly', false);
					$('#pengaduan_namapasien').focus();
				}else{
					$('#pengaduan_namapasien').val(data.nama);
					$('#pengaduan_alamatpasien').val(data.alamat);
					$('#pengaduan_tgllahir').val(data.tgl_lahir);
					$('#pengaduan_namapasien').prop('readonly', true);
					$('#pengaduan_alamatpasien').prop('readonly', true);
					$('#pengaduan_tgllahir').prop('readonly', true);
					$('#pengaduan_tempatrawat').focus();
				}
			}
		});
	}

	function kirimPengaduan(){
		var url;
        url = "<?php echo base_url() ."welcome/kirimpengaduan" ?>";
        
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: 'JSON',
            success: function(data)
            {
            	alert(data["message"]);
            	if(data["status"]==true){
            		location.reload(); 
            	}
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert(url);
                show_notif('Error','Error Saat Penyimpanan Data','danger');
            }
        });
        return true;
	}
</script>