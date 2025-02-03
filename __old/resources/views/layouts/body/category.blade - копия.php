

<!-- Category Section -->
<div id="category-section" class="category-section bottom-shadow">
    <!-- container -->
    <div class="container">
        <!-- discount block
        @ include('layouts.body.discount')-->
        <!-- discount block /- -->
        <!-- Section Header -->
        <div class="section-header">
            <h3>Выбрать категорию</h3>
        </div>
        <!-- Section Header /- -->

        <div class="category-box-main categories-slider">
            <!-- Owl Carousel -->
            <div class="our-partner">
                <div id="categories-list" class="owl-carousel owl-theme">

                    <div class="item">
                        <div class="category-box">
                            <a title="Все категории" href="index.php">
                                <img src="assets/images/category/cat-img-00.jpg" alt="cat-img" />
                                <span>Показать все категории</span>
                                <div class="cat-hover"></div>
                            </a>
                        </div>
                    </div>
                    @php
                        $massivCategories = $massivRazdelovSayta['massivCategories'];
						$arrayKeysTovar = array_keys($massivCategories);
                    @endphp
                    @for ($i = 0; $i < count($arrayKeysTovar); $i++)
                        <div class="item">
                            <div class="category-box">
                                <a title={{$massivCategories[$arrayKeysTovar[$i]]}} href="./{{$arrayKeysTovar[$i]}}_categories.php">
                                    <img src="assets/images/category/cat-img-{{$arrayKeysTovar[$i]}}.jpg" alt="cat-img" />
                                    <span>{{$massivCategories[$arrayKeysTovar[$i]]}}</span>
                                    <div class="cat-hover"></div>
                                </a>
                            </div>
                        </div>
                    @endfor

                </div>
            </div>
        </div>
    </div><!-- container /- -->
</div><!-- Category Section /- -->

<!-- productfilter
	@ include('layouts.body.productfilter')-->
<!-- productfilter /- -->
