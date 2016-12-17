<?php 
	include ('../include/menu_.php');      
?>
<title>ArhiWeb: Zahtjevnice</title>
<div class="container-fluid">
    <div class = "row">
        <div class ="col-md-5"><h2>Zahtjevnice za korištenje gradiva</h2></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2"></div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="SELECT * FROM zahtjevnica, korisnik WHERE zahtjevnica.id_kor = korisnik.id_kor order by id_zahtjeva, rb_zahtjeva";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="zahtjevnica-list" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#zahtjevnica-list').bdt();
                            });
                            </script>
                            <thead>
                                <tr>
                                    <th width="10%">RB zahtjeva</th>
                                    <th width="10%">Datum zahtjeva</th>
                                    <th width="10%">ID korisnika</th>
                                    <th width="20%">Prezime i ime</th>
                                    <th width="30%">Izrađeno preslika</th>
                                    <th width="15%">Gradivo</th>
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
                                        <?php echo $records['rb_zahtjeva'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_zahtjeva'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $records['broj_kor'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['preslici']?>
                                    </td>
                                    <td>
                                        <a href='zahtjevnica_arhjed_list_.php?id=<?php echo $records['id_zahtjeva']?>' data-toggle="tooltip" data-placement="top" title="Gradivo u zahtjevnici">Pregled detalja</a>
                                    </td>
                                    <td>
                                        <a href='zahtjevnica_view_.php?id=<?php echo $records['id_zahtjeva']?>' data-toggle="tooltip" data-placement="top" title="Pregledaj zapis"><span class="glyphicon glyphicon-list-alt font-mine"></span></a>
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
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>