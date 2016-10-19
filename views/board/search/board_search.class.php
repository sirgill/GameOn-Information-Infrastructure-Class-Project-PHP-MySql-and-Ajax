<?php
/*
 * Author: GameON
 * Date: April, 2016
 * Name: search.class.php
 * Description: this script defines the Search Games class. The class contains a method named display, which
 * accepts an array of Game objects and displays them in a grid.
 */

class BoardSearch extends BoardIndexView {
    /*
     * the displays accepts an array of board game objects and displays
     * them in a grid.
     */

    public function display($terms, $boards) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($boards)) ? "( 0 - 0 )" : "( 1 - " . count($boards) . " )");
            ?>
        </span>
        <hr>

        <!-- display all records in a grid -->
        <div class="grid-container">
            <?php
            if ($boards === 0) {
                echo "No board was found.<br><br><br><br><br>";
            } else {
                //display games in a grid; six games per row
                foreach ($boards as $i => $board) {
                    $id = $board->getId();
                    $title = $board->getTitle();
                    $image = $board->getImage();

                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . BOARD_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/board/detail/$id'><img src='" . $image .
                    "'></a><span>$title" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($boards) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a href="<?= BASE_URL ?>/board/index">Go to board game list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
