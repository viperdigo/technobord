<?php 
//Instancia Classe
$obj =   new models();
//Array com Dados menu
$menu=  $obj->menu($tipo, $grps);
?>
<div id="menu">
    <div id="menu">
        <?php
            function menu($menu)
            {
                foreach($menu as $chaves=>$valores)
                {
                    if (is_array($valores))
                    {   array_push($valores,"A");?>
                        <li><a href='javascript:void(0)' class='parent'><span><?php echo $chaves;?></span></a><ul>
                        <?php
                        menu($valores);
                    }
                    else
                    {   if($valores!="A")
                        { ?>
                            <li><a href='?router=T<?php echo $valores = str_pad($valores, 4, "0", STR_PAD_LEFT);?>/home'><span><?php echo $chaves?></span></a></li>
                    <?php }
                        else
                        {?>
                            </ul></li>
                    <?php }
                    }
                }?>
                <?php
                } ?>
        <ul class="menu"><?php menu($menu);?></ul>
    </div>    
</div>