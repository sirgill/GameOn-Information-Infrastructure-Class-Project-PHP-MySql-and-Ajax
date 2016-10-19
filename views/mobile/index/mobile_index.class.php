<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MobileIndex extends MobileIndexView {
    /*
     * the display method accepts an array of xbox objects and displays
     * them in a grid.
     */

    public function display($mobiles) {
        //display page header
        parent::displayHeader("List All Moblie Games");
        ?>
        <div id="main-header"> Mobile Games in the Library</div>

        <div class="grid-container">
            <?php
            if ($mobiles === 0) {
                echo "No games was found.<br><br><br><br><br>";
            } else {
                //display games in a grid; six xbox games per row
                foreach ($mobiles as $i => $mobile) {
                    $id = $mobile->getId();
                    $title = $mobile->getTitle();
                    $esrb_rating = $mobile->getEsrb_rating();
                    $release_year = $mobile->getRelease_year();
                    $image = $mobile->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . GAME_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/mobile/detail/$id'><img src='" . $image .
                    "'></a><span>$title<br>Rated $esrb_rating<br>" . $release_year . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($mobiles) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <div id="button-group">
            <input type="button" id="edit-button" value="   Add Game   "
                   onclick="window.location.href = '<?= BASE_URL ?>/mobile/add/'">&nbsp;

        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
