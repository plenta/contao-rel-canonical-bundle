-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_page`
-- 

CREATE TABLE `tl_page` (
  `addCanonical` char(1) NOT NULL default '',
  `canonicalType` varchar(32) NOT NULL default '',
  `canonicalJumpTo` int(10) unsigned NOT NULL default '0',
  `canonicalWebsite` varchar(255) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;