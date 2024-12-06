<div class="tbt-rating-wrapper">
    <div class="tbt-rating tbt_testimonials_star_rating">
        <?php
        if(0 >= $item['tbt_content_star_rating_number']){
        } elseif(1 == $item['tbt_content_star_rating_number']){ ?>
            <i class="fas fa-star"></i>
        <?php } elseif(2 == $item['tbt_content_star_rating_number']){ ?>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        <?php } elseif(3 == $item['tbt_content_star_rating_number']){ ?>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        <?php } elseif(4 == $item['tbt_content_star_rating_number']){ ?>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        <?php } else { ?>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        <?php } ?>
    </div>
    <div class="tbt-rating-gray tbt_testimonials_star_rating">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
    </div>
</div>