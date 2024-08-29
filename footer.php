<div id="footer-wrapper">
  <footer>
  <div id="footer-top">
      <div id="footer-dados">
        <a href="https://ufpb.br"><img id="footer-logo" src="<?php echo get_bloginfo("template_directory"); ?>/img/ufpb-brasao-pb.png"></a>
        <div>
          <div><?php echo get_bloginfo( 'name' ); ?></div>
                     
            <?php $widget_values = dynamic_sidebar('widgets-do-footer'); ?>
            
          
        </div>

        <div class="footer-direita">
          <div id="footer-creditos">
            <!--<a href="https://github.com/interfaceslivres"><img class="img-creditos" src="<?php echo get_bloginfo("template_directory"); ?>/img/logo-interfaces2.png" alt="Logo do Projeto Interfaces Livres"></a>-->
            <a href="https://www.sti.ufpb.br/"><img class="img-creditos" src="<?php echo get_bloginfo("template_directory"); ?>/img/sti-logo-branco.png" alt="Marca da STI"></a>
            <a href="https://ufpb.br/"><img class="img-creditos" src="<?php echo get_bloginfo("template_directory"); ?>/img/fundo preto.svg" alt="Marca da UFPB"></a>
          </div>
        </div>
      </div>

      <div id="footer-linha"></div>

      <div id="footer-bottom">
        <div id="footer-ultima-linha">
          <div>© 2023 Universidade Federal da Paraíba.</div>
          <div id="footer-acesso-info">
            <a href="https://www.ufpb.br/ouvidoria">Ouvidoria</a>
            <a href="https://www.ufpb.br/acessoainformacao/">Acesso à Informação</a>
            <a href="https://www.ufpb.br/cia/">Acessibilidade</a>
            <a href="https://dados.gov.br/home">Dados Abertos UFPB</a>
            <a href="https://www.gov.br/mds/pt-br/pt-br/acesso-a-informacao/privacidade-e-protecao-de-dados">Privacidade e Proteção de Dados</a>
          </div>

        </div>
      </div>


  </div>
  </footer>
</div> <!-- fecha footer wrapper -->

</div>
	
	<?php wp_footer(); ?>

  
  <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
      </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>	


</body>
</html>


<!--div class="redes-sociais">
                        <a href="#"><i class="fa-brands fa-square-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-square-youtube"></i></a>
                        <a href="#"><i class="fa-solid fa-square-rss"></i></a>
                    </div>
                    <address>R. Ver. João Freire - Conj. Pres. Castelo Branco III, João Pessoa - PB, 58050-420</address>
                    <a href="tel:+55 (83) 3216-7847">+55 (83) 3216-7847</a>
                    <a class="mais-link" href="#">Contato</a>
                    <div>Segunda à Sexta, 12h00 às 19h00</div-->