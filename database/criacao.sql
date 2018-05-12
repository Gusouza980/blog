CREATE TABLE usuario (

  idUsuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nomeUsuario VARCHAR(50) NOT NULL,
  emailUsuario VARCHAR(50) NOT NULL,
  senhaUsuario VARCHAR(32) NOT NULL

);

CREATE TABLE settings(

  idSite INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nomeSite VARCHAR(50) NOT NULL,
  emailSite VARCHAR(50),
  telefoneSite VARCHAR(20)

);

CREATE TABLE categoria(
  idCategoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nomeCategoria VARCHAR(50) NOT NULL
);

CREATE TABLE noticia(
  idNoticia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  idUsuario INT NOT NULL,
  idCategoria INT NOT NULL,
  imagemNoticia VARCHAR(100) NOT NULL,
  tituloNoticia VARCHAR(50) NOT NULL,
  conteudoNoticia VARCHAR(2000) NOT NULL,
  fonteNoticia VARCHAR(100),
  dataNoticia DATETIME NOT NULL,
  FOREIGN KEY noticia(idUsuario) REFERENCES usuario(idUsuario) ON UPDATE CASCADE,
  FOREIGN KEY noticia(idCategoria) REFERENCES categoria(idCategoria) ON UPDATE CASCADE
);

CREATE TABLE galeria(
  idNoticia INT NOT NULL,
  imagem VARCHAR(100),
  CONSTRAINT chave_galeria PRIMARY KEY galeria (idNoticia, imagem),
  FOREIGN KEY galeria(idNoticia) REFERENCES noticia(idNoticia) ON DELETE CASCADE
);

CREATE TABLE slideshow(
  idImagem INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  diretorioImagem VARCHAR(255) NOT NULL
)
