<div id="footer-wrapper">
  <footer>
  <div id="footer-top">
      <div id="footer-dados">
        <a href="https://ufpb.br"><img id="footer-logo" src="<?php echo get_bloginfo("template_directory"); ?>/img/ufpb-brasao-pb.png"></a>
        <div>
          <div><?php echo get_bloginfo( 'name' ); ?></div>
          <?php
          $logradouro   = get_theme_mod('custom_logradouro');
          $numero       = get_theme_mod('custom_numero', '566');
          $complemento  = get_theme_mod('custom_complemento', 'AP 201');
          $bairro       = get_theme_mod('custom_bairro', 'Castelo branco');
          $instagram = !empty($instance['instagram']) ? esc_url($instance['instagram']) : '';
          $facebook = !empty($instance['facebook']) ? esc_url($instance['facebook']) : '';
          $youtube = !empty($instance['youtube']) ? esc_url($instance['youtube']) : '';
          $endereco = !empty($instance['endereco']) ? esc_textarea($instance['endereco']) : '';
          $telefone = !empty($instance['telefone']) ? esc_html($instance['telefone']) : '';
          $contato = !empty($instance['contato']) ? esc_url($instance['contato']) : '';
          $horario_funcionamento = !empty($instance['horario_funcionamento']) ? esc_html($instance['horario_funcionamento']) : '';
                   
          if (!empty($logradouro)) {
              echo '<address>' . wp_kses_post($logradouro);
          }
          if (!empty($numero)) {
            echo ', ' . wp_kses_post($numero);
          }
          if (!empty($complemento)) {
            echo ', ' . wp_kses_post($complemento);
          }
          if (!empty($bairro)) {
            echo ', ' . wp_kses_post($bairro);
          }
          echo '</address>'
          
          /*
          if (!empty($telefone)) {
              echo '<div class="f-link tel"><a href="tel: ' . esc_html($telefone) . '">Telefone: ' . esc_html($telefone) . '</a></div>';
          }
          if (!empty($contato)) {
              echo '<div class="f-link"><a class="mais-link" href="' . esc_url($contato) . '">Contato</a></div>';
          }
          if (!empty($horario_funcionamento)) {
              echo '<div>Horário de funcionamento: ' . esc_html($horario_funcionamento) . '</div>';
          }
          echo '<div class="redes-sociais">';
                  echo '<a href="';
                  echo bloginfo('atom_url');
                  echo '"><i class="fa-solid fa-square-rss"></i></a>';
              if (!empty($instagram)) {
                  echo '<a href="' . esc_url($instagram) . '"><i class="fa-brands fa-square-instagram"></i></a>';
              }
              if (!empty($twitter)) {
                  echo '<a href="' . esc_url($twitter) . '"><i class="fa-brands fa-square-twitter"></i></a>';
              }
              if (!empty($facebook)) {
                  echo '<a href="' . esc_url($facebook) . '"><i class="fa-brands fa-square-facebook"></i></a>';
              }
              if (!empty($youtube)) {
                  echo '<a href="' . esc_url($youtube) . '"><i class="fa-brands fa-square-youtube"></i></a>';
              }            
          echo '</div></div>';*/
          ?>
        </div>     
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