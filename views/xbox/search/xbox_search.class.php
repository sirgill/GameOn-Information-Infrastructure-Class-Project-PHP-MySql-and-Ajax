<?php
/*
 * Author: GameOn
 * Date: April, 2016
 * Name: search.class.php
 * Description: this script defines the SearchGame class. The class contains a method named display, which
 *     accepts an array of Games objects and displays them in a grid.
 */

class XboxSearch extends XboxIndexView {
    /*
     * the displays accepts an array of game objects and displays
     * them in a grid.
     */

    public function display($terms, $xboxs) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($xboxs)) ? "( 0 - 0 )" : "( 1 - " . count($xboxs) . " )");
            ?>
        </span>
        <hr>

        <!-- display all records in a grid -->
        <div class="grid-container">
            <?php
            if ($xboxs === 0) {
                echo "No xbox was found.<br><br><br><br><br>";
            } else {
                //display movies in a grid; six games per row
                foreach ($xboxs as $i => $xbox) {
                    $id = $xbox->getId();
                    $title = $xbox->getTitle();
                    $image = $xbox->getImage();

                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . GAME_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/xbox/detail/$id'><img src='" . $image .
                    "'></a><span>$title" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($xboxs) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a href="<?= BASE_URL ?>/xbox/index">Go to xbox game list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
