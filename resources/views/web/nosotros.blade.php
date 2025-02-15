@extends("web.plantilla")
@section("contenido")
<!-- about section -->
<section class="about_section layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="web/images/about-img.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Sobre nuestra empresa
            </h2>
            <br>
            <h5>
              Somos Burguers SRL, dedicados a la gastronomía de excelencia
            </h5>
          </div>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta iste sapiente officiis cumque voluptate exercitationem fugit, illo ipsum esse rem enim facere ad ipsa. Amet aspernatur odio error architecto veniam?
          </p>
          <a href="#trabaja">
            Trabajá con nosotros
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end about section -->
<!-- client section -->
<section class="client_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center psudo_white_primary mb_45">
      <h2>
        ¿Qué dicen nuestros clientes?
      </h2>
    </div>
    <div class="carousel-wrap row ">
      <div class="owl-carousel client_owl-carousel">
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
              </p>
              <h6>
                Moana Michell
              </h6>
              <p>
                magna aliqua
              </p>
            </div>
            <div class="img-box">
              <img src="web/images/client1.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
              </p>
              <h6>
                Mike Hamell
              </h6>
              <p>
                magna aliqua
              </p>
            </div>
            <div class="img-box">
              <img src="web/images/client2.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-4 offset-4">
          <div class="form_container">
            <h2 id="trabaja" class="text-center ">Trabajá con nosotros</h2>
            <form id="form1" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div class="py-2">
                <input type="text" class="form-control" placeholder="Nombre" id="txtNombre" name="txtNombre"/>
              </div>
              <div class="py-2">
                <input type="text" class="form-control" placeholder="Apellido" id="txtApellido" name="txtApellido"/>
              </div>
              <div class="py-2">
                <input type="text" class="form-control" placeholder="Celular" id="txtCelular" name="txtCelular"/>
              </div>
              <div class="py-2">
                <input type="email" class="form-control" placeholder="Correo" id="txtCorreo" name="txtCorreo"/>
              </div>
              <div class="py-2">
                <label>Curriculum:</label>
                <input type="file" name="archivo" id="archivo" accept=".doc, .docx, .pdf">
                <p>Archivos admitidos: .doc, .docx, .pdf</p>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</section>
<!-- end client section -->
@endsection