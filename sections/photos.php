<section class="w-full flex flex-col items-center justify-center py-12 px-4 sm:py-16 sm:px-6 lg:px-8 bg-secondary" id="photos">
  <h2 class="text-3xl font-extrabold text-center text-primary sm:text-4xl mb-8 seasons-style">Wiki & Piter</h2>
  <div class="w-full grid grid-cols-4 gap-4">
    <?php
      $galleryDir = __DIR__ . '/../assets/images/gallery/';
      $images = glob($galleryDir . '*.jpeg');
      $webGalleryDir = '/assets/images/gallery/';
      $i = 1;
      foreach ($images as $imgPath) {
        $imgName = basename($imgPath);
        echo '<a href="' . $webGalleryDir . $imgName . '" data-fancybox="gallery" class="block w-full">';
        echo '<img src="' . $webGalleryDir . '/mini/' . $imgName . '" alt="Zdjęcie ' . $i . '" class="w-full h-auto object-cover gallery-photo-shadow" />';
        echo '</a>';
        $i++;
      }
    ?>
  </div>
</section>
