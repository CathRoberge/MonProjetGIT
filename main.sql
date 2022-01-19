CREATE TABLE usager (
    ID varchar(20) NOT NULL PRIMARY KEY,
    motDePasse varchar(20) NOT NULL
);

CREATE TABLE article (
    ID smallint unsigned NOT NULL PRIMARY KEY,
    texte text NOT NULL,
    auteur varchar(20) NOT NULL,
    FOREIGN KEY (auteur) references usager (ID)
);