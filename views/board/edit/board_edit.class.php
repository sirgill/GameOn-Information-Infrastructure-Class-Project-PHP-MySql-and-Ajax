<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoardEdit extends BoardIndexView {

    public function display($board) {
        //display page header
        parent::displayHeader("Edit Board Game");

        //get board age ratings from a session variable
        if (isset($_SESSION['age_rating'])) {
            $ratings = $_SESSION['age_rating'];
        }

        //retrieve board details by calling get methods
        $id = $board->getId();
        $title = $board->getTitle();
        $release_year = $board->getRelease_year();
        $publisher = $board->getPublisher();
        $image = $board->getImage();
        $age_rating = $board->getAge_rating();
        ?>

        <div id="main-header">Edit Board Details</div>

        <!-- display board details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/board/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Title</strong><br>
                <input name="title" type="text" size="100" value="<?= $title ?>" required autofocus></p>
            <p><strong>Release Year</strong>:
                <input name="release_year" type="text" size="100" value="<?= $release_year ?>" required autofocus></p>
        </p>
        <p><strong>Publisher</strong>: <input name="publisher" type="text" value="<?= $publisher ?>" required=""></p>

        <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
            <input name="image" type="text" size="100" required value="<?= $image ?>"></p>
        <p><strong>Esrb Rating</strong>:<br>
            <?php
            foreach ($ratings as $m_rating => $m_id) {
                $checked = ($age_rating == $m_rating ) ? "checked" : "";
                echo "<input type='radio' name='age_rating' value='$m_id' $checked> $m_rating &nbsp;&nbsp;";
            }
            ?>
            <input type="submit" name="action" value="Update Game">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/board/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

}
