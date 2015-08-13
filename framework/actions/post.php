<?php
/**
 * Add_action hooks for Theme Posts related elements
 *
 * @author  Bob Ulusoy
 * @copyright Copyright (c) Bob Ulusoy
 * @link  http://artbees.net
 * @since  Version 3.5
 * @package  MK Framework
 */
add_action('blog_similar_posts', 'mk_blog_similar_posts');
add_action('portfolio_similar_posts', 'mk_portfolio_similar_posts');

add_action('nz_post_footer', 'nz_post_copyright');
add_action('nz_post_footer', 'nz_post_share');
add_action('nz_post_footer', 'nz_post_tags');

add_action('nz_post_footer', 'nz_posts_related');

/**
 */
if (!function_exists('mk_blog_similar_posts'))
    {
    function mk_blog_similar_posts($post_id)
        {
        global $post, $mk_options, $single_layout;
        $backup             = $post;
        $tags               = wp_get_post_tags($post_id);
        $tagIDs             = array();
        $related_post_found = false;
        $grid_width         = $mk_options['grid_width'];
        $content_width      = $mk_options['content_width'];
        if ($single_layout == 'full')
            {
            $showposts  = 4;
            $width      = ($grid_width / 4) - 30;
            $height     = ($grid_width / 4) - 80;
            $column_css = 'four-cols';
            }
        else
            {
            $showposts  = 3;
            $width      = (($content_width / 100) * $grid_width) / 3;
            $height     = ((($content_width / 100) * $grid_width) / 3) - 40;
            $column_css = 'three-cols';
            }
        if ($tags)
            {
            $tagcount = count($tags);
            for ($i = 0; $i < $tagcount; $i++)
                {
                $tagIDs[$i] = $tags[$i]->term_id;
                }
            $related = new WP_Query(array(
                'tag__in' => $tagIDs,
                'post__not_in' => array(
                    $post->ID
                ),
                'showposts' => $showposts,
                'ignore_sticky_posts' => 1
            ));
            $output  = '';
            if ($related->have_posts())
                {
                $related_post_found = true;
                $output .= '<section class="blog-similar-posts">';
                $output .= '<div class="similar-post-title">' . __('Recommended Posts', 'mk_framework') . '</div>';
                $output .= '<ul class="' . $column_css . '">';
                while ($related->have_posts())
                    {
                    $related->the_post();
                    $output .= '<li><div class="similar-post-holder">';
                    $output .= '<a class="mk-similiar-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    if (has_post_thumbnail())
                        {
                        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                        $image_src       = bfi_thumb($image_src_array[0], array(
                            'width' => $width,
                            'height' => $height
                        ));
                        }
                    else
                        {
                        $image_src = bfi_thumb(THEME_IMAGES . '/empty-thumb.png', array(
                            'width' => $width,
                            'height' => $height
                        ));
                        }
                    $output .= '<img src="' . mk_thumbnail_image_gen($image_src, $width, $height) . '" alt="' . get_the_title() . '" />';
                    $output .= '<div class="image-hover-overlay"></div></a>';
                    $output .= '<a href="' . get_permalink() . '" class="mk-similiar-title">' . get_the_title() . '</a>';
                    $output .= '</div></li>';
                    }
                $output .= '</ul>';
                $output .= '<div class="clearboth"></div></section>';
                }
            $post = $backup;
            }
        if (!$related_post_found)
            {
            $recent = new WP_Query(array(
                'showposts' => $showposts,
                'nopaging' => 0,
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1
            ));
            $output = '';
            if ($recent->have_posts())
                {
                $related_post_found = true;
                $output .= '<section class="blog-similar-posts">';
                $output .= '<div class="similar-post-title">' . __('Recent Posts', 'mk_framework') . '</div>';
                $output .= '<ul class="' . $column_css . '">';
                while ($recent->have_posts())
                    {
                    $recent->the_post();
                    $output .= '<li><div class="similar-post-holder">';
                    $output .= '<a class="mk-similiar-thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    if (has_post_thumbnail())
                        {
                        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                        $image_src       = bfi_thumb($image_src_array[0], array(
                            'width' => $width,
                            'height' => $height
                        ));
                        $output .= '<img src="' . $image_src . '" alt="' . get_the_title() . '" />';
                        }
                    else
                        {
                        $image_src = bfi_thumb(THEME_IMAGES . '/empty-thumb.png', array(
                            'width' => $width,
                            'height' => $height
                        ));
                        $output .= '<img src="' . mk_thumbnail_image_gen($image_src, $width, $height) . '" alt="' . get_the_title() . '" />';
                        }
                    $output .= '</a>';
                    $output .= '<a href="' . get_permalink() . '" class="mk-similiar-title">' . get_the_title() . '</a>';
                    $output .= '</div></li>';
                    }
                $output .= '</ul>';
                $output .= '<div class="clearboth"></div></section>';
                }
            }
        wp_reset_postdata();
        echo $output;
        }
    }
/***************************************/
/**
 */
if (!function_exists('mk_portfolio_similar_posts'))
    {
    function mk_portfolio_similar_posts()
        {
        global $single_layout, $post, $mk_options;
        $backup             = $post;
        $cats               = wp_get_object_terms($post->ID, 'portfolio_category');
        $catSlugs           = array();
        $related_post_found = false;
        $width              = ($mk_options['grid_width'] / 4) * 2;
        $height             = $width / 1.25;
        $output             = '';
        if ($cats)
            {
            $catcount = count($cats);
            for ($i = 0; $i < $catcount; $i++)
                {
                $catSlugs[$i] = $cats[$i]->slug;
                }
            $query = array(
                'post__not_in' => array(
                    $post->ID
                ),
                'showposts' => 4,
                'ignore_sticky_posts' => 1,
                'post_type' => 'portfolio'
            );
            global $wp_version;
            if (version_compare($wp_version, "3.1", '>='))
                {
                $query['tax_query'] = array(
                    array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'slug',
                        'terms' => $catSlugs
                    )
                );
                }
            else
                {
                $query['taxonomy'] = 'portfolio_category';
                $query['term']     = implode(',', $catSlugs);
                }
            $output  = '';
            $related = new WP_Query($query);
            if ($related->have_posts())
                {
                $related_post_found = true;
                $output .= '<section class="portfolio-similar-posts">';
                $output .= '<div class="similar-post-title">' . __('Related Projects', 'mk_framework') . '</div>';
                $output .= '<div class="mk-grid">';
                $output .= '<ul>';
                while ($related->have_posts())
                    {
                    global $post;
                    $related->the_post();
                    if (has_post_thumbnail())
                        {
                        $output .= '<li>';
                        $post_type = get_post_meta($post->ID, '_single_post_type', true);
                        $post_type = !empty($post_type) ? $post_type : 'image';
                        $link_to   = get_post_meta(get_the_ID(), '_portfolio_permalink', true);
                        $permalink = '';
                        if (!empty($link_to))
                            {
                            $link_array = explode('||', $link_to);
                            switch ($link_array[0])
                            {
                                case 'page':
                                    $permalink = get_page_link($link_array[1]);
                                    break;
                                case 'cat':
                                    $permalink = get_category_link($link_array[1]);
                                    break;
                                case 'portfolio':
                                    $permalink = get_permalink($link_array[1]);
                                    break;
                                case 'post':
                                    $permalink = get_permalink($link_array[1]);
                                    break;
                                case 'manually':
                                    $permalink = $link_array[1];
                                    break;
                            }
                            }
                        if (empty($permalink))
                            {
                            $permalink = get_permalink();
                            }
                        $terms      = get_the_terms(get_the_id(), 'portfolio_category');
                        $terms_slug = array();
                        $terms_name = array();
                        if (is_array($terms))
                            {
                            foreach ($terms as $term)
                                {
                                $terms_slug[] = $term->slug;
                                $terms_name[] = $term->name;
                                }
                            }
                        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                        $image_src       = bfi_thumb($image_src_array[0], array(
                            'width' => $width,
                            'height' => $height
                        ));
                        $output .= '<div class="portfolio-similar-posts-image"><img src="' . mk_thumbnail_image_gen($image_src, $width, $height) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
                        $output .= '<div class="image-hover-overlay"></div>';
                        $output .= '<a title="' . get_the_title() . '" class="modern-post-type-icon" href="' . $permalink . '"><i class="mk-jupiter-icon-plus-circle"></i></a>';
                        $output .= '<div class="portfolio-similar-meta">';
                        $output .= '<a class="the-title" href="' . get_permalink() . '">' . get_the_title() . '</a><div class="clearboth"></div>';
                        $output .= '<div class="portfolio-categories">' . implode(' ', $terms_name) . '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</li>';
                        }
                    }
                $output .= '</ul></div>';
                $output .= '<div class="clearboth"></div></section>';
                }
            $post = $backup;
            }
        if (!$related_post_found)
            {
            $recent = new WP_Query(array(
                'post_type' => 'portfolio',
                'showposts' => 4,
                'nopaging' => 0,
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1
            ));
            $output = '';
            if ($recent->have_posts())
                {
                $related_post_found = false;
                $output .= '<section class="portfolio-similar-posts">';
                $output .= '<div class="similar-post-title">' . __('Most Recent Projects', 'mk_framework') . '</div>';
                $output .= '<div class="mk-grid">';
                $output .= '<ul>';
                while ($recent->have_posts())
                    {
                    global $post;
                    $recent->the_post();
                    if (has_post_thumbnail())
                        {
                        $output .= '<li>';
                        $post_type = get_post_meta($post->ID, '_single_post_type', true);
                        $post_type = !empty($post_type) ? $post_type : 'image';
                        $link_to   = get_post_meta(get_the_ID(), '_portfolio_permalink', true);
                        $permalink = '';
                        if (!empty($link_to))
                            {
                            $link_array = explode('||', $link_to);
                            switch ($link_array[0])
                            {
                                case 'page':
                                    $permalink = get_page_link($link_array[1]);
                                    break;
                                case 'cat':
                                    $permalink = get_category_link($link_array[1]);
                                    break;
                                case 'portfolio':
                                    $permalink = get_permalink($link_array[1]);
                                    break;
                                case 'post':
                                    $permalink = get_permalink($link_array[1]);
                                    break;
                                case 'manually':
                                    $permalink = $link_array[1];
                                    break;
                            }
                            }
                        if (empty($permalink))
                            {
                            $permalink = get_permalink();
                            }
                        $terms      = get_the_terms(get_the_id(), 'portfolio_category');
                        $terms_slug = array();
                        $terms_name = array();
                        if (is_array($terms))
                            {
                            foreach ($terms as $term)
                                {
                                $terms_slug[] = $term->slug;
                                $terms_name[] = $term->name;
                                }
                            }
                        $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                        $image_src       = bfi_thumb($image_src_array[0], array(
                            'width' => $width,
                            'height' => $height
                        ));
                        $output .= '<div class="portfolio-similar-posts-image"><img src="' . mk_thumbnail_image_gen($image_src, $width, $height) . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
                        $output .= '<div class="image-hover-overlay"></div>';
                        $output .= '<a title="' . get_the_title() . '" class="modern-post-type-icon" href="' . $permalink . '"><i class="mk-jupiter-icon-plus-circle"></i></a>';
                        $output .= '<div class="portfolio-similar-meta">';
                        $output .= '<a class="the-title" href="' . get_permalink() . '">' . get_the_title() . '</a><div class="clearboth"></div>';
                        $output .= '<div class="portfolio-categories">' . implode(' ', $terms_name) . '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</li>';
                        }
                    }
                $output .= '</ul></div>';
                $output .= '<div class="clearboth"></div></section>';
                }
            }
        wp_reset_postdata();
        echo $output;
        }
    }
/***************************************/
if (!function_exists('nz_post_copyright')){
    function nz_post_copyright(){
        global  $post, $mk_options;
        if($mk_options['diable_single_carried'] == 'true' && get_post_meta( $post->ID, '_disable_carried', true ) != 'false') :
        ?>
            <p class="post-copyright uk-hidden-small carried-yes">
            转载请注明出处<a href="<?php bloginfo('url');?>"><?php bloginfo( );?></a> » <a href="<?php the_permalink(); ?>"><?php the_title( );?></a>
            </p>
            <p class="post-copyright uk-hidden-small carried-no">
            请尊重我们的辛苦付出，未经允许，请不要转载 <a href="<?php bloginfo('url');?>"><?php bloginfo( );?></a> 的文章！
            </p>
            <p class="post-copyright uk-hidden-small carried-from">
            本文转载自 <a href="<?php bloginfo('url');?>"><?php bloginfo( );?></a> ,感谢原作者的辛苦付出，转载请注明出处！
            </p>
            <p class="post-copyright uk-hidden-small carried-translation">
            本文翻译自 <a href="<?php bloginfo('url');?>"><?php bloginfo( );?></a> ,感谢原作者的辛苦付出，转载请注明出处！
            </p>
        <?php
        endif;
    }
}

if (!function_exists('nz_post_share')){
    function nz_post_share(){
        global  $post, $mk_options;
        //if($mk_options['disable_share'] == 'true' && get_post_meta( $post->ID, '_disable_related_posts', true ) != 'false'):
        if($mk_options['disable_share'] == 'true' ):
            $html = '';
        $shares = $mk_options['disable_share_media'];
        foreach ($shares as $value) {
            $html .= '<a class="bds_'.$value.'" data-cmd="'.$value.'"></a>';
        }
        //$html .= '<span class="bds_count" data-cmd="count"></span>';
        $html .= ($mk_options['disable_share_count'] == 'true') ? '<span class="bds_count" data-cmd="count"></span>' : '' ;
        echo '<div class="action-share bdsharebuttonbox">分享：'.$html.'</div>';
        ?>
            <script>

                window._bd_share_config = {
                    common : {
                        bdText : '',
                        bdDesc : '',
                        bdUrl : '',
                        bdPic : ''
                    },
                    share : [{
                        //"bdSize" : 24
                        bdCustomStyle: '<?php echo THEME_STYLES; ?>' + '/share.css'
                    }]
                    //,
                    // slide : [{
                    //     bdImg : 0,
                    //     bdPos : "right",
                    //     bdTop : 100
                    // }],
                    // image : [{
                    //     viewType : 'list',
                    //     viewPos : 'top',
                    //     viewColor : 'black',
                    //     viewSize : '24',
                    //     viewList : ['qzone','tsina','huaban','tqq','renren']
                    // }],
                    // selectShare : [{
                    //     "bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
                    // }]
                }
                with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
            </script>
        <?php
        endif;
    }
}

if (!function_exists('nz_post_tags')){
    function nz_post_tags(){
        global  $post, $mk_options;
       // if($mk_options['diable_single_tags'] == 'true' && get_post_meta( $post->ID, '_disable_tags', true ) != 'false') :
        if($mk_options['diable_single_tags'] == 'true') :
        ?>
            <p class="post-tags">
            <?php the_tags( '标签: ', ' ', '' );?>
            </p>
        <?php
        endif;
    }
}

if (!function_exists('nz_posts_related')){

    function nz_posts_related(){
        global  $post, $mk_options;
        //if($mk_options['enable_single_related_posts'] == 'true' && get_post_meta( $post->ID, '_disable_tags', true ) != 'false') :
        if($mk_options['enable_single_related_posts'] == 'true') :
        ?>
            <div class="post-related">
            <?php _posts_related();?>
            </div>
        <?php
        endif;
    }

}













