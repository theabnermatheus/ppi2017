create database meu_projeto;

use meu_projeto;

CREATE TABLE `musicas` (
  `codigo` int(11) NOT NULL,
  `titulo` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `artista` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `genero` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `caminho` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `musicas`
--

INSERT INTO `musicas` (`codigo`, `titulo`, `artista`, `genero`, `caminho`) VALUES
(1, 'musica 1 ', 'artista 1 ', 'Eletronica', 'Musicas/musica 1 - artista 1 .mp3'),
(2, 'musica 2', 'artista 2', 'Pop', 'Musicas/musica 2- artista 2.mp3'),
(3, 'musica 3', 'artista 3', 'Rock', 'Musicas/musica 3- artista 3.mp3'),
(4, 'musica 4', 'artista 4', 'Rock', 'Musicas/musica 4- artista 4.mp3'),
(5, 'musica 5', 'artista 5', 'Rock', 'Musicas/musica 5- artista 5.mp3'),
(6, 'meet me halfway', 'black eyed peas', 'Eletronica', 'Musicas/meet me halfway- black eyed peas.mp3'),
(7, 'oi', 'oi', 'Pop', 'Musicas/oi- oi.mp3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist`
--

CREATE TABLE `playlist` (
  `idlist` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nome` text CHARACTER SET utf8 COLLATE utf8_bin,
  `musicas` text CHARACTER SET utf8 COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `playlist`
--

INSERT INTO `playlist` (`idlist`, `idUsuario`, `nome`, `musicas`) VALUES
(4, 1, 'tem as musicas', '54123'),
(5, 1, 'Tem As Musicas 2', '12'),
(7, 6, 'meus eletros', ''),
(19, 2, 'As Melhores bimbas', '1'),
(21, 4, 'keep on rising', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpf` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telefone` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `senha` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` smallint(6) NOT NULL,
  `dataCadastro` datetime NOT NULL,
  `dataExclusao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nome`, `cpf`, `telefone`, `email`, `login`, `senha`, `status`, `dataCadastro`, `dataExclusao`) VALUES
(1, 'Abner Matheus gomes Silva', '11783586664', '38999451386', 'theabnermatheus@hotmail.com', 'theabnermatheus', '30249544', 0, '2017-05-20 18:21:17', NULL),
(2, 'Admin', '12345678912', '99999999999', 'admin@admin.com', 'admin', 'admin', 1, '2017-05-20 18:21:44', NULL),
(4, 'Abner Teste', '11851224654', '38999999999', 'teste@teste.com', 'teste', 'teste', 0, '2017-06-08 21:50:09', NULL),
(5, 'jose genuino', '33884512364', '38999412480', 'josepereira@gmail.com', 'thejose', '123321', 0, '2017-06-25 16:42:18', NULL),
(6, 'teste de cadastro da aula', '12345678932', '38999451386', 'thejkb@test.com', 'thelogin123', '30249544', 0, '2017-06-27 19:04:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `musicas`
--
ALTER TABLE `musicas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`idlist`),
  ADD KEY `fk_usuario` (`idUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `musicas`
--
ALTER TABLE `musicas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `idlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

