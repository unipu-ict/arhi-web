<?php 
        //Including FusionCharts’ PHP Wrapper
        include ('../include/menu.php');
        include ('../include/fusioncharts.php');
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Statistika: evidencija korisnika</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../fusioncharts/fusioncharts.js" type="text/javascript"></script>
    <script src="../fusioncharts/fusioncharts.charts.js" type="text/javascript"></script>
    <script src="../fusioncharts/fusioncharts.theme.zune.js" type="text/javascript"></script>
    <script src="../fusioncharts/app.js" type="text/javascript"></script>

    <?php
    
    //Ukupno novih korisnika u godini
    
    $sql = "SELECT COUNT(id_kor) AS total, god_prijave
            FROM korisnik
            GROUP BY god_prijave";
    
    $query=mysqli_query($link,$sql);

    //initialize the array to store the processed data
    $jsonArray = array();

    //Converting the results into an associative array
    while($records=mysqli_fetch_array($query)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['god_prijave'];
        $jsonArrayItem['value'] = $records['total'];
        //append the above created object into the main array
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data=json_encode($jsonArray);
 
    $column3dChart = new FusionCharts("column3d", "graf01", "550", 400, "kor_new", "json", "{
        'chart':{
        'caption':'Novoprijavljenih korisnika čitaonice u godini',
        'xAxisName':'Godina',
        'yAxisName':'Broj korisnika',
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
    
    
    //Ukupno korisnika u čitaonici u godini
    
    $sql2 = "SELECT COUNT(DISTINCT(id_kor)) AS total,
            (SELECT year(datum)) AS godina
            FROM dnevnik
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

    $column3dChart2 = new FusionCharts("column3d", "graf02", "550", 400, "kor_sum", "json", "{
        'chart':{
        'caption':'Ukupno korisnika u čitaonici u godini',
        'xAxisName':'Godina',
        'bgColor':'#F8F8FF',
        'yAxisName':'Broj korisnika',
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

    
    //Korisnici prema državljanstvu
    
        $sql3 = "SELECT
            drzave.NAZIV AS drzava,
            COUNT(DISTINCT dnevnik.id_kor) AS total
            FROM dnevnik
            INNER JOIN korisnik ON korisnik.id_kor = dnevnik.id_kor
            INNER JOIN mjesto ON mjesto.id_grad = korisnik.id_grad
            INNER JOIN drzave ON drzave.id_drz = mjesto.id_drz
            GROUP BY drzava";
    
    $query3=mysqli_query($link,$sql3);

    $jsonArray = array();

      while($records=mysqli_fetch_array($query3)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['drzava'];
        $jsonArrayItem['value'] = $records['total'];
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data3=json_encode($jsonArray);
  
    $pie3dChart = new FusionCharts("pie3d", "graf03", "550", 400, "kor_drz", "json", "{
        'chart':{
        'caption':'Korisnici čitaonice prema državljanstvu',
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
    
     
    //Ukupno posjeta u čitaonici u godini
    
    $sql4 = "SELECT COUNT(id_kor) AS total,
            (SELECT year(datum)) AS godina
            FROM dnevnik
            GROUP BY godina";
    
    $query4=mysqli_query($link,$sql4);

    $jsonArray = array();

    while($records=mysqli_fetch_array($query4)){
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $records['godina'];
        $jsonArrayItem['value'] = $records['total'];
        array_push($jsonArray, $jsonArrayItem);
      }

    $json_data4=json_encode($jsonArray);

    $column3dChart3 = new FusionCharts("column3d", "graf04", "550", 400, "kor_pos", "json", "{
        'chart':{
        'caption':'Ukupno posjeta korisnika čitaonici u godini',
        'xAxisName':'Godina',
        'yAxisName':'Posjeta',
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
                <h2>Statistika - evidencija korisnika</h2>
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
                                <div id="kor_sum" class="col-md-6"></div>
                                <div id="kor_new"></div>
                            </div>
                            <div class="form-group">
                                <div id="kor_drz" class="col-md-6"></div>
                                <div id="kor_pos"></div>
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