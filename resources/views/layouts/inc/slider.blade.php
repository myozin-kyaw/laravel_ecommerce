<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('/storage/'.$fSlider->slider_img) }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block text-dark">
        <h5>{{ $fSlider->slider_label }}</h5>
        <p>{{ $fSlider->slider_desc }}</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/storage/'.$mSlider->slider_img) }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block text-dark">
        <h5>{{ $mSlider->slider_label }}</h5>
        <p>{{ $mSlider->slider_desc }}</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/storage/'.$lSlider->slider_img) }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block text-dark">
        <h5>{{ $lSlider->slider_label }}</h5>
        <p>{{ $lSlider->slider_desc }}</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



