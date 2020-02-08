<div class="resume-experience">
    <?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
        <h2 class="section-title"><?php esc_html_e( 'Experience', 'capstone' ); ?></h2>
        <dl class="candidate-experience">
        <?php
            foreach( $items as $item ) : ?>

                <dt>
                    <div class="title"><span><?php echo esc_html($item['employer']); ?></span><small class="date"><?php echo esc_html($item['date']); ?></small></div>
                    <span class="designation"><?php echo esc_html($item['job_title']); ?></span>
                </dt>
                <dd>
                    <?php echo wpautop( wp_kses_post(wptexturize( $item['notes'] )) ); ?>
                </dd>

            <?php endforeach;
        ?>
        </dl>
    <?php endif; ?>
</div>