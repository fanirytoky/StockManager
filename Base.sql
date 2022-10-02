CREATE TABLE F_COMPTET (
  CT_Num varchar(17) NOT NULL,
  CT_Intitule varchar(69) NULL,
  CT_Type smallint NULL,
  cbMarq int IDENTITY (1, 1) NOT NULL,
  CONSTRAINT PK_CBMARQ_F_COMPTET PRIMARY KEY CLUSTERED (cbMarq asc),
  CONSTRAINT UKA_F_COMPTET_CT_Num UNIQUE (CT_Num asc)
);

GO
  CREATE TABLE F_DEPOT (
    DE_No int NULL,
    DE_Intitule varchar(35) NOT NULL,
    DE_Adresse varchar(35) NULL,
    DE_Ville varchar(35) NULL,
    DE_Region varchar(25) NULL,
    DE_Pays varchar(35) NULL,
    DE_EMail varchar(69) NULL,
    DE_Telephone varchar(21) NULL,
    cbMarq int IDENTITY (1, 1) NOT NULL,
    CONSTRAINT unq_F_DEPOT_DE_No UNIQUE (DE_No asc)
  );

GO
  CREATE TABLE F_DEPOTEMPL (
    DE_No int NOT NULL,
    DP_No int NULL,
    DP_Code varchar(13) NULL,
    DP_Intitule varchar(35) NULL,
    cbMarq int IDENTITY (1, 1) NOT NULL,
    CONSTRAINT unq_F_DEPOTEMPL_DP_No UNIQUE (DP_No asc)
  );

GO
  CREATE TABLE F_FAMILLE (
    FA_CodeFamille varchar(11) NOT NULL,
    FA_Type smallint NULL,
    FA_Intitule varchar(69) NULL,
    cbMarq int IDENTITY (1, 1) NOT NULL,
    CONSTRAINT PK_CBMARQ_F_FAMILLE PRIMARY KEY CLUSTERED (cbMarq asc),
    CONSTRAINT unq_F_FAMILLE_FA_CodeFamille UNIQUE (FA_CodeFamille asc)
  );

GO
  CREATE TABLE Type_Condition (
    id int IDENTITY (1, 1) NOT NULL,
    Libelle varchar(60) NULL,
    Notation float NULL,
    CONSTRAINT pk_Type_Condition PRIMARY KEY CLUSTERED (id asc)
  );

GO
  CREATE TABLE Type_Stockage (
    T_Stockage_ref int IDENTITY (1, 1) NOT NULL,
    Type_Stockage varchar(16) NULL,
    CONSTRAINT pk_Type_Stockage PRIMARY KEY CLUSTERED (T_Stockage_ref asc)
  );

GO
  CREATE TABLE controle_condition (
    cond_controle_ref int IDENTITY (1, 1) NOT NULL,
    normes varchar(150) NULL,
    id_libelle int NULL,
    CONSTRAINT pk_cond_primaire PRIMARY KEY CLUSTERED (cond_controle_ref asc)
  );

GO
  CREATE TABLE fiche (
    id_Fiche bigint IDENTITY (1, 1) NOT NULL,
    date_controle date DEFAULT getdate() NOT NULL,
    CONSTRAINT pk_fiche PRIMARY KEY CLUSTERED (id_Fiche asc)
  );

GO
  CREATE TABLE forme_categories (
    FO_Categ_ref int IDENTITY (1, 1) NOT NULL,
    FO_Categorie varchar(15) NULL,
    CONSTRAINT pk_forme_categories PRIMARY KEY CLUSTERED (FO_Categ_ref asc)
  );

GO
  CREATE TABLE formes (
    FO_ref varchar(2) NOT NULL,
    FO_Categ_ref int NULL,
    FO_designation varchar(40) NULL,
    CONSTRAINT pk_formes PRIMARY KEY CLUSTERED (FO_ref asc)
  );

GO
  CREATE TABLE posts (
    id bigint IDENTITY (1, 1) NOT NULL,
    titre_post nvarchar(255) NOT NULL,
    CONSTRAINT PK__post__3213E83FEB6E1FB9 PRIMARY KEY CLUSTERED (id asc)
  );

GO
  CREATE TABLE presentations (
    P_ref int IDENTITY (1, 1) NOT NULL,
    P_Intitule varchar(10) NULL,
    CONSTRAINT pk_presentations PRIMARY KEY CLUSTERED (P_ref asc)
  );

GO
  CREATE TABLE users (
    id bigint IDENTITY (1, 1) NOT NULL,
    name nvarchar(255) NOT NULL,
    email nvarchar(255) NOT NULL,
    password nvarchar(255) NOT NULL,
    post_id bigint NOT NULL,
    id_user bigint NULL,
    CONSTRAINT PK__users__3213E83FA605D8A1 PRIMARY KEY CLUSTERED (id asc),
    CONSTRAINT users_email_unique UNIQUE (email asc)
  );

GO
  CREATE TABLE F_ARTICLE (
    AR_Ref varchar(19) NOT NULL,
    AR_Design varchar(69) NULL,
    FA_CodeFamille varchar(11) NOT NULL,
    cbMarq int IDENTITY (1, 1) NOT NULL,
    CONSTRAINT PK_CBMARQ_F_ARTICLE PRIMARY KEY CLUSTERED (cbMarq asc),
    CONSTRAINT UKA_F_ARTICLE_AR_Ref UNIQUE (AR_Ref asc)
  );

GO
  CREATE TABLE F_ARTSTOCKEMPL (
    AR_Ref varchar(19) NOT NULL,
    DE_No int NOT NULL,
    DP_No int NOT NULL,
    cbMarq int IDENTITY (1, 1) NOT NULL
  );

GO
  CREATE TABLE details_Fiche (
    dt_Fiche_ref bigint IDENTITY (1, 1) NOT NULL,
    id_Fiche bigint NOT NULL,
    AR_Ref varchar(19) NOT NULL,
    FO_ref varchar(2) NULL,
    dosage varchar(10) NULL,
    P_ref int NULL,
    fabricant varchar(50) NULL,
    quantite bigint DEFAULT 0 NOT NULL,
    T_Stockage_ref int NULL,
    num_Lot varchar(255) NULL,
    date_fab date NULL,
    date_peremp date NOT NULL,
    volume float DEFAULT 0 NULL,
    poids float DEFAULT 0 NULL,
    etat int DEFAULT 0 NULL,
    id_User bigint NULL,
    CT_Num varchar(17) NULL,
    Observation varchar(max) NULL,
    P_quantite int DEFAULT 0 NULL,
    CONSTRAINT pk_DT_Fiche PRIMARY KEY CLUSTERED (dt_Fiche_ref asc)
  );

GO
  CREATE TABLE details_fiche_score (
    dt_fiche_ref bigint NULL,
    Condition_ref int NULL,
    score float NULL,
    observation varchar(50) NULL,
    id_user bigint NULL
  );

GO
  CREATE TABLE fiche_reference (
    ref_marche varchar(20) NOT NULL,
    date_livraison date DEFAULT getdate() NOT NULL,
    fournisseur_ref varchar(17) NULL,
    id_Fiche bigint NOT NULL,
    id_user bigint NULL
  );

GO
  CREATE TABLE fiche_stock (
    id_fiche_stock bigint IDENTITY (1, 1) NOT NULL,
    date date DEFAULT getdate() NULL,
    dt_Fiche_ref bigint NULL,
    DE_No int NULL,
    CONSTRAINT pk_fiche_stock PRIMARY KEY CLUSTERED (id_fiche_stock asc)
  );

GO
  CREATE TABLE inventaire_stock (
    id_inventaire bigint IDENTITY (1, 1) NOT NULL,
    id_fiche_stock bigint NULL,
    quantite int NULL,
    date_inventaire date DEFAULT getdate() NULL,
    observations text NULL,
    CONSTRAINT pk_inventaire_stock PRIMARY KEY CLUSTERED (id_inventaire asc)
  );

GO
  CREATE TABLE stock_Empl (
    id_stock_Empl bigint IDENTITY (1, 1) NOT NULL,
    id_fiche_stock bigint NULL,
    num_Rack varchar(13) NULL,
    quantite bigint DEFAULT 0 NULL,
    Date date DEFAULT getdate() NULL,
    observation varchar(50) NULL,
    CONSTRAINT pk_stock_Empl PRIMARY KEY CLUSTERED (id_stock_Empl asc)
  );

GO
  CREATE TABLE details_Fiche_Stock (
    id_stock_empl bigint NULL,
    CT_Num varchar(17) NULL,
    num_Doc varchar(50) NULL,
    entree int DEFAULT 0 NULL,
    sortie int DEFAULT 0 NULL,
    observation varchar(50) NULL,
    date date DEFAULT getdate() NULL,
    id_user bigint NULL
  );

GO
ALTER TABLE
  F_ARTICLE
ADD
  CONSTRAINT fk_F_ARTICLE_F_FAMILLE FOREIGN KEY (FA_CodeFamille) REFERENCES F_FAMILLE(FA_CodeFamille) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  F_ARTSTOCKEMPL
ADD
  CONSTRAINT fk_F_ARTSTOCKEMPL_F_ARTICLE FOREIGN KEY (AR_Ref) REFERENCES F_ARTICLE(AR_Ref);

GO
ALTER TABLE
  F_ARTSTOCKEMPL
ADD
  CONSTRAINT fk_F_ARTSTOCKEMPL_F_DEPOTEMPL FOREIGN KEY (DP_No) REFERENCES F_DEPOTEMPL(DP_No);

GO
ALTER TABLE
  F_DEPOTEMPL
ADD
  CONSTRAINT fk_F_DEPOTEMPL_F_DEPOT FOREIGN KEY (DE_No) REFERENCES F_DEPOT(DE_No);

GO
ALTER TABLE
  controle_condition
ADD
  CONSTRAINT fk_controle_condition_Type_Condition FOREIGN KEY (id_libelle) REFERENCES Type_Condition(id) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_fiche FOREIGN KEY (P_ref) REFERENCES presentations(P_ref) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_Fiche_F_ARTICLE FOREIGN KEY (AR_Ref) REFERENCES F_ARTICLE(AR_Ref);

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_Fiche_F_COMPTET FOREIGN KEY (CT_Num) REFERENCES F_COMPTET(CT_Num) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_fiche_fiche FOREIGN KEY (id_Fiche) REFERENCES fiche(id_Fiche);

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_Fiche_formes FOREIGN KEY (FO_ref) REFERENCES formes(FO_ref) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_Fiche_Type_Stockage FOREIGN KEY (T_Stockage_ref) REFERENCES Type_Stockage(T_Stockage_ref) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  details_Fiche
ADD
  CONSTRAINT fk_details_fiche_users FOREIGN KEY (id_User) REFERENCES users(id);

GO
ALTER TABLE
  details_Fiche_Stock
ADD
  CONSTRAINT fk_details_Fiche_Stock_stock_Empl FOREIGN KEY (id_stock_empl) REFERENCES stock_Empl(id_stock_Empl) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  details_fiche_score
ADD
  CONSTRAINT fk_details_fiche_score_controle_condition FOREIGN KEY (Condition_ref) REFERENCES controle_condition(cond_controle_ref);

GO
ALTER TABLE
  details_fiche_score
ADD
  CONSTRAINT fk_details_fiche_score_details_Fiche FOREIGN KEY (dt_fiche_ref) REFERENCES details_Fiche(dt_Fiche_ref);

GO
ALTER TABLE
  details_fiche_score
ADD
  CONSTRAINT fk_details_fiche_score_users FOREIGN KEY (id_user) REFERENCES users(id);

GO
ALTER TABLE
  fiche_reference
ADD
  CONSTRAINT fk_fiche_reference_f_comptet FOREIGN KEY (fournisseur_ref) REFERENCES F_COMPTET(CT_Num) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  fiche_reference
ADD
  CONSTRAINT fk_fiche_reference_fiche FOREIGN KEY (id_Fiche) REFERENCES fiche(id_Fiche) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  fiche_reference
ADD
  CONSTRAINT fk_fiche_reference_users FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  fiche_stock
ADD
  CONSTRAINT fk_fiche_stock_details_Fiche FOREIGN KEY (dt_Fiche_ref) REFERENCES details_Fiche(dt_Fiche_ref);

GO
ALTER TABLE
  fiche_stock
ADD
  CONSTRAINT fk_fiche_stock_F_DEPOT FOREIGN KEY (DE_No) REFERENCES F_DEPOT(DE_No) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  formes
ADD
  CONSTRAINT fk_formes_forme_categories FOREIGN KEY (FO_Categ_ref) REFERENCES forme_categories(FO_Categ_ref) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  inventaire_stock
ADD
  CONSTRAINT fk_inventaire_stock_fiche_stock FOREIGN KEY (id_fiche_stock) REFERENCES fiche_stock(id_fiche_stock);

GO
ALTER TABLE
  stock_Empl
ADD
  CONSTRAINT fk_stock_Empl_fiche_stock FOREIGN KEY (id_fiche_stock) REFERENCES fiche_stock(id_fiche_stock) ON DELETE CASCADE ON UPDATE CASCADE;

GO
ALTER TABLE
  users
ADD
  CONSTRAINT users_post_id_foreign FOREIGN KEY (post_id) REFERENCES posts(id);

GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[articles_Adresses]
AS
SELECT a.AR_Ref, a.DE_No, a.DP_No, d.DP_Code, d.DP_Intitule, dp.DE_Intitule
FROM     dbo.F_ARTSTOCKEMPL AS a INNER JOIN
                  dbo.F_DEPOTEMPL AS d ON a.DE_No = d.DE_No AND a.DP_No = d.DP_No INNER JOIN
                  dbo.F_DEPOT AS dp ON a.DE_No = dp.DE_No
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "a"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 170
               Right = 242
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "d"
            Begin Extent = 
               Top = 7
               Left = 290
               Bottom = 170
               Right = 484
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "dp"
            Begin Extent = 
               Top = 7
               Left = 532
               Bottom = 170
               Right = 726
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'articles_Adresses'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'articles_Adresses'
GO


SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[fiche_details_Fiche]
AS
SELECT dbo.fiche.id_Fiche, dbo.fiche.date_controle, dbo.details_Fiche.AR_Ref, dbo.F_ARTICLE.AR_Design, dbo.F_COMPTET.CT_Intitule, 
                  CASE WHEN [details_Fiche].etat = 0 THEN 'Fiche en attente envoie' WHEN [details_Fiche].etat = 1 THEN 'Fiche non referencier' WHEN [details_Fiche].etat = 2 THEN 'Fiche non controler' WHEN [details_Fiche].etat = 3 THEN 'Attente validation Resp. Stock'
                   WHEN [details_Fiche].etat = - 2 THEN 'Mise en Quarantaine ' WHEN [details_Fiche].etat = - 3 THEN 'REBUT' WHEN [details_Fiche].etat = 4 THEN 'Attente mise en place' END AS position, dbo.details_Fiche.quantite, dbo.details_Fiche.FO_ref, 
                  dbo.details_Fiche.P_ref, dbo.details_Fiche.dosage, dbo.details_Fiche.fabricant, dbo.details_Fiche.T_Stockage_ref, dbo.details_Fiche.volume, dbo.details_Fiche.poids, dbo.details_Fiche.CT_Num, dbo.formes.FO_designation, 
                  dbo.presentations.P_Intitule, dbo.details_Fiche.date_fab, dbo.details_Fiche.date_peremp, dbo.Type_Stockage.Type_Stockage, dbo.details_Fiche.etat, dbo.details_Fiche.num_Lot, dbo.details_Fiche.dt_Fiche_ref, 
                  CASE WHEN DATEDIFF(month, GETDATE(), dbo.details_Fiche.date_peremp) - (datediff(year, GETDATE(), dbo.details_Fiche.date_peremp) * 12) < 0 THEN (((DATEDIFF(year, GETDATE(), dbo.details_Fiche.date_peremp)) * 12) 
                  - ABS((DATEDIFF(month, GETDATE(), dbo.details_Fiche.date_peremp) - (datediff(year, GETDATE(), dbo.details_Fiche.date_peremp) * 12)))) / 12 ELSE DATEDIFF(year, GETDATE(), dbo.details_Fiche.date_peremp) END AS ANS, 
                  CASE WHEN DATEDIFF(month, GETDATE(), dbo.details_Fiche.date_peremp) - (datediff(year, GETDATE(), dbo.details_Fiche.date_peremp) * 12) < 0 THEN (((DATEDIFF(year, GETDATE(), dbo.details_Fiche.date_peremp)) * 12) 
                  - ABS((DATEDIFF(month, GETDATE(), dbo.details_Fiche.date_peremp) - (datediff(year, GETDATE(), dbo.details_Fiche.date_peremp) * 12)))) - (((((DATEDIFF(year, GETDATE(), dbo.details_Fiche.date_peremp)) * 12) - ABS((DATEDIFF(month, 
                  GETDATE(), dbo.details_Fiche.date_peremp) - (datediff(year, GETDATE(), dbo.details_Fiche.date_peremp) * 12)))) / 12)) * 12 ELSE DATEDIFF(month, GETDATE(), dbo.details_Fiche.date_peremp) - (datediff(year, GETDATE(), 
                  dbo.details_Fiche.date_peremp) * 12) END AS MOIS, dbo.details_Fiche.P_quantite, dbo.details_Fiche.Observation
FROM     dbo.fiche INNER JOIN
                  dbo.details_Fiche ON dbo.fiche.id_Fiche = dbo.details_Fiche.id_Fiche INNER JOIN
                  dbo.F_ARTICLE ON dbo.details_Fiche.AR_Ref = dbo.F_ARTICLE.AR_Ref INNER JOIN
                  dbo.presentations ON dbo.details_Fiche.P_ref = dbo.presentations.P_ref INNER JOIN
                  dbo.F_COMPTET ON dbo.details_Fiche.CT_Num = dbo.F_COMPTET.CT_Num INNER JOIN
                  dbo.Type_Stockage ON dbo.details_Fiche.T_Stockage_ref = dbo.Type_Stockage.T_Stockage_ref INNER JOIN
                  dbo.formes ON dbo.details_Fiche.FO_ref = dbo.formes.FO_ref
GROUP BY dbo.fiche.id_Fiche, dbo.fiche.date_controle, dbo.details_Fiche.AR_Ref, dbo.details_Fiche.etat, dbo.F_ARTICLE.AR_Design, dbo.F_COMPTET.CT_Intitule, dbo.details_Fiche.quantite, dbo.fiche.date_controle, dbo.details_Fiche.FO_ref, 
                  dbo.details_Fiche.P_ref, dbo.details_Fiche.dosage, dbo.details_Fiche.fabricant, dbo.details_Fiche.T_Stockage_ref, dbo.details_Fiche.volume, dbo.details_Fiche.poids, dbo.details_Fiche.CT_Num, dbo.formes.FO_designation, 
                  dbo.presentations.P_Intitule, dbo.details_Fiche.date_fab, dbo.details_Fiche.date_peremp, dbo.Type_Stockage.Type_Stockage, dbo.details_Fiche.num_Lot, dbo.details_Fiche.dt_Fiche_ref, dbo.details_Fiche.P_quantite, 
                  dbo.details_Fiche.Observation
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[38] 4[3] 2[43] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "fiche"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 126
               Right = 258
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "details_Fiche"
            Begin Extent = 
               Top = 7
               Left = 306
               Bottom = 170
               Right = 516
            End
            DisplayFlags = 280
            TopColumn = 15
         End
         Begin Table = "F_ARTICLE"
            Begin Extent = 
               Top = 7
               Left = 564
               Bottom = 170
               Right = 781
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "presentations"
            Begin Extent = 
               Top = 7
               Left = 829
               Bottom = 126
               Right = 1039
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "F_COMPTET"
            Begin Extent = 
               Top = 126
               Left = 48
               Bottom = 289
               Right = 258
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Type_Stockage"
            Begin Extent = 
               Top = 126
               Left = 829
               Bottom = 245
               Right = 1039
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "formes"
            Begin Extent = 
               Top = 7
               Left = 1087
               Bottom = 148
               Right = 1300
            End
            D' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'fiche_details_Fiche'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N'isplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1176
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1356
         SortOrder = 1416
         GroupBy = 1350
         Filter = 1356
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'fiche_details_Fiche'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'fiche_details_Fiche'
GO



SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[dt_fiche_scores]
AS
SELECT dbo.details_fiche_score.dt_fiche_ref, dbo.controle_condition.cond_controle_ref, dbo.controle_condition.id_libelle, dbo.controle_condition.normes, dbo.Type_Condition.Libelle, dbo.Type_Condition.Notation, dbo.details_fiche_score.score, 
                  dbo.details_fiche_score.observation, dbo.details_fiche_score.Condition_ref
FROM     dbo.details_fiche_score INNER JOIN
                  dbo.controle_condition ON dbo.details_fiche_score.Condition_ref = dbo.controle_condition.cond_controle_ref INNER JOIN
                  dbo.Type_Condition ON dbo.controle_condition.id_libelle = dbo.Type_Condition.id
GROUP BY dbo.details_fiche_score.dt_fiche_ref, dbo.controle_condition.cond_controle_ref, dbo.controle_condition.id_libelle, dbo.controle_condition.normes, dbo.Type_Condition.Libelle, dbo.Type_Condition.Notation, 
                  dbo.details_fiche_score.score, dbo.details_fiche_score.observation, dbo.details_fiche_score.Condition_ref
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "details_fiche_score"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 170
               Right = 242
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "controle_condition"
            Begin Extent = 
               Top = 7
               Left = 290
               Bottom = 148
               Right = 503
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "Type_Condition"
            Begin Extent = 
               Top = 7
               Left = 551
               Bottom = 148
               Right = 745
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1176
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1356
         SortOrder = 1416
         GroupBy = 1350
         Filter = 1356
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'dt_fiche_scores'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'dt_fiche_scores'
GO



SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[details_FCPCC]
AS
SELECT dbo.fiche_details_Fiche.id_Fiche, dbo.fiche_details_Fiche.date_controle, dbo.fiche_details_Fiche.AR_Ref, dbo.fiche_details_Fiche.AR_Design, dbo.fiche_details_Fiche.CT_Intitule, dbo.fiche_details_Fiche.quantite, 
                  dbo.fiche_details_Fiche.FO_ref, dbo.fiche_details_Fiche.P_ref, dbo.fiche_details_Fiche.dosage, dbo.fiche_details_Fiche.fabricant, dbo.fiche_details_Fiche.T_Stockage_ref, dbo.fiche_details_Fiche.volume, dbo.fiche_details_Fiche.poids, 
                  dbo.fiche_details_Fiche.CT_Num, dbo.fiche_details_Fiche.FO_designation, dbo.fiche_details_Fiche.P_Intitule, dbo.fiche_details_Fiche.date_fab, dbo.fiche_details_Fiche.date_peremp, dbo.fiche_details_Fiche.Type_Stockage, 
                  dbo.fiche_details_Fiche.etat, dbo.fiche_details_Fiche.num_Lot, dbo.fiche_details_Fiche.dt_Fiche_ref, dbo.fiche_details_Fiche.ANS, dbo.fiche_details_Fiche.MOIS, dbo.dt_fiche_scores.normes, dbo.dt_fiche_scores.Libelle, 
                  dbo.dt_fiche_scores.score, dbo.dt_fiche_scores.Notation, dbo.dt_fiche_scores.observation, dbo.dt_fiche_scores.id_libelle, dbo.fiche_reference.ref_marche, dbo.fiche_reference.date_livraison, dbo.F_COMPTET.CT_Intitule AS fournisseur, 
                  dbo.fiche_details_Fiche.position, dbo.fiche_details_Fiche.Observation AS ObsDecision
FROM     dbo.fiche_details_Fiche INNER JOIN
                  dbo.dt_fiche_scores ON dbo.fiche_details_Fiche.dt_Fiche_ref = dbo.dt_fiche_scores.dt_fiche_ref INNER JOIN
                  dbo.fiche_reference ON dbo.fiche_details_Fiche.id_Fiche = dbo.fiche_reference.id_Fiche INNER JOIN
                  dbo.F_COMPTET ON dbo.fiche_reference.fournisseur_ref = dbo.F_COMPTET.CT_Num
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "fiche_details_Fiche"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 170
               Right = 245
            End
            DisplayFlags = 280
            TopColumn = 23
         End
         Begin Table = "dt_fiche_scores"
            Begin Extent = 
               Top = 7
               Left = 293
               Bottom = 170
               Right = 506
            End
            DisplayFlags = 280
            TopColumn = 1
         End
         Begin Table = "fiche_reference"
            Begin Extent = 
               Top = 7
               Left = 554
               Bottom = 170
               Right = 748
            End
            DisplayFlags = 280
            TopColumn = 1
         End
         Begin Table = "F_COMPTET"
            Begin Extent = 
               Top = 7
               Left = 796
               Bottom = 170
               Right = 990
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1176
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1356
         SortOrder = 1416
         GroupBy = 1350
         Filter = 1356
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'details_FCPCC'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'details_FCPCC'
GO



SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[dt_fiche_stock]
AS
SELECT dbo.fiche_stock.id_fiche_stock, dbo.fiche_details_Fiche.AR_Ref, dbo.fiche_details_Fiche.AR_Design, dbo.fiche_details_Fiche.quantite, dbo.fiche_details_Fiche.P_Intitule, dbo.fiche_details_Fiche.date_peremp, 
                  dbo.fiche_details_Fiche.num_Lot, dbo.fiche_details_Fiche.dt_Fiche_ref, dbo.stock_Empl.num_Rack, dbo.stock_Empl.quantite AS qte_sur_rack, dbo.stock_Empl.observation, dbo.stock_Empl.Date, dbo.fiche_stock.DE_No, 
                  dbo.F_DEPOT.DE_Intitule, dbo.stock_Empl.id_stock_Empl
FROM     dbo.fiche_details_Fiche INNER JOIN
                  dbo.fiche_stock ON dbo.fiche_details_Fiche.dt_Fiche_ref = dbo.fiche_stock.dt_Fiche_ref INNER JOIN
                  dbo.stock_Empl ON dbo.fiche_stock.id_fiche_stock = dbo.stock_Empl.id_fiche_stock INNER JOIN
                  dbo.F_DEPOT ON dbo.fiche_stock.DE_No = dbo.F_DEPOT.DE_No
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "fiche_details_Fiche"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 170
               Right = 245
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "fiche_stock"
            Begin Extent = 
               Top = 7
               Left = 293
               Bottom = 148
               Right = 487
            End
            DisplayFlags = 280
            TopColumn = 1
         End
         Begin Table = "stock_Empl"
            Begin Extent = 
               Top = 7
               Left = 535
               Bottom = 170
               Right = 729
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "F_DEPOT"
            Begin Extent = 
               Top = 7
               Left = 777
               Bottom = 170
               Right = 971
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1176
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1356
         SortOrder = 1416
         GroupBy = 1350
         Filter = 1356
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'dt_fiche_stock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'dt_fiche_stock'
GO


SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[mvt_stock]
AS
SELECT dfs.id_stock_empl, dt.id_fiche_stock, se.num_Rack, dfs.date AS date_mvt, dfs.num_Doc, dfs.CT_Num, cpt.CT_Intitule, dfs.entree, dfs.sortie, dfs.observation, dt.AR_Design, dt.AR_Ref, dt.num_Lot, dbo.details_Fiche.id_Fiche
FROM     dbo.dt_fiche_stock AS dt INNER JOIN
                  dbo.details_Fiche_Stock AS dfs ON dfs.id_stock_empl = dt.id_stock_Empl INNER JOIN
                  dbo.fiche_stock AS f ON f.id_fiche_stock = dt.id_fiche_stock INNER JOIN
                  dbo.details_Fiche ON f.dt_Fiche_ref = dbo.details_Fiche.dt_Fiche_ref INNER JOIN
                  dbo.fiche ON dbo.details_Fiche.id_Fiche = dbo.fiche.id_Fiche LEFT OUTER JOIN
                  dbo.F_COMPTET AS cpt ON cpt.CT_Num = dfs.CT_Num LEFT OUTER JOIN
                  dbo.stock_Empl AS se ON se.id_stock_Empl = dt.id_stock_Empl
GROUP BY dfs.id_stock_empl, dt.id_fiche_stock, dfs.entree, dfs.sortie, dt.id_stock_Empl, dfs.date, dfs.date, dfs.num_Doc, dfs.CT_Num, cpt.CT_Intitule, se.num_Rack, dfs.observation, dt.AR_Design, dt.AR_Ref, dt.num_Lot, dbo.details_Fiche.id_Fiche
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "dt"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 170
               Right = 258
            End
            DisplayFlags = 280
            TopColumn = 7
         End
         Begin Table = "dfs"
            Begin Extent = 
               Top = 7
               Left = 306
               Bottom = 170
               Right = 516
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "f"
            Begin Extent = 
               Top = 7
               Left = 564
               Bottom = 170
               Right = 774
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "cpt"
            Begin Extent = 
               Top = 7
               Left = 822
               Bottom = 170
               Right = 1032
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "se"
            Begin Extent = 
               Top = 7
               Left = 1080
               Bottom = 170
               Right = 1290
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "fiche"
            Begin Extent = 
               Top = 175
               Left = 48
               Bottom = 298
               Right = 258
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "details_Fiche"
            Begin Extent = 
               Top = 175
               Left = 306
               Bottom = 338
               Right = 516
            End
            DisplayFlags = 280
            TopColumn' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'mvt_stock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane2', @value=N' = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1176
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1356
         SortOrder = 1416
         GroupBy = 1350
         Filter = 1356
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'mvt_stock'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=2 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'mvt_stock'
GO


