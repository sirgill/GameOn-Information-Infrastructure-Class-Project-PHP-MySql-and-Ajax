-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2016 at 03:15 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_games`
--

CREATE TABLE IF NOT EXISTS `board_games` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `release_year` year(4) NOT NULL,
  `publisher` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  `age_rating` smallint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_games`
--

INSERT INTO `board_games` (`id`, `title`, `release_year`, `publisher`, `image`, `age_rating`) VALUES
(2, 'Monopoly Here & Now Board Game', 2005, 'Hasbro', 'http://1.bp.blogspot.com/-1yvbsGKhBgI/U4AK4gFdblI/AAAAAAAAAC8/oe_UOlzwTsY/s1600/mono.jpg', 2),
(3, 'Scrabble', 1938, 'James Brunot', 'https://s-media-cache-ak0.pinimg.com/736x/9f/fa/10/9ffa1085af5510538ee02afffdb867bc.jpg', 3),
(4, 'Uno', 1997, 'AMIGO Speil', 'http://boxedupfun.com/image/1/0/350/0/uploads/cover-art/uno-1313902078.png', 2),
(5, 'BattleShip', 1967, 'Milton Bradley', 'https://ianthecool.files.wordpress.com/2010/12/pic374107_md.jpg', 2),
(6, 'Sorry', 1933, 'British Card Manufacturers', 'http://s3.amazonaws.com/libapps/accounts/51635/images/Sorry.jpg', 2),
(7, 'Connect Four', 1974, 'Milton Bradley', 'http://uncannyflats.com/wp-content/uploads/2013/12/connect-4.jpg', 2),
(8, 'Candy Land', 1949, 'Hasbro Interactive', 'http://cdn.theatlantic.com/static/mt/assets/hua_hsu/orenstein_boardbox_post.jpg', 2),
(9, 'Risk', 1959, 'Hasbro', 'http://theoldschoolgamevault.com/images/Blog_Images/Risk_Board_Game.jpg', 3),
(10, 'Chinese Checkers', 1928, 'Pressman company', 'http://cf.ltkcdn.net/boardgames/images/std/50457-257x280-Chinese_checkers.jpg', 2),
(11, 'Life', 1960, 'Hasbro', 'http://www.growingrichkids.com/wp-content/uploads/2011/05/Game-of-Life1.jpg', 2),
(12, 'Clue', 1949, 'Hasbro', 'http://improvintoronto.com/wp-content/uploads/2009/10/clue-game.jpg', 4),
(13, 'Ticket To Ride', 1958, 'Hasbro', 'http://androidspin.com/wp-content/uploads/2013/06/tickettoride1.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `board_rating`
--

CREATE TABLE IF NOT EXISTS `board_rating` (
  `age_rating_id` smallint(6) NOT NULL,
  `age_rating` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_rating`
--

INSERT INTO `board_rating` (`age_rating_id`, `age_rating`) VALUES
(1, '+4'),
(2, '+8'),
(3, '+10'),
(4, '+12'),
(5, '+15');

-- --------------------------------------------------------

--
-- Table structure for table `games_ratings`
--

CREATE TABLE IF NOT EXISTS `games_ratings` (
  `esrb_rating_id` smallint(6) NOT NULL,
  `esrb_rating` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games_ratings`
--

INSERT INTO `games_ratings` (`esrb_rating_id`, `esrb_rating`) VALUES
(1, 'Everyone'),
(2, '10 and Up'),
(3, 'Mature'),
(4, 'Teen'),
(5, 'Not Rated');

-- --------------------------------------------------------

--
-- Table structure for table `mobile`
--

CREATE TABLE IF NOT EXISTS `mobile` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `release_year` year(4) NOT NULL,
  `developer` varchar(100) NOT NULL,
  `operating_system` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `esrb_rating` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile`
--

INSERT INTO `mobile` (`id`, `title`, `release_year`, `developer`, `operating_system`, `image`, `esrb_rating`) VALUES
(1, 'Angry Birds', 2009, 'Rovio Entertainment', 'IOS, Android', 'http://www.kutsaloyun.com/wp-content/uploads/2015/04/angry-birds-wallpaper-hd-for-pc.png', 1),
(2, 'Love You To Bits', 2016, ' Alike Studio', 'IOS', 'http://pocketfullofapps.com/wp-content/uploads/2016/02/Love-you-to-bits.png', 1),
(3, 'Jetpack Joyride', 2011, 'Halfbrick Studios', 'IOS, Andriod', 'http://www.dafont.com/forum/attach/orig/3/4/341737.jpg', 1),
(4, 'Angry Birds Star Wars', 2012, 'Rovio Entertainment', 'IOS,Andriod', 'https://lh5.ggpht.com/gLJR8a1u8y9wcOIBCXq8yHHi18pjS-NZMueTF85Pr64ElSnsrPuIbylhE8OVURi5Qz4=h900', 1),
(5, 'Temple Run 2', 2013, 'Imangi Studios', 'IOS,Andriod', 'http://screenshots.en.sftcdn.net/en/scrn/69653000/69653939/temple-run-2-07-700x393.jpg', 1),
(6, 'Minecraft Pocket Edition ', 2011, 'Mojang', 'IOS, Andriod', 'http://androidoyun.club/wp-content/uploads/2015/11/minecraft-pocket-edition-v0-13-0-full-apk.jpg', 1),
(7, 'World of Goo', 2008, '2D Boy', 'IOS, Andriod', 'http://images.nintendolife.com/news/2008/08/2d_boy_interview_world_of_goo/large.jpg', 1),
(8, 'Words with Friends ', 2009, 'Zynga', 'IOS, Android ', 'http://cdn-media-1.lifehack.org/wp-content/files/2012/04/words-with-friends-icon.jpg', 1),
(9, 'Clash of Clans', 2012, 'Supercell', 'IOS', 'http://hoodhacker.com/wp-content/uploads/2015/11/clash-of-clans-hack2.0.jpeg', 1),
(10, 'Plants vs Zombies', 2009, 'PopCap Games', 'IOS, Android ', 'http://kiengiangmuaban.com/raovat/319/89366/images/ImgImg/11205.jpg', 1),
(11, 'Candy Crush Saga ', 2012, 'King', 'IOS', 'http://screenshots.en.sftcdn.net/en/scrn/6655000/6655272/candy-crush-saga-08-700x437.png', 1),
(12, 'Triple Town', 2010, 'Spry Fox', 'IOS', 'http://toucharcade.com/wp-content/uploads/2012/01/tripletown.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xbox`
--

CREATE TABLE IF NOT EXISTS `xbox` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `release_year` year(4) NOT NULL,
  `developer` varchar(45) NOT NULL,
  `platform` varchar(45) NOT NULL,
  `image` varchar(100) NOT NULL,
  `esrb_rating` smallint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xbox`
--

INSERT INTO `xbox` (`id`, `title`, `release_year`, `developer`, `platform`, `image`, `esrb_rating`) VALUES
(1, 'Sunset Overdrive', 2014, 'Insomniac Games', 'Xbox One', 'http://img.au.gpncdn.com/article_title_large/e05ef70d08ce2a88443d3265d033fb1d.jpeg', 3),
(2, 'Halo: The Master Chief Collection', 2014, 'Bungie', 'Xbox One', 'https://upload.wikimedia.org/wikipedia/en/d/d2/Halo_Collection.jpg', 3),
(3, 'Project Spark', 2015, 'SkyBox Labs', 'Xbox', 'http://ecx.images-amazon.com/images/I/71fpYIpkv4L._SL1188_.jpg', 2),
(4, 'Scalebound ', 2017, 'Platinum Games', 'Xbox One', 'https://upload.wikimedia.org/wikipedia/en/f/f6/Scalebound_cover_art.jpg', 5),
(5, 'Cuphead', 2016, 'Studio MDHR', 'Xbox One', 'https://i.ytimg.com/vi/8UExdrEGZ4Y/mqdefault.jpg', 5),
(6, 'Ori and the Blind Forest', 2015, 'Moon Studios', 'Xbox One', 'http://pre07.deviantart.net/d890/th/pre/f/2014/167/e/b/eb72d79135ad065c5bfa9e40c7bce92b-d7mlqu8.jpg', 2),
(7, 'Quantum Break', 2015, 'Remedy Entertainment', 'Xbox One', 'https://upload.wikimedia.org/wikipedia/en/d/d9/Quantum_Break_cover.jpg', 3),
(8, 'Fable Legends', 2015, 'Lionhead Studios', 'Xbox One', 'https://upload.wikimedia.org/wikipedia/en/4/46/Fable_Legends.jpg', 4),
(9, 'Crackdown 3', 2015, 'Cloudgine', 'Xbox One', 'http://mega-game.org/_nw/11/13482878.jpg', 5),
(11, 'Halo 5: Guardians', 2015, '343 Industries', 'Xbox One', 'http://static.trueachievements.com/customimages/039459.jpg', 4),
(12, 'Gears of War 4', 2016, 'The Coalition', 'Xbox One', 'http://cdn.wccftech.com/wp-content/uploads/2016/04/ghsfsgh-gears-of-war-4-vertical-1.jpg', 3),
(13, 'Dead Rising 3', 2013, 'Capcom Vancouver', 'Xbox', 'https://upload.wikimedia.org/wikipedia/en/0/00/Dead_Rising_3_Cover_Art.jpg', 3),
(21, 'Call of Duty 4 Modern Warfare', 2007, 'Infinity Ward', 'Xbox 360', 'http://ecx.images-amazon.com/images/I/51lSiG%2BtEWL.jpg', 3),
(22, 'Call of Duty: Black Ops III', 2015, 'Treyarch', 'Xbox 360', 'http://charlieintel.com/wp-content/uploads/2015/04/9200000042914442.jp_.jpg', 3),
(23, 'Fallout 4', 2015, 'Bethesda Game Studios', 'Xbox One', 'http://cdn.gamerant.com/wp-content/uploads/Fallout-4-Box-Art.jpg', 3),
(24, 'Star Wars Battlefront', 2015, 'EA DICE', 'Xbox One', 'http://ecx.images-amazon.com/images/I/71unMhOsM-L._SX425_.jpg', 5),
(25, 'Forza Motorsport 6', 2015, 'Turn 10 Studios', 'Xbox One', 'http://xboxonedigital.eu/image/cache/data/ForzaMotorsport6-400x564.jpg', 1),
(26, 'Madden NFL 16', 2015, 'EA Tiburon', 'Xbox One', 'https://images-na.ssl-images-amazon.com/images/I/51jL2oBgc4L.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_games`
--
ALTER TABLE `board_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_rating`
--
ALTER TABLE `board_rating`
  ADD PRIMARY KEY (`age_rating_id`);

--
-- Indexes for table `games_ratings`
--
ALTER TABLE `games_ratings`
  ADD PRIMARY KEY (`esrb_rating_id`);

--
-- Indexes for table `mobile`
--
ALTER TABLE `mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xbox`
--
ALTER TABLE `xbox`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_games`
--
ALTER TABLE `board_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `board_rating`
--
ALTER TABLE `board_rating`
  MODIFY `age_rating_id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `games_ratings`
--
ALTER TABLE `games_ratings`
  MODIFY `esrb_rating_id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mobile`
--
ALTER TABLE `mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `xbox`
--
ALTER TABLE `xbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
