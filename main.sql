CREATE TABLE usager (
    ID varchar(20) NOT NULL PRIMARY KEY,
    motDePasse varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE article (
    ID smallint unsigned NOT NULL PRIMARY KEY,
    titre varchar(50) NOT NULL,
    texte text NOT NULL,
    idUsager varchar(20) NOT NULL,
    FOREIGN KEY (idUsager) references usager (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE article
    ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idUsager`) REFERENCES `usager` (`ID`)

INSERT INTO usager VALUES
("Jeano123", "123456"),
("rockVoisin", "Maman"),
("iPhilIt", "papa");

INSERT INTO article VALUES
(1, "Le ciel est bleu", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae massa vestibulum, gravida justo eu, mollis tortor. In faucibus nunc dui, quis luctus purus tempus nec. Maecenas blandit congue placerat. Vivamus tristique eros nunc, ullamcorper facilisis ipsum rhoncus quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut vitae ornare purus, nec ullamcorper purus. Phasellus egestas vestibulum quam vel vulputate. Fusce a semper ipsum, sit amet tempus diam. Donec enim lectus, efficitur quis ultrices eget, pellentesque id tellus. Aenean eu malesuada libero, a convallis nisl. Proin consectetur nisi non pulvinar iaculis. Suspendisse tellus dui, facilisis in lacus et, laoreet tincidunt mauris. Morbi scelerisque velit vitae metus interdum efficitur. Proin mattis finibus ante, et feugiat mi tincidunt vel. Quisque porta vel purus vel ultricies.", "rockVoisin"),
(2, "J'entend frapper", "Vestibulum ex lectus, gravida et lacus at, luctus egestas elit. Morbi laoreet est sed eros laoreet vestibulum. Pellentesque a hendrerit sapien, at pretium augue. Nam sit amet tortor congue, pulvinar eros eu, sodales tortor. Nulla facilisis feugiat tortor vitae posuere. Vivamus ut lorem sit amet purus ornare viverra sit amet ut erat. Vestibulum faucibus non urna a finibus. Nam cursus, sapien a condimentum egestas, nulla libero sodales arcu, id dictum leo dui in mauris. Aliquam at sem malesuada, luctus massa vel, euismod velit. Aliquam sed est euismod, tristique metus eget, vehicula velit. Nam condimentum pharetra condimentum.", "iPhilIt");

SELECT * FROM article WHERE article.titre = "Le ciel est bleu" OR article.texte = "Le ciel est bleu" OR article.idUsager = "Le ciel est bleu";