CREATE TABLE IF NOT EXISTS `#__concursos_icas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(255) NOT NULL,
  `arquivo` varchar(60) DEFAULT NULL,
  `descricao` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `data` date DEFAULT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__concursos_concurso` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `escola` varchar(255) NOT NULL,
  `turma` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `ica_inspecao` int(11) NOT NULL,
  `ica_psicologico` int(11) NOT NULL,
  `ica_tacf` int(11) NOT NULL,
  `instrucoes_especificas` varchar(255) NOT NULL,
  `veiculo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `site` varchar(255) NOT NULL,
  `ambito` varchar(60) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

