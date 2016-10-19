
<?php
/*
 * Author:GameOn
 * Date:April, 2016
 * Name: mobile_detail.class.php
 * Description: This class defines a method "display".
 * The method accepts a Mobile object and displays the details of the mobile in a table.
 */

class MobileDetail extends MobileIndexView {

    public function display($mobile, $confirm = "") {
        //display page header
        parent::displayHeader("Game Details");

        //retrieve mobile details by calling get methods
        $id = $mobile->getId();
        $title = $mobile->getTitle();
        $release_year = $mobile->getRelease_year();
        $developer = $mobile->getDeveloper();
        $operating_system = $mobile->getOperating_system();
        $image = $mobile->getImage();
        $esrb_rating = $mobile->getEsrb_rating();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . GAME_IMG . $image;
        }
        ?>

        <div id="main-header">Mobile Game Details</div>
        <hr>
        <!-- display mobile details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Release Year:</strong></p>
                    <p><strong>Developer:</strong></p>
                    <p><strong>Operating:</strong></p>
                    <p><strong>Esrb Rating:</strong></p>
                    </br>
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/mobile/edit/<?= $id ?>'">&nbsp;

                    </div>
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p><?= $release_year ?></p>
                    <p><?= $developer ?></p>
                    <p><?= $operating_system ?></p>
                    <p><?= $esrb_rating ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/mobile/index">Go to mobile game list</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
