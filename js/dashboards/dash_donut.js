// Dashboard

am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
am4core.useTheme(am4themes_dark);   
// Themes end

// Create chart instance
var chart = am4core.create("dash-donut", am4charts.PieChart);

// Add data

let url = "http://127.0.0.1/web/src_2.0/api/api.php?go=pie";
fetch(url)
  .then(response=>response.json())
  .then(datos=>mostrar(datos))
  .then(e=>console.log(e))

const mostrar = (tipos)=>{
  tipos.forEach(element=>{
    chart.data.push(element.descripcion)
  });

  chart.data = tipos;
  console.log(chart.data);
};

// Set inner radius
chart.innerRadius = am4core.percent(50);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "1";
pieSeries.dataFields.category = "0";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()