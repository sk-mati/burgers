@extends("web.plantilla")
@section("banner")
<!-- slider section -->
  <section class="slider_section">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Burgers
                  </h1>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum nisi consequuntur est numquam enim dignissimos voluptate eveniet laborum suscipit officia, soluta tempora cumque earum rem vitae sint obcaecati dicta eos?
                  </p>
                  <div class="btn-box">
                    <a href="/takeaway" class="btn1">
                      Realiza tu pedido
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Burgers
                  </h1>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore impedit quas neque? Error quidem assumenda magni? Perspiciatis veritatis quis sit, explicabo accusantium perferendis ullam voluptatum tenetur neque, sint ea tempora?
                  </p>
                  <div class="btn-box">
                    <a href="/takeaway" class="btn1">
                      Realiza tu pedido
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Burguers
                  </h1>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, deleniti quasi quo suscipit eum, velit fugiat vitae illo repellat ipsam doloribus eaque harum autem non, minima quis nam mollitia necessitatibus!
                  </p>
                  <div class="btn-box">
                    <a href="/takeaway" class="btn1">
                      Realiza tu pedido
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </div>
  </section>
<!-- end slider section -->
@endsection