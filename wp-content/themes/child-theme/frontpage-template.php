<?php
/*
Template Name: Шаблон главной страницы
Template Post Type: page
*/

get_header(); ?>
<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Каталог недвижимости</h1>
        <p class="lead text-muted">Данный сайт выполнен в качестве тестового задания для отклика на вакансию Wordpress разработчика.</p>
      </div>
    </div>
  </section>

<?php echo do_shortcode('[estate count="5" type="5" title="Частные дома"]'); ?>
<?php echo do_shortcode('[estate count="6" type="6" title="Квартиры"]'); ?>
<?php echo do_shortcode('[estate count="5" type="7" title="Офисы"]'); ?>

</main>
<?php get_footer(); ?>
