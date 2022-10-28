<section id="partner" class="home-section paddingbot-60">	
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 my_text">
				<div id="content">
					<div class="judul text-center">
						<h1 class="h-bold">
							Kritik Dan Saran
						</h1>
					</div>
				</div>
				<div class="isi">
					<div class="row">
						<form role="form" class="lead" id="form" method="POST" action="#">
								
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>DESKRIPSI KRITIK DAN SARAN </label>
									<div class="form-group">
										<textarea name="kritik_desc" class="form-control" rows=10></textarea>
										
									</div>
								</div>

								<div class="col-sm-12" style="text-align: center;margin-bottom: 15px;">
									<div class="col-xs-3 col-sm-3 col-md-4">
										<img src="<?php echo base_url() .'rsud-backend/public/img/3.png'; ?>"><br>
										<input type="radio" name="kritik_penilaian" value="Puas">
									</div>
									<div class="col-xs-3 col-sm-3 col-sm-4">
										<img src="<?php echo base_url() .'rsud-backend/public/img/2.png'; ?>"><br>
										<input type="radio" name="kritik_penilaian" value="Tidak Puas">
									</div>
									<div class="col-xs-3 col-sm-3 col-md-4">
										<img src="<?php echo base_url() .'rsud-backend/public/img/1.png'; ?>"><br>
										<input type="radio" name="kritik_penilaian" value="Normal">
									</div>
									
								</div>
								<div class="col-sm-12" >
									<button class="btn btn-success btn-lg" type="button" onclick="simpanKritik()">Simpan</button>
								</div>
						</form>
					</div>
					
				</div>
			</div>
			
		</div>
    </div>
</section>	

<script type="text/javascript">
	function simpanKritik(){
		var url;
        url = "<?php echo base_url() ."welcome/simpankritik" ?>";
        
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
                alert(url);
                //show_notif('Error','Error Saat Penyimpanan Data','danger');
            }
        });
        return true;
	}
</script>