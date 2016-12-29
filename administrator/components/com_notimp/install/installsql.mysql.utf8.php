CREATE TABLE IF NOT EXISTS `#__notimpe_artigos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_artigo` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `id_notimpe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__notimpe_notimpe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nr_notimpe` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `data` date NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `oficial_servico` int(11)  NULL COMMENT 'id_user',
  `graduado_servico` int(11) NULL COMMENT 'id_user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__notimpe_veiculo` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ordem` int(11) NULL,
  `cidade` VARCHAR( 100 ) NULL,
  `estado` VARCHAR( 100 ) NULL,
  `site` VARCHAR( 100 ) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
