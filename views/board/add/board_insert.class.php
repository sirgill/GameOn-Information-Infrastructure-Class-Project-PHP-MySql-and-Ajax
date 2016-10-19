<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoardInsert extends BoardIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Insert Board Game");
        ?>
        <div id="main-header">New Board Game Details</div>

        <form class="new-media" action='<?= BASE_URL . "/board/add/" ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <p><strong>Title</strong><br>
                <input name="title" type="text" size="100" placeholder="Enter the title of the game" required="" ></p>

            <p><strong>Release Year</strong>: <input name="release_year" type="year" required="" ></p>
            <p><strong>Publisher</strong>:
                <input name="publisher" type="text" size="40" placeholder="publisher" required="" ></p>
            <p><strong>Image</strong>:<br>
                <input name="image" type="text" size="100"   required="" placeholder="url (http:// or https://) or local file including path and file extension"></p>
            <p><strong>Age Rating </strong>:
                <input type='radio' name='age_rating' value='1' > +4 &nbsp;&nbsp;<input type='radio' name='age_rating' value='2' > 8+ &nbsp;&nbsp;<input type='radio' name='age_rating' value='3' checked> +10 &nbsp;&nbsp;<input type='radio' name='esrb_rating' value='4' > +12 &nbsp;&nbsp;<input type='radio' name='age_rating' value='5' > +15 &nbsp;&nbsp; </p>

            <input type="submit" name="action" value="Add Game" />
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/board/index/" ?>"'/>
        </form>



        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
