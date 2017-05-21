<?php if ($result->trade == 1) echo '<div class="shadow"></div>'; ?>
<div class="kaart" id="<?php echo str_replace(' ', '-', $result->ucId); ?>"
     style="background-image: url('img/kaarten/<?php echo $result->image ?>'); <?php if ($result->trade == 1) echo 'margin-top: -150px; z-index: 500; position: relative;'; ?>">
</div>