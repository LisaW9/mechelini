<div class="kaart" id="<?php echo str_replace(' ', '-', $result->name); ?>"
     style="background-image: url('img/kaarten/<?php echo $result->image ?>');"><?php
    echo '<div class="amountOfCards">' . $result->amount . '</div>'; ?>
</div>