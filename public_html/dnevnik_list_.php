<?php 
	include ('../include/menu_.php');
?>
<title>ArhiWeb: Dnevnik čitaonice</title>
<div class="container-fluid">
    <div class = "row">	
        <div class ="col-md-4"><h2>Dnevnik čitaonice</h2></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10">
             <?php
            error_reporting(E_ALL & ~E_NOTICE);
            if (isset($_GET["page"]))
                {
                $page = $_GET["page"];
                
                } else {
                    $page=1;
                };
                $endlimit = 10;
                $start_from = ($page-1) * $endlimit;
                $number_records = "SELECT * FROM dnevnik";
                $sum_records = mysqli_query($link,$number_records);
                ?>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="SELECT * FROM dnevnik, korisnik WHERE dnevnik.id_kor = korisnik.id_kor order by id_dne, rb_godina DESC LIMIT $start_from, $endlimit";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="dnevnik-list" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#dnevnik-list').bdt();
                            });
                            </script>
                            <thead>
                                <tr>
                                    <th width="10%">RB u godini</th>
                                    <th width="10%">ID korisnika</th>
                                    <th width="15%">Prezime i ime</th>
                                    <th width="10%">Datum</th>
                                    <th width="7%">Ulazak</th>
                                    <th width="7%">Izlazak</th>
                                    <th width="36%">Napomena</th>
                                    <th colspan=1 class="colspan-list"></th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $records['rb_godina'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['id_kor'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $records['vrijeme_ul']?>
                                    </td>
                                    <td>
                                        <?php echo $records['vrijeme_izl']?>
                                    </td>
                                    <td>
                                        <?php echo $records['napomena']?>
                                    </td>
                                    <td>
                                        <a href='dnevnik_view_.php?id=<?php echo $records['id_dne']?>' data-toggle="tooltip" data-placement="top" title="Pregledaj zapis"><span class="glyphicon glyphicon-list-alt font-mine"></span></a>
                                    </td>
                                        <?php
                                        
                                        }
                                        ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    //pagination
    $num_rows = mysqli_num_rows($sum_records);
    $total_pages = ceil($num_rows / $endlimit);
    $i=0;
    for($i=1; $i<=$total_pages; $i++ ){
        echo"<ul class='pagination '> <li>&nbsp<a href = '../public_html/dnevnik_list_.php?page=".$i."'>".$i."</a></li></ul>";
        
    }
    echo'&nbsp&nbsp';
    ?>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>