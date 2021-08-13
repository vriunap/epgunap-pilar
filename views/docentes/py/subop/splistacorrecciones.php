<div id="divListaCorrecciones">
    
   <div class='list-group' style='max-height: 330px;  margin-bottom: 10px; overflow-y:scroll;  -webkit-overflow-scrolling: touch;'>
<?php
    
    foreach($correcciones as $item)
    {    
    echo("        
        <a href='#' class='list-group-item list-group-item-action flex-column align-items-start'>
        <div class='d-flex w-100 justify-content-between'>
        <h6 class='mb-1'># ".$item['numero']."</h6>
        <small>".$item['fecha']."</small>
        </div>
        <p class='mb-1'>".$item['mensaje']."</p>
        </a>
        "); 
    }  

?>
    </div>
</div>

