
<?php
/*
 * Author: GameOn
 * Date: April, 2016
 * Name: xbox_view.class.php
 * Description: This class defines a method "display".
 * The method accepts a Xbox object and displays the details of the xbox in a table.
 */

class XboxDetail extends XboxIndexView {

    public function display($xbox, $confirm = "") {
        //display page header
        parent::displayHeader("Game Details");

        //retrieve xbox details by calling get methods
        $id = $xbox->getId();
        $title = $xbox->getTitle();
        $release_year = $xbox->getRelease_year();
        $developer = $xbox->getDeveloper();
        $platform = $xbox->getPlatform();
        $image = $xbox->getImage();
        $esrb_rating = $xbox->getEsrb_rating();
        

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . GAME_IMG . $image;
        }
        ?>

        <div id="main-header">Xbox Game Details</div>
        <hr>
        <!-- display xbox details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Release Year:</strong></p>
                    <p><strong>Developer:</strong></p>
                    <p><strong>Platform:</strong></p>
                    <p><strong>Esrb Rating:</strong></p>
                    </br>
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/xbox/edit/<?= $id ?>'">&nbsp;
     
                    </div> 
                    </br>
                     
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p><?= $release_year ?></p>
                    <p><?= $developer ?></p>
                    <p><?= $platform ?></p>
                    <p><?= $esrb_rating ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/xbox/index">Go to xbox game list</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}

