var elem = document.getElementById("page-top");
    var c = 0;
    var t;
    var hitung = 0;
    var timer_is_on = 0;
    //var base_url = "<?php echo base_url() ?>";
    // var base_url = "<?= base_url(); ?>";
    //var mode=$('mode').val();
    //getDisplay();
    //getKamar(0);
    startCount();
    var c = 0;
    var mode = "";
    var interval = 1000;

    function timedCount() {
      //document.getElementById("txt").value = c;
      $('#txt').val(c);
      //if(mode!=$('#mode').val()) c=0;
      var mode = $('#mode').val();
      if (mode == 'Tabel' || mode == 'Split') interval = 5000;
      else interval = 1000;
      var limit =   20;
      var jmlData = 100;
      //alert(jmlData);
      if (c == jmlData % limit) c = 1;
      else c = c + 1;
      if (c == 1) {
        //alert("Full");
        // show_full();
      }
      t = setTimeout(timedCount, interval);
      //console.clear();
      //hitung++;
      //console.log(c);
      //if(c%5==0) getKelas();
      getDisplay();
      //getKamar(c);
    }

    function getDisplay() {
      var search;
      var url = base_url + "welcome/mode";
      console.log(url);
      $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {
          get_param: 'value'
        },
        success: function(data) {
          $('#mode').val(data["display_mode"])
          if (data["display_mode"] == "Block") {
            $('#tabel').removeClass("col-md-6");
            $('#block').removeClass("col-md-6");
            $('#tabel').hide();
            $('#block').show();
            getRuangan();
          } else if (data["display_mode"] == "Tabel") {
            //(c);
            $('#tabel').removeClass("col-md-6");
            $('#block').removeClass("col-md-6");
            $('#tabel').show();
            $('#block').hide();
            getKamar(c);
          } else {
            getRuangan();
            getKamar(c);
            $('#tabel').addClass("col-md-6");
            $('#block').addClass("col-md-6");
            $('#tabel').show();
            $('#block').show();
          }
        }
      });
    }

    
    function getRuangan() {
      //alert("test");
      var url = base_url + "welcome/ruangan";
      //console.log(url);
      $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {
          get_param: 'value'
        },
        success: function(data) {
          var kelas = data["kelas"];
          var ruang = data["ruang"];
          console.log(ruang);
          var jmlData = ruang.length;
          var display = "";
          var total_welcome = 0;
          var terisi = 0;
          var tersedia = 0;
          var style_ruang = 'nama_ruang';
          var style_total = 'bulat';
          var style_kelas = 'kelas';
          var style_jumlah = 'jumlah';
          var mode = $('#mode').val();
          if (mode == 'Split') {
            style_ruang = 'split_nama_ruang';
            style_total = 'split_bulat';
            style_kelas = 'split_kelas';
            style_jumlah = 'split_jumlah';
          } else {
            style_ruang = 'nama_ruang';
            style_total = 'bulat';
            style_kelas = 'kelas';
            style_jumlah = 'jumlah';
          }
          var offset = 0;
          var jmlkelas = kelas.length;
          //console.log("JML KELAS : "+jmlkelas);
          var selisih = jmlkelas - parseInt(data["jmlkelas"]);
          //console.log("Selisih : "+data["jmlkelas"] +" - " +jmlkelas + " = "+ selisih);
          var str;
          var grandtot = 0;
          var grandtotterisi = 0;
          var grandtotkosong = 0;
          for (var i = 0; i < jmlData; i++) {
            total_welcome = parseInt(ruang[i]["jml_tt"]);
            grandtot += total_welcome;
            //console.log(total_welcome);
            //if(i==0) display+="<div class='col-md-1'></div>";
            if (mode == 'Block') var col = 'col-md-3';
            else col = 'col-xs-4';
            offset = i % 5;
            if (total_welcome > 0) {
              display += '<div class="' + col + ' shadow">';
              display += '<div class="box box-primary box-solid ">';
              display += '<div class="row">';
              display += '<div class="col-md-12">';
              display += '<div class=" col-md-12 bg-primary ' + style_ruang + '">';
              str = ruang[i]["nama_ruang"];
              //console.log(nama_ruang);
              //nama_ruang.replace("RUANGAN ", " ");
              str.replace("RUANGAN", "")
              console.log(str)
              display += str;
              //display += '<b class="' + style_total + '">' + total_welcome + '</b>';
              display += '</div>';
              display += '</div>';
              display += '<div class="col-md-12">';
              //Display Kelas
              var kosong = 0;
              var konten_kosong = '';
              var totsemua = 0;
              var tot_terisi = 0;
              var tot_kosong = 0;
              var kosong_mata = 0;
              for (var j = 0; j < jmlkelas; j++) {
                totsemua += parseInt(ruang[i]['jml_tt_' + kelas[j]["kode"]]);

                if (parseInt(ruang[i]['jml_tt_' + kelas[j]["kode"]]) > 0) {
                  terisi = parseInt(ruang[i]['tlk_' + kelas[j]["kode"]]) + parseInt(ruang[i]['tpr_' + kelas[j]["kode"]]);
                  grandtotterisi += terisi;
                  tot_terisi += terisi;
                  tersedia = parseInt(ruang[i]['jml_tt_' + kelas[j]["kode"]]) - terisi;
                  grandtotkosong += tersedia;
                  tot_kosong += tersedia;
                  display += '<div class="col-md-6 ' + style_kelas + ' ">' + kelas[j]["alias"] + '</div>';
                  display += '<div class="col-md-2 bg-blue ' + style_jumlah + ' text-center" >' + parseInt(ruang[i]['jml_tt_' + kelas[j]["kode"]]) + '</div>';
                  display += '<div class="col-md-2 bg-green ' + style_jumlah + ' text-center" >' + tersedia + '</div>';
                  display += '<div class="col-md-2 bg-red ' + style_jumlah + ' text-center" >' + terisi + '</div>';
                } else {
                  kosong++;

                  //alert(ruang[i]["idx"]);
                  // console.log(ruang[i].id_ruang + " kosong")
                  if (kosong > selisih) {
                    //console.clear();
                    console.log(kosong_mata);
                    if (ruang[i]["id_ruang"] == 55) {
                      //kosong mata
                      kosong_mata += 1;
                      console.log('Kosong Mata : ' + kosong_mata);
                    } else {
                      kosong_mata = 0;
                    }
                    if (kosong_mata > 0 && kosong_mata <= 1) {
                      konten_kosong += "";
                      console.log(kosong_mata + " adalah > 0 Dan Kecil dari 2");
                      //console.log("Konten Kosong Mata " + kosong_mata);
                      //alert("disini");
                    } else {
                      console.log(kosong_mata + " adalah > 0 Dan Kecil dari 2");
                      konten_kosong += '<div class="col-md-12 ' + style_kelas + ' ">&nbsp;</div>';
                    }
                  }
                }
              }
              display += konten_kosong;
              display += '<div class="col-md-6 bg-gray ' + style_kelas + ' ">JUMLAH</div>';
              display += '<div class="col-md-2 bg-blue ' + style_jumlah + ' text-center" >' + totsemua + '</div>';
              display += '<div class="col-md-2 bg-green ' + style_jumlah + ' text-center" >' + tot_kosong + '</div>';
              display += '<div class="col-md-2 bg-red ' + style_jumlah + ' text-center" >' + tot_terisi + '</div>';


              display += '</div></div></div></div>';
              if (mode == 'Block') {
                if (i % 4 == 3) display += "<div class='row'></div>";
              } else {
                if (i % 2 == 1) display += "<div class='row'></div>";
              }

            }
          }
          //alert(mode);

          if (mode == "Block") {
            //display+='<div class="row"></div>';
            //display+="";
            display += '<div class="col-md-12 shadow">';
          } else {
            display += '<div class="col-md-12 shadow">';
          }

          display += '<div class="">';
          display += '<div class="row">';
          display += '<div class="col-md-12 text-center" >';
          display += '<div class=" col-md-1 bg-green text-center ' + style_ruang + '">' + grandtotkosong + '</div>';
          display += '<div class=" col-md-1 text-center ' + style_ruang + '"><b> = Kosong</b></div>';
          display += '<div class=" col-md-1 bg-red text-center ' + style_ruang + '">' + grandtotterisi + '</div>';
          display += '<div class=" col-md-1 ' + style_ruang + '"><b> = Terisi</b></div>';
          display += '<div class=" col-md-1 bg-blue text-center ' + style_ruang + '">' + grandtot + '</div>';
          display += '<div class=" col-md-2 ' + style_ruang + '"><b> = Total Tempat Tidur</b></div>';
          //display += '<div class=" col-md-1 bg-blue ' + style_ruang + '"><div class="bulat" style="width:100%">&nbsp;</div></div>';
          //display += '<div class=" col-md-5 ' + style_ruang + '"><b> = Jumlah Tempat Tidur</b></div>';
          display += '</div>';
          display += '</div>';
          display += '</div>';
          display += '</div>';
          $('#block').html(display);
        }
      });
    }

    function startCount() {
      if (!timer_is_on) {
        timer_is_on = 1;
        timedCount();
      }
    }

    function getKelas() {
      var search;
      var url = base_url + "welcome/datakelas";
      //console.clear();
      //console.log(url);
      $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {
          get_param: 'value'
        },
        success: function(data) {
          //console.log(data);
          var jmlData = data.length;
          var kelas = "";
          var a = 0;
          var style = 'box-info';
          var welcometersedia = 0;
          var welcometerisi = 0;
          var welcomekosong = 0;
          for (var i = 0; i < jmlData; i++) {

            a = i + 1;
            if (a == 1 || a % 3 == 1) style = 'box-info';
            if (a == 2 || a % 3 == 2) style = 'box-warning';
            if (a == 3 || a % 3 == 0) style = 'box-danger';
            welcometersedia = (parseInt(data[i]["kapasitas_pria"]) + parseInt(data[i]["kapasitas_wanita"]) + parseInt(data[i]["kapasitas_priawanita"])) - parseInt(data[i]["welcome_rusak"]);
            welcometerisi = parseInt(data[i]["terisi_pria"]) + parseInt(data[i]["terisi_wanita"]) + parseInt(data[i]["terisi_priawanita"]);
            welcomekosong = welcometersedia - welcometerisi;
            //console.log(welcomekosong);
            kelas += "<div class=\"col-md-4\"><div class=\"box " + style + " box-solid\"><div class=\"box-header with-border text-center\"><h3 class=\"box-title \">" + data[i]["kelas_nama"] + "</h3></div><div class=\"box-body text-center \"><button class=\"btn btn-default btn-block\"><div class=\"font32 \">" + welcomekosong + "</div></button></div><div class=\"box-footer box-success text-center\"><h3>TERISI : " + welcometerisi + "</h3></div></div></div>";
          }
          $('#kelas').html(kelas);
          //console.log(kelas);
        }
      });
    }

    function getKamar(c) {
      var search;
      var url = base_url + "welcome/datakamar/" + c;
      //console.clear();
      //console.log(url);
      $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        data: {
          get_param: 'value'
        },
        success: function(data) {
          //console.log(data);
          var jmlData = data.length;
          var kelas = "";
          var a = 0;
          var style = 'box-info';
          var welcometersedia = 0;
          var welcometerisi = 0;
          var welcomekosong = 0;
          var no = 0;
          kelas += '<div class="col-md-12"><table class="table table-hover bordered" style="box-shadow: 5px 10px #a4e09b;font-size: 12pt;">';
          kelas += '<thead class="bg-green text-center">';
          kelas += '<tr>';
          kelas += '<th rowspan="2">#</th>';
          kelas += '<th rowspan="2">RUANGAN</th>';
          kelas += '<th rowspan="2">KELAS</th>';
          kelas += '<th rowspan="2">JML welcome</th>';
          kelas += '<th colspan="2" class="text-center">TERISI</th>';
          kelas += '<th rowspan="2" class="text-center">KOSONG</th>';
          kelas += '</tr>';
          kelas += '<tr>';
          kelas += '<th class="text-center">PRIA</th>';
          kelas += '<th class="text-center">WANITA</th>';
          kelas += '</tr>';
          kelas += '</thead>';
          kelas += '<tbody>';
          for (var i = 0; i < jmlData; i++) {
            jmlwelcome = parseInt(data[i]["total_TT"]);
            no = c;
            terpakai_male = parseInt(data[i]["terpakai_male"]);
            terpakai_female = parseInt(data[i]["terpakai_female"]);
            welcomekosong = jmlwelcome - terpakai_male - terpakai_female;
            if (welcomekosong == 0) bg = "bg-red";
            else bg = "bg-green";
            kelas += '<tr>';
            kelas += '<td>' + no + '</td>';
            kelas += '<td>' + data[i]["jenis_ruangan"] + '</td>';
            kelas += '<td>' + data[i]["kelas_perawatan"] + '</td>';
            kelas += '<td class="text-center bg-green">' + jmlwelcome + '</td>';
            kelas += '<td class="text-center">' + terpakai_male + '</td>';
            kelas += '<td  class="text-center">' + terpakai_female + '</td>';
            kelas += '<td  class="text-center ' + bg + '">' + welcomekosong + '</td></tr>';
            c++;
          }
          kelas += '</tbody></table></div>';
          $('#tabel').html(kelas);
          //console.log(kelas);
        }
      });
    }

    function stopCount() {
      clearTimeout(t);
      timer_is_on = 0;
    }

    // function show_full() {
    //   req = elem.requestFullScreen || elem.webkitRequestFullScreen || elem.mozRequestFullScreen;
    //   //req.call(elem);
    //   return req;
    //   //alert("SHOW FULL SCREEN");
    // }