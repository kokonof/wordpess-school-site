<?php echo get_header();  ?>
    <div class="container">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="https://picsum.photos/1200/400" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://picsum.photos/1200/400" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/1200/400" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<?php
//$query = new WP_Query('cat=19,13&posts_per_page=-1');

$query = new WP_Query([
    'cat' => '19,13',
    'posts_per_page' => '-1',
    'order' => 'ASC'

]);


if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
    ?>
    <h3><?php the_title();?> </h3>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata();?>

    <div class="container pb-3">
        <div class="d-grid gap-4" style="grid-template-columns: 3fr 1fr;">

            <div class="bg-body-tertiary rounded-3">
                <div class="row mb-2">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-12">
                        <div class="row g-0 rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
                            <div class="col p-3 d-flex post-content">
                                <div class="col-md-4">
                                    <div class=" d-none d-lg-block">
                                        <?php the_post_thumbnail('thumbnail') ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row text-secondary">
                                        <div class=" justify-content-start">
                                            <i class="fa-solid fa-user"></i> <?php the_author(); ?>
                                        </div>
                                        <div class="justify-content-end">
                                             <i class=" fa-solid fa-calendar-days "></i> <?php the_date(); ?>
                                        </div>
                                    </div>

                                    <h3 class="mb-0"><i class="fa-solid fa-hashtag"></i><?php the_ID() .' '.  the_title(); ?></h3>

                                    <div class="col  d-flex flex-column">
                                        <p class="card-text mb-auto"><?php the_excerpt(); ?></p>
                                    </div>
                                    <div class="">
                                        <a href="<?php the_permalink(); ?>" class="">
                                            <?php echo __('Continue reading...', 'cocojambo') ?>
                                        </a>
                                        <span class="text-danger text-end">Подобається <i class="fa-regular fa-heart"></i></span>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php the_posts_pagination([
                            'prev_next'    => true,
                            'prev_text'    => __('« Попередня'),
                            'next_text'    => __('Наступна »'),
                            'type'         => 'list'
                        ]);?>
                    <?php else: ?>
                        <p>Записів поки що немає...</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bg-body-tertiary rounded-3">
                <div class="position-sticky shadow" style="top: 2rem;">
                    <?php dynamic_sidebar('right_sidebar')?>
                </div>
            </div>
        </div>
    </div>
    <div class="b-example-divider"></div>
 <?php echo get_footer() ?>