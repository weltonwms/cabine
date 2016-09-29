CREATE TABLE IF NOT EXISTS `#__aeronaves_aeronave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` varchar(255) NOT NULL,
  `tipo_aviacao` varchar(100) NOT NULL,
  `aeronave` varchar(255) NOT NULL,
  `pais_origem` varchar(80) NOT NULL,
  `paises_operacao` varchar(255) NOT NULL,
  `tripulacao` varchar(255) NOT NULL,
  `armamento` varchar(100) NOT NULL,
  `envergadura` varchar(50) NOT NULL,
  `comprimento` varchar(50) NOT NULL,
  `altura` varchar(50) NOT NULL,
  `peso` varchar(50) NOT NULL,
  `peso_maximo` varchar(50) NOT NULL,
  `decolagem` varchar(255) NOT NULL,
  `motor` varchar(80) NOT NULL,
  `velocidade_maxima` varchar(50) NOT NULL,
  `teto_servico` varchar(50) NOT NULL,
  `missoes` varchar(255) NOT NULL,
  `versoes_brasil` varchar(80) NOT NULL,
  `link` varchar(80) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__aeronaves_om_map` (
  `id_aeronave` int(11) NOT NULL COMMENT 'foreign key para aeronave',
  `id_unidade` int(11) NOT NULL COMMENT 'foreign key para unidade',
  PRIMARY KEY (`id_aeronave`,`id_unidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__aeronaves_tags_map` (
  `id_aeronave` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  PRIMARY KEY (`id_aeronave`,`id_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__midia_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `#__unidades_unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(255) UNSIGNED NOT NULL DEFAULT '0',
  `nome_om` varchar(255) NOT NULL,
  `logo_om` varchar(255) NOT NULL,
  `sigla` varchar(11) NOT NULL,
  `data_aniversario` date DEFAULT NULL,
  `comandante` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(5) NOT NULL,
  `cep` varchar(25) DEFAULT NULL,
  `pais` varchar(25) DEFAULT NULL,
  `site_internet` varchar(100) DEFAULT NULL,
  `site_intraer` varchar(100) DEFAULT NULL,
  `ddd` int(5) DEFAULT NULL,
  `caixa_postal` varchar(60) DEFAULT NULL,
  `pabx` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `lista_ramais` mediumtext,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




