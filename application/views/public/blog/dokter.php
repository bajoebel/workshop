<section id="doctor" class="home-section bg-gray paddingbot-30">
	<div class="container marginbot-50">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="section-heading text-center">
						<h2 class="h-bold">Dokter</h2>
						<p></p>
					</div>
				</div>
				<div class="divider-short"></div>
			</div>
		</div>
	</div>

	<div class="container">
        <?php 
        $header="<div id=\"filters-container\" class=\"cbp-l-filters-alignLeft\">
                    <div data-filter=\"*\" class=\"cbp-filter-item-active cbp-filter-item\">All (<div class=\"cbp-filter-counter\"></div>)
                </div>";
        $spesialis="";
        $list_dokter="";
        //print_r($dokter);
        $jmlDokter=0;
        foreach ($dataDokter as $d) {
            if($spesialis!=$d->spesialis_nama){
                $header.="<div data-filter=\".spesialis" .$d->spesialis_id ."\" class=\"cbp-filter-item\">" .$d->spesialis_nama ." (<div class=\"cbp-filter-counter\"></div>)</div>";
                $spesialis=$d->spesialis_nama;
                
            }
            if(empty($d->dokter_fhoto)) $fhoto=base_url() ."images/dokter/default.png";
            else $fhoto=base_url() ."images/dokter/thumb/thumb_" .$d->dokter_fhoto;
            $list_dokter.="<li class=\"cbp-item spesialis" .$d->spesialis_id ."\">
                        <a href=\"" .base_url() ."profile/" .$d->dokter_id ."\" class=\"cbp-caption cbp-singlePage\">
                            <div class=\"cbp-caption-defaultWrap\">
                                <img src=\"" .$fhoto ."\" alt=\"\" width=\"100%\">
                            </div>
                            <div class=\"cbp-caption-activeWrap\">
                                <div class=\"cbp-l-caption-alignCenter\">
                                    <div class=\"cbp-l-caption-body\">
                                        <div class=\"cbp-l-caption-text\">VIEW PROFILE</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href=\"" .base_url() ."blog/view_profile/" .$d->dokter_id ."\" class=\"cbp-singlePage cbp-l-grid-team-name\">" .$d->dokter_nama ."</a>
                        <div class=\"cbp-l-grid-team-position\">" .$d->spesialis_nama ."</div>
                    </li>";
        }
        ?>
		<div class="row">
			<div class="col-lg-12">
                <?php echo $header; ?>
				<!--div id="filters-container" class="cbp-l-filters-alignLeft">
					<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All (<div class="cbp-filter-counter"></div>)
                </div>
                <div data-filter=".cardiologist" class="cbp-filter-item">Cardiologist (<div class="cbp-filter-counter"></div>)</div>
                <div data-filter=".psychiatrist" class="cbp-filter-item">Psychiatrist (<div class="cbp-filter-counter"></div>)</div>
                <div data-filter=".neurologist" class="cbp-filter-item">Neurologist (<div class="cbp-filter-counter"></div>)</div-->
            </div>

            <div id="grid-container" class="cbp-l-grid-team">
                <ul>
                    <?php echo $list_dokter; ?>
                    <!--li class="cbp-item psychiatrist">
                        <a href="doctors/member1.html" class="cbp-caption cbp-singlePage">
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?php echo base_url() ."medicio/"; ?>img/team/1.jpg" alt="" width="100%">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">VIEW PROFILE</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="doctors/member1.html" class="cbp-singlePage cbp-l-grid-team-name">Alice Grue</a>
                        <div class="cbp-l-grid-team-position">Psychiatrist</div>
                    </li>
                    <li class="cbp-item cardiologist">
                        <a href="home" class="cbp-caption cbp-singlePage">
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?php echo base_url() ."medicio/"; ?>img/team/2.jpg" alt="" width="100%">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">VIEW PROFILE</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="home" class="cbp-singlePage cbp-l-grid-team-name">Joseph Murphy</a>
                        <div class="cbp-l-grid-team-position">Cardiologist</div>
                    </li>
                    <li class="cbp-item cardiologist">
                        <a href="doctors/member3.html" class="cbp-caption cbp-singlePage">
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?php echo base_url() ."medicio/"; ?>img/team/3.jpg" alt="" width="100%">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">VIEW PROFILE</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="doctors/member3.html" class="cbp-singlePage cbp-l-grid-team-name">Alison Davis</a>
                        <div class="cbp-l-grid-team-position">Cardiologist</div>
                    </li>
                    <li class="cbp-item neurologist">
                        <a href="doctors/member4.html" class="cbp-caption cbp-singlePage">
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?php echo base_url() ."medicio/"; ?>img/team/4.jpg" alt="" width="100%">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-text">VIEW PROFILE</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="doctors/member4.html" class="cbp-singlePage cbp-l-grid-team-name">Adam Taylor</a>
                        <div class="cbp-l-grid-team-position">Neurologist</div>
                    </li-->

                </ul>
            </div>
		</div>
	</div>
	<!--/div-->
</section>