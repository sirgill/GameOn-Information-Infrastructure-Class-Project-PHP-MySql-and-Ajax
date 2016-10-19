<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoardIndex extends BoardIndexView {
    /*
     * the display method accepts an array of baord games objects and displays
     * them in a grid.
     */

    public function display($boards) {
        //display page header
        parent::displayHeader("List All Board Games");
        ?>
        <div id="main-header"> Board Games in the Library</div>

        <div class="grid-container">
            <?php
            if ($boards === 0) {
                echo "No games was found.<br><br><br><br><br>";
            } else {
                //display games in a grid; six board games per row
                foreach ($boards as $i => $board) {
                    $id = $board->getId();
                    $title = $board->getTitle();
                    $release_year = $board->getRelease_year();
                    $age_rating = $board->getAge_rating();
                    $image = $board->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . BOARD_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/board/detail/$id'><img src='" . $image .
                    "'></a><span>$title<br>Rated $age_rating<br>" . $release_year . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($boards) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <div id="button-group">
            <input type="button" id="edit-button" value="   Add Game   "
                   onclick="window.location.href = '<?= BASE_URL ?>/board/insert/'">&nbsp;

        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
