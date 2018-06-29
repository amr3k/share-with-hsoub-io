<?php
/*
  Plugin Name: Share with hsoub I/O
  Plugin URI:  https://github.com/akkk33/share-with-hsoub-io
  Description: Instantly share links from your website with Hsoub I/O
  Version:     1.0
  Author:      akkk33
  Author URI:  https://github.com/akkk33
  License:     MIT
  License URI: https://github.com/akkk33/share-with-hsoub-io/blob/master/LICENSE
 */
/*
  MIT License

  Copyright (c) 2018 Amr

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
  SOFTWARE.
 */

function social_share_menu_item()
{
    add_submenu_page("options-general.php", "مشاركة مع حسوب I/O", "مشاركة مع حسوب I/O", "manage_options", "share-with-hsoub-io", "social_share_page");
}

add_action("admin_menu", "social_share_menu_item");

function social_share_page()
{
    ?>
    <div class="wrap">
        <h1>خيارات المشاركة</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields("social_share_config_section");

            do_settings_sections("social-share");

            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function social_share_settings()
{
    add_settings_section("social_share_config_section", "", null, "social-share");

    add_settings_field("social-share-hsoub-io", "هل تود إظهار زر المشاركة مع حسوب I/O؟", "social_share_hsoub_io_checkbox", "social-share", "social_share_config_section");

    register_setting("social_share_config_section", "social-share-hsoub-io");
}

function social_share_hsoub_io_checkbox()
{
    ?>
    <input type="checkbox" name="social-share-hsoub-io" value="1" <?php checked(1, get_option('social-share-hsoub-io'), true); ?> /> Check for Yes
    <?php
}

add_action("admin_init", "social_share_settings");

function add_social_share_icons($content)
{
    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);

    if (get_option("social-share-hsoub-io") == 1) {
        $html = $html . "<div class='hsoub-io'><a target='_blank' href='https://io.hsoub.com/add/link'>مشاركة مع حسوب I/O</a></div>";
    }

    $html = $html . "<div class='clear'></div></div>";

    return $content = $content . $html;
}

add_filter("the_content", "add_social_share_icons");

function social_share_style()
{
    wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "style.css");
    wp_enqueue_style("social-share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");
