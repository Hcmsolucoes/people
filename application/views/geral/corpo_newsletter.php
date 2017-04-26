<?php 
$iduser = $this->session->userdata('id_funcionario'); 

?>
<div class="message-box animated fadeIn" data-sound="alert" id="mb-exclembrete">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-times"></span> Excluir Notícia ?</div>
      <div class="mb-content">
        <p>Deseja excluir essa notícia?</p>                    
        <p>Clique em Não para continuar trabalhando. Clique em Sim apagá-lo.</p>
      </div>
      <div class="mb-footer">
        <div class="pull-right">
          <a id="exclembrete" href="#" data-id="" class="btn btn-info btn-lg mb-control-close ">Sim</a>
          <button id="nao" class="btn btn-default btn-lg mb-control-close">Não</button>
        </div>
      </div>
    </div>
  </div>
</div>                                                                                

<div class="row">
  <div class="fleft-10" style="min-height: 800px;">
    <div class="alert acenter bold" role="alert" style="display: none;font-size: 15px;"></div>

    <div class="col-md-3" >
      <div class="page-title">                    
        <h2><span class="fa fa-file-text"></span> Newsletter</h2><div style="float: left; font-weight: bold; margin: 8px 0px 0px 10px;" id="itematual"></div>
        
      </div>
   
      <div class="content-frame-left ">
       
        <div class="fleft-10" style="margin-bottom: 10px;">

          
          <div class="list-group border-bottom">
            
            <a href="#addmsg" id="btnaddmsg" aria-controls="addmsg" role="tab" data-toggle="tab" class="btn btn-info btn-block btn-lg">
              <span class="fa fa-edit"></span> <span class="desc">Nova Newsletter</span> 
            </a>


            <a href="#enviadas" aria-controls="minhasmensagens" role="tab" data-toggle="tab" class="list-group-item aba"><span class="fa fa-share"></span> <span class="desc">Newsletters</span><!--<span class="badge badge-warning"><?php echo count($msg_enviadas) ; ?></span>-->
            </a>            

          </div>                        
        </div>
      </div>
    </div>

    <div class="col-md-9">

      <div class="tab-content">

        <div role="tabpanel" class="tab-pane" id="addmsg">

          <div class="widget widget-default">

              <h3>Nova Newsletter</h3>

              <div class=" fleft-9 fleftmobile" >
                <select name="categoria" id="categoria" class="" style="margin: 7px 0px">
                  <option value="">Categoria</option>
                  <?php foreach ($categorias as $key => $value) { ?>
                    <option value="<?php echo $value->id_categoria_newsletter; ?>"><?php echo $value->descricao_categoria_newsletter; ?></option>
                  <?php } ?>
                </select>
                <input type="text" id="newstitulo" class="form-control" placeholder="Titulo da notícia" />
              </div>

              <div id="div_colab"></div>
              <div class="clearfix"></div>

              <div class="fleft-9 fleftmobile" style="margin: 10px 0px 0px 0px;">
                <textarea class="hcmeditor" name="mensagem" id="mensagem" style="width: 100%;"></textarea>
                <img id="loadmsg" style="display: none;" src="<?php echo base_url('img/loaders/default.gif') ?>" class="fleft">
                
                <input type="text" id="fonte" class="form-control" placeholder="Fonte da notícia" style="margin: 7px 0px" />

                <span class="btn btn-info fright" id="enviar" >Enviar</span>
              </div>
          </div>
          <div id="selecionados"></div>
        </div>


        <div role="tabpanel" class="tab-pane" id="enviadas">

          <div class="widget widget-default">

            <h3>Newsletters</h3>

            <?php             
            foreach ($newsletter as $key => $value) { ?>
            <div class="panel panel-default" id="panel<?php echo $value->id_newsletter; ?>">
              <div class="panel-heading" role="tab" id="" data-toggle="collapse" data-target="#news<?php echo $value->id_newsletter; ?>" >
              <span class="btn btn-default fright mb-control exclemb" data-id="<?php echo $value->id_newsletter; ?>" data-box="#mb-exclembrete"><i class="fa fa-times"></i></span>
                <span class=" bold"><?php echo $value->titulo_newsletter; ?></span>
                <br>
                <?php echo $value->descricao_categoria_newsletter; ?> - 
                <?php 
                $datahora = date('Y-m-d H:m:s' , strtotime($value->data_newsletter) );
                list($data, $hora) = explode(" ", $datahora);
                $data = $this->Log->alteradata1( $data );
                ?>
                <span class="font-sub bold"><?php echo $data." ".$hora; ?></span>                            
                
              </div>
              <div id="news<?php echo $value->id_newsletter; ?>" class="panel-collapse collapse" role="tabpanel" >
                <div class="col-md-12 lg-img"><?php echo $value->descricao_newsletter; ?></div>
                <div class="font-sub"><?php echo $value->fonte_newsletter; ?> </div>
              </div>
            </div>
            <?php } ?>


            </div>
          </div><!-- tab enviadas-->

         
        </div><!--tab content -->

      </div><!-- col-md-9 -->
    </div><!--fleft-10-->
    <input type="hidden" id="url" name="url" >
  </div>

  <script type="text/javascript">
    
    $("a").click(function(){
        
      $(".aba").removeClass("active");
        
        if( $(this).hasClass("list-group-item") ){        
        
          $(this).addClass("active");
        
        }
    });

    $("#enviar").click(function(){

      $("#loadmsg").show();
      var mensagem = $("#mensagem");
      var titulo = $("#newstitulo").val();
      var categoria = $("#categoria").val();
      var urlimg = $("#url").val();
      var fonte = $("#fonte").val();
      
      $.ajax({
        type: "POST",
        url: '<?php echo base_url("home/salvarNewsletter");?>',
        dataType : 'html',
        secureuri:false,
        cache: false,
        data:{
          mensagem: mensagem.code(),
          titulo: titulo, 
          categoria: categoria,
          urlimg: urlimg,
          fonte: fonte
        },                  
        success: function(msg){

          if(msg === 'erro'){
            $(".alert").addClass("alert-danger")
            .html("Houve um erro. Contate o suporte.")
            .slideDown("slow");
            $(".alert").delay( 3500 ).hide(500);

          }else{

            $(".alert").addClass("alert-success")
            .html("Newsletter enviada com sucesso")
            .slideDown("slow");
            $(".alert").delay( 3500 ).fadeOut(500);
            $("#loadmsg").hide();
          }

        } 
      });
    });

    $("#exclembrete").click(function(){
      var id = $(this).data("id");

      $.ajax({          
        type: "POST",
        url: '<?php echo base_url("home/excluirNewsletter"); ?>',
        dataType : 'json',
        data: {
          id: id
        },           
        success: function(msg){
            //console.log(msg);
            if(msg.status === 'erro'){

              $(".alert").addClass("alert-danger")
              .html("Houve um erro. Contate o suporte.")
              .slideDown("slow");
              $(".alert").delay( 3500 ).hide(500);

            }else if(msg.msg==1) {

              $("#panel"+id).hide("fast");
              
            }

          } 
        });
    });

    $(".exclemb").click(function(){

      var id = $(this).data("id");
      $("#exclembrete").data("id", id);

    });

    $("#nao").click(function(){

      $("#exclembrete").data("id", "");
      
    });

   
    $(".hcmeditor").summernote({height: 200,
      toolbar: [
      ["style", ["bold", "italic", "underline", "clear"]],
      ["insert",["link","picture","video"]]                                                          
      ],
      onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
    });

    function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: '<?php echo base_url("home/salvarNewsletter");?>',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
       
                    editor.insertImage(welEditable, url);
                    $("#url").val(url);
                }
            });
        }


  </script>