<div class="resume-education">
    <?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
        <h2 class="section-title"><?php esc_html_e( 'Education', 'capstone' ); ?></h2>
        <dl class="candidate-education">
        <?php
            foreach( $items as $item ) : ?>

                <dt>
                    <div class="title"><span><?php echo esc_html($item['location']); ?></span><small class="date"><?php echo esc_html($item['date']); ?></small></div>
                    <span class="qualification"><?php echo esc_html($item['qualification']); ?></span>
                </dt>
                <dd>
                    <?php echo wpautop( wp_kses_post(wptexturize( $item['notes'] )) ); ?>
                </dd>

            <?php endforeach;
        ?>
        </dl>
    <?php endif; ?>
</div>