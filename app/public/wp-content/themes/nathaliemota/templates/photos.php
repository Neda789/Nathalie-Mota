<div class="photo-cards">
    <a href="<?php echo esc_url(get_permalink()); ?>" class="photo" data-href="<?php echo get_the_post_thumbnail_url(); ?>" data-category="Catégorie" data-reference="Référence">
        <div class="cardPhoto" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
            <div class="overlay">
                <div class="overlay-content">
                    <i class="fa fa-eye eye-icon"></i>
                    <img class="fullscreen" src="<?php echo get_theme_file_uri() . '/assets/img/fullscreen.png'; ?>" alt="">
                    <span class="ref">Référence: <?php $value = get_field("reference_photo");
                          if ($value) {
                            echo wp_kses_post($value);
                          } else {
                            echo 'empty';
                          }
                      ?>
                    </span>                    <span class="cat">Catégorie:  <?php $categories = get_the_terms(get_the_ID(), 'categorie_photo');
                          foreach ($categories as $categorie) {
                            echo $categorie->name;
                          }
                      ?>
                    </span>
                </div>
            </div>
        </div>
    </a>
</div>