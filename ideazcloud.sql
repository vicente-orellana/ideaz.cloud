-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2016 at 08:39 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ideazcloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `threads` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `threads`) VALUES
(1, 'A_category', 4),
(2, 'Music', 4),
(3, 'A_category_2', 1),
(4, 'A_category_3', 0),
(5, 'A_category_4', 0),
(6, 'A_category_5', 0),
(7, 'A_category_6', 0),
(8, 'A_category_7', 0),
(9, 'A_category_8', 0),
(10, 'A_category_9', 0),
(11, 'A_category_10', 1),
(12, 'A_category_11', 1),
(13, 'A_category_12', 0),
(14, 'A_category_13', 1),
(15, 'Category_13', 0),
(16, 'Category_14', 0),
(17, 'Category_15', 0),
(18, 'Category_16', 0),
(34, 'Best_Locations_in_the_World', 1),
(21, 'ESPN', 0),
(22, 'Fun', 0),
(23, 'Games', 1),
(24, 'Hogwarts', 0),
(25, 'Harry_Potter', 0),
(26, 'Intel', 0),
(27, 'Juicing', 0),
(28, 'Kites', 0),
(29, 'League_of_Legends', 0),
(30, 'Funny_Pics', 0),
(31, 'Virtual_Reality', 0),
(32, 'Harvard', 0),
(33, 'Dinosaurs', 0),
(35, 'Board_Games', 1),
(36, 'Drinks', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(500) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `thread_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `user_id`, `thread_id`) VALUES
(1, '<p>A test reply.</p>', 1, 1),
(6, '<p>Wow!</p>', 2, 1),
(7, '<p>Lorem.</p>', 3, 1),
(8, '<p>test</p>', 3, 3),
(9, '<p>Harvard is #1</p>', 4, 4),
(10, '<p>Lalala</p>', 1, 1),
(11, '<img src="https://g.twimg.com/blog/blog/image/Cat-party.gif">', 1, 1),
(12, '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/9g6jidr4Zog" frameborder="0" allowfullscreen=""></iframe></div>', 1, 1),
(13, '<p>Another post.</p>', 1, 1),
(14, '<p>Blah.</p>', 1, 1),
(15, '<p>Look at the nice infinite scroll.</p>', 1, 1),
(16, '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/bjyGkvNUtRU" frameborder="0" allowfullscreen=""></iframe></div>', 1, 1),
(17, '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen=""></iframe></div>', 1, 1),
(18, '<p>:)</p>', 4, 4),
(19, '<p>Wow!</p>', 2, 1),
(20, '<p>Hehehehehehee</p>', 2, 2),
(22, '<p><strong>I&nbsp;also like to play chess!</strong></p>', 1, 14),
(23, '<p class="align-center"><img src="/uploads/images/6ffcca3d8b8d1fe5975d355173d9ddac.jpg" data-image=""></p>\n\n<p class="align-center"><em>This is Motoko. She is my favorite anime character from&nbsp;Ghost in the Shell!</em></p>', 1, 1),
(24, '<p>Wow!&nbsp;I&nbsp;would love to visit Hawaii one of these days!</p>', 1, 13),
(25, '<p>Hehehehehehee!</p>', 23, 2),
(27, '<p>Those are some good words.</p>', 23, 4),
(28, '<figure><img src="http://r.ddmcdn.com/s_f/o_1/cx_41/cy_0/cw_360/ch_360/w_360/APL/uploads/2014/06/130133644036413155301501197_Ragamuffin.jpg"></figure>', 23, 22),
(29, '<figure><img src="/uploads/images/7477ec541c71d7a1384a66d2c36a124d.jpg" data-image=""></figure>', 23, 22),
(30, '<p>O_O</p>', 23, 1),
(31, '<p>I love to play tic-tac-toe as well!</p>', 23, 14),
(32, '<p class="align-center"><iframe width="500" height="281" src="//www.youtube.com/embed/u3VFzuUiTGw" frameborder="0" allowfullscreen=""></iframe></p><p class="align-center"></p>', 23, 4);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `posts` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `upvotes` int(10) unsigned NOT NULL,
  `vote_users` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `title`, `body`, `posts`, `user_id`, `category_id`, `upvotes`, `vote_users`) VALUES
(1, 'Test thread', '<p>This is a test thread.</p>', 16, 1, 1, 2, ' 2  1 '),
(2, 'Another test idea', '<p>Hehehehe</p>', 3, 1, 1, 1, ' 2 '),
(3, 'Melanie Martinez - Alphabet Boy', '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/tDS3_RBYdJQ" frameborder="0" allowfullscreen=""></iframe></div>', 1, 1, 2, 0, ''),
(4, 'Lorem...', '<p class="align-center"><img src="http://news.harvard.edu/gazette/wp-content/themes/gazette20/a/i/harvard-logo-2x.png" alt="" title=""></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla blandit sodales ex sit amet interdum. Donec metus massa, vulputate et facilisis ut, molestie vitae quam. Quisque mattis gravida eros, vel laoreet tellus sagittis nec. Pellentesque id metus vestibulum, facilisis nulla in, accumsan nunc. Ut interdum auctor ligula vitae commodo. Nullam mauris neque, bibendum a velit vel, vulputate faucibus urna. Proin sed libero suscipit, pulvinar tellus id, porttitor risus.</p>\n\n\n\n<p>Fusce nec sapien nibh. Sed dictum dapibus tortor quis pellentesque. Maecenas dignissim luctus augue eu viverra. Praesent mauris lectus, tempor vel consequat congue, lobortis sit amet tortor. In consequat arcu sem, at sodales lorem pulvinar ut. Maecenas vulputate blandit lacus id viverra. Suspendisse vitae nunc risus. Proin pellentesque iaculis accumsan. Cras nec risus sit amet arcu ultricies lacinia. In hac habitasse platea dictumst. Praesent luctus nunc eros, et sollicitudin est ullamcorper tristique. Vestibulum blandit rhoncus erat. Praesent dictum ac urna ut luctus. Phasellus ultricies metus ac mi fermentum, et ultricies purus fringilla.</p>\n\n\n\n\n\n<p>Quisque molestie scelerisque ipsum ac porta. Integer laoreet quam sed tellus cursus, non accumsan magna bibendum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin sed cursus eros, quis tempus nibh. Aenean vulputate mauris ex, sed sollicitudin metus efficitur vitae. Etiam arcu risus, semper quis facilisis eu, iaculis quis libero. Nullam congue fermentum egestas. In dictum eleifend porttitor. Aliquam erat volutpat. Curabitur porta quam a urna egestas, a varius nisl sollicitudin. Mauris cursus tellus id augue ultrices, at tempus ipsum pharetra. Aliquam eros ipsum, dignissim sit amet pretium sed, sagittis a sem. Donec maximus tortor vitae cursus mattis. Sed sapien enim, feugiat sit amet est et, dignissim tincidunt leo. Morbi sagittis rutrum sodales.</p>\n\n\n\n\n\n<p>Duis placerat convallis urna in condimentum. Curabitur eu ullamcorper est, nec euismod ante. Curabitur mollis dolor in interdum viverra. Ut at ex turpis. Aenean vitae facilisis libero, sit amet hendrerit odio. Nullam malesuada laoreet dolor, pharetra suscipit diam tincidunt id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque in nibh lacus. Proin velit urna, fermentum vitae dui vel, efficitur semper nisi. Aliquam ullamcorper eros quis odio posuere eleifend. In tincidunt, nibh elementum cursus aliquet, mauris magna elementum eros, sed sollicitudin dolor urna nec felis. Vivamus ut pharetra metus, a commodo sapien. Duis quis arcu vitae augue luctus consequat quis vitae ante. Nam vehicula feugiat lacinia.</p>\n\n\n\n\n\n<p>Sed eleifend sit amet leo id lacinia. Vivamus blandit, lectus et egestas consequat, odio arcu egestas augue, at sagittis libero lectus eu lorem. Donec elementum condimentum vehicula. Fusce et euismod mi. Nulla aliquam vehicula mauris. Sed porttitor eget mi vitae interdum. Mauris ut massa ipsum.</p>', 4, 1, 3, 1, ' 1 '),
(5, 'Lorem ipsum', '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/Bun4BgPnZVI" frameborder="0" allowfullscreen=""></iframe></div><p>facilisis ut, molestie vitae quam. Quisque mattis gravida eros, vel laoreet tellus sagittis nec. Pellentesque id metus vestibulum, facilisis nulla in, accumsan nunc. Ut interdum auctor ligula vitae commodo. Nullam mauris neque, bibendum a velit vel, vulputate faucibus urna. Proin sed libero suscipit, pulvinar tellus id, porttitor risus.</p>\r\n\r\n<p>Fusce nec sapien nibh. Sed dictum dapibus tortor quis pellentesque. Maecenas dignissim luctus augue eu viverra. Praesent mauris lectus, tempor vel consequat congue, lobortis sit amet tortor. In consequat arcu sem, at sodales lorem pulvinar ut. Maecenas vulputate blandit lacus id viverra. Suspendisse vitae nunc risus. Proin pellentesque iaculis accumsan. Cras nec risus sit amet arcu ultricies lacinia. In hac habitasse platea dictumst. Praesent luctus nunc eros, et sollicitudin est ullamcorper tristique. Vestibulum blandit rhoncus erat. Praesent dictum ac urna ut luctus. Phasellus ultricies metus ac mi fermentum, et ultricies purus fringilla.</p>\r\n\r\n<p>Quisque molestie scelerisque ipsum ac porta. Integer laoreet quam sed tellus cursus, non accumsan magna bibendum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin sed cursus eros, quis tempus nibh. Aenean vulputate mauris ex, sed sollicitudin metus efficitur vitae. Etiam arcu risus, semper quis facilisis eu, iaculis quis libero. Nullam congue fermentum egestas. In dictum eleifend porttitor. Aliquam erat volutpat. Curabitur porta quam a urna egestas, a varius nisl sollicitudin. Mauris cursus tellus id augue ultrices, at tempus ipsum pharetra. Aliquam eros ipsum, dignissim sit amet pretium sed, sagittis a sem. Donec maximus tortor vitae cursus mattis. Sed sapien enim, feugiat sit amet est et, dignissim tincidunt leo. Morbi sagittis rutrum sodales.</p>\r\n\r\n<p>Duis placerat convallis urna in condimentum. Curabitur eu ullamcorper est, nec euismod ante. Curabitur mollis dolor in interdum viverra. Ut at ex turpis. Aenean vitae facilisis libero, sit amet hendrerit odio. Nullam malesuada laoreet dolor, pharetra suscipit diam tincidunt id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque in nibh lacus. Proin velit urna, fermentum vitae dui vel, efficitur semper nisi. Aliquam ullamcorper eros quis odio posuere eleifend. In tincidunt, nibh elementum cursus aliquet, mauris magna elementum eros, sed sollicitudin dolor urna nec felis. Vivamus ut pharetra metus, a commodo sapien. Duis quis arcu vitae augue luctus consequat quis vitae ante. Nam vehicula feugiat lacinia.</p>\r\n\r\n<p>Sed eleifend sit amet leo id lacinia. Vivamus blandit, lectus et egestas consequat, odio arcu egestas augue, at sagittis libero lectus eu lorem. Donec elementum condimentum vehicula. Fusce et euismod mi. Nulla aliquam vehicula mauris. Sed porttitor eget mi vitae interdum. Mauris ut massa ipsum.</p>', 0, 1, 11, 0, ''),
(6, 'Test', '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/u3VFzuUiTGw" frameborder="0" allowfullscreen=""></iframe></div>', 0, 1, 14, 0, ''),
(7, '7 Years', '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/jErJimwom94" frameborder="0" allowfullscreen=""></iframe></div>', 0, 1, 2, 0, ''),
(8, 'Yet another test', '<p>Another test...</p><ul><li>1</li><li>2</li><li>3</li></ul><p><em>Italic</em></p><p><del>Strikethrough</del></p><p><br></p><p class="align-right"><del></del>Right</p>', 0, 1, 1, 0, ''),
(9, 'A new thread', '<p>Another thread...</p>', 0, 3, 1, 0, ''),
(10, 'Blah blah blah', '<p>blah blah</p>', 0, 5, 12, 0, ''),
(11, 'HI', '<p>Hi</p>', 0, 1, 19, 0, ''),
(12, 'A serious thread.', '<div class="video-container"><iframe width="500" height="281" src="//www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen=""></iframe></div>', 0, 1, 2, 0, ''),
(13, 'Hawaii', '<p class="align-center"><img src="http://www.astonhotels.com/assets/slides/690x380-Hawaii-Sunset.jpg"></p>\n\n<p class="align-center"></p>', 1, 1, 34, 0, ''),
(14, 'What is your favorite game?', '<p>My favorite game is tic-tac-toe!</p>', 2, 1, 23, 0, ''),
(15, 'Any chess players out there?', '<p>I''m looking for a formidable opponent!</p>', 0, 1, 35, 0, ''),
(22, 'Love this song!', '<p class="align-center"><iframe width="500" height="281" src="//www.youtube.com/embed/Bun4BgPnZVI" frameborder="0" allowfullscreen=""></iframe></p>', 2, 23, 2, 1, ' 23 ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `is_admin` int(1) unsigned NOT NULL,
  `posts` int(10) unsigned NOT NULL,
  `avatar` varchar(400) NOT NULL DEFAULT '<img src="/templates/images/anonymous.jpg" />',
  `about` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_admin`, `posts`, `avatar`, `about`) VALUES
(1, 'admin', '$2y$10$.38amDq2exaWwcD86CFHxOho5qoH4umqN0rQQSE.io8GvWKWuNLWu', 'admin@ideaz.cloud', 1, 25, '<img src="/uploads/images/9a312f91f3cef7d6501506b2a9055c49.jpg" />', '<figure><img src="http://sports.cbsimg.net/images/collegebasketball/logos/100x100/HARV.png"></figure>\r\n\r\n<p class="align-center"></p>\r\n\r\n<p class="align-center">This is an example of About Me text.</p><p class="align-right">I&nbsp;also happen to be a chess player.</p><p class="align-center"><del>Not really...</del></p>'),
(2, 'user1', '$2y$10$0vDEwV3n5WY..MZ.C2xXUeInp5hh62VRByk2J/isu.M.OHhPqLRge', 'user1@ideaz.cloud', 0, 3, '<img src="/uploads/images/c83fdb1d97c99cf567b52a7835619ecc.jpg" />', ''),
(3, 'user3', '$2y$10$0dqI/FUGKRknIDrqg9Vj0eO4ONdfz6D.1vpThOTe5LDHuzyxUhAgq', 'user3@ideaz.cloud', 0, 3, '<img src="/templates/images/anonymous.jpg" />', ''),
(4, 'user2', '$2y$10$6QeB6qkYetDKBgP//W4kP.xzNY05ckbIY3QQ84QvtcCzhkqhgFO1K', 'user2@ideaz.cloud', 0, 2, '<img src="/uploads/images/4f8cc10df8a945be09dbc442d4afbd19.jpg" />', ''),
(5, 'user4', '$2y$10$XTmiuns9Ybpn0sudBzvw8upiIbziI8YHv/hRfB9ej/0PUoo5jwyiq', 'user4@ideaz.cloud', 0, 1, '<img src="/templates/images/anonymous.jpg" />', ''),
(6, 'user5', '$2y$10$Bd/tNJerHqVx69XqzjzWJeJ5VB11u9.xeFG3krdGx7fD442hwkhM.', 'user5@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(7, 'user6', '$2y$10$9saGkgRO966jjQqA5hdwteldiS6bgkfLvwuAxxxQebaCm7CtW8S9O', 'user6@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(8, 'user7', '$2y$10$w3b4B6OfxFJ40Q1ttvHX4..M2OJjbIuhiCzSYSk4Y0vG.UgM3iOWG', 'user7@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(9, 'user8', '$2y$10$yr.ZFuKBDoFQoCoiX1ItrODAv/s3ewmLKi7Y1pzHBDktHQKhR.KAu', 'user8@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(10, 'user9', '$2y$10$ftGr.L.3uyFyxqAO2CjsQOGSCIMdZEvdLX64abSPo2BcELCcdzEty', 'user9@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(11, 'user10', '$2y$10$T5w0D/cu43iFNPX4gbRqMOTVWnCQGGa/1tFPCQj759gTYPFp54Fe2', 'user10@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(12, 'user11', '$2y$10$3SXwEqnTA0qRE7iQ3rFEWuSDQcCPAcMbPG2PxGKLkI7RJ5JyR.rjy', 'user11@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(13, 'user12', '$2y$10$vU4rvkyc88py0SkK43c3u.JR1SK9NHh0DFi4bYT8YggaSSVdrfoLi', 'user12@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(14, 'user13', '$2y$10$bx396xF.mTPcRuPPkGXRouTE9oVlCC2vnh7Ck8/OOL3vrKsaB2diu', 'user13@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(15, 'user14', '$2y$10$2fX/0/sxSAzbwMFLnxuWY.htbANdIID7w57qO0Rx1fuMs33W5zpm6', 'user14@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(16, 'user15', '$2y$10$SdyvsO9sAkUR4SBcRva5r.0Uh77fCssL2327MlEjpPUAJ3PxWJum6', 'user15@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(17, 'user16', '$2y$10$XydB5AefPzTBgUlRdJItIeCt0JfAwPEnLiptW/Z5pAMVtqqLEcSEW', 'user16@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(18, 'user17', '$2y$10$A7bsDx6D8N.LGYrlzOjR8u9P8.NQyyKUNCNZA.H5w/ROKYvl4fTnu', 'user17@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(19, 'user18', '$2y$10$egT/vFrtVbs4aGn57QGjPORII5p3LQuqpMWg1Y7c5TF7esU5Y1HMC', 'user18@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(20, 'user19', '$2y$10$3V2O0PnyoOM5joas1n1.uOPAgnDEp7Nscz4TCnhtxfdCovm3.A1xa', 'user19@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(21, 'user20', '$2y$10$4J5fFWYZ4vWlT6YneG3opOKPKfYMBaqUDqE9zwE1MakI828o43/jy', 'user20@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(22, 'user21', '$2y$10$GyOoVS8ABKcz5v52GDDzsentq2.sr7GiSGlDoyfF0gmRHSpReIAL2', 'user21@ideaz.cloud', 0, 0, '<img src="/templates/images/anonymous.jpg" />', ''),
(23, 'vicente', '$2y$10$UtQ.Z5Qa04T.BoNepoSKAOIx.goVg.lP8aJUvkpD//xCTahAcap7K', 'vicente@ideaz.cloud', 0, 7, '<img src="/uploads/images/33bded65ef1be56806471a1b075f9094.jpg" />', '<p>I''m a CS50 student!</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
