<div id="page-content-wrapper" class="rm-transition">    
   
             
             <div class="box">
                 <div class="padding">
                     <span class="tit">Evolução salarial</span>
                     <div class="divisao_pontim"></div>
                     <div style=" width: 130px" class="center-block">
                        <select class="form-control" style="font-weight: bold" id="for_parent1" name="for_parent1">
                            <option>Ano: 2016</option>
                            <option>Ano: 2015</option>
                        </select>                         
                         
                     </div>
                     <p class=" text-center" style=" font-size: 16px; margin-top: 15px">Resumo da remuneração anual</p>
                     
                     <div id="columnchart_values" style="width:100%; height:400px"></div>
                 
             </div>
         </div>
    
    </div>

</div> 
<script type="text/javascript">
    $('#collapseTwo').collapse();
    google.charts.load("current", {packages:['corechart']});
    
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Valor", { role: "style" } ],
        ["Provento", 3542, "#337ab7"],
        ["Desconto", 2587, "#337ab7"],
        ["Vantagem", 2140, "#337ab7"]        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        vAxis: { gridlines: { count: 4 } },
        bar: {groupWidth: "40%"},
        legend: { position: "none" }
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>


    


   

