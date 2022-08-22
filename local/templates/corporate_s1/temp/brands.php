<div class="brands">
	<div class="container">
		<div class="items owl-carousel" id="brands-carousel">
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-1.png" alt="������� �������� ��������"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-2.png" alt="������� �������� Nspace"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-3.png" alt="������� �������� �������24"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-4.png" alt="������� �������� 1�-�������"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-5.png" alt="������� �������� Samsung"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-6.png" alt="������� �������� Bosch"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-1.png" alt="������� �������� ��������"></div>
			<div class="item"><img src="<?=SITE_TEMPLATE_PATH?>/images/temp/Brands/logo-2.png" alt="������� �������� Nspace"></div>
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