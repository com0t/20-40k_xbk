<?php

$jltma_white_label_options = get_option( 'jltma_white_label_settings' );
?>

<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-white-label" style="display: none;">
    <div class="jltma-master-addons-features">
        <?php 
?>

        <div class="jltma-tab-dashboard-wrapper">
            <form action="" method="POST" id="jltma-addons-white-label-settings" class="jltma-addons-tab-settings" name="jltma-addons-white-label-settings">

                <?php 
?>
                    <div class="jltma-addons-white-label-notice">
                        <div class="jltma-addons-white-label-notice-content">
                            <div class="jltma-addons-white-label-notice-logo">
                                <img src="<?php 
echo  esc_url( JLTMA_IMAGE_DIR ) . 'logo.png' ;
?>" alt="Master Addons">
                            </div>
                            <h2><?php 
_e( 'Upgrade <span>Pro</span> for White Labeling', JLTMA_TD );
?></h2>
                            <p>
                                <?php 
_e( 'Master Addons can be completely re-branded with your own brand Logo, Name and Author Details. Your clients will never know what tools you are using to build their website and will think that this is your own tool set. White-labeling works as long as your license is active.', JLTMA_TD );
?><br>
                                <em><?php 
_e( 'Note: Developer Plans Only', JLTMA_TD );
?></em>
                            </p>
                            <a class="jltma-button jltma-get-pro" href="<?php 
echo  esc_url( 'https://master-addons.com/pricing/' ) ;
?>" target="_blank"><?php 
_e( 'Get PRO', JLTMA_TD );
?></a>
                        </div>
                    </div>
                <?php 
?>
                <div class="jltma-addons-dashboard-tabs-wrapper">
                    <div class="jltma-master-addons-dashboard-filter is-flex">
                        <!-- Start of White Label Settings -->
                        <div class="jltma-api-settings-element jltma-half">
                            <h4><?php 
echo  esc_html__( 'White Label Settings', JLTMA_TD ) ;
?></h4>
                            <div class="jltma-api-element-inner">
                                <div class="jltma-api-forms">

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_logo">
                                            <?php 
echo  esc_html__( 'Logo Image', JLTMA_TD ) ;
?>
                                        </label>
                                        <div class="jltma-logo-handler">
                                            <?php 
$jltma_white_label_setting = jltma_get_options( 'jltma_white_label_settings' );
$image_id = jltma_check_options( $jltma_white_label_setting['jltma_wl_plugin_logo'] );

if ( $image = wp_get_attachment_image_src( $image_id ) ) {
    echo  '<a href="#" class="jltma-form-control jltma-wl-plugin-logo"><img src="' . $image[0] . '" /></a>
                                                        <a href="#" class="jltma-remove-button"><i class="dashicons dashicons-no-alt"></i></a>
                                                        <input type="hidden" name="jltma_wl_plugin_logo" value="' . $image_id . '">' ;
} else {
    $selected_image = ( isset( $jltma_white_label_options['jltma_wl_plugin_logo'] ) ? $jltma_white_label_options['jltma_wl_plugin_logo'] : "" );
    echo  '<a href="#" class="jltma-form-control jltma-wl-plugin-logo"><i class="dashicons dashicons-cloud-upload"></i> <span>Upload image</span></a>
                                                        <a href="#" class="jltma-remove-button" style="display:none"><i class="dashicons dashicons-no-alt"></i></a>
                                                        <input type="hidden" class="jltma-whl-selected-image" name="jltma_wl_plugin_logo" value="">' ;
}

?>
                                        </div>
                                    </div>


                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_name">
                                            <?php 
echo  esc_html__( 'Plugin Name', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_name" type="text" class="jltma-form-control jltma_wl_plugin_name" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_name'] ) ? $jltma_white_label_options['jltma_wl_plugin_name'] : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_desc">
                                            <?php 
echo  esc_html__( 'Plugin Description', JLTMA_TD ) ;
?>
                                        </label>
                                        <textarea name="jltma_wl_plugin_desc" type="text" class="jltma-form-control jltma_wl_plugin_desc" cols="50"><?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_desc'] ) ? $jltma_white_label_options['jltma_wl_plugin_desc'] : "" ) ;
?></textarea>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_author_name">
                                            <?php 
echo  esc_html__( 'Developer/Agency Name', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_author_name" type="text" class="jltma-form-control jltma_wl_plugin_author_name" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_author_name'] ) ? $jltma_white_label_options['jltma_wl_plugin_author_name'] : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_menu_label">
                                            <?php 
echo  esc_html__( 'Menu Label', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_menu_label" type="text" class="jltma-form-control jltma_wl_plugin_menu_label" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_menu_label'] ) ? $jltma_white_label_options['jltma_wl_plugin_menu_label'] : "" ) ;
?>">
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_url">
                                            <?php 
echo  esc_html__( 'Plugin URL', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_url" type="text" class="jltma-form-control jltma_wl_plugin_url" value="<?php 
echo  ( isset( $jltma_white_label_options['jltma_wl_plugin_url'] ) ? $jltma_white_label_options['jltma_wl_plugin_url'] : "" ) ;
?>">
                                    </div>
                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_row_links">
                                            <?php 
echo  esc_html__( 'Hide Plugin Row Meta Links', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_row_links" type="checkbox" class="jltma-form-control jltma_wl_plugin_row_links" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_row_links'], true );
?>>
                                        <p class="pl-3"><?php 
echo  __( 'This will hide Support, Docs & FAQs and Video Tutorials links on Plugins page.', JLTMA_TD ) ;
?></p>
                                    </div>

                                </div>
                            </div><!-- /.jltma-api-element-inner -->
                        </div><!-- /.jltma-api-settings-element jltma-half -->
                        <!-- End of White Label Settings -->


                        <!-- Start of White Label Admin Settings -->
                        <div class="jltma-api-settings-element jltma-half">
                            <h4><?php 
echo  esc_html__( 'Admin Settings', JLTMA_TD ) ;
?></h4>
                            <div class="jltma-api-element-inner">
                                <div class="jltma-api-forms">

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_welcome">
                                            <?php 
echo  esc_html__( 'Hide Welcome Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_welcome" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_welcome" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_welcome'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_addons">
                                            <?php 
echo  esc_html__( 'Hide Addons Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_addons" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_addons" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_addons'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_extensions">
                                            <?php 
echo  esc_html__( 'Hide Extensions Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_extensions" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_extensions" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_extensions'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_icons_library">
                                            <?php 
echo  esc_html__( 'Hide Icons Library', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_icons_library" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_icons_library" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_icons_library'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_api">
                                            <?php 
echo  esc_html__( 'Hide Welcome Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_api" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_api" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_api'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_white_label">
                                            <?php 
echo  esc_html__( 'Hide White Label Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_white_label" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_white_label" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_white_label'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_version">
                                            <?php 
echo  esc_html__( 'Hide Version Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_version" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_version" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_version'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_changelogs">
                                            <?php 
echo  esc_html__( 'Hide Changelogs Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_changelogs" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_changelogs" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_changelogs'], true );
?>>
                                    </div>

                                    <div class="jltma-form-group is-flex">
                                        <label for="jltma_wl_plugin_tab_system_info">
                                            <?php 
echo  esc_html__( 'Hide System Info Tab', JLTMA_TD ) ;
?>
                                        </label>
                                        <input name="jltma_wl_plugin_tab_system_info" type="checkbox" class="jltma-form-control jltma_wl_plugin_tab_system_info" <?php 
checked( 1, $jltma_white_label_options['jltma_wl_plugin_tab_system_info'], true );
?>>
                                    </div>

                                    <p class="border border-danger p-2">
                                        <strong><?php 
_e( 'NOTE: ', JLTMA_TD );
?></strong>
                                        <?php 
echo  __( 'You will need to reactivate Master Addons PRO for Elementor plugin to be able to reset White Labeling Tab Options.', JLTMA_TD ) ;
?>
                                    </p>

                                </div>
                            </div><!-- /.jltma-api-element-inner -->
                        </div><!-- /.jltma-api-settings-element jltma-half -->
                        <!-- End of White Label Admin Settings -->

                    </div>
                </div><!-- /.master_addons_feature -->
            </form>
        </div>
    </div>
</div>
