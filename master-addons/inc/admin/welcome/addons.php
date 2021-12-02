<?php

namespace MasterAddons\Admin\Dashboard\Addons;

use MasterAddons\Master_Elementor_Addons;
?>


<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-addons" style="display: none;">
    <div class="jltma-master-addons-features">

        


        <div class="jltma-tab-dashboard-wrapper">
            <form action="" method="POST" id="jltma-addons-tab-settings" class="jltma-addons-tab-settings" name="jltma-addons-tab-settings">
                <?php wp_nonce_field('maad_el_settings_nonce_action'); ?>
                <div class="jltma-addons-dashboard-tabs-wrapper">
                    <div id="jltma-addons-elements" class="jltma-addons-dashboard-header-left">
                        <?php
                        include_once JLTMA_PATH . '/inc/admin/welcome/addons-elements.php';
                        include_once JLTMA_PATH . '/inc/admin/welcome/addons-forms.php';
                        include_once JLTMA_PATH . '/inc/admin/welcome/addons-marketing.php';
                        ?>
                    </div>
                </div> <!-- .jltma-addons-tab-dashboard-tabs-wrapper-->
            </form>
        </div>
    </div>
</div>
