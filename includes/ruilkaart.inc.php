 <div class="ruilkaart" id="<?php echo htmlspecialchars($result->tradeId); ?>">
    <?php include('kaart.inc.php'); ?>
    <div class="info">
        <div class="user">
            <div class="profilePicture" style="background-image:url('img/userImages/<?php echo $user->image ?>');"></div>
            <p class="profileName"><?php echo htmlspecialchars($user->firstName).' '.htmlspecialchars($user->lastName) ?></p>
        </div>
        <div class="date">
            <div class="dateIcon"></div>
            <p class="dateP"><?php echo htmlspecialchars($result->date) ?></p>
        </div>
        <div class="rarity">
            <p class="rarityTitle">RARITY</p>
            <p class="rarityP"><?php switch ($result->rarity) {
                    case 1:
                        echo 'Common';
                        break;
                    case 2:
                        echo 'Rare';
                        break;
                    case 3:
                        echo 'Very rare';
                        break;
                } ?></p>
        </div>
    </div>
</div>