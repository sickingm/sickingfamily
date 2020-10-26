-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2020 at 07:09 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sickingf_family`
--

-- --------------------------------------------------------

--
-- Table structure for table `clans`
--

CREATE TABLE `clans` (
  `clan_id` bigint(20) NOT NULL,
  `clan_name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clans`
--

INSERT INTO `clans` (`clan_id`, `clan_name`) VALUES
(7, 'Andy & Elaine McInerney'),
(2, 'Fred & Nancy Lloyd'),
(9, 'John & Julie Bubash'),
(10, 'Laura Sicking'),
(8, 'Mark & Clare Wilhelm'),
(3, 'Mark & Teresa Sicking'),
(4, 'Matt & Jeannette Sicking'),
(1, 'Ollie & Jinny Sicking'),
(5, 'Paul & Janet Sicking'),
(6, 'Regie Neff');

-- --------------------------------------------------------

--
-- Table structure for table `dbc_constants`
--

CREATE TABLE `dbc_constants` (
  `name` varchar(24) CHARACTER SET latin1 NOT NULL,
  `value` varchar(128) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbc_constants`
--

INSERT INTO `dbc_constants` (`name`, `value`) VALUES
('date', '12/18/2019'),
('number', '29'),
('organizer', 'Matt'),
('time', 'tbd'),
('venue', 'tbd');

-- --------------------------------------------------------

--
-- Table structure for table `deep_thoughts`
--

CREATE TABLE `deep_thoughts` (
  `meeting_number` int(8) NOT NULL DEFAULT '0',
  `meeting_date` date DEFAULT NULL,
  `thought` text CHARACTER SET latin1,
  `dummy_PWD` varchar(41) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deep_thoughts`
--

INSERT INTO `deep_thoughts` (`meeting_number`, `meeting_date`, `thought`, `dummy_PWD`) VALUES
(4, '2005-05-11', 'Today I accidentally stepped on a snail on the sidewalk in front of my house and I thought I too, am like that snail.  I build a defensive wall around myself, a \"shell\" if you will.\nBut my shell isn\'t made out of a hard, protective substance.  Mine is made out of tin foil and paper bags.', NULL),
(5, '2005-06-02', 'I think a funny thing to say when a child asks you why it is raining would be: \"God is crying because you were bad.\"', NULL),
(6, '2005-07-12', 'The next time you go to the doctor, go ahead and bring a stool sample.  They might need it.\r\nBetter go ahead and bring one to the dentist too.', NULL),
(9, '2005-10-18', 'The king threw back his head and laughed.  He enjoyed a good laugh as did his wife, the queen.  When she saw the king laughing she let out a big laugh too.  In fact, she laughed so hard she broke her throne.  This made them laugh harder.\r\nThen they got serious when they remembered they had the plague.  \"The plague,\" said the king, but the way he said it made them both burst out laughing again.', NULL),
(10, '2005-11-15', 'I hope that if dogs ever take over the world and they choose a king, they don\'t go just by size, because I think there are probably a lot of Chihuahuas with good ideas.', NULL),
(11, '2005-12-22', 'Many people don\'t know that ordinary coral painted brown and attached to the skull with wooden screws can make your child look like a reindeer.', NULL),
(12, '2006-01-12', 'If I lived back in the Wild West days, instead of carrying a six-gun in my holster, I\'d carry a soldering iron. That way if some smart aleck-y cowboy said something like, \"Hey look, he\'s carrying a soldering iron\" and started laughing and everybody else started laughing, I could just say \"That\'s right, it\'s a soldering iron...The soldering iron of justice.\" Then everybody would get real quiet and ashamed because they made fun of the soldering iron of justice. Then I would probably hit them up for a free drink.', NULL),
(13, '2006-02-28', 'Sometimes the beauty of the world is so overwhelming, I just want to throw back my head and gargle.  Just gargle and gargle, and I don\'t care who hears me, because I am beautiful.', '737b14b40a889f19'),
(15, '2006-04-17', 'I think in one of my previous lives I was a mighty queen, because I like everyone to do what I say.', '737b14b40a889f19'),
(27, '2009-01-12', 'I think a good novel would be where a bunch of men on a ship are looking for a whale. They look and look but they never find him. And you know why? It doesn\'t say. The book leaves it up to you, the reader to decide. Then at the very end, there\'s a page you can lick and it tastes like kool-aid.', NULL),
(28, '2015-01-01', 'When you\'re riding in a time machine way far into the future, don\'t stick your elbow out the window, or it\'ll turn into a fossil. ', NULL),
(29, '2015-01-03', 'If you were a pirate, you know what would be the one thing that would really make you mad? Treasure chests with no handles. How the hell are you supposed to carry it?! ', NULL),
(30, '2015-01-02', 'Better not take a dog on the space shuttle, because if he sticks his head out when you\'re coming home his face might burn up', NULL),
(31, '2015-01-04', 'If you\'re a horse, and someone gets on you, and falls off, and then gets right back on you, I think you should buck him off right away. ', NULL),
(32, '2015-01-05', 'If a kid asks where rain comes from, I think a cute thing to tell him is \"God is crying.\" And if he asks why God is crying, another cute thing to tell him is \"Probably because of something you did.\" ', NULL),
(33, '2015-01-06', 'The first thing was, I learned to forgive myself. Then, I told myself, \"Go ahead and do whatever you want, it\'s okay by me.\" ', NULL),
(34, '2015-01-07', 'If I ever get real rich, I hope I\'m not real mean to poor people, like I am now.', NULL),
(35, '2015-01-08', 'I remember how my Great Uncle Jerry would sit on the porch and whittle all day long. Once he whittled me a toy boat out of a larger toy boat I had. It was almost as good as the first one, except now it had bumpy whittle marks all over it. And no paint, because he had whittled off the paint. ', NULL),
(36, '2015-01-09', 'I hope that after I die, people will say of me: \"That guy sure owed me a lot of money.\" ', NULL),
(37, '2015-01-10', 'Children need encouragement. So if a kid gets an answer right, tell him it was a lucky guess. That way, he develops a good, lucky feeling. ', NULL),
(38, '2015-01-11', 'I can picture in my mind a world without war, a world without hate. And I can picture us attacking that world, because they\'d never expect it. ', NULL),
(39, '2015-01-12', 'It\'s easy to sit there and say you\'d like to have more money. And I guess that\'s what I like about it. It\'s easy. Just sitting there, rocking back and forth, wanting that money. ', NULL),
(40, '2015-01-13', 'I wish I would have a real tragic love affair and get so bummed out that I\'d just quit my job and become a bum for a few years, because I was thinking about doing that anyway. ', NULL),
(41, '2015-01-14', 'The most unfair thing about life is the way it ends. I mean, life is tough. It takes up a lot of your time. What do you get at the end of it? A death. What\'s that, a bonus? I think the life cycle is all backwards. You should die first, get it out of the way. Then you live in an old age home. You get kicked out when you\'re too young, you get a gold watch, you go to work. You work forty years until you\'re young enough to enjoy your retirement. You do drugs, alcohol, you party, you get ready for high school. You go to grade school, you become a kid, you play, you have no responsibilities, you become a little baby, you go back into the womb, you spend your last nine months warm, happy, and floating...you finish off as an orgasm. ', NULL),
(42, '2015-01-15', 'The face of a child can say it all, especially the mouth part of the face. ', NULL),
(43, '2015-01-16', 'To me, boxing is like a ballet, except there\'s no music, no choreography, and the dancers hit each other. ', '41'),
(44, '2015-01-17', 'Remember, kids in the backseat cause accidents; accidents in the backseat cause kids. ', '42'),
(45, '2015-01-18', 'If you\'re a cowboy and you\'re dragging a guy behind your horse, I bet it would really make you mad if you looked back and the guy was reading a magazine.', NULL),
(48, '2015-01-20', 'I think my new thing will be to try to be a real happy guy. I\'ll just walk around being real happy until some jerk says something stupid to me.', NULL),
(49, '2015-01-21', 'If you lived in the Dark Ages and you were a catapult operator, I bet the most common question people would ask is, \'Can\'t you make it shoot farther?\' \'No, I\'m sorry. That\'s as far as it shoots.\'', NULL),
(50, '2015-01-22', 'Is there anything more beautiful than a beautiful, beautiful flamingo, flying across in front of a beautiful sunset? And he\'s carrying a beautiful rose in his beak, and also he\'s carrying a very beautiful painting with his feet. And also, you\'re drunk.', NULL),
(52, '2015-01-24', 'I think people tend to forget that trees are living creatures. They\'re sort of like dogs. Huge, quiet, motionless dogs, with bark instead of fur.', NULL),
(54, '2015-01-26', 'One thing kids like is to be tricked. For instance, I was going to take my little nephew to Disneyland, but instead I drove him to an old burned-out warehouse. \'Oh, no,\' I said. \'Disneyland burned down.\' He cried and cried, but I think that deep down, he thought it was a pretty good joke. I started to drive over to the real Disneyland, but it was getting pretty late. ', NULL),
(55, '2015-01-27', 'Too bad you can\'t buy a voodoo globe so that you could make the earth spin real fast and freak everybody out. ', NULL),
(56, '2015-01-28', 'If you\'re a young Mafia gangster out on your first date, I bet it\'s real embarrassing if someone tries to kill you.  ', NULL),
(57, '2015-01-29', 'You know what\'s probably a good thing to hang on your porch in the summertime, to keep mosquitos away from you and your guests? Just a big bag full of blood. ', NULL),
(58, '2015-01-30', 'I guess the hard thing for a lot of people to accept is why God would allow me to go running through their yards, yelling and spinning around. ', NULL),
(59, '2015-01-31', 'It takes a big man to cry, but it takes a bigger man to laugh at that man. ', NULL),
(61, '2015-02-07', 'Here\'s a good thing to do if you go to a party and you don\'t know anybody: First take out the garbage. Then go around and collect any extra garbage that people might have, like a crumpled napkin, and take that out too. Pretty soon people will want to meet the busy garbage guy.  ', NULL),
(62, '2015-02-03', 'What is it about a beautiful sunny afternoon, with the birds singing and the wind rustling through the leaves, that makes you want to get drunk? And after you\'re real drunk, maybe go down to the public park and stagger around and ask people for money, and then lay down and go to sleep. ', NULL),
(63, '2015-02-04', 'Is there anything more beautiful than a beautiful, beautiful flamingo, flying across in front of a beautiful sunset? And he\'s carrying a beautiful rose in his beak, and also he\'s carrying a very beautiful painting with his feet. And also, you\'re drunk. ', NULL),
(64, '2015-02-02', 'I wish outer space guys would conquer the Earth and make people their pets, because I\'d like to have one of those little beds with my name on it. ', NULL),
(65, '2015-02-03', 'I think a good product would be Baby Duck Hat. It\'s a fake baby duck, which you strap on top of your head. Then you go swimming underwater until you find a mommy duck and her babies, and you join them. Then, all of a sudden, you stand up out of the water and roar like Godzilla. Man, those ducks really take off! Also, Baby Duck Hat is good for parties. ', '66'),
(69, '2015-02-06', 'It makes me mad when people say I turned and ran like a scared rabbit. Maybe it was like an angry rabbit, who was going to fight in another fight, away from the first fight. ', NULL),
(70, '2016-05-01', 'If I had a dollar for every girl that found me unattractive, they\'d eventually find me attractive.', NULL),
(71, '2016-05-01', 'I changed my password to \"incorrect\" so whenever I forget it the computer will say, \"Your password is incorrect.\"', NULL),
(72, '2016-05-01', 'I hate it when people use big words just to make themselves sound perspicacious.', NULL),
(73, '2016-05-01', 'I bought a vacuum cleaner six months ago and so far all it\'s been doing is gathering dust.', NULL),
(74, '2016-05-01', 'A computer once beat me at chess, but it was no match for me at kick boxing.', NULL),
(75, '2016-05-01', 'There may be no excuse for laziness, but I\'m still looking.', NULL),
(76, '2016-05-01', 'Give me ambiguity or give me something else.', NULL),
(77, '2016-05-01', 'I like long walks, especially when they\'re taken by people who annoy me.', NULL),
(78, '2016-05-01', 'No matter how much you push the envelope, it\'ll still be stationery.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` bigint(20) NOT NULL,
  `member_ptr` bigint(20) NOT NULL DEFAULT '0',
  `email` varchar(64) NOT NULL DEFAULT '',
  `email_type` varchar(6) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `member_ptr`, `email`, `email_type`) VALUES
(1225, 44, 'teresa@sickingfamily.com', 'DBC'),
(1458, 62, ' ', ' '),
(313, 58, 'sickingj@aol.com', 'home'),
(1224, 44, 'tmsicking@sbcglobal.net', 'home'),
(1235, 33, 'ecmiazga@yahoo.com', 'home'),
(1418, 53, 'guttrx@yahoo.com', 'home'),
(1077, 54, 'ennaybbil@hotmail.com', 'home'),
(1448, 65, 'markw@sickingfamily.com', 'DBC'),
(1389, 38, 'emailsjn@gmail.com', 'home'),
(1180, 4, 'maureenbranson@yahoo.com', 'home'),
(1311, 63, 'wilhelmcd@att.net', 'home'),
(996, 60, 'clairesicking@hotmail.com', 'home'),
(1255, 77, 'stevepearce916@gmail.com', 'home'),
(1452, 19, 'katello@gmail.com', 'other'),
(128, 68, 'wil.valenzuela@ugs.com', 'work'),
(129, 68, 'wvalenzuela@socal.rr.com', 'home'),
(1451, 66, 'mwilhelm16@gmail.com', 'home'),
(1447, 65, 'mbwilhelm@att.net', 'home'),
(1402, 8, 'juliebubash@gmail.com', 'home'),
(1320, 13, 'fredlloyd@charter.net', 'home'),
(1324, 51, 'grancyx8@charter.net', 'home'),
(314, 58, 'janet@sickingfamily.com', 'DBC'),
(787, 40, 'lvsicking@sbcglobal.net', 'home'),
(1310, 63, 'clare@sickingfamily.com', 'DBC'),
(1319, 13, 'fred@careersincomputers.com', 'work'),
(1214, 59, 'sickingp@gmail.com', 'home'),
(995, 61, 'ssteinbruegge@hotmail.com', 'home'),
(1343, 42, 'mark@sickingfamily.com', 'DBC'),
(1177, 11, 'lloydbf@gmail.com', 'home'),
(562, 73, 'nortonjl@sbcglobal.net', 'home'),
(964, 74, 'ljodon@gmail.com', 'home'),
(1353, 78, 'ksicking@gmail.com', 'home'),
(1379, 52, 'lauras1022@gmail.com', 'home'),
(786, 40, 'laura@sickingfamily.com', 'DBC'),
(1323, 51, 'nancy@sickingfamily.com', 'DBC'),
(1282, 22, 'amscuba09@gmail.com', 'home'),
(1152, 25, 'mlmalpocker1@att.net', 'home'),
(1178, 17, 'bflkfl@yahoo.com', 'home'),
(1446, 48, 'luke@sickingfamily.com', 'home'),
(1174, 34, 'marcusmiazga11@gmail.com ', 'home'),
(951, 84, 'CharlieSicking@sbcglobal.net', 'home'),
(1401, 8, 'julie@sickingfamily.com', 'DBC'),
(633, 47, 'jeannette@sickingfamily.com', 'home'),
(1445, 67, 'patrick.neff@me.com', 'home'),
(1283, 9, 'kmbubash@yahoo.com', 'home'),
(1304, 26, 'AndyMcInerney69@gmail.com', 'home'),
(1427, 1, 'aaron.branson@gmail.com', 'home'),
(1420, 5, 'ambubash@sbcglobal.net', 'home'),
(1253, 56, 'cariepearce@gmail.com', 'home'),
(1213, 59, 'paul@sickingfamily.com', 'DBC'),
(1271, 50, 'samsicking0510@gmail.com', 'home'),
(1390, 41, 'MarianneSicking@gmail.com', 'home'),
(1344, 64, 'ecwilhelm@att.net', 'home'),
(1153, 20, 'rubydo@divastar.net', 'home'),
(839, 99, 'marytbudde@prodigy.com', 'home'),
(883, 91, 'splatz0510@gmail.com', 'home'),
(1019, 105, 'splatz0510@gmail.com', 'home'),
(1303, 27, 'ElaineDMcInerney@gmail.com', 'home'),
(1164, 43, 'qxface@gmail.com', 'other'),
(1091, 115, 'kandomom2@att.net', 'home'),
(1078, 39, 'jthomasnguyen@yahoo.com', 'other'),
(1415, 10, 'paulbubash@gmail.com', 'home'),
(1342, 42, 'msicking49@gmail.com', 'other'),
(1256, 55, 'sickingalison@gmail.com', 'home'),
(1352, 57, 'sickingd@gmail.com', 'home'),
(1274, 28, 'kevin1220@live.missouristate.edu', ' '),
(1045, 3, 'lukeabranson@gmail.com', 'home'),
(1421, 120, 'dlthu9@gmail.com', 'home'),
(1302, 27, 'elaine@sickingfamily.com', 'DBC'),
(1079, 39, 'thunder95@hotmail.com', 'home'),
(1163, 43, 'MikeSicking@sbcglobal.net', 'home'),
(1449, 121, 'medtf7@gmail.com', 'home'),
(1441, 49, 'matt@sickingfamily.com', 'home'),
(1365, 130, 'gec005@gmail.com', ' '),
(1162, 43, 'mike@sickingfamily.com', 'DBC'),
(1280, 29, ' Maggie.Baker@dentwizard.com ', 'home'),
(1197, 123, 'scubastl@yahoo.com', 'home'),
(1356, 30, 'qmcinerney@yahoo.com', 'home'),
(1444, 67, 'neff.patrick@gmail.com', 'home'),
(1318, 13, 'fred@sickingfamily.com', 'DBC'),
(1377, 31, 'shawnmcinerney0658@gmail.com', 'home'),
(1357, 125, 'kaylinmcinerney@gmail.com', ' '),
(1425, 2, 'cfaithbranson@gmail.com', 'home'),
(1376, 6, 'davidbubash@gmail.com ', 'home'),
(1457, 62, 'Bjwilhelm93@gmail.com', 'home'),
(1316, 126, 'katybraden13@gmail.com', 'home'),
(1355, 127, 'jackson.net.com@gmail.com', 'home'),
(1341, 42, 'msicking@sbcglobal.net', 'home'),
(1387, 37, 'regien1@gmail.com', 'home'),
(1414, 131, 'gec005@gmail.com', 'home'),
(1383, 135, 'ecwilhelm@att.net', 'home'),
(1382, 136, 'dannywasie@gmail.com', 'home'),
(1403, 139, 'lbaeza76@gmail.com', 'home'),
(1386, 37, 'regie@sickingfamily.com', 'DBC'),
(1391, 41, 'marianne26@sbcglobal.net', 'other');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` bigint(20) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  `event` text CHARACTER SET latin1 NOT NULL,
  `venue` text CHARACTER SET latin1 NOT NULL,
  `comments` text CHARACTER SET latin1 NOT NULL,
  `posted_by` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `family_id` bigint(20) NOT NULL,
  `family_name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `clan_ptr` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`family_id`, `family_name`, `clan_ptr`) VALUES
(1, 'Ollie & Jinny Sicking', 1),
(2, 'Fred & Nancy Lloyd', 2),
(3, 'Mark & Teresa Sicking', 3),
(4, 'Matt & Jeannette Sicking', 4),
(5, 'Paul & Janet Sicking', 5),
(6, 'Regie Neff', 6),
(7, 'Andy & Elaine McInerney', 7),
(8, 'Mark & Clare Wilhelm', 8),
(9, 'John & Julie Bubash', 9),
(10, 'Laura Sicking', 10),
(11, 'Crissy Lloyd', 2),
(12, 'Ben & Karen Lloyd', 2),
(13, 'Annie & Matt Malpacker', 2),
(14, 'Elaine & Marcus Miazga', 4),
(15, 'Aaron & Maureen Branson', 4),
(16, 'Libbyanne & John Nguyen', 4),
(17, 'Claire & Scott Steinbruegge', 4),
(19, 'Mike & Laura Brown Girl Sicking', 3),
(21, 'Danny and Kaitie Sicking', 5),
(22, 'Steve and Carie Pearce', 5),
(23, 'Sam Sicking & Sarah Platz', 4),
(25, 'Mike & Maggie Baker', 7),
(26, 'Mitch Duffield & Marianne Sicking', 3),
(27, 'Shawn & Kaylin McInerney', 7),
(28, 'Kevin & Katy McInerney', 7),
(29, 'Elizabeth & Danny Wasielewski', 8),
(30, 'Katie Lloyd', 2),
(31, 'Angela & Dan Thuet', 9),
(32, 'Paul & Ginger Bubash', 9);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` bigint(20) NOT NULL,
  `family_ptr` bigint(20) NOT NULL DEFAULT '0',
  `first_name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `address` text CHARACTER SET latin1,
  `birthday` date DEFAULT '0000-00-00',
  `comments` text CHARACTER SET latin1,
  `userid` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(41) CHARACTER SET latin1 NOT NULL DEFAULT 'Joseph',
  `bot` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `edit_privilege` enum('self','family','clan','all','mom&dad') CHARACTER SET latin1 NOT NULL DEFAULT 'self' COMMENT 'Using this field to determine DBC and inlaw status, too',
  `see_hidden` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `sib` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `dbc` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `gender` enum('M','F') CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `family_ptr`, `first_name`, `last_name`, `address`, `birthday`, `comments`, `userid`, `password`, `bot`, `edit_privilege`, `see_hidden`, `sib`, `dbc`, `gender`) VALUES
(1, 15, 'Aaron', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '1977-05-27', '314-252-0802 is actually a Google Phone number which will ring all the Branson cell phones.', 'Aaron', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(2, 15, 'Faith', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '2004-06-28', '', 'Faith', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(3, 15, 'Luke', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '2001-04-08', '', 'LukeB', 'amlfiam2735', 'N', 'self', 'N', 'N', 'N', 'M'),
(4, 15, 'Maureen', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '1977-10-22', '314-252-0802 is actually a Google Phone number which will ring all the Branson cell phones.', 'Maureen', 'Joseph', 'Y', 'family', 'N', 'N', 'N', 'F'),
(5, 31, 'Angela', 'Bubash', '1914 Senate St\r\nSaint Louis, MO 63118', '1989-04-07', '', 'Angela', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(6, 9, 'David', 'Bubash', '929 Jefferson St\r\nApt 609\r\nKansas City, MO 64105', '1993-10-05', '', 'David', 'DBC', 'N', 'self', 'N', 'N', 'N', 'M'),
(7, 9, 'John', 'Bubash', '3932 Butler Hill Road\r\nSt. Louis, MO 63129', '1961-11-03', '', 'John', 'Joseph', 'N', 'clan', 'Y', 'N', 'Y', 'M'),
(8, 9, 'Julie', 'Bubash', '3932 Butler Hill Road\r\nSt. Louis, MO 63129', '1963-09-13', '', 'Julie', 'Joseph', 'Y', 'clan', 'Y', 'Y', 'Y', 'F'),
(9, 9, 'Karen', 'Bubash', '1302 Rockhurst Road\r\nKansas City, MO 64110', '1996-09-12', '', 'Karen', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(10, 32, 'Paul', 'Bubash', '4655 N Beacon St Apt 2\r\nChicago, IL 60640', '1990-09-17', '', 'PaulB', 'DBC', 'N', 'family', 'N', 'N', 'N', 'M'),
(11, 12, 'Ben', 'Lloyd', '2663 Edmund.\r\nGulf Breeze, FL 32563', '1972-04-08', '....', 'Ben', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(13, 2, 'Fred', 'Lloyd', '13 Red Oaks Drive\r\nSt. Peters MO  63376', '1948-02-16', '', 'Fred', 'Joseph', 'N', 'clan', 'Y', 'N', 'Y', 'M'),
(14, 12, 'Grace', 'Lloyd', '2663 Edmund\r\nGulf Breeze, FL 32563', '2004-12-29', '', 'Grace', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(15, 12, 'Joey', 'Lloyd', '2663 Edmund\r\nGulf Breeze, FL 32563', '2001-03-27', '', 'Joey', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(16, 12, 'Josh', 'Lloyd', '2663 Edmund\r\nGulf Breeze, FL 32563', '2002-12-29', '', 'Josh', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(17, 12, 'Karen', 'Lloyd', '2663 Edmund\r\nGulf Breeze, FL 32563', '1972-09-29', '', 'KarenL', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(18, 12, 'Nicholas', 'Lloyd', '2663 Edmund\r\nGulf Breeze, FL 32563', '1998-02-21', '', 'Nicholas', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(19, 30, 'Katie', 'Lloyd', '10319 St. Dolores Dr.\r\nSt. Ann,  MO. 63074', '1978-10-27', '', 'Katie', 'DBC', 'N', 'self', 'N', 'N', 'N', 'F'),
(20, 11, 'Kiarra', 'Lloyd', '7057 Tholozan\r\nSt. Louis, MO  63109', '2001-09-22', '', 'Kiarra', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(21, 11, 'Ollie', 'Lloyd', '7057 Tholozan\r\nSt. Louis, MO  63109', '2002-09-22', '', 'OllieL', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(22, 13, 'Annie', 'Malpocker', '1897 Hwy F\r\nWright City, MO  63390', '1976-10-26', '', 'Annie', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(23, 13, 'Danny', 'Malpocker', '1897 Hwy F\r\nWright City, MO  63390', '2001-01-09', '', 'DannyM', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(24, 13, 'Emily', 'Malpocker', '1897 Hwy F\r\nWright City, MO  63390 ', '2004-11-17', '', 'Emily', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(25, 13, 'Matt', 'Malpocker', '1897 Hwy F\r\nWright City, MO  63390', '1977-06-07', '', 'MattM', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(26, 7, 'Andy', 'McInerney', '241 Falling Leaf Drive\r\nSt. Peters, MO 63376', '1955-07-14', '', 'Andy', 'Joseph', 'N', 'clan', 'Y', 'N', 'Y', 'M'),
(27, 7, 'Elaine', 'McInerney', '241 Falling Leaf Drive\r\nSt. Peters, MO 63376\r\n\r\n\r\n', '1957-12-19', 'Wk email:  EMcInerney@cassinfo. com\r\n\r\nWe tend to scoff at the beliefs of the ancients. But we can\'t scoff at them personally, to their faces, and this is what annoys me.', 'Elaine', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'F'),
(29, 25, 'Maggie', 'Baker', '1209 Cashmere Lane \r\nSt. Peters, MO 63376', '1985-02-18', '', 'Maggie', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(30, 7, 'Quinn', 'McInerney', '817 Illinois Street\r\nCape Girardeau, MO 63701\r\n', '1998-07-23', '', 'Quinn', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(31, 27, 'Shawn', 'McInerney', '1446 Cutter Avenue\r\nSt. Louis MO 63139', '1988-01-10', '', 'Shawn', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(32, 14, 'Alex', 'Miazga', '52 Country Hill Road\r\nSt. Peters, MO 63376', '2002-09-11', '', 'Alex', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(33, 14, 'Elaine', 'Miazga', '52 Country Hill Road\r\nSt. Peters, MO 63376', '1975-03-12', '<a href=\'http://maps.google.com/maps?f=q&hl=en&geocode=&q=52+country+hill+rd,+st.+peters+Mo+63376&sll=37.0625,-95.677068&sspn=39.916234,66.09375&ie=UTF8&ll=38.79057,-90.620921&spn=0.009617,0.016136&z=16\' target=_blank>Map to our house</a>', 'ecmiazga', 'lainey', 'N', 'family', 'N', 'N', 'N', 'F'),
(34, 14, 'Marcus', 'Miazga', '52 Country Hill Road\r\nSt. Peters, MO 63376', '1978-02-25', '', 'Marcus', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(35, 14, 'Tori', 'Miazga', '52 Country Hill Road\r\nSt. Peters, MO 63376', '2002-09-11', '', 'Tori', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(37, 6, 'Regie', 'Neff', '3012 Autumn Shores Dr\r\nMaryland Heights, MO 63043', '1955-09-12', '', 'Regie', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'F'),
(38, 6, 'Sarah', 'Neff', '3012 Autumn Shores Dr.\r\nMaryland Heights', '1988-09-08', '', 'Sarah', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(39, 16, 'John', 'Nguyen', '165 Birchwood Trail Drive\r\nMaryland Heights, MO  63043', '1979-05-04', '', 'JohnN', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(40, 10, 'Laura V.', 'Sicking', '1732 Summergate Estates Dr.\r\nSt. Charles, MO 63303', '1965-12-29', 'Praise be to St Cronan forever.', 'Laura', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'F'),
(41, 26, 'Marianne', 'Sicking', '9116 Slater\r\nOverland Park, KS 66212\r\n', '1989-02-06', '', 'Marianne', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(42, 3, 'Mark', 'Sicking', '12267 Spring Shadow Ct.\r\nMaryland Heights, MO 63043 ', '1949-03-08', 'It\'s amazing how much \'mature wisdom\' resembles being too tired.', 'Mark', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'M'),
(43, 19, 'Mike', 'Sicking', '43 High Valley Dr.\r\nChesterfield, MO 63017-2763', '1978-10-27', '', 'Mike', 'sickingFamily0', 'N', 'family', 'N', 'N', 'N', 'M'),
(44, 3, 'Teresa', 'Sicking', '12267 Spring Shadow Ct.\r\nMaryland Heights, MO 63043 ', '1952-01-16', '', 'Teresa', 'Joseph', 'N', 'clan', 'Y', 'N', 'Y', 'F'),
(45, 1, 'Jinny', 'Sicking', '', '1924-10-22', '', 'Jinny', 'Joseph', 'N', 'clan', 'N', 'N', 'Y', 'F'),
(46, 1, 'Ollie', 'Sicking', '', '1923-05-21', '', 'OLLIE', 'Joseph', 'N', 'self', 'N', 'N', 'Y', 'M'),
(47, 4, 'Jeannette', 'Sicking', '11892 Archerton Drive\r\nBridgeon, MO 63044-2838', '1951-08-20', '', 'Jeannette', 'Joseph', 'Y', 'clan', 'Y', 'N', 'Y', 'F'),
(48, 4, 'Luke', 'Sicking', '11892 Archerton Drive\r\nBridgeon, MO 63044-2838', '1987-11-10', '', 'Lukey', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(49, 4, 'Matt', 'Sicking', '11892 Archerton Drive.\r\nBridgeton, MO 63044-2838', '1949-03-08', '', 'Matt', 'Sic8926!', 'Y', 'all', 'Y', 'Y', 'Y', 'M'),
(50, 23, 'Sam', 'Sicking', '1861 Waybridge Ln\r\nFenton, MO 63026', '1984-11-21', '', 'Sam', 'Joseph', 'N', 'family', 'Y', 'N', 'N', 'M'),
(51, 2, 'Nancy', 'Lloyd', '13 Red Oaks Drive\r\nSt. Peters MO  63376', '1947-10-03', '', 'Nancy', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'F'),
(52, 3, 'Laura T.', 'Sicking', '3201 N 69th Pl.\r\nScottsdale, AZ  85251', '1986-10-22', '', 'LauraT', 'joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(53, 4, 'Adam', 'Sicking', '1252 Whitemoon Way Apt. F\r\nHazelwood, MO 63042  ', '1972-08-20', '.', 'Adam', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(54, 16, 'Libbyanne', 'Nguyen', '165 Birchwood Trail Drive\r\nMaryland Heights, MO  63043', '1980-03-29', '', 'ennaybbil', 'poopoopy', 'N', 'family', 'N', 'N', 'N', 'F'),
(55, 5, 'Alison', 'Sicking', '8915 Wren Circle\r\nFountain Valley, CA 92708', '1986-08-06', '', 'Alison', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(56, 22, 'Carie', 'Pearce', '3348 E. Geddes Dr.\r\nCentennial, CO 80122', '1979-09-15', '', 'Carie', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(57, 21, 'Danny', 'Sicking', '6431 E. Mantova\r\nLong Beach, CA  90815', '1982-03-17', '', 'Danny', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(58, 5, 'Janet', 'Sicking', '8915 Wren Circle\r\nFountain Valley, CA 92708', '1955-12-27', '', 'Janet', 'PaulOliver', 'N', 'clan', 'Y', 'N', 'Y', 'F'),
(59, 5, 'Paul', 'Sicking', '8915 Wren Circle\r\nFountain Valley, CA 92708', '1953-06-07', '', 'Paul', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'M'),
(60, 17, 'Claire', 'Steinbruegge', '1911 Country Acres Dr. \r\nSt. Peters, MO 63376', '1983-01-16', '', 'Claire', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(61, 17, 'Scott', 'Steinbruegge', '1911 Country Acres Dr. \r\nSt. Peters, MO 63376', '1983-01-13', '', 'Scott', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(62, 8, 'Brian', 'Wilhelm', '6 Media Drive \r\nSaint Louis, MO  63146\r\n', '1993-09-14', '', 'Brian', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(63, 8, 'Clare', 'Wilhelm', '10737 Oak Pointe Dr.\r\nSt. Ann, MO 63074', '1961-09-15', '', 'Clare', 'Joseph', 'N', 'clan', 'Y', 'Y', 'Y', 'F'),
(65, 8, 'Mark', 'Wilhelm', '10737 Oak Pointe Dr.\r\nSt. Ann, MO 63074', '1960-11-29', 'Go Cardinals & Blues\r\nWe Won the Cup!', 'MarkW', 'Joseph', 'N', 'clan', 'Y', 'N', 'Y', 'M'),
(66, 8, 'Mary', 'Wilhelm', '1520 Washington Ave.\r\nApt 323\r\nSt. Louis, MO 63103', '1995-10-30', '', 'Mary', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(67, 6, 'Patrick', 'Neff', '401 Guadalupe St.\r\n#2019\r\nAustin, TX  78701', '1985-02-03', '', 'Patrick', '22121216', 'N', 'self', 'N', 'N', 'N', 'M'),
(70, 14, 'Macie', 'Miazga', '52 Country Hill Road\r\nSt. Peters, MO 63376', '2005-09-14', '', 'Macie', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(72, 1, 'Joseph', 'Sicking', '10319 Pearly Gate Drive\r\nHoly Innocents, Paradise 77777', '1959-02-14', '', 'Joseph', 'Joseph', 'N', 'all', 'N', 'N', 'N', 'M'),
(73, 10, 'Jen', 'Norton', '1732 Summergate Estates Dr.\r\nSt. Charles, MO 63303', '1972-04-09', 'Religion \"Baptist\"', 'Jen', 'Joseph', 'N', 'clan', 'Y', 'N', 'Y', 'F'),
(74, 19, 'Laura J.', 'Sicking', '43 High Valley Dr.\r\nChesterfield, MO 63017-2763', '1980-07-04', '', 'LauraO', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(77, 22, 'Steve', 'Pearce', '3348 E. Geddes Dr. \r\nCentennial, CO 80122', '1979-09-16', '', 'Steve', 'steve', 'N', 'family', 'N', 'N', 'N', 'M'),
(78, 21, 'Kaitie', 'Sicking', '6431 E. Mantova\r\nLong Beach, CA  90815', '1983-11-02', '', 'Kaitie', 'kaite', 'N', 'self', 'N', 'N', 'N', 'F'),
(79, 15, 'Isaac', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '2007-07-10', '', 'Isaac', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(84, 19, 'Charlie', 'Sicking', '43 High Valley Dr.\r\nChesterfield, MO 63017-2763', '2008-08-07', '', 'Charlie', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(85, 17, 'John Paul', 'Steinbruegge', '1911 Country Acres Dr.\r\nSt. Peters, MO 63376', '2008-04-15', '', 'John Paul', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(87, 21, 'Lily', 'Sicking', '6431 E Mantova St\r\nLong Beach, CA 90815', '2009-09-25', '', 'Lily', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(88, 15, 'Andrew', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '2009-11-22', '', 'Andrew', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(89, 22, 'Olivia', 'Pearce', '3348 E. Geddes Dr. \r\nCentennial, CO 80122', '2009-09-07', '', 'Olivia', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(92, 23, 'Cameron', 'Horch', '3649 Vescovo\r\nSt. Louis, MO 63125', '2005-11-17', '', 'Cameron', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(93, 23, 'Kaitlyn', 'Sicking', '3649 Vescovo\r\nSt. Louis, MO 63125', '2010-09-21', '', 'Kaitlyn', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(97, 19, 'Penny', 'Sicking', '43 High Valley Dr.\r\nChesterfield, MO 63017-2763 ', '2010-12-11', '', 'penny', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(102, 17, 'Monica', 'Steinbruegge', '1911 Country Acres Dr. \r\nSt. Peters, MO 63376', '2010-06-03', '', 'monica', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(105, 23, 'Sarah', 'Platz', '3649 Vescovo\r\nSt. Louis, MO 63125', '1987-08-20', '', 'SarahP', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(106, 22, 'Sheamus', 'Pearce', '3348 E. Geddes Dr. \r\nCentennial, CO 80122', '2012-01-15', '', 'Sheamus', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(110, 15, 'Marie', 'Branson', '#5 Stable  RIdge\r\nSt. Charles, MO 63301', '2012-08-20', '', 'Marie', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(112, 17, 'Nathaniel', 'Steinbruegge', '1911 Country Acres Dr. \r\nSt. Peters, MO 63376', '2012-08-16', '', 'Nate', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(113, 19, 'Johnny', 'Sicking', '43 High Valley Dr.\r\nChesterfield, MO 63017-2763', '2012-11-13', 'I\'m no longer the youngest, but I am the youngest Sicking! My cousin Lucy is the youngest.', 'Johnny', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(115, 11, 'Crissy', 'Lloyd', '7057 Tholozan Ave.\r\nSt. Louis, MO 63109', '1970-11-25', '', 'Crissy', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(116, 21, 'Finn', 'Sicking', '6431 E Mantova St\r\nLong Beach, CA 90815', '2012-07-27', '', 'Finn', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(117, 23, 'Aria Elizabeth', 'Sicking', '3649 Vescovo Dr', '2014-01-10', '', 'Aria', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(119, 17, 'Adrianna', 'Steinbruegge', '1911 Country Acres Drive\r\nSt. Peters, MO 63376', '2014-04-05', '', 'adrianna', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(120, 31, 'Dan', 'Thuet', '1914 Senate St\r\nSaint Louis, MO 63118 ', '1989-05-03', '', 'Dan', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(121, 26, 'Mitch', 'Duffield', '9116 Slater\r\nOverland Park, KS 66212.', '1987-07-07', '', 'Mitch', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(122, 13, 'Jase', 'Malpocker', '1897 Hwy F\r\nWright City, MO  63390  ', '2013-12-06', '', 'Jase', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'M'),
(123, 25, 'Mike', 'Baker', '1209 Cashmere Lane \r\nSt. Peters MO 63376', '1969-09-19', '', 'MikeB', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'M'),
(124, 22, 'Maeve Jane Caroline', 'Pearce', '3348 E. Geddes Dr. \r\nCentennial, CO 80122', '2016-09-03', '', 'Maeve', 'Joseph', 'N', 'self', 'N', 'N', 'N', 'F'),
(125, 27, 'Kaylin', 'McInerney', '1446 Cutter Avenue\r\nSt. Louis, MO 63139', '1992-03-31', '', 'Kaylin', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(126, 28, 'Katy', 'Braden-McInerney', '1511 Sproule Avenue\r\nSt. Louis, MO 63139', '1991-06-18', '', 'Katy', 'Joseph', 'N', 'family', 'N', 'N', 'N', 'F'),
(127, 28, 'Kevin Andrew', 'McInerney', '1511 Sproule Avenue\r\nSt. Louis, MO 63139', '1990-12-20', '', 'Kevin', 'DBC', 'N', 'family', 'N', 'N', 'N', 'M'),
(128, 17, 'Matthew', 'Steinbruegge', '1911 Country Acres Drive\r\nSt. Peters, MO 63376 ', '2018-11-20', '', 'Matthew', 'DBC', 'N', 'self', 'N', 'N', 'N', 'M'),
(131, 32, 'Ginger', 'Clements', '4655 N Beacon St Apt 2\r\nChicago, IL 60640', '1985-10-23', '', NULL, 'Joseph', 'N', 'family', 'N', 'N', 'N', NULL),
(135, 29, 'Elizabeth', 'Wasielewski', '13038 Ferncrest Ct.\r\nCreve Coeur, MO 63141', '1989-09-15', '', 'Elizabeth', 'Joseph', 'N', 'family', 'N', 'N', 'N', NULL),
(136, 29, 'Danny', 'Wasielewski', '13038 Ferncrest Ct.\r\nCreve Coeur, MO 63141', '1987-06-29', '', 'DannyWasie', 'Joseph', 'N', 'family', 'N', 'N', 'N', NULL),
(137, 25, 'Jack', 'Baker', '1209 Cashmere Lane\r\nSt. Peters, MO 63376', '2017-05-29', '', NULL, 'Joseph', 'N', 'self', 'N', 'N', 'N', NULL),
(138, 25, 'Molly Ann ', 'Baker ', '1209 Cashmere Drive\r\nSt. Peters, MO 63376', '2018-12-17', '', NULL, 'Joseph', 'N', 'self', 'N', 'N', 'N', NULL),
(140, 30, 'Adie', 'Lloyd', '10319 Saint Dolores Dr. Daint Ann, MO 63074', '2016-04-18', '', NULL, 'Joseph', 'N', 'self', 'N', 'N', 'N', NULL),
(141, 26, 'Lucy Mae', 'Duffield', ' 9116 Slater\r\nOverland Park, KS 6621', '2020-08-22', '', 'Lucy', 'Joseph', 'N', 'self', 'N', 'N', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parms`
--

CREATE TABLE `parms` (
  `parm_name` varchar(16) CHARACTER SET latin1 NOT NULL,
  `parm_description` varchar(128) CHARACTER SET latin1 NOT NULL,
  `parm_value` varchar(180) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parms`
--

INSERT INTO `parms` (`parm_name`, `parm_description`, `parm_value`) VALUES
('bud_M', '', 'We don&#039;t know yet whether Bud can call.'),
('bud_N', '', 'Bud cannot call, so no workshop this week.'),
('bud_Y', '', 'Bud can call.'),
('comment ', 'Reminder to admin what this file is for', 'Configuration parameters for the MVP Workshop signup'),
('event_date', 'Current workshop date (or the last date used, anyway)', '2019-10-22'),
('longtitle', 'Detailed title appearing at top of browser window', 'MVP Workshop sign up page for ##DATE##'),
('maybetext', 'Text at top of screen indicating how many people might be coming', '##MAYBES## dancers might come'),
('message', 'Add a general message to the screen', 'Having trouble using this site?  Want your name removed from the distribution list?&lt;br/&gt;Know someone who would like to be added?&lt;br/&gt;Call Matt at 314-452-6677'),
('min_needed', 'Minimum number of attendees necessary to hold the event', '8'),
('noreplytext', 'Text at top of screen indicating how many people have not yet responded', '##NOREPLIES## have not replied'),
('notext', 'Text at top of screen indicating how many people are not coming.', '##NOS## dancers cannot come.'),
('resultno', 'Verbiage used to indicate that the event is canceled.', 'So we &lt;u&gt;&lt;b&gt;will not&lt;/b&gt;&lt;/u&gt; be holding a workshop this week.'),
('resultunknown', 'Verbiage used to indicate that as yet not enough people have responded to determine if he event can be held ', 'So we aren&#039;t sure yet if we can hold a workshop this week.'),
('resultyes', 'Verbiage used to indicate that sufficient players will be coming', 'So we &lt;u&gt;&lt;b&gt;will&lt;/b&gt;&lt;/u&gt; be holding a workshop this week.'),
('subject', 'Subject line for bi-weekly email.', 'Next MVP Square Dance Workshop ##DATE## -- Will you attend?????....'),
('title', 'Long page title', 'MVP Workshop Sign-up Sheet'),
('yestext', 'Text at top of screen indicating how many people are not coming.', '##YESES## dancers are coming');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `phone_id` bigint(20) NOT NULL,
  `member_ptr` bigint(20) NOT NULL DEFAULT '0',
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `phone_type` varchar(6) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`phone_id`, `member_ptr`, `phone`, `phone_type`) VALUES
(359, 68, '714-952-5833', 'work'),
(360, 68, '714-841-3015', 'home'),
(361, 68, '714-334-0320', 'cell'),
(704, 58, '714-843-5071', 'work'),
(705, 58, '714-614-7156', 'cell'),
(706, 58, '714-965-9939', 'home'),
(1036, 73, '636-236-4844', 'cell'),
(1040, 79, '314-252-0802', 'home'),
(1117, 32, '636-387-0971', 'home'),
(1120, 70, '636-387-0971', 'home'),
(1121, 35, '636-387-0971', 'home'),
(1141, 47, '314-739-3722', 'home'),
(1142, 47, '314-369-4519', 'cell'),
(1321, 40, '314-495-0485', 'cell'),
(1322, 40, '636-926-0635', 'home'),
(1383, 99, '314-631-3447', 'home'),
(1507, 88, '314-252-0802', 'home'),
(1534, 74, '314-303-9769', 'home'),
(1569, 102, '  	 636-284-7518', 'home'),
(1570, 112, ' 	 636-284-7518', 'home'),
(1571, 61, '636-284-7518', 'home'),
(1572, 61, '314-452-1254', 'cell'),
(1573, 60, '636-284-7518', 'home'),
(1574, 60, '314-369-4359', 'cell'),
(1575, 85, ' 	 	636-284-7518', 'home'),
(1630, 119, '636-284-7518', 'home'),
(1644, 3, '314-252-0802', 'home'),
(1645, 3, '314-452-8954', 'cell'),
(1686, 54, '314-395-6622', 'home'),
(1687, 54, '314-503-1803', 'cell'),
(1688, 39, '314-642-5426', 'cell'),
(1696, 115, '314-223-0011', 'cell'),
(1776, 25, '314-249-7272', 'cell'),
(1777, 23, '636-384-0953', 'cell'),
(1778, 24, '636-384-6509', 'cell'),
(1779, 21, '314-399-6730', 'cell'),
(1780, 20, '314-449-4881', 'cell'),
(1800, 43, '314-827-4855', 'cell'),
(1810, 34, '314-368-2235', 'cell'),
(1811, 34, '636-387-0971', 'home'),
(1814, 11, '850-916-1609', 'home'),
(1815, 11, '850-417-9228', 'cell'),
(1822, 14, '850-916-1609', 'home'),
(1823, 14, '850-748-0692', 'cell'),
(1824, 15, '850-602-0505', 'cell'),
(1825, 15, '850-916-1609', 'home'),
(1828, 17, '314-288-9051', 'cell'),
(1829, 17, '850-916-1609', 'home'),
(1830, 18, '850-916-1906', 'home'),
(1831, 18, '850-418-4562', 'cell'),
(1832, 16, '850-916-1609', 'home'),
(1833, 16, '850-748-1762', 'cell'),
(1835, 110, '314-252-0802', 'home'),
(1839, 4, '314-252-0802', 'home'),
(1840, 4, '314-322-9711', 'cell'),
(1865, 123, '314-304-5193', 'cell'),
(1881, 59, '714-965-9939', 'home'),
(1882, 59, '714-926-7130', 'cell'),
(1895, 44, '314-878-1730', 'home'),
(1896, 44, '314-269-6643', 'cell'),
(1900, 33, '636-219-5341', 'cell'),
(1901, 33, '636-465-2711', 'home'),
(1915, 7, '314-629-2829', 'cell'),
(1922, 56, '714-334-1140', 'cell'),
(1924, 77, '714-225-6407', 'cell'),
(1925, 55, '714-965-9939', 'home'),
(1926, 55, '714-477-3561', 'cell'),
(1941, 50, '3142872349', 'cell'),
(1944, 28, '636-441-8510', 'home'),
(1952, 29, '314-592-1813', 'work'),
(1953, 29, '314-792-8194', 'cell'),
(1955, 22, '636-288-3999', 'cell'),
(1956, 9, '314-546-6738', 'cell'),
(1977, 27, '636-448-5817', 'cell'),
(1979, 26, '314-651-3855', 'cell'),
(1986, 63, '314-428-2737', 'home'),
(1987, 63, '314-740-7536', 'cell'),
(1988, 63, '314-875-4412', 'work'),
(1992, 126, '405-503-1349', 'home'),
(1994, 13, '888-438-2114', 'fax'),
(1995, 13, '850-889-3223 ', 'cell'),
(1996, 13, '314-594-4040', 'work'),
(1997, 13, '636-240-5306', 'home'),
(2001, 51, '314-477-6117', 'cell'),
(2002, 51, '636-240-5306', 'home'),
(2003, 51, '314-594-4040', 'work'),
(2007, 98, '314-412-8134', 'cell'),
(2008, 98, '314-638-8134', 'home'),
(2009, 98, '314-729-2400, ext. 8', 'work'),
(2025, 42, '314-269-6642', 'cell'),
(2026, 42, '314-878-1730', 'home'),
(2027, 64, '314-732-3551', 'cell'),
(2032, 57, '714-357-6543', 'cell'),
(2033, 57, '714-952-5536', 'work'),
(2034, 78, '925-324-3906', 'cell'),
(2035, 78, '562-316-5047', 'home'),
(2037, 127, '636-578-3416', 'home'),
(2038, 30, '636-699-5824', 'cell'),
(2039, 125, '314-809-2384', 'cell'),
(2047, 130, '318-245-3361', ' '),
(2057, 6, '314-269-6267', 'cell'),
(2058, 31, '314-239-8164', 'cell'),
(2059, 31, ' ', ' '),
(2061, 52, '314-585-3302', 'cell'),
(2062, 136, '314-502-0654', 'cell'),
(2063, 135, '314-732-3551', 'cell'),
(2064, 87, '562-316-5047', 'home'),
(2066, 37, '972-567-5260', 'cell'),
(2068, 38, '214-620-6969', 'cell'),
(2069, 41, '314-269-6639', 'cell'),
(2080, 8, '314-892-1891', 'home'),
(2081, 8, '314-629-2829', 'cell'),
(2082, 8, '314-454-6037', 'work'),
(2083, 128, '636-284-7518', 'home'),
(2097, 131, '318-245-3361', 'cell'),
(2098, 10, '314-255-9057', 'cell'),
(2103, 53, '314-313-9891', 'cell'),
(2104, 53, '314-291-0600', 'work'),
(2106, 5, '314 255 3693', 'cell'),
(2107, 120, '314-603-0745', 'cell'),
(2111, 2, '314-252-0802', 'home'),
(2115, 1, '314-692-2823', 'work'),
(2116, 1, '314-482-9589', 'cell'),
(2117, 1, '314-252-0802', 'home'),
(2144, 49, '314-452-6677', 'cell'),
(2145, 49, '314-739-3722', 'home'),
(2147, 67, '2145781132', 'cell'),
(2148, 48, '314-739-3722', 'home'),
(2149, 48, '314-494-9870', 'cell'),
(2150, 65, '314-330-1535', 'cell'),
(2151, 65, '314-434-2713', 'fax'),
(2152, 65, '314-434-4545', 'work'),
(2153, 65, '314-428-2737', 'home'),
(2154, 121, '816-309-4245', 'cell'),
(2155, 66, '314-599-3449', 'cell'),
(2156, 19, '239-287-0220', 'cell'),
(2161, 62, '314-539-1080', 'cell'),
(2162, 62, ' ', ' '),
(2163, 141, '1-800-Cutie', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `wbw`
--

CREATE TABLE `wbw` (
  `event_ptr` bigint(20) NOT NULL DEFAULT '0',
  `member_ptr` bigint(20) NOT NULL DEFAULT '0',
  `coming` enum('Yes','No') CHARACTER SET latin1 DEFAULT NULL,
  `bringing` text CHARACTER SET latin1,
  `comments` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wccw_dates`
--

CREATE TABLE `wccw_dates` (
  `date` date NOT NULL,
  `event_ptr` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wccw_dates`
--

INSERT INTO `wccw_dates` (`date`, `event_ptr`) VALUES
('2020-07-27', 98),
('2020-07-28', 98),
('2020-07-29', 99),
('2020-07-30', 99);

-- --------------------------------------------------------

--
-- Table structure for table `wccw_events`
--

CREATE TABLE `wccw_events` (
  `event_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `details` text,
  `organizer_ptr` bigint(20) NOT NULL,
  `is_private` enum('public','private') NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wccw_events`
--

INSERT INTO `wccw_events` (`event_id`, `title`, `details`, `organizer_ptr`, `is_private`) VALUES
(98, 'Pretend DBC Meeting', 'This is a test for Matt who worked on improving things I don\'t know if I really understand', 44, 'private'),
(99, 'Test DBC meeting', 'Just a test to thank Matt and test this Event Site that he worked hard on to improve  I may not know how to use it but here goes...do I have to click on each name below in the Invitees box or just the DBC button?-I did both', 44, 'private');

-- --------------------------------------------------------

--
-- Table structure for table `wccw_invitees`
--

CREATE TABLE `wccw_invitees` (
  `invitee_id` bigint(20) NOT NULL COMMENT 'Not auto-increementedd; Actual member number of invitee',
  `event_ptr` bigint(20) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wccw_invitees`
--

INSERT INTO `wccw_invitees` (`invitee_id`, `event_ptr`, `comments`) VALUES
(7, 99, 'EMPTY COMMENTS'),
(8, 99, 'EMPTY COMMENTS'),
(13, 99, 'EMPTY COMMENTS'),
(26, 99, 'EMPTY COMMENTS'),
(27, 99, 'EMPTY COMMENTS'),
(37, 99, 'EMPTY COMMENTS'),
(40, 99, 'EMPTY COMMENTS'),
(42, 99, 'EMPTY COMMENTS'),
(44, 98, 'EMPTY COMMENTS'),
(47, 99, 'EMPTY COMMENTS'),
(49, 99, 'EMPTY COMMENTS'),
(51, 99, 'EMPTY COMMENTS'),
(58, 99, 'EMPTY COMMENTS'),
(59, 99, 'EMPTY COMMENTS'),
(63, 99, 'EMPTY COMMENTS'),
(65, 99, 'EMPTY COMMENTS'),
(73, 99, 'EMPTY COMMENTS');

-- --------------------------------------------------------

--
-- Table structure for table `wccw_ynm`
--

CREATE TABLE `wccw_ynm` (
  `ynm_member_id` bigint(11) NOT NULL,
  `ynm_date_id` date NOT NULL,
  `event_ptr` bigint(20) NOT NULL,
  `ynm` enum('Y','N','M','?') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clans`
--
ALTER TABLE `clans`
  ADD PRIMARY KEY (`clan_id`),
  ADD KEY `clan_name` (`clan_name`);

--
-- Indexes for table `dbc_constants`
--
ALTER TABLE `dbc_constants`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `deep_thoughts`
--
ALTER TABLE `deep_thoughts`
  ADD PRIMARY KEY (`meeting_number`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`family_id`),
  ADD KEY `family_name` (`family_name`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `family_ptr` (`family_ptr`),
  ADD KEY `sib` (`sib`,`dbc`);

--
-- Indexes for table `parms`
--
ALTER TABLE `parms`
  ADD PRIMARY KEY (`parm_name`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`phone_id`);

--
-- Indexes for table `wbw`
--
ALTER TABLE `wbw`
  ADD PRIMARY KEY (`event_ptr`,`member_ptr`);

--
-- Indexes for table `wccw_dates`
--
ALTER TABLE `wccw_dates`
  ADD PRIMARY KEY (`date`),
  ADD KEY `date_cascade_on_event` (`event_ptr`);

--
-- Indexes for table `wccw_events`
--
ALTER TABLE `wccw_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `wccw_invitees`
--
ALTER TABLE `wccw_invitees`
  ADD PRIMARY KEY (`invitee_id`),
  ADD KEY `Invitee_cascade_on_event` (`event_ptr`);

--
-- Indexes for table `wccw_ynm`
--
ALTER TABLE `wccw_ynm`
  ADD PRIMARY KEY (`ynm_member_id`,`ynm_date_id`),
  ADD KEY `avail_cascade_on_date` (`ynm_date_id`),
  ADD KEY `avail_cascade_on_event` (`event_ptr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
  MODIFY `clan_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1459;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `phone_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2164;

--
-- AUTO_INCREMENT for table `wccw_events`
--
ALTER TABLE `wccw_events`
  MODIFY `event_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wccw_dates`
--
ALTER TABLE `wccw_dates`
  ADD CONSTRAINT `date_cascade_on_event` FOREIGN KEY (`event_ptr`) REFERENCES `wccw_events` (`event_id`) ON DELETE CASCADE;

--
-- Constraints for table `wccw_invitees`
--
ALTER TABLE `wccw_invitees`
  ADD CONSTRAINT `Invitee_cascade_on_event` FOREIGN KEY (`event_ptr`) REFERENCES `wccw_events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invitee_cascade_on_member` FOREIGN KEY (`invitee_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `wccw_ynm`
--
ALTER TABLE `wccw_ynm`
  ADD CONSTRAINT `avail_cascade_on_date` FOREIGN KEY (`ynm_date_id`) REFERENCES `wccw_dates` (`date`) ON DELETE CASCADE,
  ADD CONSTRAINT `avail_cascade_on_event` FOREIGN KEY (`event_ptr`) REFERENCES `wccw_events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avail_cascade_on_member` FOREIGN KEY (`ynm_member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
