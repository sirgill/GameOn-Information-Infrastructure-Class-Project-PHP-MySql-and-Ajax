<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: search.class.php
 * Description: this script defines the SearchMovie class. The class contains a method named display, which
 *     accepts an array of Movie objects and displays them in a grid.
 */

class MobileSearch extends MobileIndexView {
    /*
     * the displays accepts an array of movie objects and displays
     * them in a grid.
     */

     public function display($terms, $mobiles) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($mobiles)) ? "( 0 - 0 )" : "( 1 - " . count($mobiles) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($mobiles === 0) {
                echo "No game was found.<br><br><br><br><br>";
            } else {
                //display movies in a grid; six movies per row
                foreach ($mobiles as $i => $mobile) {
                    $id = $mobile->getId();
                    $title = $mobile->getTitle();
                    $image = $mobile->getImage();
                    
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . GAME_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                     echo "<div class='col'><p><a href='", BASE_URL, "/mobile/detail/$id'><img src='" . $image .
                    "'></a><span>$title"  . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($mobiles) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a href="<?= BASE_URL ?>/mobile/index">Go to mobile game list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
