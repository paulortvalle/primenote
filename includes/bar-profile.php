<?php if ( ! defined('ABSPATH')) exit; ?>

<?php
    
    // carrega os dados do usuário
    $dataLogin = $profile->getMyLogIns();

?>

<div id="BAR">
    
    <!--
    <a id="OPEN" title="Clique para abrir a barra de itens" class="fa fa-indent fa-2x btn"></a>
    <a id="CLOSE" title="Clique para fechar a barra de itens" class="fa fa-outdent fa-2x btn"></a>
    -->

    <div class="container-fluid">
        <div class="bar-header">
            
            <div class="col-xs-10 col-sm-11 bar-header-content">
                <h1>Meu Histórico de Acessos</h1>
                <p class="text-muted">O controle de segurança do Primenote registra o acesso de todos os usuários. Aqui você pode consultar os seus últimos 10 acessos ao sistema. Caso algum acesso pareça suspeito, entre em contato com o administrador do sistema.</p>
                
                <div class="page-header">
                    <h4>Lista de Acessos <small><i class="fa fa-angle-double-right"></i> últimos 10 acessos ao sistema</small></h4>
                </div>               

            </div>

            <div class="col-xs-2 col-sm-1 text-right">
                <a id="OPEN" title="Clique para abrir a barra de itens" class="fa fa-indent fa-2x btn"></a>
                <a id="CLOSE" title="Clique para fechar a barra de itens" class="fa fa-outdent fa-2x btn"></a>
            </div>

            <div class="clearfix"></div>
            
        </div><!-- .bar-header .container -->

        <div class="bar-itens">

            <div class="col-xs-12" >
                <table class="table table-striped">
                    
                    <tbody class="table-hover">
                        <?php $cont = 1; ?>
                        <?php foreach ($dataLogin as $line) {?>
                            <tr>
                                <th scope="row"><?php echo $cont; ?></th>
                                <td><?php echo $profile->formatDate($line['login_date'], 3); ?></td>
                                <td><strong><?php echo $line['login_remote_addr']; ?></strong><br/><small><?php echo $line['login_remote_host_addr']; ?></small></td>
                            </tr>
                            <?php $cont++; ?>
                        <?php } ?>
                    </tbody> 

                </table>
            </div>

            <div class="clearfix"></div>
            
        </div>
    </div><!-- .container-fluid -->
    
</div><!-- #BARRA -->



<script language="javascript">
    //$(function(){ perfil_dados(); });
</script>