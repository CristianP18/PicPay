<?php 
      function thumb($arq){
        $caminho = "fotos/$arq";
        if(is_null($arq) || !file_exists($caminho)) {
            return "fotos/indisponivel.png";
        }else {
            return $caminho;
        }}
        function voltar() {
            return "<a href='index.php'><span class='material-symbols-outlined'>
            arrow_back_ios </span></a>";
            
        }
      function msg_sucesso($m) {
          $resp = "<div class='sucesso'><i
          class='material-symbols-outlined'>check_circle</i>$m</div>";
          return $resp;
      }
      function msg_aviso($m){
        $resp = "<div class='aviso'><i
        class='material-symbols-outlined'>info</i>$m</div>";
        return $resp;
      }
      function msg_error($m){
        $resp = "<div class='error'><i
        class='material-symbols-outlined'>error</i>$m</div>";
        return $resp;
      }

    ?>