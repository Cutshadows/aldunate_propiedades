$(function () {
    $.ajax({
        url: '../cliente/controller/cGraphics.php',
        type: 'POST',
        dataType: 'JSON',
        async:true,
        cache: false,
        data: {
            opcion: 'ultimo-siete'
        },
        success: function (d) {
            var resultado = d;
            var line = new Morris.Line({
                element: 'entradas-diarias',
                resize: true,
              data:resultado,
             xkey: 'fecha',
                ykeys: ['visitas'],
                labels: ['day'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto'
            });
        }
    });
    $.ajax({
        url: '../cliente/controller/cGraphics.php',
        type: 'POST',
        dataType: 'JSON',
        async:true,
        cache: false,
        data: {
            opcion: 'ultimo-mes'
        },
        success: function (d) {
            var resultado = d;
            var line = new Morris.Line({
                element: 'entradas-mensuales',
                resize: true,
                data: resultado,
                xkey: 'fecha',
                ykeys: ['visitas'],
                labels: ['Item 1'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto'
            });
        }
    });

    $.ajax({
        url: '../cliente/controller/cGraphics.php',
        type: 'POST',
        dataType: 'JSON',
        async:true,
        cache: false,
        data: {
            opcion: 'grafico-torta'
        },
        success: function (d) {
            var resultado = d;
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
              var vueltas=d.length;
              var elementos=[];
              for (let col = 0; col < vueltas; col++) {
                var ele = col;
                ele=getRandomColor();
                elementos.push(ele);
              }
              //var col=getRandomColor(elementos);
               var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                //colors: ["#3c8dbc", "#f56954", "#00a65a"],
                colors: elementos,
                data: resultado,
                hideHover: 'auto'
              });
        }
    });
    
    








	
    //DONUT CHART
    /* var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
        {label: "Download Sales", value: 12},
        {label: "In-Store Sales", value: 30},
        {label: "Mail-Order Sales", value: 20}
      ],
      hideHover: 'auto'
    }); */
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });
  });