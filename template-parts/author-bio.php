<?php if ( (bool) get_the_author_meta( 'description' ) ) : ?>

    <div class="author-bio">
        <div class="author-contents media">
            <div class="author-avatar float-left">
                <img class="rounded-circle" src="images/t-1.jpg" alt="Avatar">
                <?php //echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
            </div><!-- /.author-avatar -->
            <div class="author-details media-body">
                <h3 class="name">
                    <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php echo esc_html( get_the_author() );?>
                    </a>
                </h3>
                <p>
                    <?php the_author_meta( 'description' ); ?>
                </p>
                <div class="author-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
