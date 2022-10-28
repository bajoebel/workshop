  <style>
    .box{
      width:100%
    }
  </style>
  <section id="service" class="home-section paddingtop-80">

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="form-wrapper">
            <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <span class="fa fa-pencil-square-o"></span> Ketersediaan Tempat Tidur
                    <small><i>
                        <font color="fff">Online</font>
                      </i></small>
                  </h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <?php if (empty($setting)) $mode = "Tabel";
                    else $mode = $setting->display_mode; ?>

                    <div class="col-md-12">
                      <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>">
                      <input type="hidden" name="txt" id="txt" value="0">
                      <div id="block">BLOK</div>
                      <div id="tabel">TABEL</div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
