<?php
$heading = get_field('heading');
$subheading = get_field('subheading');
$media_type = get_field('media_type');
$bg_image = get_field('background_image');
$video_source = get_field('video_source'); // 'Select Video' (for internal) or 'Youtube' (for external)
$video_internal = get_field('background_video_selection'); // ACF File field URL
$video_external = get_field('background_video_youtube'); // ACF oEmbed field HTML
$button = get_field('button');
?>

<section class="hero-block">
    <div class="hero-media">
        <?php if ($media_type === 'image' && $bg_image): ?>
            <img src="<?= esc_url($bg_image['url']); ?>" alt="<?= esc_attr($bg_image['alt']); ?>" />
        <?php elseif ($media_type === 'video' && $video_source): ?>
            <?php if ($video_source === 'Select Video' && $video_internal): ?>
                <video autoplay muted playsinline class="hero-background-video">
                    <source src='<?= esc_url($video_internal); ?>' type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            <?php elseif($video_source === 'Youtube' && $video_external):
                // 1. Load the oEmbed iframe HTML from ACF
                $iframe = $video_external;

                // 2. Use preg_match to find iframe src.
                preg_match('/src="(.+?)"/', $iframe, $matches);
                $src = $matches[1] ?? '';

                if (!empty($src)) {
                    // 3. Define parameters for background video: autoplay and muted
                    $params = array(
                        'autoplay'       => 1,
                        'mute'           => 1, // Crucial for autoplay in most browsers
                        'controls'       => 0, // Hide controls for background video
                        'showinfo'       => 0, // Hide video title and uploader info
                        'modestbranding' => 1, // Hide YouTube logo
                        'iv_load_policy' => 3, // Disable annotations
                        'rel'            => 0, // Do not show related videos
                        'enablejsapi'    => 1, // Enable JS API for more control if needed later
                        'playsinline'    => 1, // Important for iOS autoplay
                    );

                    // 4. Add parameters to src and replace HTML.
                    $new_src = add_query_arg($params, $src);
                    $iframe = str_replace($src, $new_src, $iframe);

                    // 5. Remove hardcoded width/height and add `allow` attribute for permissions
                    $iframe = preg_replace('/(width|height)="\d+"/', '', $iframe);
                    $iframe = str_replace('<iframe', '<iframe class="hero-youtube-bg-iframe" frameborder="0" allow="autoplay; muted; playsinline;" allowfullscreen', $iframe);
                }

                // 6. Display customized HTML.
                echo $iframe;
            ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="hero-content">
        <?php if ($heading): ?><h1><?= esc_html($heading); ?></h1><?php endif; ?>
        <?php if ($subheading): ?><p><?= esc_html($subheading); ?></p><?php endif; ?>
        <?php if ($button): ?>
            <a href="<?= esc_url($button['url']); ?>" class="btn" <?= $button['target'] ? 'target="_blank"' : ''; ?>>
                <?= esc_html($button['title']); ?>
            </a>
        <?php endif; ?>
    </div>
</section>