<div class="brands">
	<div class="container">
		<div class="items owl-carousel" id="brands-carousel">
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-1.png" alt="Логотип компании Некстайп"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-2.png" alt="Логотип компании Nspace"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-3.png" alt="Логотип компании Битрикс24"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-4.png" alt="Логотип компании 1С-Битрикс"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-5.png" alt="Логотип компании Samsung"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-6.png" alt="Логотип компании Bosch"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-1.png" alt="Логотип компании Некстайп"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-2.png" alt="Логотип компании Nspace"></div>
		</div>
		<div class="brands-nav"></div>
		<script>
			$('#brands-carousel').owlCarousel({
				items: 6,
				margin: 10,
				loop: true,
				nav: true,
				navContainer: '.brands-nav',
				navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
				dots: false
			});
		</script>
	</div>
</div>