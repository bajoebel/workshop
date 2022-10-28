tinymce.init({
    selector: 'textarea#full-featured-non-premium',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons powerpaste',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    content_css: '//www.tiny.cloud/css/codepen.min.css',
    link_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
      { title: 'My page 1', value: 'http://www.tinymce.com' },
      { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
      { title: 'None', value: '' },
      { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    file_picker_callback: function (callback, value, meta) {
      /* Provide file and text for the link dialog */
      if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === 'image') {
        callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === 'media') {
        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
      }
    },
    templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
      { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
      { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 520,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
    images_upload_url: base_url+'admin/berita/upload',
    images_upload_base_path: ''
});
$(document).ready(function() {
    // $('#no_ktp').focus();
    $('#post_tglpublish').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    });
    $('#post_tglpublish').datepicker({
        autoclose : true,
        format    : "dd/mm/yyyy"
    }) 
    getData(1)
});
function add(){
    $('#tombol').hide();
    $('#form_box').show()
    $('#tabel_box').hide()
    tinyMCE.activeEditor.setContent('');
    // $('#form_box').addClass('col-md-4')
    // $('#tabel_box').removeClass('col-md-12');
    // $('#tabel_box').addClass('col-md-8');
}
function resetApp(){
    $('#tombol').show();
    $('#form_box').hide()
    $('#tabel_box').show()
    $('#post_id').val("");
    $('#post_judul').val("")
    tinyMCE.activeEditor.setContent('');
    $('#full-featured-non-premium').val("");
    $('#post_tglpublish').val("")
    $('#post_status_komen').prop('checked',false);
    $('#post_status').val("")
    $('#err_post_judul').html("")
    $('#err_post_status').html("")
    
}
function edit(post_id){
    add();
    $.ajax({
        url: base_url + "admin/berita/edit/" + post_id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if(data.status==true){
                $('#post_id').val(data.data.post_id);
                $('#post_judul').val(data.data.post_judul)
                tinyMCE.activeEditor.setContent(data.data.post_isi);
                $('#full-featured-non-premium').val(data.data.post_isi);
                $('#post_tglpublish').val(data.data.post_tglpublish)
                $('#post_kategori_id').val(data.data.post_kategori_id)
                // alert(data.data.post_status_komen)
                if(data.data.post_status_komen=='Aktif') $('#post_status_komen').prop('checked',true);
                else $('#post_status_komen').prop('checked',false);
                $('#post_status').val(data.data.post_status)
            }else{
                swal({
                    title: "Terjadi Kesalahan ",
                    text: data.message,
                    type: "error",
                    timer: 5000
                   });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error')
        }
    });
    // $('#post_id').val(post_id);
    // $('#post_judul').val(post_judul)
    // if(post_status=="Aktif") {
    //     $('#post_status').prop('checked',true);
    //     // alert("checked")
    // }
    // else  $('#post_status').prop('checked',false);
}

function hapus(id) {
    var isConfirm = confirm("Apakah anda yakin akan menghapus")
    if (isConfirm) {
        $.ajax({
            url: base_url + "admin/berita/hapus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var start=$('#start').val();
                getData(start);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error')
            }
        });
    }
}