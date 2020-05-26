# Dumping Table Structure for project

#
CREATE TABLE `project` (
  `Id` int(11) NOT NULL auto_increment,
  `Gid` smallint(6) NOT NULL default '0',
  `Name` varchar(60) NOT NULL default '',
  `Description` varchar(255) default NULL,
  `Data` date default NULL,
  `Url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`Id`)
) TYPE=MyISAM;
#
# Dumping Data for project
#
INSERT INTO `project` (Id, Gid, Name, Description, Data, Url) VALUES (1, 1, 'HWFOTO', 'Erotic-art photographer\'s site', NULL, 'http://www.hwfoto.com');
INSERT INTO `project` (Id, Gid, Name, Description, Data, Url) VALUES (2, 1, 'VIP-Escort-Test', 'Escort Agencies Mgmt System', NULL, 'http://www.vip-escort-test.com');
INSERT INTO `project` (Id, Gid, Name, Description, Data, Url) VALUES (4, 0, 'Magic Mindset', 'Software trains your mind for success with little to no effort on your part', NULL, 'http://magicmindset.com/');
INSERT INTO `project` (Id, Gid, Name, Description, Data, Url) VALUES (5, 0, 'Crossalizer', 'Plugins that handles with WMA files and capture data from video devices via TWAIN', NULL, 'http://www.crossalizer.com/');
INSERT INTO `project` (Id, Gid, Name, Description, Data, Url) VALUES (6, 0, 'INTAS sponsored scientific project', 'Novel Technology for Fermentation Process Monitoring and Quality Control of Alcoholic Beverages Based on Enzyme Electrodes and Kits', NULL, 'http://www.franko.lviv.ua/conference/intas/index.php');
INSERT INTO `project` (Id, Gid, Name, Description, Data, Url) VALUES (7, 0, 'Telecommunication Company Offical Site', '', NULL, 'http://www.lv.ukrtel.net/');
