<?php 
$total_pessoas = count($equipe);
$total_m=0;
$total_f=0;
foreach ($equipe as $key => $value) { 
strcasecmp($value->fun_sexo, "Feminino") ? $total_m++ : $total_f++;
}

if(isset($funcionario)){
    foreach ($funcionario as $value) {
        $nome = $value->fun_nome;
        $cargo = $value->fun_cargo;
        $matricula = $value -> fun_matricula;
        $avatar = ( $value->fun_sexo==1 )?"avatar1":"avatar2";
        $foto = ($value->fun_foto=="")? base_url("/img/".$avatar.".jpg") : $value->fun_foto;
        $email = $value-> fun_email;
        $endereco1 = $value->end_rua.", ".$value->end_numero. " ".$value->end_complemento ;
        $endereco2 = "Bairro: ". $value->bair_nomebairro." - ".$value->cid_nomecidade. " / ".$value->est_nomeestado  ;
        $cep = $value->end_cep;
    }
}
?>
    <style>
      
     
   .link {
  fill: none;
  stroke: #9ecae1;
  stroke-width: 2.5px;
}
      .node:not(:hover) .nodetext {
        display: none;
      }

 .node text {
  font: 12px sans-serif;
}     
     
.node {
  cursor: pointer;
}
      
    </style>
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-users"></span> Minha Hierarquia <small><?php echo $total_pessoas; ?> subordinados</small></h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
  <div class="tab-content panel" style="padding: 15px 0px 0px 7px; min-height: '100%';">
  
    <div class="col-md-3 btn-default list-group-item pessoa" >
   <div id="foto"><img src='http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/HCMSOLUCOES/56qD6P57a7m.png' class='imgcirculo_m fleft' style='margin: 0px 5px 100px 0px;'/> </div>
  <span class="font-sub bold corsec" id="nome">Janaina Santos</span><br>
  <span class="font-sub bold corsec" >Admissão: </span><span class="font-sub" id="admissao">23/05/2000</span><br>
  <span class="font-sub bold corsec" >Cargo: </span><span class="font-sub" id="cargo">Gerente de Recursos Humanos</span><br>
  <span class="font-sub bold corsec" >Sexo: </span><span class="font-sub" id="sexo">feminino</span><br>
  <span class="font-sub bold corsec">Dept: </span><span class="font-sub" id="depto">Departamento de Pessoal e Recursos Humanos</span><br>
  <span class="font-sub bold corsec">Situação: </span><span class="font-sub" id="situacao">Trabalhando</span>
</div>

    <div id="vis">

    </div> 
  </div>

 <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<script>

// some colour variables
  var tcBlack = "#130C0E";

// rest of vars
var w = 1000,
    h = 1000,
    maxNodeSize = 50,
    x_browser = 50,
    y_browser = -25,
    root;
 
var vis;
var force = d3.layout.force(); 

vis = d3.select("#vis").append("svg")
      .attr({
        "width": "100%",
        "height": "100%"
      })
      .attr("viewBox", "0 0 " + w + " " + h )
      .attr("preserveAspectRatio", "xMidYMid meet")
      .attr("pointer-events", "all");
 
/*d3.json("marvel.json", function(json) {
 
  

  root = json;
  root.fixed = true;
  root.x = w / 2;
  root.y = h / 4;
 
 
        // Build the path
  var defs = vis.insert("svg:defs")
      .data(["end"]);
 
 
  defs.enter().append("svg:path")
      .attr("d", "M0,-5L10,0L0,5");
 
     update();
});*/
 
var treeData = 
{
 "name": "Janaina Santos",
 "cargo": "Gerente de Recursos Humanos",
 "admissao": "23/05/2000",
 "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/HCMSOLUCOES/56qD6P57a7m.png",
 "situacao": "Trabalhando",
 "departamento": "Departamento de Pessoal e Recursos Humanos",
 "sexo": "Feminino",
 "size": 40000,
 "children": [
    {
     "name": "Antonio Pereira Gomes",
     "cargo": "Chefe Op. Regionais",
     "admissao": "15/02/2009",
     "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/000395.png",
     "situacao": "Trabalhando",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Masculino",
     "size": 40000
    },
    {
     "name": "Carlos Alexandre Costa",
     "cargo": "Supervisora Operacional",
     "admissao": "15/02/2010",
     "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/HCMSOLUCOES/55ZUZsw77q0.jpg",
     "situacao": "Trabalhando",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Masculino",
     "size": 40000
    },
    {
     "name": "Hellen Caroline Siqueira",
     "cargo": "Supervisora",
     "admissao": "10/11/2016",
     "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/HCMSOLUCOES/57fF5qnaxC3.jpg",
     "situacao": "Férias",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Feminino",
     "size": 40000
    },
    {
     "name": "José Alves Sousa",
     "cargo": "Chefe Op. Regionais",
     "admissao": "24/11/2016",
     "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/HCMSOLUCOES/58FwIdNjgSn.jpg",
     "situacao": "Auxílio Doença",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Masculino",
     "size": 40000,
       "children": [
     {
     "name": "Marcio oliveira Santos",
     "cargo": "Motorista",
     "admissao": "15/01/2010",
     "img": "https://www.getninjas.com.br/images/professional_header_images/55/original/motorista.png",
     "situacao": "Trabalhando",
     "departamento": "Logistica",
     "sexo": "Masculino",
     "size": 40000
    },
    {
     "name": "Marcelo Fabricio",
     "cargo": "Motorista II",
     "admissao": "10/02/2016",
     "img": "http://www.centralrondonia.com.br/galerias/filemanager/20120724205439-4fe752-asoprofessor_003.jpg",
     "situacao": "Acidente de Trabalho",
     "departamento": "Financeiro",
     "sexo": "Feminino",
     "size": 40000
    }
    ]
    },
    {
     "name": "Agnaldo Querino Bezerra",
     "cargo": "MOTORISTAS",
     "admissao": "24/11/2016",
     "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/000392.png",
     "situacao": "Trabalhando",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Masculino",
     "size": 40000,
     "children": [
     {
     "name": "Maria Jose",
     "cargo": "Chefe Op. Regionais",
     "admissao": "15/02/2009",
     "img": "http://www.ilos.com.br/web/wp-content/uploads/Claudia-Bessa-1030x979.jpg",
     "situacao": "Trabalhando",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Feminino",
     "size": 40000
    },
    {
     "name": "Monica Alves",
     "cargo": "Diretora Financeira",
     "admissao": "15/02/1998",
     "img": "http://www.ilos.com.br/web/wp-content/uploads/BeatrisHuber.jpg",
     "situacao": "Trabalhando",
     "departamento": "Financeiro",
     "sexo": "Feminino",
     "size": 40000,
      "children": [
     {
     "name": "Sandra Alves",
     "cargo": "Analista 2",
     "admissao": "15/01/2009",
     "img": "http://www.glam.com.pt/wp-content/uploads/2015/12/perfil_leonor-poeiras.png",
     "situacao": "Trabalhando",
     "departamento": "Financeiro - Operações",
     "sexo": "Feminino",
     "size": 40000
    },
    {
     "name": "Juliana Oliveira dos Santos",
     "cargo": "Analista I",
     "admissao": "10/01/2017",
     "img": "https://erirp.com.br/images/profissionais/danielle-perfil.jpg",
     "situacao": "Trabalhando",
     "departamento": "Financeiro",
     "sexo": "Feminino",
     "size": 40000
    }
    ]
    },
    {
     "name": "Fabricio Azevedo",
     "cargo": "Analista financeiro",
     "admissao": "10/11/2000",
     "img": "https://s3.amazonaws.com/igd-wp-uploads-pluginaws/wp-content/uploads/2016/05/30105213/Qual-e%CC%81-o-Perfil-do-Empreendedor.jpg",
     "situacao": "Férias",
     "departamento": "Regional Sul - Compras",
     "sexo": "Masculino",
     "size": 40000
    }
    ]
    },
    {
     "name": "Thiago Souza Cruz",
     "cargo": "Analista Subcontratacao Pl",
     "admissao": "02/11/2016",
     "img": "http://hcmsolucoes.hcmpeople.com.br/assets/img/upload/000300.png",
     "situacao": "Trabalhando",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Masculino",
     "size": 40000,
    },
    {
      "name": "Flavio Santos Alves De Souza",
     "cargo": "Analista Subcontratacao Pl",
     "admissao": "02/11/2016",
     "img": "http://hcmsolucoes.hcmpeople.com.br/img/avatar1.jpg",
     "situacao": "Trabalhando",
     "departamento": "Departamento de Pessoal e Recursos Humanos",
     "sexo": "Masculino",
     "size": 40000,
    }
 ]
}; 
   root = treeData;
  root.fixed = true;
  root.x = w / 2;
  root.y = h / 4;
 
 
        // Build the path
  var defs = vis.insert("svg:defs")
      .data(["end"]);
 
 
  defs.enter().append("svg:path")
      .attr("d", "M0,-5L10,0L0,5");
 
     update();

 
/**
 *   
 */
function update() {
  var nodes = flatten(root),
      links = d3.layout.tree().links(nodes);
 
  // Restart the force layout.
  force.nodes(nodes)
        .links(links)
        .gravity(0.05)
    .charge(-1500)
    .linkDistance(100)
    .friction(0.5)
    .linkStrength(function(l, i) {return 1; })
    .size([w, h])
    .on("tick", tick)
        .start();
 
   var path = vis.selectAll("path.link")
      .data(links, function(d) { return d.target.id; });
 
    path.enter().insert("svg:path")
      .attr("class", "link")
      // .attr("marker-end", "url(#end)")
      .style("stroke", "#eee");
 
 
  // Exit any old paths.
  path.exit().remove();
 
 
 
  // Update the nodes…
  var node = vis.selectAll("g.node")
      .data(nodes, function(d) { return d.id; });
 
 
  // Enter any new nodes.
  var nodeEnter = node.enter().append("svg:g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
      .on("click", click)
      .call(force.drag);
 
  // Append a circle
  nodeEnter.append("svg:circle")
      .attr("r", function(d) { return Math.sqrt(d.size) / 10 || 4.5; })
      .style("fill", "#eee");
 
   
  // Append images
  var images = nodeEnter.append("svg:image")
        .attr("xlink:href",  function(d) { return d.img;})
        .attr("x", function(d) { return -25;})
        .attr("y", function(d) { return -25;})
        .attr("height", 50)
        .attr("width", 50);
  
  // make the image grow a little on mouse over and add the text details on click
  var setEvents = images
          // Append hero text
          .on( 'click', function (d) {
              d3.select("#nome").html(d.name); 
              d3.select("#foto").html("<img src='"+d.img+"' class='imgcirculo_m fleft' style='margin: 0px 5px 100px 0px;'/>"); 
               d3.select("#admissao").html(d.admissao); 
               d3.select("#cargo").html(d.cargo); 
                d3.select("#depto").html(d.departamento); 
                  d3.select("#sexo").html(d.sexo); 
                  d3.select("#situacao").html(d.situacao); 
           })

          .on( 'mouseenter', function() {
            // select element in current context
            d3.select( this )
              .transition()
              .attr("x", function(d) { return -60;})
              .attr("y", function(d) { return -60;})
              .attr("height", 100)
              .attr("width", 100);
          })
          // set back
          .on( 'mouseleave', function() {
            d3.select( this )
              .transition()
              .attr("x", function(d) { return -25;})
              .attr("y", function(d) { return -25;})
              .attr("height", 50)
              .attr("width", 50);
          });

  // Append hero name on roll over next to the node as well
  nodeEnter.append("text")
      .attr("class", "nodetext")
      .attr("x", x_browser)
      .attr("y", y_browser +30)
      .attr("fill", tcBlack)
      .text(function(d) { return d.name; });
 
 
  // Exit any old nodes.
  node.exit().remove();
 
 
  // Re-select for update.
  path = vis.selectAll("path.link");
  node = vis.selectAll("g.node");
 
function tick() {
 
 
    path.attr("d", function(d) {
 
     var dx = d.target.x - d.source.x,
           dy = d.target.y - d.source.y,
           dr = Math.sqrt(dx * dx + dy * dy);
           return   "M" + d.source.x + "," 
            + d.source.y 
            + "A" + dr + "," 
            + dr + " 0 0,1 " 
            + d.target.x + "," 
            + d.target.y;
  });
    node.attr("transform", nodeTransform);    
  }
}

 
/**
 * Gives the coordinates of the border for keeping the nodes inside a frame
 * http://bl.ocks.org/mbostock/1129492
 */ 
function nodeTransform(d) {
  d.x =  Math.max(maxNodeSize, Math.min(w - (d.imgwidth/2 || 16), d.x));
    d.y =  Math.max(maxNodeSize, Math.min(h - (d.imgheight/2 || 16), d.y));
    return "translate(" + d.x + "," + d.y + ")";
   }
 
/**
 * Toggle children on click.
 */ 
function click(d) {
  if (d.children) {
    d._children = d.children;
    d.children = null;
  } else {
    d.children = d._children;
    d._children = null;
  }
 
  update();
}
 
 
/**
 * Returns a list of all nodes under the root.
 */ 
function flatten(root) {
  var nodes = []; 
  var i = 0;
 
  function recurse(node) {
    if (node.children) 
      node.children.forEach(recurse);
    if (!node.id) 
      node.id = ++i;
    nodes.push(node);
  }
 
  recurse(root);
  return nodes;
} 
  
  
</script>