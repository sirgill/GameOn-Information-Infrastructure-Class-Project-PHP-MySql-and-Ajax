<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MobileInsert extends MobileIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Insert Mobile Game");
        ?>
        <div id="main-header">New Mobile Game Details</div>

        <form class="new-media" action='<?= BASE_URL . "/mobile/add/" ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <p><strong>Title</strong><br>
                <input name="title" type="text" size="100" placeholder="Enter the title of the game" required="" ></p>

            <p><strong>Release Year</strong>: <input name="release_year" type="year" required="" ></p>
            <p><strong>Developer</strong>:
                <input name="developer" type="text" size="40" placeholder="developer" required="" ></p>
            <p><strong>Platform</strong>: <br>
                <input name="platform" type="text" size="40" placeholder="platform" required="" ></p>
            <p><strong>Image</strong>:<br>
                <input name="image" type="text" size="100"   required="" placeholder="url (http:// or https://) or local file including path and file extension"></p>
            <p><strong>Esrb Rating </strong>:
                <input type='radio' name='esrb_rating' value='1' > Everyone &nbsp;&nbsp;<input type='radio' name='esrb_rating' value='2' > 10 and Up &nbsp;&nbsp;<input type='radio' name='esrb_rating' value='3' checked> Mature &nbsp;&nbsp;<input type='radio' name='esrb_rating' value='4' > Teen &nbsp;&nbsp;<input type='radio' name='rating' value='5' > Not Rated &nbsp;&nbsp; </p>

            <input type="submit" name="action" value="Add Movie" />
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/mobile/index/" ?>"'/>
        </form>



        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
