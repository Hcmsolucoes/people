<style>

.node {
  cursor: pointer;
}

.node circle {
  fill: #fff;
  stroke: steelblue;
  stroke-width: 2px;
}

.node text {
  font: 12px sans-serif;
}

.link {
  fill: none;
  stroke: #ccc;
  stroke-width: 1.5px;
}

</style>
  <div class="tab-content panel" style="padding: 15px 0px 0px 7px; min-height: '100%';">
    <button onclick="expandAll()">Expandir Tudo</button>
    <button onclick="collapseAll()">Recolher Tudo</button>

  
  
<div id="vis3">

</div>
<script src="//d3js.org/d3.v3.min.js"></script>
<script>



var margin = {top: 20, right: 120, bottom: 20, left: 120},
    width = 960 - margin.right - margin.left,
    height = 800 - margin.top - margin.bottom;

var i = 0,
    duration = 750,
    root;

var tree = d3.layout.tree()
    .size([height, width]);

var diagonal = d3.svg.diagonal()
    .projection(function(d) { return [d.y, d.x]; });


var svg  = d3.select("#vis3").append("svg")
      .attr("width", width + margin.right + margin.left)
    .attr("height", height + margin.top + margin.bottom)
      .attr("viewBox", "0 0 " + 1000 + " " + 1000 )
      .attr("preserveAspectRatio", "xMidYMid meet")
      .attr("pointer-events", "all");
/*var svg = d3.select("#vis3").append("svg")
    .attr("width", width + margin.right + margin.left)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("viewBox", "0 0 " + 1000 + " " + 1000 )
      .attr("preserveAspectRatio", "xMidYMid meet")
      .attr("pointer-events", "all")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
*/
//d3.json("flare.json", function(error, flare) {
  flare={
 "name": "HCM Soluções",
 "children": [
  {
   "name": "HCM Administração de Pessoal",
   "children": [
    {
     "name": "Diretoria Geral",
     "children": [
      {"name": "Diretoria Operacional", "size": 3938},
      {"name": "Diretoria Administrativa", "size": 3812},
      {"name": "Diretoria Financeira", "size": 6714},
      {"name": "Diretoria Compras", "size": 743}
     ]
    },
    {
     "name": "Recursos Humanos",
     "children": [
      {"name": "Beneficios", "size": 3534},
      {"name": "Folha", "size": 5731},
      {"name": "Recrutamento e Seleção", "size": 7840},
      {"name": "Cargos e Salarios", "size": 5914},
      {"name": "Treinamento e Pesquisa", "size": 3416}
     ]
    },
    {
     "name": "Logistica",
     "children": [
      {"name": "Motoristas", "size": 7074}
     ]
    }
   ]
  },
  {
   "name": "HCM Consultoria",
   "children": [
    {"name": "Consultoria", "size": 17010},
    {"name": "suporte", "size": 5842},
    {
     "name": "Diretoria de Operações",
     "children": [
      {"name": "Compras", "size": 1983},
      {"name": "Financeiro", "size": 2047},
      {"name": "Contas a Pagar", "size": 1375},
      {"name": "Operacional", "size": 8746},
      {"name": "Centro de Pesquisa", "size": 2202},
      {"name": "Desenvolvimento", "size": 1382},
      {"name": "Qualidade", "size": 1629},
      {"name": "Centro de Tecnologia", "size": 1675},
     ]
    }
 ]
},
]
};


var data = [
    { "name": "HCM Soluções", "parent":"null"},
    { "name": "HCM Administração de Pessoal", "parent":"HCM Soluções" },
    { "name": "Diretoria Geral", "parent":"HCM Administração de Pessoal"},
    {"name": "Diretoria Operacional","parent":"Diretoria Geral","size": 3938},
    {"name": "Diretoria Administrativa","parent":"Diretoria Geral", "size": 3812},
    {"name": "Diretoria Financeira", "parent":"Diretoria Geral","size": 6714},
    {"name": "Diretoria Compras", "parent":"Diretoria Geral","size": 743},
    { "name": "Recursos Humanos", "parent":"HCM Administração de Pessoal"},
    {"name": "Beneficios","parent":"Recursos Humanos","size": 3938},
    {"name": "Folha","parent":"Recursos Humanos", "size": 3812},
    {"name": "Recrutamento e Seleção", "parent":"Recursos Humanos","size": 6714},
    {"name": "Treinamento e Pesquisa", "parent":"Recursos Humanos","size": 743},
     { "name": "Logistica", "parent":"HCM Administração de Pessoal"},
      {"name": "Motoristas", "parent":"Logistica","size": 7074},
       { "name": "HCM Consultoria", "parent":"HCM Soluções","size": 17010 },
        { "name": "Consultoria", "parent":"HCM Consultoria","size": 5842},
        { "name": "suporte", "parent":"HCM Consultoria","size": 5842},
        { "name": "Diretoria de Operações", "parent":"HCM Consultoria","size": 5842},
         { "name": "Compras", "parent":"Diretoria de Operações","size": 5842},
          { "name": "Financeiro", "parent":"Diretoria de Operações","size": 2047},
            { "name": "Contas a Pagar", "parent":"Diretoria de Operações","size": 2047},
        { "name": "Operacional", "parent":"Diretoria de Operações","size": 2047},
        { "name": "Centro de Pesquisa", "parent":"Diretoria de Operações","size": 2047},
          { "name": "Desenvolvimento", "parent":"Diretoria de Operações","size": 2047},
          { "name": "Qualidade", "parent":"Diretoria de Operações","size": 2047},
                  { "name": "Centro de Tecnologia", "parent":"Diretoria de Operações","size": 2047}
    ];

    // *********** Convert flat data into a nice tree ***************
// create a name: node map
var dataMap = data.reduce(function(map, node) {
  map[node.name] = node;
  return map;
}, {});

// create the tree array
var treeData = [];
data.forEach(function(node) {
  // add to parent
  var parent = dataMap[node.parent];
  if (parent) {
    // create child array if it doesn't exist
    (parent.children || (parent.children = []))
      // add node to child array
      .push(node);
  } else {
    // parent is null or missing
    treeData.push(node);
  }
});

  root = treeData[0];
  root.x0 = height / 2;
  root.y0 = 0;

  function collapse(d) {
    if (d.children) {
      d._children = d.children;
      d._children.forEach(collapse);
      d.children = null;
    }
  }

  root.children.forEach(collapse);
  update(root);


d3.select(self.frameElement).style("height", "800px");

function update(source) {

  // Compute the new tree layout.
  var nodes = tree.nodes(root).reverse(),
      links = tree.links(nodes);

  // Normalize for fixed-depth.
  nodes.forEach(function(d) { d.y = d.depth * 180; });

  // Update the nodes…
  var node = svg.selectAll("g.node")
      .data(nodes, function(d) { return d.id || (d.id = ++i); });

  // Enter any new nodes at the parent's previous position.
  var nodeEnter = node.enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
      .on("click", click);

  nodeEnter.append("circle")
      .attr("r", 1e-6)
      .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeEnter.append("text")
      .attr("x", function(d) { return d.children || d._children ? -10 : 10; })
      .attr("dy", ".35em")
      .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
      .text(function(d) { return d.name; })
      .style("fill-opacity", 1e-6);

  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

  nodeUpdate.select("circle")
      .attr("r", 4.5)
      .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeUpdate.select("text")
      .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
      .remove();

  nodeExit.select("circle")
      .attr("r", 1e-6);

  nodeExit.select("text")
      .style("fill-opacity", 1e-6);

  // Update the links…
  var link = svg.selectAll("path.link")
      .data(links, function(d) { return d.target.id; });

  // Enter any new links at the parent's previous position.
  link.enter().insert("path", "g")
      .attr("class", "link")
      .attr("d", function(d) {
        var o = {x: source.x0, y: source.y0};
        return diagonal({source: o, target: o});
      });

  // Transition links to their new position.
  link.transition()
      .duration(duration)
      .attr("d", diagonal);

  // Transition exiting nodes to the parent's new position.
  link.exit().transition()
      .duration(duration)
      .attr("d", function(d) {
        var o = {x: source.x, y: source.y};
        return diagonal({source: o, target: o});
      })
      .remove();

  // Stash the old positions for transition.
  nodes.forEach(function(d) {
    d.x0 = d.x;
    d.y0 = d.y;
  });
}


function collapse(d) {
  if (d.children) {
    d._children = d.children;
    d._children.forEach(collapse);
    d.children = null;
  }
}

function expand(d){   
    var children = (d.children)?d.children:d._children;
    if (d._children) {        
        d.children = d._children;
        d._children = null;       
    }
    if(children)
      children.forEach(expand);
}

function expandAll(){
    expand(root); 
    update(root);
}

function collapseAll(){
    root.children.forEach(collapse);
    collapse(root);
    update(root);
}
// Toggle children on click.
function click(d) {
  if (d.children) {
    d._children = d.children;
    d.children = null;
  } else {
    d.children = d._children;
    d._children = null;
  }
  update(d);
}

</script>

