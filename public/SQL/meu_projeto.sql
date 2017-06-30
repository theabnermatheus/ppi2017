CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` text COLLATE utf8_bin NOT NULL,
  `cpf` varchar(15) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(12) COLLATE utf8_bin NOT NULL,
  `email` varchar(250) COLLATE utf8_bin NOT NULL UNIQUE,
  `login` varchar(250) COLLATE utf8_bin NOT NULL UNIQUE,
  `senha` text COLLATE utf8_bin NOT NULL,
  `status` smallint(6) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `dataExclusao` datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin

create table musicas(
codigo int not null auto_increment PRIMARY KEY,
titulo text not null,
artista text not null,
genero text not null,
caminho text not null 

);