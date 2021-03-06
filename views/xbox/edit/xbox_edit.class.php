<?php
/*
 * Author: GameOn
 * Edit page to edit game details
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class XboxEdit extends XboxIndexView {

    public function display($xbox) {
        //display page header
        parent::displayHeader("Edit Xbox Game");

        //get xbox game ratings from a session variable
        if (isset($_SESSION['esrb_rating'])) {
            $ratings = $_SESSION['esrb_rating'];
        }

        //retrieve xbox game details by calling get methods
        $id = $xbox->getId();
        $title = $xbox->getTitle();
        $release_year = $xbox->getRelease_year();
        $developer = $xbox->getDeveloper();
        $platform = $xbox->getPlatform();
        $image = $xbox->getImage();
        $esrb_rating = $xbox->getEsrb_rating();
        ?>

        <div id="main-header">Edit Xbox Details</div>

        <!-- display xbox details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/xbox/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Title</strong><br>
                <input name="title" type="text" size="100" value="<?= $title ?>" required autofocus></p>
            <p><strong>Release Year</strong>:
                <input name="release_year" type="text" size="100" value="<?= $release_year ?>" required autofocus></p>
        </p>
        <p><strong>Developer</strong>: <input name="developer" type="text" value="<?= $developer ?>" required=""></p>
        <p><strong>Platform</strong>: Separate platforms with commas<br>
            <input name="platform" type="text" size="100" value="<?= $platform ?>" ></p>
        <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
            <input name="image" type="text" size="100"  value="<?= $image ?>"></p>
        <p><strong>Esrb Rating</strong>:<br>
            <?php
            foreach ($ratings as $m_rating => $m_id) {
                $checked = ($esrb_rating == $m_rating ) ? "checked" : "";
                echo "<input type='radio' name='esrb_rating' value='$m_id' $checked> $m_rating &nbsp;&nbsp;";
            }
            ?>
            <input type="submit" name="action" value="Update Game">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/xbox/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

}
