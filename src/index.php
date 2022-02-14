<?php

/*
  Plugin Name: Share with hsoub I/O
  Plugin URI:  https://github.com/416d72/share-with-hsoub-io
  Description: Instantly share links from your website with Hsoub I/O
  Version:     0.0.2
  Author:      416d72
  Author URI:  https://github.com/416d72
  License:     MIT
  License URI: https://github.com/416d72/share-with-hsoub-io/blob/master/LICENSE
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

function add_social_share_icons($content) {
    global $post;

    $url = esc_url(get_permalink($post->ID));

    $html = $content . '<aside class="hsoubShareContainer">
            <div class="hsoubShareBtns">
                <div class="hsoubShareBtnContainer hsoubShareBtnContainer_facebook">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" title="Facebook" class="hsoubShareBtn"><img src="https://static.hsoubcdn.com/share/img/facebook.png" alt="Facebook" class="hsoubShareIcon"></a>
                </div>
                <div class="hsoubShareBtnContainer hsoubShareBtnContainer_twitter">
                    <a href="https://twitter.com/intent/tweet?text=url=' . $url . '" target="_blank"  title="Twitter" class="hsoubShareBtn"><img src="https://static.hsoubcdn.com/share/img/twitter.png" alt="Twitter" class="hsoubShareIcon"></a>
                </div>
                <div class="hsoubShareBtnContainer hsoubShareBtnContainer_whatsapp">
                    <a href="whatsapp://send?text=/' . $url . '" target="_blank" title="WhatsApp" class="hsoubShareBtn"><img src="https://static.hsoubcdn.com/share/img/whatsapp.png" alt="WhatsApp" class="hsoubShareIcon"></a>
                </div>
                <div class="hsoubShareBtnContainer hsoubShareBtnContainer_hsoubio">
                    <a href="https://io.hsoub.com/add/link?url=' . $url . '" target="_blank" title="Hsoub I/O" class="hsoubShareBtn"><img src="https://static.hsoubcdn.com/share/img/hsoubio.png" alt="Hsoub I/O" class="hsoubShareIcon"></a>
                </div>
            </div>
        </aside>';

    return $html;
}

add_filter("the_content", "add_social_share_icons");

function social_share_style() {
    wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "hsoub.css");
    wp_enqueue_style("social-share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");
