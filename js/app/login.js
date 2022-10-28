function login(){
    var username=$('#username').val();
    var password=$('#password').val();
    var opt1=$('#opt1').html();
    var opt2=$('#opt2').html();
    var jml=parseInt(opt1)+parseInt(opt2);
    var jawaban = $('#jawaban').val();
    
    if(username=="" || password==""){
        if(username=="") $('#err_username').html('Username masih kosong'); else $('#err_username').html('');
        if(password=="") $('#err_password').html('Password masih kosong'); else $('#err_password').html('');
        return false;
    }else{
        $('#err_username').html('');
        $('#err_password').html('');
    }
    if(jml!=jawaban) {
        $('#err_jawaban').html('Jawaban yang anda masukkan salah'); 
        return false;
    }else {
        $('#err_jawaban').html('');
    }
    var url = base_url + "welcome/cekuser";
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            if (data.status == true) {
                window.location.href=base_url+'admin/dasboard';
            }
            else {
                sweetAlert({
                    title: "Peringatan",
                    text: data.message,
                    type: "warning",
                    timer: 5000
                });
                $('#message').html('<div class="alert alert-danger">' +
                '<strong>Error!</strong> '+data.message+'</div>');
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#message').html('<div class="alert alert-danger">' +
                '<strong>Error!</strong> Error Saat koneksi ke database </div>');
        }
    });
}