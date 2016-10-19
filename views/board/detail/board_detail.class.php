<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BoardDetail extends BoardIndexView {

    public function display($board, $confirm = "") {
        //display page header
        parent::displayHeader("Board Game Details");

        //retrieve board details by calling get methods
        $id = $board->getId();
        $title = $board->getTitle();
        $release_year = $board->getRelease_year();
        $publisher = $board->getPublisher();
        $image = $board->getImage();
        $age_rating = $board->getAge_rating();
        

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . BOARD_IMG . $image;
        }
        ?>

        <div id="main-header">Board Game Details</div>
        <hr>
        <!-- display board details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Release Year:</strong></p>
                    <p><strong>Publisher:</strong></p>
                    <p><strong>Age Rating:</strong></p>
                    </br>
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/board/edit/<?= $id ?>'">&nbsp;
     
                    </div>
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p><?= $release_year ?></p>
                    <p><?= $publisher ?></p>
                    <p><?= $age_rating ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/board/index">Go to board games list</a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}


