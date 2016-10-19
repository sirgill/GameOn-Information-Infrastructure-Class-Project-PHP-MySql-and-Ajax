<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class XboxIndex extends XboxIndexView {
    /*
     * the display method accepts an array of xbox objects and displays
     * them in a grid.
     */

    public function display($xboxs) {
        //display page header
        parent::displayHeader("List All Xbox Games");
        ?>
        <div id="main-header"> Xbox Games in the Library</div>

        <div class="grid-container">
            <?php
            if ($xboxs === 0) {
                echo "No games was found.<br><br><br><br><br>";
            } else {
                //display games in a grid; six xbox games per row
                foreach ($xboxs as $i => $xbox) {
                    $id = $xbox->getId();
                    $title = $xbox->getTitle();
                    $esrb_rating = $xbox->getEsrb_rating();
                    $release_year = $xbox->getRelease_year();
                    $image = $xbox->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . GAME_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/xbox/detail/$id'><img src='" . $image .
                    "'></a><span>$title<br>Rated $esrb_rating<br>" . $release_year . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($xboxs) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <div id="button-group">
            <input type="button" id="edit-button" value="   Add   "
                   onclick="window.location.href = '<?= BASE_URL ?>/xbox/add/'">&nbsp;

        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
