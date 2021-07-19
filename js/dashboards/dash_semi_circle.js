am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    var chart = am4core.create("dash-semi-c", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
    
    // Data

    let url = "http://127.0.0.1/web/src_2.0/api/api.php?go=semi-c";
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

    chart.radius = am4core.percent(70);
    chart.innerRadius = am4core.percent(40);
    chart.startAngle = 180;
    chart.endAngle = 360;  
    
    var series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "1";
    series.dataFields.category = "0";
    
    series.slices.template.cornerRadius = 10;
    series.slices.template.innerCornerRadius = 7;
    series.slices.template.draggable = true;
    series.slices.template.inert = true;
    series.alignLabels = false;
    
    series.hiddenState.properties.startAngle = 90;
    series.hiddenState.properties.endAngle = 90;
    
    chart.legend = new am4charts.Legend();
    
    }); // end am4core.ready()