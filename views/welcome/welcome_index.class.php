<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WelcomeIndex extends WelcomeIndexView {

    public function display() {
        //display page header
        parent::displayHeader("");
        ?>    
        <div id="main-header"></div>
        <p></p>
        <br>
        <table style="border: none; width: 700px; margin: 5px auto">
            <tr>
                <td colspan="2" style="text-align: center"><strong>Features include:</strong></td>
            </tr>
            <tr>
                <td style="text-align: left">
                    <ul>
                        <li>List all media</li>
                        <li>Update existing media</li>
                        <li>Add new media</li>
                    </ul>
                </td>
                <td style="text-align: left">
                    <ul>
                        <li>Display details of specific media</li>
                        <li>Search for media</li>
                        <li>Autosuggestion</li>
                    </ul></td>
            </tr>
        </table>

        <br>

        <div id="thumbnails" style="text-align: center; border: none">
            <p></p>

            <a href="<?= BASE_URL ?>/xbox/index">
                <img src="<?= BASE_URL ?>/www/img/xbox.jpg" title="Xbox Library"/>
            </a>
            <a href="<?= BASE_URL ?>/board/index">
                <img src="<?= BASE_URL ?>/www/img/board.jpeg" title="Board Games Library"/>
            </a>
            <a href="<?= BASE_URL ?>/mobile/index">
                <img src="<?= BASE_URL ?>/www/img/phone.jpg" title="Moblie Games"/>
            </a>

        </div>

        <br>
        <p style="text-align: center; color: red; font-weight: bold"></p>
        <p style="font-style: italic"></p><br>
        <p></p>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
