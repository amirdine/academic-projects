use bibliotheque;

CREATE TABLE ADHERENT (
   Numero_ADHERENT Varchar (25) NOT NULL ,
   NOM             Varchar (25) NOT NULL,
   PRENOM          Varchar (25) NOT NULL,
   VILLE           Varchar (25) NOT NULL,
   DATE_NAISSANCE  DATE NOT NULL,
   SEXE            Varchar (25) NOT NULL,
   ADRESSE         Varchar (350) NOT NULL,
   COURRIEL        Varchar (50) NOT NULL, 
   TELEPHONE       Varchar (25) NOT NULL, 
   DATE_ADHESION   DATE NOT NULL,
   DD_PAIEMENT     DATE NOT NULL,
   PRIMARY KEY(Numero_ADHERENT)
   
   )ENGINE = INNODB;

  
CREATE TABLE OEUVRE (
   COTE  Varchar (25) NOT NULL ,
   TITRE Varchar (25) NOT NULL , 
   DATE_PARUTION Date NOT NULL , 
   PRIMARY KEY(COTE)

)ENGINE = INNODB;

CREATE TABLE EDITEUR (
  ID_Editeur Varchar (25) NOT NULL ,
  NOM_EDI    Varchar (25) NOT NULL ,
  PRIMARY KEY(ID_Editeur)
   
  )ENGINE = INNODB;
  


CREATE TABLE LIVRE (
  CODE_BARRE Varchar (25) NOT NULL ,
  ISBN       Varchar (25) NOT NULL ,
  DISPONIBILITE Bool ,
  NUMERO_EXEMPLAIRE int (30) NOT NULL ,
  DATE_ACHAT  Date NOT NULL,
  ID_EDITEUR Varchar (25) NOT NULL,
  COTE       Varchar (25) NOT NULL,
  PRIMARY KEY(CODE_BARRE),
  FOREIGN KEY(ID_EDITEUR)REFERENCES EDITEUR(ID_EDITEUR),
  FOREIGN KEY(COTE)REFERENCES OEUVRE(COTE)
)ENGINE = INNODB;
  
CREATE TABLE PRET (  
  Numero_ADHERENT Varchar (25) NOT NULL ,
  CODE_BARRE Varchar (25) NOT NULL ,
  DATE_EMP Datetime NOT NULL,
  DATE_RETOUR Date NOT NULL ,
  Prolongation Bool,
  PRIMARY KEY(CODE_BARRE,DATE_EMP, Numero_ADHERENT),
  FOREIGN KEY(Numero_ADHERENT)REFERENCES ADHERENT(Numero_ADHERENT),
  FOREIGN KEY(CODE_BARRE)REFERENCES LIVRE(CODE_BARRE)
)ENGINE = INNODB;

  
  
CREATE TABLE RESERVE (

  Numero_ADHERENT Varchar (25) NOT NULL ,
  COTE Varchar (25) NOT NULL ,
  DATE_RESERVATION Datetime NOT NULL,
  DATE_LIM Date NOT NULL ,
  PRIMARY KEY(Numero_ADHERENT,COTE,DATE_RESERVATION),
  FOREIGN KEY(Numero_ADHERENT)REFERENCES ADHERENT(Numero_ADHERENT),
  FOREIGN KEY(COTE)REFERENCES OEUVRE(COTE)
  
  )ENGINE = INNODB;

  
CREATE TABLE AUTEUR (
  ID_AUTEUR Varchar (25) NOT NULL ,
  NOM_AUTEUR Varchar (25) NOT NULL ,
  PRENOM_AUTEUR VARCHAR (25) NOT NULL,
  PRIMARY KEY(ID_AUTEUR)  

)ENGINE = INNODB;


CREATE TABLE MOT_CLE (
  NUM_MOTCLE Varchar (25) NOT NULL ,
  MOT_CLES Varchar (25) NOT NULL ,
   PRIMARY KEY(NUM_MOTCLE)
  
)ENGINE = INNODB;


CREATE TABLE REDIGER (
  ID_AUTEUR Varchar (25) NOT NULL ,
  COTE  Varchar (25) NOT NULL ,
  PRIMARY KEY(ID_AUTEUR,COTE),
  FOREIGN KEY(ID_AUTEUR)REFERENCES AUTEUR(ID_AUTEUR),
  FOREIGN KEY(COTE)REFERENCES OEUVRE(COTE)
  
)ENGINE = INNODB;


CREATE TABLE CARACTERISE (
  NUM_MOTCLE Varchar (25) NOT NULL ,
  COTE  Varchar (25) NOT NULL ,
  PRIMARY KEY(NUM_MOTCLE,COTE),
  FOREIGN KEY(NUM_MOTCLE)REFERENCES MOT_CLE(NUM_MOTCLE),
  FOREIGN KEY(COTE)REFERENCES OEUVRE(COTE)
  
)ENGINE = INNODB;

