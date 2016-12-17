<?php 
        //Including FusionCharts’ PHP Wrapper
        include ('../include/menu.php');
        include ('../include/fusioncharts.php');
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Statistika: evidencija korištenja</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../fusioncharts/fusioncharts.js" type="text/javascript"></script>
    <script src="../fusioncharts/fusioncharts.charts.js" type="text/javascript"></script>
    <script src="../fusioncharts/fusioncharts.theme.zune.js" type="text/javascript"></script>
    <script src="../fusioncharts/app.js" type="text/javascript"></script>

    <?php
    
    //Ukupno korišteno arhivskih jedinica u godini
    
    $sql = "SELECT 
            COUNT(za.signatura) AS total,
            (SELECT YEAR(z.datum_zahtjeva)) AS godina
            FROM zahtjevnica_arhjed za
            INNER JOIN zahtjevnica z ON z.id_zahtjeva = za.id_zahtjeva
            GROUP BY godina";
    
    $query=mysqli_query($link,$sql);

    //initialize the array to store the processed data
    $jsonArray = array();

    //Converting the results into an associative array
    while($records=mysqli_fetch_array($query)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['godina'];
        $jsonArrayItem['value'] = $records['total'];
        //append the above created object into the main array
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data=json_encode($jsonArray);
 
    $column3dChart = new FusionCharts("column3d", "graf05", "550", 400, "kor_arhjed", "json", "{
        'chart':{
        'caption':'Ukupno korišteno arhivskih jedinica u godini',
        'xAxisName':'Godina',
        'yAxisName':'Broj arhivskih jedinica',
        'theme':'zune',
        'bgColor':'#F8F8FF',
        'placevaluesInside':'0',
        'valuefontcolor':'#333',
        'rotatevalues':'0',
        'usePlotGradientColor':'0',
        'plotGradientColor':'#eeeeee',
        'dataLoadStartMessage':'Učitavam podatke...',
        'dataLoadStartMessage':'Nema podataka...',
        'palettecolors':'#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000'
         },
        'data':$json_data}");
    // FusionCharts render() method
    $column3dChart->render();
    
    
    //Ukupno korišteno preslika u godini
    
    $sql2 = "SELECT 
            COUNT(id_zaharh) AS total,
            (SELECT YEAR(z.datum_zahtjeva)) AS godina
            FROM zahtjevnica z
            INNER JOIN zahtjevnica_arhjed za ON za.id_zahtjeva = z.id_zahtjeva
            WHERE oblik_kor LIKE '%3 - korištenje preslika%'
            GROUP BY godina";
    
    $query2=mysqli_query($link,$sql2);

    $jsonArray = array();

    while($records=mysqli_fetch_array($query2)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['godina'];
        $jsonArrayItem['value'] = $records['total'];
        //append the above created object into the main array
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data2=json_encode($jsonArray);

    $column3dChart2 = new FusionCharts("column3d", "graf06", "550", 400, "kor_pre", "json", "{
        'chart':{
        'caption':'Ukupno korišteno preslika u godini',
        'xAxisName':'Godina',
        'bgColor':'#F8F8FF',
        'yAxisName':'Broj arhivskih jedinica',
        'theme':'zune',
        'placevaluesInside':'0',
        'valuefontcolor':'#333',
        'rotatevalues':'0',
        'usePlotGradientColor':'0',
        'plotGradientColor':'#eeeeee',
        'dataLoadStartMessage':'Učitavam podatke...',
        'dataLoadStartMessage':'Nema podataka...',
        'palettecolors':'#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000'
        },
        'data':$json_data2}");

    $column3dChart2->render();

    
    //Svrha sitraživanja po godini
    
        $sql3 = "SELECT
                COUNT(p.id_prijave) AS total,
                (SELECT YEAR(datum_prijave)) AS godina,
                s.naziv
                FROM prijavnica p
                INNER JOIN svrha_ist s ON s.sif_svrhe = p.sif_svrhe
                GROUP BY s.naziv
                ORDER BY total DESC";
    
    $query3=mysqli_query($link,$sql3);

    $jsonArray = array();

      while($records=mysqli_fetch_array($query3)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['naziv'];
        $jsonArrayItem['value'] = $records['total'];
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data3=json_encode($jsonArray);
  
    $pie3dChart = new FusionCharts("pie3d", "graf07", "550", 400, "kor_svr", "json", "{
        'chart':{
        'caption':'Svrha istraživanja u godini',
        'paletteColors':'#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000',
        'showPercentValues':'0',
        'decimals':'1',
        'theme':'zune',
        'bgColor':'#F8F8FF',
        'toolTipBgColor':'#000000',
        'toolTipColor':'#ffffff',
        'toolTipBgAlpha':'80',
        'toolTipBorderRadius':'2',
        'toolTipPadding':'5',
        'showHoverEffect':'1',
        'showLegend':'1',
        'legendItemFontSize':'10',
        'legendItemFontColor':'#666666',
        'dataLoadStartMessage':'Učitavam podatke...',
        'dataLoadStartMessage':'Nema podataka...',
        'legendItemFontSize':'10'
        },
        'data':$json_data3}");

        $pie3dChart->render();
    
     
    //Najviše korišteno u godini
    
    $sql4 = "SELECT
            COUNT(za.signatura) AS total, signatura,
            (SELECT YEAR(z.datum_zahtjeva)) AS godina
            FROM zahtjevnica_arhjed za
            INNER JOIN zahtjevnica z ON z.id_zahtjeva = za.id_zahtjeva
            GROUP BY signatura
            ORDER BY total DESC, signatura LIMIT 10";
    
    $query4=mysqli_query($link,$sql4);

    $jsonArray = array();

    while($records=mysqli_fetch_array($query4)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['signatura'];
        $jsonArrayItem['value'] = $records['total'];
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data4=json_encode($jsonArray);

    $column3dChart3 = new FusionCharts("bar3d", "graf08", "550", 400, "kor_max", "json", "{
        'chart':{
        'caption':'Najviše korišteni fondovi/zbirke u godini',
        'xAxisName':'Fond/zbirka',
        'yAxisName':'Ukupno korišteno',
        'theme':'zune',
        'bgColor':'#F8F8FF',
        'placevaluesInside':'0',
        'valuefontcolor':'#333',
        'rotatevalues':'0',
        'usePlotGradientColor':'0',
        'plotGradientColor':'#eeeeee',
        'dataLoadStartMessage':'Učitavam podatke...',
        'dataLoadStartMessage':'Nema podataka...',
        'palettecolors':'#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000'
        },
        'data':$json_data4}");

    $column3dChart3->render();    
        
    ?>
    <div class="container-fluid">
    
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Statistika - evidencija korištenja</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid box">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <div id="kor_arhjed" class="col-md-6"></div>
                                <div id="kor_pre"></div>
                            </div>
                            <div class="form-group">
                                <div id="kor_max" class="col-md-6"></div>
                                <div id="kor_svr"></div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }else{
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Nemate ovlasti za izvršenje tražene radnje!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/korisnik_list_.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
    }
?>