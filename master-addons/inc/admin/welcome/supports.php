<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-welcome">
    <div class="jltma-master-addons-features is-flex">
        <div class="jltma-left_column">
            <ul class="jltma-master-addons-supports-list is-flex">
                <li>
                    <div class="jltma-supports-list-content is-flex">
                        <a href="https://www.facebook.com/groups/2495256720521297/" target="_blank">
                            <?php echo esc_html__('Facebook Community', JLTMA_TD); ?>
                        </a>
                        <div class="jltma-supports-list-icon">
                            <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/fb_group.svg" alt="Join our Facebook Community">
                        </div><!-- /.addons-supports-list-icon -->
                    </div><!-- /.addons-supports-list-content -->
                </li>
                <li>
                    <div class="jltma-supports-list-content is-flex">
                        <a href="https://www.facebook.com/masteraddons" target="_blank">
                            <?php echo esc_html__('Like Facebook Page', JLTMA_TD); ?>
                        </a>
                        <div class="jltma-supports-list-icon">
                            <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/fb_page.svg" alt="Like Facebook Page">
                        </div><!-- /.addons-supports-list-icon -->
                    </div><!-- /.addons-supports-list-content -->
                </li>
                <li>
                    <div class="jltma-supports-list-content is-flex">
                        <a href="https://master-addons.com/contact-us/" target="_blank">
                            <?php echo esc_html__('Email Support', JLTMA_TD); ?>
                        </a>
                        <div class="jltma-supports-list-icon">
                            <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/MA_icon.svg" alt="Contact Support">
                        </div><!-- /.addons-supports-list-icon -->
                    </div><!-- /.addons-supports-list-content -->
                </li>
                <li>
                    <div class="jltma-supports-list-content is-flex">
                        <?php
                        if (ma_el_fs()->is_premium()) {
                            $support_url = 'https://master-addons.com/contact-us';
                        } else {
                            $support_url = 'https://wordpress.org/support/plugin/master-addons/';
                        }
                        ?>
                        <a href="<?php echo esc_url($support_url); ?>" target="_blank">
                            <?php echo esc_html__('WordPress.org Support', JLTMA_TD); ?>
                        </a>

                        <div class="jltma-supports-list-icon">
                            <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/ma_wp_support.svg" alt="Icon Image">
                        </div><!-- /.addons-supports-list-icon -->
                    </div><!-- /.addons-supports-list-content -->
                </li>
                <li>
                    <div class="jltma-supports-list-content is-flex">
                        <a href="https://www.youtube.com/playlist?list=PLqpMw0NsHXV9V6UwRniXTUkabCJtOhyIf" target="_blank">
                            <?php echo esc_html__('Video Tutorials', JLTMA_TD); ?>
                        </a>

                        <div class="jltma-supports-list-icon">
                            <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/video.svg" alt="Icon Image">
                        </div><!-- /.addons-supports-list-icon -->
                    </div><!-- /.addons-supports-list-content -->
                </li>

                <li>
                    <div class="jltma-supports-list-content is-flex">
                        <a href="https://master-addons.com/docs/" target="_blank">
                            <?php echo esc_html__('Documentation', JLTMA_TD); ?>
                        </a>

                        <div class="jltma-supports-list-icon">
                            <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/docs.svg" alt="Icon Image">
                        </div><!-- /.addons-supports-list-icon -->
                    </div><!-- /.addons-supports-list-content -->
                </li>
            </ul>

            <div class="jltma-master_addons-star-review is-flex">
                <div class="jltma-review-content-left">
                    <img src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/reviews.svg" alt="Icon Image">
                </div><!-- /.review-content-left -->

                <div class="jltma-review-content-right">
                    <h4>
                        <?php echo esc_html__('Show Us Some Love', JLTMA_TD); ?>
                    </h4>
                    <p>
                        <?php echo esc_html__('Support us by giving a 5 Star rating on our WordPress plugin Repository. It will inspire us to do better work and bring some amazing elements for you. Thanks for using Master Addons.', JLTMA_TD); ?>
                    </p>

                    <a href="https://wordpress.org/support/plugin/master-addons/reviews/#new-post" target="_blank">
                        <button class="jltma-master-addons-review-button jltma-button">
                            <?php echo esc_html__('Give a Five star review', JLTMA_TD); ?>
                        </button>
                    </a>
                </div><!-- /.review-content-right -->
            </div><!-- /.jltma-master_addons-star-review -->

            <div class="jltma-master-addons-support-faq">
                <div class="jltma-master-addons-faq-content">
                    <h4>
                        <?php echo esc_html__('What is Master Addons & How does it Work?', JLTMA_TD); ?>
                    </h4>
                    <p>
                        <?php echo sprintf(__('It\'s an <strong>Elementor</strong> Addons pack plugin. Elementor Page Builder is required for using Master Addons. This plugin adds more elements/features inside your elementor editor so you feel more independency.', JLTMA_TD)); ?>
                    </p>
                </div><!-- /.master-addons-faq-content -->

                <div class="jltma-master-addons-faq-content">
                    <h4>
                        <?php echo esc_html__('How to Upgrade from Free to Pro?', JLTMA_TD); ?>
                    </h4>
                    <p>
                        <?php echo sprintf(
                            __('It\'s easy to upgrade your free version to pro with a few steps. We have explained details on <a href="%s" target="_blank">Free to Pro Update here</a>.', JLTMA_TD),
                            esc_url('https://master-addons.com/docs/getting-started/upgrade-master-addons-free-to-pro/')
                        ); ?>
                    </p>
                </div><!-- /.master-addons-faq-content -->

                <button class="jltma-master-addons-button jltma-button read-more">
                    <a href="https://master-addons.com/pricing/" target="_blank">
                        <?php echo esc_html__('Read more', JLTMA_TD); ?>
                    </a>
                </button>
            </div><!-- /.master-addons-support-faq -->
        </div>

        <div class="jltma-right_column">

            <?php if (ma_el_fs()->is_not_paying()) { ?>
                <div class="jltma-master-addons-banner">
                    <a href="https://master-addons.com/pricing" target="_blank">
                        <img class="tab-banner" src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/upgrade-pro.png" alt="Upgrade to Pro Master Addons">
                    </a>
                </div><!-- /.master-addons-banner -->
            <?php } ?>

            <div class="jltma-master-addons-right-column-widget">
                <img class="jltma-icon-image" src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/contribute.svg" alt="Request a Feature">
                <h4>
                    <?php echo esc_html__('Request a Feature', JLTMA_TD); ?>
                </h4>
                <p>
                    <?php echo esc_html__('Missing something? Share your IDEA/Requirements with us, drop us an email about your details. We will be in touch with you(work with you) and Develop it.', JLTMA_TD); ?>
                </p>
                <a href="https://master-addons.com/contact-us/" target="_blank">
                    <button class="jltma-master-addons-widget-btn jltma-button">
                        <?php echo esc_html__('Request a Feature', JLTMA_TD); ?>
                    </button>
                </a>
            </div><!-- /.master-addons-right-column-widget -->

            <div class="jltma-master-addons-right-column-widget">
                <img class="jltma-icon-image" src="<?php echo JLTMA_ADMIN_ASSETS; ?>icons/newsletter.svg" alt="Subscript to Newsletter">
                <h4>
                    <?php echo esc_html__('Subscribe Newsletter', JLTMA_TD); ?>
                </h4>
                <p>
                    <?php echo esc_html__('Newsletter is the best way for you to get informed about the latest news and updates. Subscribe now & stay updated.', JLTMA_TD); ?>
                </p>
                <a href="https://master-addons.com/newsletter/" target="_blank">
                    <button class="jltma-master-addons-widget-btn jltma-button">
                        <?php echo esc_html__('Subscribe Now', JLTMA_TD); ?>
                    </button>
                </a>
            </div><!-- /.master-addons-right-column-widget -->

        </div>
    </div>
</div>
