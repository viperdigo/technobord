<?php

$true   =   $_SESSION['msg']['status'];

if($true)
{
    
    $tipo   =   $_SESSION['msg']['tipo']  ;
    $texto  =   $_SESSION['msg']['texto']   ;
    
    echo "<script>
                $(function(){
                        mensagem('$tipo', '$texto');
                });
            </script>";    
    
    $_SESSION['msg']['status'] = false;
}

?>
<div id="rodape">
    <hr><!--  Linha Horizontal  -->
    &copy;2012 <a href="#">por Rodrigo Alfieri</a>
</div>
</div>
</body>
</html> 