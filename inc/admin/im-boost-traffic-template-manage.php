<?php
function imBoostTrafficTemplateManage() {    ?>

	<div class="wrap options-im-boost-traffic">
        <div class="wrap">
            <div id="icon-themes" class="icon32"></div>

			<div class="im-boost-traffic-container" id="postbox-container-2">
                            
                            <div class="meta-box-sortables ui-sortable">

                                         
                                            <h2 class="nav-tab-wrapper" id="im-admin-tabs">
                                                <a class="nav-tab" id="general-tab" href="#top#general"><?php _e( 'Boost Traffic >>', 'im-boost-traffic' );?></a>
                                              
                                            </h2>
                                            <div class="tabwrapper">
                                                <div id="general" class="im-tab">
                                                   <?php include(IM_BOOST_TRAFFIC_BASE_PATH.'/inc/admin/tabs/im-boost-traffic-general.php'); ?>
                                                </div>			   
                                            </div>
					
				</div>
			</div>
                        <div class="im-boost-traffic-container" id="im-boost-traffic-container-market" style="text-align: center; background: #FFF; border-top: 3px solid; float:left">
                            <div id="side-sortables" class="meta-box-sortables ui-sortable">
			        <h3 class="im-boost-traffic-promo"><span><strong><?php _e( 'Boost is a new way to market new websites without being bogged down by expensive and complex marketing campaigns.', 'im-boost-traffic' )?></strong></span></h3>
                                <a class="im-boost-traffic-button" target="_blank" href="<?php echo IM_BOOST_TRAFFIC_WEBSITE_URL; ?>">
                                    <?php _e( 'Boost Traffic Website', 'im-boost-traffic' )?>
                                </a>
                                <p><?php _e( 'If You Like Leaving Reviews:', 'im-boost-traffic' )?></p>
                                <ul>
                                    <li><a target="_blank" href="https://wordpress.org/plugins/boost-traffic"><?php _e( 'Please Consider Giving Boost Traffic A 5★ On WordPress.org', 'im-boost-traffic' )?></a></li>
                                    <li><?php printf( __( 'Any issues, please reach out to the support team %1$ssupport@boost-traffic.io%2$s', 'im-boost-traffic' ), '<a target="_blank" href="mailto:support@boost-traffic.io">', '</a>')?></li>
                                </ul>
                                <div class="im-boost-traffic-copyright"> Boost-traffic.io® is a silicon valley, california based company and in operations since 2009.</div> 
                            </div>
                        </div>
                    
		</div>
	</div>	
<?php 
}
