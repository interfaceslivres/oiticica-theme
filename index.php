     
<?php get_header(); ?>
	 
    <div class="corpo" id="index">
      <div class="imagem"></div>
      <div class="noticias">
        <h1>Notícias</h1>
        <div class="conteudo">
          <div class="noticias-coluna-unica">

            <div class="noticia-wrapper">
              <div class="rotulo">
                <div>15 de Setembro de 2022</div>
                <div>
                  <a href="ufpb.br">Notícia</a>, <a href="ufpb.br">Calamidade</a>
                </div>
              </div>
              <a class="noticia-sem-img camada-1" href="noticia.html"> 
                <div class="noticia-sem-img-titulo" id="noticia-principal">Resultado final do concurso de "Áudio Digital"</div>
              </a>               
            </div>            


          </div>        
          <div class="noticias-coluna">
            <div class="noticia-wrapper">
              <div class="rotulo-claro">
                <div>15 de Setembro de 2022</div>
                <div><a href="ufpb.br">Notícia</a>, <a href="ufpb.br">Calamidade</a></div>
              </div>
              <a href="noticia.html" class="noticia-com-img camada-1" style="
              background-image:
              linear-gradient(180deg, rgba(0,   0,   0, 0.5) 0%, rgba(0, 0, 0, 0) 50%), 
              linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, #ffffff 85%),
              url('<?php echo get_bloginfo("template_directory"); ?>/img/noticia.jpeg')">
                <div class="background-wrapper">                  
                  <div class="noticia-com-img-titulo">Resultado final do concurso de "Marketing Digital e Empreendedorismo"</div>
                </div>                          
              </a>
            </div>

            <div class="noticia-wrapper">
              <div class="rotulo">
                <div>15 de Setembro de 2022</div>
                <div><a href="ufpb.br">Notícia</a>, <a href="ufpb.br">Calamidade</a></div>
              </div>
              <a href="noticia.html" class="noticia-sem-img camada-1">              
                <div class="noticia-sem-img-titulo">Resultado final do concurso de "Áudio Digital"</div>              
              </a>
              </div>
            </div>
            
        </div>
        <div class="link-wrapper justify-end">
          <a class="mais-link" href="noticias.html">Mais Notícias</a>           
        </div>
      </div>   

      <div class="links-wrapper camada-1">
        <div class="links">
          <a href="#" class="link-full"> 
            <div class="link-image-wrapper">              
                <i class="fa-solid fa-calendar"></i>              
            </div>          
            <div class="link-text" href="#">Calendário Acadêmico</div>
          </a>
          <a href="#" class="link-full"> 
            <div class="link-image-wrapper">
              <i class="fa-solid fa-pen-fancy"></i>
            </div>          
            <div class="link-text" href="#">Concursos</div>
          </a>
          <a href="#" class="link-full"> 
            <div class="link-image-wrapper">
              <i class="fa-solid fa-users"></i>
            </div>          
            <div class="link-text" href="#">Equipe</div>
          </a>
          <a href="#" class="link-full"> 
            <div class="link-image-wrapper">
              <i class="fa-solid fa-microscope"></i>
            </div>          
            <div class="link-text" href="#">Pesquisa e Extensão</div>
          </a>
          <a href="#" class="link-full"> 
            <div class="link-image-wrapper">
              <i class="fa-solid fa-file"></i>
            </div>          
            <div class="link-text" href="#">Documentos</div>
          </a>
          <a href="#" class="link-full"> 
            <div class="link-image-wrapper">
              <i class="fa-solid fa-newspaper"></i>
            </div>          
            <div class="link-text" href="#">Newsletter</div>
          </a>
        </div>
      </div>
      
      <div class="apresentacao camada-1">        
        <div>
          <div>
            <h1>Mídias Digitais na UFPB</h1>
            <p>
              O Departamento de Mídias Digitais (DEMID) pertence ao Centro de Ciências Humanas, Letras e Artes (CCHLA) da Universidade Federal da Paraíba (UFPB). O Curso de Bacharelado em Comunicação em Mídias Digitais (CCMD) está vinculado ao Departamento e foi criado pela Resolução nº 38/2009 do Conselho de Ensino, Pesquisa e Extensão (CONSEPE/UFPB). Seria muito interessante se este texto de apresentação fosse maior.
            </p>
            <div class="link-wrapper">
              <a class="mais-link" href="#">Apresentação</a>
            </div>
            <div class="link-wrapper">
              <a class="mais-link" href="#">Projeto Político-Pedagógico</a>
            </div>
          </div>          
        </div>
        <div class="youtube">
          <iframe width="100%" height="100%" src="https://www.youtube.com/embed/XUCxGYSJEDY?autoplay=0&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; web-share" allowfullscreen></iframe>
        </div>
      </div>
      <div class="mapa">
        <h1>Encontre o Departamento</h1>
        <div class="mapa-grid">
          <div id="mapa-coluna1">
            <div id="mapa-inlay">
              <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111.87252228998113!2d-34.84983169399343!3d-7.137336889729705!2m3!1f22.312500000000025!2f48.49688112803378!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x7acc2b97fcc474f%3A0x7330f1f2dbd68687!2sDEMID - Departamento de Mídias Digitais!5e1!3m2!1sen!2sbr!4v1682431792367!5m2!1sen!2sbr" width="100%" height="100%" frameborder="0"><a href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe>
            </div>
            <div class="foto">
              <img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto1.jpg" alt="">
            </div>
          </div>
          <div id="mapa-coluna2" class="foto">
            <img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto2.png" alt="">
          </div>
        </div>
      </div>      
    </div>
	
	
<?php get_footer(); ?>