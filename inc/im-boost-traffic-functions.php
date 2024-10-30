<?php
add_action('wp_ajax_im_boost_traffic_dismiss_message', 'imBoostTrafficDismissMessage' );
function imBoostTrafficDismissMessage(){
    check_ajax_referer( 'im_boost_traffic_security_ajax', 'security');
    update_option('im_boost_traffic_dismiss_message',IM_BOOST_TRAFFIC_VERSION);
    die();
}

add_action( 'admin_notices', 'imBoostTrafficAdminNotice');
function imBoostTrafficAdminNotice(){
    $security = wp_create_nonce( "im_boost_traffic_security_ajax" );
    $current_user = wp_get_current_user();

    if(get_option('im_boost_traffic_dismiss_message') != IM_BOOST_TRAFFIC_VERSION) {
        echo '<div class="im-boost-traffic-notice info boost-notice-info notice">';
        echo '<div class="im-boost-traffic-logo"><img src='.plugins_url('/boost-traffic/assets/images/boost-logo.png').' alt="Boost Your Website!" /></div>'
            . '<div class="im-boost-traffic-des">';
        echo '<p>' . __('<span style="font-weight: bold;">Thanks for using <b>Boost Traffic!</b> </span>', 'im-boost-traffic');
        echo '<a type="button" class="im-boost-traffic-settings-button button button-primary" href="'.esc_url( get_admin_url(null, 'options-general.php?page='.IM_BOOST_TRAFFIC_ADMIN_SLUG) ).'">'. __('Settings', 'im-boost-traffic').'</a> ';
    
        echo '</p>';
        echo '<button type="button" class="im-boost-traffic-dismiss-notice notice-dismiss"><span class="screen-reader-text">'. __('Dismiss this notice.', 'im-boost-traffic').'</span></button>';
        echo '</div>';
         echo '<div style="clear:both"></div>';
        echo '</div>';

        echo '  <script>
                    jQuery(function(){
                        jQuery(".im-boost-traffic-dismiss-notice").on("click", function(){
                            jQuery(".im-boost-traffic-notice").fadeOut();
                            
                            jQuery.ajax({
                                type: "post",
                                url: "'.admin_url( 'admin-ajax.php' ).'",
                                data: {action: "im_boost_traffic_dismiss_message", security: "'.$security.'"}
                            })                        
                                    
                        })                    
                    })
                </script>';
        }
    echo '
    <style> .im-boost-traffic-notice p{ margin:0px;}   
            .im-boost-traffic-logo img{ width: 100%;}
            .im-boost-traffic-logo{ float: left; width:10%;}
            .im-boost-traffic-des{ float: left; width:60%; margin-left:1%;}
            .im-boost-traffic-notice{
                background-color: #fff;
                background-image: url('.plugins_url('/boost-traffic/assets/images/background-footer.png').');
                background-position: right;
                color: #000;
                position:relative;
                padding:10px;
           
            }
            .im-boost-traffic-settings-button{background: #7CD9C8!important; margin-left:10px;}
            
            .boost-notice-info{
                    border-left-color: #2EB4CE;
            }

            .im-boost-traffic-settings-button:before{
                background: 0 0;
                color: #fff;
                content: "\f111";
                display: block;
                font: 400 16px/20px dashicons;
                speak: none;
                height: 29px;
                text-align: center;
                width: 16px;
                float: left;
                margin-top: 3px;
                margin-right: 4px;
            }
            
            .im-boost-traffic-addons-button:before{
                background: 0 0;
                color: #fff;
                content: "\f106";
                display: block;
                font: 400 16px/20px dashicons;
                speak: none;
                height: 29px;
                text-align: center;
                width: 16px;
                float: left;
                margin-top: 3px;
                margin-right: 4px;
            }
            .im-boost-traffic-addons-button, .im-boost-traffic-addons-button:visited,.im-boost-traffic-addons-button:active{
                background: #FB5895 !important;
                border-color: #FB5895 !important; 
                color: #fff !important;
                text-decoration: none !important;
                text-shadow: none!important;
                box-shadow: none !important;
            }
            
            .im-boost-traffic-addons-button:hover{
                background:#2EB4CE  !important;
                border-color: #2EB4CE  !important; 
            }
            
            .im-boost-traffic-dismiss-notice:hover:before, .im-boost-traffic-dismiss-notice:focus:before, .im-boost-traffic-dismiss-notice:visited:before{
                color:#E5E34F !important;
            }
            
            .im-boost-traffic-notice a{ color: #2EB4CE; font-weight: bold; }
    </style>';

}

/**
* Create a Checkbox input field
*/
function imBoostTrafficCheckbox($id,$optionname,$filter="") {
   $options = get_option( $optionname );
 
   $checked = false;
   if ( isset($options[$id]) && $options[$id] == 'on' )
       $checked = true;
   return '<input '.$filter.' type="checkbox" id="'.$id.'" name="'.$id.'"'. checked($checked,true,false).'/>';
}
 
/**
* Create a Text input field
*/
function imBoostTrafficTextInput($id,$optionname,$imtype="text", $inputText = "") {
   $options = get_option( $optionname );
  $val = '';
   if ( isset( $options[$id] ) )
       $val = $options[$id];
   return '<input class="text" type="'.$imtype.'" id="'.$id.'" name="'.$id.'" size="38" value="'.$val.'"/>'.$inputText;
}

/**
* Create a Text input field
*/
function imBoostTrafficTextArea($id,$r,$c,$optionname) {
   $options = get_option( $optionname );
   $val = '';
   if ( isset( $options[$id] ) )
       $val = $options[$id];
   return '<textarea class="textarea" id="'.$id.'" name="'.$id.'" rows="'.$r.'" cols="'.$c.'">'.$val.'</textarea>';
}

/**
 * Create a dropdown field
 */
function imBoostTrafficSelect($id, $options, $multiple = false, $state = "", $msg = "",$optionname) {
    $opt = get_option($optionname);
    $output = '<select class="select" name="'.$id.'" id="'.$id.'" '.$state.'>';
    foreach ($options as $val => $name) {
        $sel = '';
        if ($opt[$id] == $val)
            $sel = ' selected="selected"';
        if ($name == '')
            $name = $val;
        $output .= '<option value="'.$val.'"'.$sel.'>'.$name.'</option>';
    }
    $output .= '</select><label><i>'.$msg.'</i></label>';
    return $output;
}
        
/**
 * Create a potbox widget
 */
function imBoostTrafficPostbox($id, $title, $content) {
?>
    <div id="<?php echo $id; ?>">
        <h3 class="hndle"><span><?php echo $title; ?></span></h3>
        <div class="inside">
            <?php echo $content; ?>
        </div>
    </div>
<?php
}   


/**
 * Create a form table from an array of rows
 */
function imBoostTrafficFormTable($rows) {
    $content = '<table class="form-table">';
    $i = 1;
    foreach ($rows as $row) {
        $class = '';
        if ($i > 1) {
            $class .= 'yst_row';
        }
        if ($i % 2 == 0) {
            $class .= ' even';
        }
        $content .= '<tr id="'.$row['id'].'_row" class="'.$class.'"><th valign="top" scrope="row">';
        if (isset($row['id']) && $row['id'] != '')
            $content .= '<label for="'.$row['id'].'">'.$row['label'].':</label>';
        else
            $content .= '<h2>'.$row['label'].'</h2>';
        $content .= '</th><td valign="top" ';
                if ( !isset($row['content2']) && empty($row['content2']) ) {
             $content .= "colspan=2";         
                }
        $content .= '>';
        $content .= $row['content'];
        $content .= '</td>';
        if ( isset($row['content2']) && !empty($row['content2']) ) {
            $content .= '<td>'.$row['content2'].'</td>';
        }       
            $content .= '</tr>'; 
        if ( isset($row['desc']) && !empty($row['desc']) ) {
            $content .= '<tr class="'.$class.'"><td colspan="2" class="yst_desc"><small>'.$row['desc'].'</small></td></tr>';
        }

        $i++;
    }
    $content .= '</table>';
    return $content;
}

function imBoostTrafficTextLimit( $text, $limit, $finish = ' [&hellip;]') {
    if( strlen( $text ) > $limit ) {
        $text = substr( $text, 0, $limit );
        $text = substr( $text, 0, - ( strlen( strrchr( $text,' ') ) ) );
        $text .= $finish;
    }
    return $text;
}
        
function imBoostTrafficGetDateFormat( $date, $format) {
    $timelineDate = explode("-", $date);

    if ($format == 'yy') {
        return $timelineDate[0];
    } elseif ($format == 'yy/mm') {
        return $timelineDate[0]."/".$timelineDate[1];
    } elseif ($format == 'mm/yy') {
        return $timelineDate[1]."/".$timelineDate[0];
    } else  {
        return "";
    }
}       