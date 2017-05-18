<div class="kaart" id="<?php echo str_replace(' ', '-', $result->name); ?>"
     style="background-image: url('img/kaarten/<?php echo $result->image ?>');"><?php //if ($result->amount > 1) {
        echo '<div class="amountOfCards">';
        echo $result->amount;
        echo '</div>';
    /*}*/ ?>
</div>