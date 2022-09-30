CREATE  TABLE reception_salama.dbo.F_COMPTET ( 
	CT_Num               varchar(17)      NOT NULL,
	CT_Intitule          varchar(69)      NULL,
	CT_Type              smallint      NULL,
	cbMarq               int    IDENTITY (1, 1)  NOT NULL,
	CONSTRAINT PK_CBMARQ_F_COMPTET PRIMARY KEY  CLUSTERED ( cbMarq  asc ) ,
	CONSTRAINT UKA_F_COMPTET_CT_Num UNIQUE ( CT_Num  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.F_DEPOT ( 
	DE_No                int      NULL,
	DE_Intitule          varchar(35)      NOT NULL,
	DE_Adresse           varchar(35)      NULL,
	DE_Ville             varchar(35)      NULL,
	DE_Region            varchar(25)      NULL,
	DE_Pays              varchar(35)      NULL,
	DE_EMail             varchar(69)      NULL,
	DE_Telephone         varchar(21)      NULL,
	cbMarq               int    IDENTITY (1, 1)  NOT NULL,
	CONSTRAINT unq_F_DEPOT_DE_No UNIQUE ( DE_No  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.F_DEPOTEMPL ( 
	DE_No                int      NOT NULL,
	DP_No                int      NULL,
	DP_Code              varchar(13)      NULL,
	DP_Intitule          varchar(35)      NULL,
	cbMarq               int    IDENTITY (1, 1)  NOT NULL,
	CONSTRAINT unq_F_DEPOTEMPL_DP_No UNIQUE ( DP_No  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.F_FAMILLE ( 
	FA_CodeFamille       varchar(11)      NOT NULL,
	FA_Type              smallint      NULL,
	FA_Intitule          varchar(69)      NULL,
	cbMarq               int    IDENTITY (1, 1)  NOT NULL,
	CONSTRAINT PK_CBMARQ_F_FAMILLE PRIMARY KEY  CLUSTERED ( cbMarq  asc ) ,
	CONSTRAINT unq_F_FAMILLE_FA_CodeFamille UNIQUE ( FA_CodeFamille  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.Type_Condition ( 
	id                   int    IDENTITY (1, 1)  NOT NULL,
	Libelle              varchar(60)      NULL,
	Notation             float      NULL,
	CONSTRAINT pk_Type_Condition PRIMARY KEY  CLUSTERED ( id  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.Type_Stockage ( 
	T_Stockage_ref       int    IDENTITY (1, 1)  NOT NULL,
	Type_Stockage        varchar(16)      NULL,
	CONSTRAINT pk_Type_Stockage PRIMARY KEY  CLUSTERED ( T_Stockage_ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.controle_condition ( 
	cond_controle_ref    int    IDENTITY (1, 1)  NOT NULL,
	normes               varchar(150)      NULL,
	id_libelle           int      NULL,
	CONSTRAINT pk_cond_primaire PRIMARY KEY  CLUSTERED ( cond_controle_ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.fiche ( 
	id_Fiche             bigint    IDENTITY (1, 1)  NOT NULL,
	date_controle        date  DEFAULT getdate()    NOT NULL,
	CONSTRAINT pk_fiche PRIMARY KEY  CLUSTERED ( id_Fiche  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.forme_categories ( 
	FO_Categ_ref         int    IDENTITY (1, 1)  NOT NULL,
	FO_Categorie         varchar(15)      NULL,
	CONSTRAINT pk_forme_categories PRIMARY KEY  CLUSTERED ( FO_Categ_ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.formes ( 
	FO_ref               varchar(2)      NOT NULL,
	FO_Categ_ref         int      NULL,
	FO_designation       varchar(40)      NULL,
	CONSTRAINT pk_formes PRIMARY KEY  CLUSTERED ( FO_ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.posts ( 
	id                   bigint    IDENTITY (1, 1)  NOT NULL,
	titre_post           nvarchar(255)      NOT NULL,
	CONSTRAINT PK__post__3213E83FEB6E1FB9 PRIMARY KEY  CLUSTERED ( id  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.presentations ( 
	P_ref                int    IDENTITY (1, 1)  NOT NULL,
	P_Intitule           varchar(10)      NULL,
	CONSTRAINT pk_presentations PRIMARY KEY  CLUSTERED ( P_ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.users ( 
	id                   bigint    IDENTITY (1, 1)  NOT NULL,
	name                 nvarchar(255)      NOT NULL,
	email                nvarchar(255)      NOT NULL,
	password             nvarchar(255)      NOT NULL,
	post_id              bigint      NOT NULL,
	id_user              bigint      NULL,
	CONSTRAINT PK__users__3213E83FA605D8A1 PRIMARY KEY  CLUSTERED ( id  asc ) ,
	CONSTRAINT users_email_unique UNIQUE ( email  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.F_ARTICLE ( 
	AR_Ref               varchar(19)      NOT NULL,
	AR_Design            varchar(69)      NULL,
	FA_CodeFamille       varchar(11)      NOT NULL,
	cbMarq               int    IDENTITY (1, 1)  NOT NULL,
	CONSTRAINT PK_CBMARQ_F_ARTICLE PRIMARY KEY  CLUSTERED ( cbMarq  asc ) ,
	CONSTRAINT UKA_F_ARTICLE_AR_Ref UNIQUE ( AR_Ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.F_ARTSTOCKEMPL ( 
	AR_Ref               varchar(19)      NOT NULL,
	DE_No                int      NOT NULL,
	DP_No                int      NOT NULL,
	cbMarq               int    IDENTITY (1, 1)  NOT NULL
 );
GO

CREATE  TABLE reception_salama.dbo.details_Fiche ( 
	dt_Fiche_ref         bigint    IDENTITY (1, 1)  NOT NULL,
	id_Fiche             bigint      NOT NULL,
	AR_Ref               varchar(19)      NOT NULL,
	FO_ref               varchar(2)      NULL,
	dosage               varchar(10)      NULL,
	P_ref                int      NULL,
	fabricant            varchar(50)      NULL,
	quantite             bigint  DEFAULT 0    NOT NULL,
	T_Stockage_ref       int      NULL,
	num_Lot              varchar(255)      NULL,
	date_fab             date      NULL,
	date_peremp          date      NOT NULL,
	volume               float  DEFAULT 0    NULL,
	poids                float  DEFAULT 0    NULL,
	etat                 int  DEFAULT 0    NULL,
	id_User              bigint      NULL,
	CT_Num               varchar(17)      NULL,
	Observation          varchar(max)      NULL,
	P_quantite           int  DEFAULT 0    NULL,
	CONSTRAINT pk_DT_Fiche PRIMARY KEY  CLUSTERED ( dt_Fiche_ref  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.details_fiche_score ( 
	dt_fiche_ref         bigint      NULL,
	Condition_ref        int      NULL,
	score                float      NULL,
	observation          varchar(50)      NULL,
	id_user              bigint      NULL
 );
GO

CREATE  TABLE reception_salama.dbo.fiche_reference ( 
	ref_marche           varchar(20)      NOT NULL,
	date_livraison       date  DEFAULT getdate()    NOT NULL,
	fournisseur_ref      varchar(17)      NULL,
	id_Fiche             bigint      NOT NULL,
	id_user              bigint      NULL
 );
GO

CREATE  TABLE reception_salama.dbo.fiche_stock ( 
	id_fiche_stock       bigint    IDENTITY (1, 1)  NOT NULL,
	date                 date  DEFAULT getdate()    NULL,
	dt_Fiche_ref         bigint      NULL,
	DE_No                int      NULL,
	CONSTRAINT pk_fiche_stock PRIMARY KEY  CLUSTERED ( id_fiche_stock  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.inventaire_stock ( 
	id_inventaire        bigint    IDENTITY (1, 1)  NOT NULL,
	id_fiche_stock       bigint      NULL,
	quantite             int      NULL,
	date_inventaire      date  DEFAULT getdate()    NULL,
	observations         text      NULL,
	CONSTRAINT pk_inventaire_stock PRIMARY KEY  CLUSTERED ( id_inventaire  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.stock_Empl ( 
	id_stock_Empl        bigint    IDENTITY (1, 1)  NOT NULL,
	id_fiche_stock       bigint      NULL,
	num_Rack             varchar(13)      NULL,
	quantite             bigint  DEFAULT 0    NULL,
	Date                 date  DEFAULT getdate()    NULL,
	observation          varchar(50)      NULL,
	CONSTRAINT pk_stock_Empl PRIMARY KEY  CLUSTERED ( id_stock_Empl  asc ) 
 );
GO

CREATE  TABLE reception_salama.dbo.details_Fiche_Stock ( 
	id_stock_empl        bigint      NULL,
	CT_Num               varchar(17)      NULL,
	num_Doc              varchar(50)      NULL,
	entree               int  DEFAULT 0    NULL,
	sortie               int  DEFAULT 0    NULL,
	observation          varchar(50)      NULL,
	date                 date  DEFAULT getdate()    NULL,
	id_user              bigint      NULL
 );
GO

ALTER TABLE reception_salama.dbo.F_ARTICLE ADD CONSTRAINT fk_F_ARTICLE_F_FAMILLE FOREIGN KEY ( FA_CodeFamille ) REFERENCES reception_salama.dbo.F_FAMILLE( FA_CodeFamille ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.F_ARTSTOCKEMPL ADD CONSTRAINT fk_F_ARTSTOCKEMPL_F_ARTICLE FOREIGN KEY ( AR_Ref ) REFERENCES reception_salama.dbo.F_ARTICLE( AR_Ref );
GO

ALTER TABLE reception_salama.dbo.F_ARTSTOCKEMPL ADD CONSTRAINT fk_F_ARTSTOCKEMPL_F_DEPOTEMPL FOREIGN KEY ( DP_No ) REFERENCES reception_salama.dbo.F_DEPOTEMPL( DP_No );
GO

ALTER TABLE reception_salama.dbo.F_DEPOTEMPL ADD CONSTRAINT fk_F_DEPOTEMPL_F_DEPOT FOREIGN KEY ( DE_No ) REFERENCES reception_salama.dbo.F_DEPOT( DE_No );
GO

ALTER TABLE reception_salama.dbo.controle_condition ADD CONSTRAINT fk_controle_condition_Type_Condition FOREIGN KEY ( id_libelle ) REFERENCES reception_salama.dbo.Type_Condition( id ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_fiche FOREIGN KEY ( P_ref ) REFERENCES reception_salama.dbo.presentations( P_ref ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_Fiche_F_ARTICLE FOREIGN KEY ( AR_Ref ) REFERENCES reception_salama.dbo.F_ARTICLE( AR_Ref );
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_Fiche_F_COMPTET FOREIGN KEY ( CT_Num ) REFERENCES reception_salama.dbo.F_COMPTET( CT_Num ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_fiche_fiche FOREIGN KEY ( id_Fiche ) REFERENCES reception_salama.dbo.fiche( id_Fiche );
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_Fiche_formes FOREIGN KEY ( FO_ref ) REFERENCES reception_salama.dbo.formes( FO_ref ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_Fiche_Type_Stockage FOREIGN KEY ( T_Stockage_ref ) REFERENCES reception_salama.dbo.Type_Stockage( T_Stockage_ref ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.details_Fiche ADD CONSTRAINT fk_details_fiche_users FOREIGN KEY ( id_User ) REFERENCES reception_salama.dbo.users( id );
GO

ALTER TABLE reception_salama.dbo.details_Fiche_Stock ADD CONSTRAINT fk_details_Fiche_Stock_stock_Empl FOREIGN KEY ( id_stock_empl ) REFERENCES reception_salama.dbo.stock_Empl( id_stock_Empl ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.details_fiche_score ADD CONSTRAINT fk_details_fiche_score_controle_condition FOREIGN KEY ( Condition_ref ) REFERENCES reception_salama.dbo.controle_condition( cond_controle_ref );
GO

ALTER TABLE reception_salama.dbo.details_fiche_score ADD CONSTRAINT fk_details_fiche_score_details_Fiche FOREIGN KEY ( dt_fiche_ref ) REFERENCES reception_salama.dbo.details_Fiche( dt_Fiche_ref );
GO

ALTER TABLE reception_salama.dbo.details_fiche_score ADD CONSTRAINT fk_details_fiche_score_users FOREIGN KEY ( id_user ) REFERENCES reception_salama.dbo.users( id );
GO

ALTER TABLE reception_salama.dbo.fiche_reference ADD CONSTRAINT fk_fiche_reference_f_comptet FOREIGN KEY ( fournisseur_ref ) REFERENCES reception_salama.dbo.F_COMPTET( CT_Num ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.fiche_reference ADD CONSTRAINT fk_fiche_reference_fiche FOREIGN KEY ( id_Fiche ) REFERENCES reception_salama.dbo.fiche( id_Fiche ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.fiche_reference ADD CONSTRAINT fk_fiche_reference_users FOREIGN KEY ( id_user ) REFERENCES reception_salama.dbo.users( id ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.fiche_stock ADD CONSTRAINT fk_fiche_stock_details_Fiche FOREIGN KEY ( dt_Fiche_ref ) REFERENCES reception_salama.dbo.details_Fiche( dt_Fiche_ref );
GO

ALTER TABLE reception_salama.dbo.fiche_stock ADD CONSTRAINT fk_fiche_stock_F_DEPOT FOREIGN KEY ( DE_No ) REFERENCES reception_salama.dbo.F_DEPOT( DE_No ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.formes ADD CONSTRAINT fk_formes_forme_categories FOREIGN KEY ( FO_Categ_ref ) REFERENCES reception_salama.dbo.forme_categories( FO_Categ_ref ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.inventaire_stock ADD CONSTRAINT fk_inventaire_stock_fiche_stock FOREIGN KEY ( id_fiche_stock ) REFERENCES reception_salama.dbo.fiche_stock( id_fiche_stock );
GO

ALTER TABLE reception_salama.dbo.stock_Empl ADD CONSTRAINT fk_stock_Empl_fiche_stock FOREIGN KEY ( id_fiche_stock ) REFERENCES reception_salama.dbo.fiche_stock( id_fiche_stock ) ON DELETE CASCADE ON UPDATE CASCADE;
GO

ALTER TABLE reception_salama.dbo.users ADD CONSTRAINT users_post_id_foreign FOREIGN KEY ( post_id ) REFERENCES reception_salama.dbo.posts( id );
GO

--#################################################################################################
-- Real World DBA Toolkit Version 2019-08-01 Lowell Izaguirre lowell@stormrage.com
--#################################################################################################
-- USAGE: exec sp_GetDDL GMACT
--   or   exec sp_GetDDL 'bob.example'
--   or   exec sp_GetDDL '[schemaname].[tablename]'
--   or   exec sp_GetDDL #temp
--#################################################################################################
-- copyright 2004-2018 by Lowell Izaguirre scripts*at*stormrage.com all rights reserved.
--developer utility function added by Lowell, used in SQL Server Management Studio
-- http://www.stormrage.com/SQLStuff/sp_GetDDL_Latest.txt
--Purpose: Script Any Table, Temp Table or Object(Procedure Function Synonym View Table Trigger)
--#################################################################################################
-- see the thread here for lots of details: http://www.sqlservercentral.com/Forums/Topic751783-566-7.aspx
-- You can use this however you like...this script is not rocket science, but it took a bit of work to create.
-- the only thing that I ask
-- is that if you adapt my procedure or make it better, to simply send me a copy of it,
-- so I can learn from the things you've enhanced.The feedback you give will be what makes
-- it worthwhile to me, and will be fed back to the SQL community.
-- add this to your toolbox of helpful scripts.
--#################################################################################################
--
-- V300  uses String concatination and sys.tables instead of a cursor
-- V301  enhanced 07/31/2009 to include extended properties definitions
-- V302  fixes an issue where the schema is created , ie 'bob', but no user named 'bob' owns the schema, so the table is not found
-- V303  fixes an issue where all rules are appearing, instead of jsut the rule related to a column
-- V304  testing whether vbCrLf is better than just CHAR(13), some formatting cleanup with GO statements
--       also fixed an issue with the conversion from syscolumns to sys.columns, max-length is only field we need, not [precision]
-- V305  user feedback helped me find that the type_name function should call user_type_id instead of system_type_id
--       also fixed issue where identity definition missing from numeric/decimal definition
-- V306  fixes the computed columns definition that got broken/removed somehow in V300
--       also formatting when decimal is not an identity
-- V307  fixes bug identified by David Griffiths-491597 from SSC where the  @TABLE_ID
--       is reselected, but without it's schema  , potentially selecting the wrong table
--       also fixed is the missing size definition for varbinary, also found by David Griffith
-- V308  abtracted all SQLs to use Table Alaises
--       added logic to script a temp table.
--       added warning about possibly not being marked as system object.
-- V309  added logic based on feedback from Vincent Wylenzek @SSC to return the definition from sys.sql_modules for
--       any object like procedure/view/function/trigger, and not just a table.
--       note previously, if you pointed sp_GetDDL at a view, it returned the view definition as a table...
--       now it will return the view definition instead.
-- V309a returns multi row recordset, one line per record
-- V310a fixed the commented out code related to collation identified by moadh.bs @SSC
--       changed the DEFAULT definitions to not include the default name.
-- V310b Added PERSISTED to calculated columns where applicable
-- V310b fixed COLLATE statement for temp tables
-- V310c fixed NVARCHAR size misreported as doubled.
-- V311  fixed issue where indexes did not identify if the column was ASC or DESC found by nikus @ SSC
-- V311a fixed issue where indexes did not identify if the index was CLUSTERED or NONCLUSTERED found by nikus @ SSC 02/22/2013
-- V312  got rid of all upper casing, and allowing all scripts to generate the exact object names in cases of case sensitive databases.
--       now using the case sensitive name of the table passed: so of you did 'exec sp_GetDDL invoicedocs , it might return the script for InvoiceDocs, as that is how it is spelled in sys.objects.
--       added if exists(drop table/procedure/function) statement to the scripting automatically.
--       toggled the commented out code to list any default constraints by name, hopefully to be more accurate..
--       formatting of index statements to be multi line for better readability
--V314   03/30/2015
--       did i mention this scripts out temp tables too? sp_GetDDL #tmp
--       scripts any object:table,#temptable procedure, function, view or trigger
--       added ability to script synonyms
--       moved logic for REAL datatype to fix error when scripting real columns
--       added OmaCoders suggestion to script column extended properties as well.
--       added matt_slack suggestion to script schemaname as part of index portion of script.
--       minor script cleanup to use QUOTENAME insead of concatenating square brackets.
--       changed compatibility to 2008 and above only, now filtered idnexes with WHERE statmeents script correctly
--       foreign key tables and columns  in script now quotenamed to account for spaces in names; previously an error for Applciation ID instead of [Application ID]
--V315   Fixes Aliases and column names that prevented Case Sensitive collations from working.
--       Adds code if the procedure scripted is a system object
--       index scripts featuring filtered indexes is now included
--       index scripts now include filegroup name and compression settings
--       foreign key casecade delete/update settings now included as identified by Alberto aserio@SSC)
--       Fixes related to scripting extended events  as identified by Alberto aserio@SSC)
--V316   Fixes Identified 07/27/2016 by mlm( m.martinelli@SSC)
--       Added logic  resolving error when custom data type are defined using name greather than 16 char.
--       Added handling for data types: binary, datetime2, datetimeoffset, time
--       Added Set Based logic for Handling Fixed FOREIGN KEYS handling when one foreign key is define on more then one field
--       Added SPARSE column property
--V317   Fixes Identified 03/30/2017 by Lowell
--       Scripting of Foreign key column(s) are now quotenamed
--       Scripting column store indexes was broken, now fixed for column store indexes
--V318   Fixes Identified 02/14/2018 by Lowell
--       Scripting of with collation added/required for scripting SharePoint/ReportServer , or databases with non standard collations
--       Scripting enhanced to definitively handle case sensitive collations as well.
--V319   Adding logic for Temporal Tables, to grab their auto nistory tables
--       first attempt for partitioned tables, to get the columns correctly on the partition scheme
-- DROP PROCEDURE [dbo].[sp_GetDDL]
--#############################################################################
--if you are going to put this in MASTER, and want it to be able to query
--each database's sys.indexes, you MUST mark it as a system procedure:
--EXECUTE sp_ms_marksystemobject 'sp_GetDDL'
--#############################################################################
-- REMOVE TWO LINES WHERE IS THE TEXT 'FROM master.sys.objects'
-- REPLACE HEADER  'CREATE OR ALTER PROCEDURE [dbo].[sp_GetDDL]'
CREATE   PROCEDURE [dbo].[sp_GetDDL]
  @TBL                VARCHAR(255)
AS
BEGIN
  SET NOCOUNT ON;
  DECLARE     @TBLNAME                VARCHAR(200),
              @SCHEMANAME             VARCHAR(255),
              @STRINGLEN              INT,
              @TABLE_ID               INT,
              @FINALSQL               VARCHAR(MAX),
              @CONSTRAINTSQLS         VARCHAR(MAX),
              @CHECKCONSTSQLS         VARCHAR(MAX),
              @RULESCONSTSQLS         VARCHAR(MAX),
              @FKSQLS                 VARCHAR(MAX),
              @TRIGGERSTATEMENT       VARCHAR(MAX),
              @EXTENDEDPROPERTIES     VARCHAR(MAX),
              @INDEXSQLS              VARCHAR(MAX),
              @MARKSYSTEMOBJECT       VARCHAR(MAX),
              @vbCrLf                 CHAR(2),
              @ISSYSTEMOBJECT         INT,
              @PROCNAME               VARCHAR(256),
              @input                  VARCHAR(MAX),
              @ObjectTypeFound        VARCHAR(255),
              @ObjectDataTypeLen      INT,
              --V3.20 additions
              @WithStatement          VARCHAR(MAX),
              @FileGroupStatement     VARCHAR(MAX),
              @PartitioningStatement  VARCHAR(MAX),
              @TemporalStatement      VARCHAR(MAX);
--##############################################################################
-- INITIALIZE
--##############################################################################
  SET @input = '';
  --new code: determine whether this proc is marked as a system proc with sp_ms_marksystemobject,
  --which flips the is_ms_shipped bit in sys.objects
    SELECT @ISSYSTEMOBJECT = ISNULL([is_ms_shipped],0),@PROCNAME = ISNULL([name],'sp_GetDDL') FROM [sys].[objects] WHERE [object_id] = @@PROCID;
  IF @ISSYSTEMOBJECT IS NULL
    SET @ISSYSTEMOBJECT = 0;
  IF @PROCNAME IS NULL
    SET @PROCNAME = 'sp_GetDDL';
  --SET @TBL =  '[DBO].[WHATEVER1]'
  --does the tablename contain a schema?
  SET @vbCrLf =  CHAR(10);
  SELECT @SCHEMANAME = ISNULL(PARSENAME(@TBL,2),'dbo') ,
         @TBLNAME    = PARSENAME(@TBL,1);
  SELECT
    @TBLNAME    = [objz].[name],
    @TABLE_ID   = [objz].[object_id]
  FROM [sys].[objects] AS [objz]
  WHERE [objz].[type]          IN ('S','U')
    AND [objz].[name]          <>  'dtproperties'
    AND [objz].[name]           =  @TBLNAME
    AND [objz].[schema_id] =  SCHEMA_ID(@SCHEMANAME) ;
 SELECT @ObjectDataTypeLen = MAX(LEN([name])) FROM [sys].[types];
--##############################################################################
-- Check If TEMP TableName is Valid
--##############################################################################
  IF LEFT(@TBLNAME,1) = '#'  COLLATE SQL_Latin1_General_CP1_CI_AS
    BEGIN
      PRINT '--TEMP TABLE  ' + QUOTENAME(@TBLNAME) + '  FOUND';
      IF OBJECT_ID('tempdb..' + QUOTENAME(@TBLNAME)) IS NOT NULL
        BEGIN
          PRINT '--GOIN TO TEMP PROCESSING';
          GOTO TEMPPROCESS;
        END;
    END;
  ELSE
    BEGIN
      PRINT '--Non-Temp Table, ' + QUOTENAME(@TBLNAME) + ' continue Processing';
    END;
--##############################################################################
-- Check If TableName is Valid
--##############################################################################
  IF ISNULL(@TABLE_ID,0) = 0
    BEGIN
      --V309 code: see if it is an object and not a table.
      SELECT
        @TBLNAME    = [objz].[name],
        @TABLE_ID   = [objz].[object_id],
        @ObjectTypeFound = [objz].[type_desc]
      FROM [sys].[objects] AS [objz]
      --WHERE [type_desc]     IN('SQL_STORED_PROCEDURE','VIEW','SQL_TRIGGER','AGGREGATE_FUNCTION','SQL_INLINE_TABLE_VALUED_FUNCTION','SQL_TABLE_VALUED_FUNCTION','SQL_SCALAR_FUNCTION','SYNONYMN')
      WHERE [objz].[type]          IN ('P','V','TR','AF','IF','FN','TF','SN')
        AND [objz].[name]          <>  'dtproperties'
        AND [objz].[name]           =  @TBLNAME
        AND [objz].[schema_id] =  SCHEMA_ID(@SCHEMANAME) ;
      IF ISNULL(@TABLE_ID,0) <> 0
        BEGIN
          --adding a drop statement.
          --adding a sp_ms_marksystemobject if needed
          SELECT @MARKSYSTEMOBJECT = CASE
                                       WHEN [objz].[is_ms_shipped] = 1
                                       THEN '
GO
--#################################################################################################
--Mark as a system object
EXECUTE sp_ms_marksystemobject  ''' + QUOTENAME(@SCHEMANAME) +'.' + QUOTENAME(@TBLNAME) + '''
--#################################################################################################
'
                                       ELSE '
GO
'
                                     END
          FROM [sys].[objects] AS [objz]
          WHERE [objz].[object_id] = @TABLE_ID;
          --adding a drop statement.
          IF @ObjectTypeFound = 'SYNONYM'  COLLATE SQL_Latin1_General_CP1_CI_AS
            BEGIN
               SELECT @FINALSQL =
                'IF EXISTS(SELECT * FROM sys.synonyms WHERE name = '''
                                + [name]
                                + ''''
                                + ' AND base_object_name <> ''' + [base_object_name] + ''')'
                                + @vbCrLf
                                + '  DROP SYNONYM ' + QUOTENAME([name]) + ''
                                + @vbCrLf
                                +'GO'
                                + @vbCrLf
                                +'IF NOT EXISTS(SELECT * FROM sys.synonyms WHERE name = '''
                                + [name]
                                + ''')'
                                + @vbCrLf
                                + 'CREATE SYNONYM ' + QUOTENAME([name]) + ' FOR ' + [base_object_name] +';'
                                FROM [sys].[synonyms]
                                WHERE  [name]   =  @TBLNAME
                                AND [schema_id] =  SCHEMA_ID(@SCHEMANAME);
            END;
          ELSE
            BEGIN
          SELECT @FINALSQL =
          'IF OBJECT_ID(''' + QUOTENAME(@SCHEMANAME) + '.' + QUOTENAME(@TBLNAME) + ''') IS NOT NULL ' + @vbCrLf
          + 'DROP ' + CASE
                        WHEN [objz].[type] IN ('P')
                        THEN ' PROCEDURE '
                        WHEN [objz].[type] IN ('V')
                        THEN ' VIEW      '
                        WHEN [objz].[type] IN ('TR')
                        THEN ' TRIGGER   '
                        ELSE ' FUNCTION  '
                      END
                      + QUOTENAME(@SCHEMANAME) + '.' + QUOTENAME(@TBLNAME) + ' ' + @vbCrLf + 'GO' + @vbCrLf
          + [def].[definition] + @MARKSYSTEMOBJECT
          FROM [sys].[objects] AS [objz]
            INNER JOIN [sys].[sql_modules] AS [def]
              ON [objz].[object_id] = [def].[object_id]
          WHERE [objz].[type]          IN ('P','V','TR','AF','IF','FN','TF')
            AND [objz].[name]          <>  'dtproperties'
            AND [objz].[name]           =  @TBLNAME
            AND [objz].[schema_id] =  SCHEMA_ID(@SCHEMANAME) ;
            END;
          SET @input = @FINALSQL
            --ten years worth of days from todays date:
         ;WITH [E01]([N]) AS (SELECT 1 UNION ALL SELECT 1 UNION ALL
                          SELECT 1 UNION ALL SELECT 1 UNION ALL
                          SELECT 1 UNION ALL SELECT 1 UNION ALL
                          SELECT 1 UNION ALL SELECT 1 UNION ALL
                          SELECT 1 UNION ALL SELECT 1), --         10 or 10E01 rows
               [E02]([N]) AS (SELECT 1 FROM [E01] AS [a], [E01] AS [b]),  --        100 or 10E02 rows
               [E04]([N]) AS (SELECT 1 FROM [E02] AS [a], [E02] AS [b]),  --     10,000 or 10E04 rows
               [E08]([N]) AS (SELECT 1 FROM [E04] AS [a], [E04] AS [b]),  --100,000,000 or 10E08 rows
               --E16(N) AS (SELECT 1 FROM E08 a, E08 b),  --10E16 or more rows than you'll EVER need,
               [Tally]([N]) AS (SELECT ROW_NUMBER() OVER (ORDER BY [E08].[N]) FROM [E08]),
             [ItemSplit](
                       [ItemOrder],
                       [Item]
                      ) AS (
                            SELECT [Tally].[N],
                              SUBSTRING(@vbCrLf + @input + @vbCrLf,[Tally].[N] + DATALENGTH(@vbCrLf),CHARINDEX(@vbCrLf,@vbCrLf + @input + @vbCrLf,[Tally].[N] + DATALENGTH(@vbCrLf)) - [Tally].[N] - DATALENGTH(@vbCrLf))
                            FROM [Tally]
                            WHERE [Tally].[N] < DATALENGTH(@vbCrLf + @input)
                            --WHERE N < DATALENGTH(@vbCrLf + @input) -- REMOVED added @vbCrLf
                              AND SUBSTRING(@vbCrLf + @input + @vbCrLf,[Tally].[N],DATALENGTH(@vbCrLf)) = @vbCrLf --Notice how we find the delimiter
                           )
        SELECT
          --row_number() over (order by ItemOrder) as ItemID,
          [ItemSplit].[Item]
        FROM [ItemSplit];
         RETURN 0;
        END;
      ELSE
        BEGIN
        SET @FINALSQL = 'Object ' + QUOTENAME(@SCHEMANAME) + '.' + QUOTENAME(@TBLNAME) + ' does not exist in Database ' + QUOTENAME(DB_NAME())   + ' '
                      + CASE
                          WHEN @ISSYSTEMOBJECT = 0 THEN @vbCrLf + ' (also note that ' + @PROCNAME + ' is not marked as a system proc and cross db access to sys.tables will fail.)'
                          ELSE ''
                        END;
      IF LEFT(@TBLNAME,1) = '#'
        SET @FINALSQL = @FINALSQL + ' OR in The tempdb database.';
      SELECT @FINALSQL AS [Item];
      RETURN 0;
        END;
    END;
--##############################################################################
-- Valid Table, Continue Processing
--##############################################################################
--Is this a SYSTEM versioned TABLE?
SELECT @FINALSQL =
     CASE
       WHEN [tabz].[history_table_id] IS NULL
       THEN ''
       ELSE 'ALTER TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id]) ) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ' SET (SYSTEM_VERSIONING = OFF);' + @vbCrLf
            +  'IF OBJECT_ID(''' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[history_table_id]) ) + '.' + QUOTENAME(OBJECT_NAME([tabz].[history_table_id])) + ''') IS NOT NULL ' + @vbCrLf
              + 'DROP TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[history_table_id])) + '.' + QUOTENAME(OBJECT_NAME([tabz].[history_table_id])) + ' ' + @vbCrLf + 'GO' + @vbCrLf
       END
    + 'IF OBJECT_ID(''' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id]) ) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ''') IS NOT NULL ' + @vbCrLf
              + 'DROP TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id])) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ' ' + @vbCrLf + 'GO' + @vbCrLf
              + 'CREATE ' + ( CASE WHEN tabz.is_external = 1 THEN 'EXTERNAL ' ELSE '' END ) + 'TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id])) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ' ( '
    FROM [sys].[tables] [tabz] WHERE [tabz].[object_id] = @TABLE_ID
    PRINT @FINALSQL
  --removed invalid code here which potentially selected wrong table--thanks David Grifiths @SSC!
  SELECT
    @STRINGLEN = MAX(LEN([colz].[name])) + 1
  FROM [sys].[objects] AS [objz]
    INNER JOIN [sys].[columns] AS [colz]
      ON  [objz].[object_id] = [colz].[object_id]
      AND [objz].[object_id] = @TABLE_ID;
--##############################################################################
--Get the columns, their definitions and defaults.
--##############################################################################
  SELECT
    @FINALSQL = @FINALSQL
    + CASE
        WHEN [colz].[is_computed] = 1
        THEN @vbCrLf
             + QUOTENAME([colz].[name])
             + ' '
             + SPACE(@STRINGLEN - LEN([colz].[name]))
             + 'AS ' + ISNULL([CALC].[definition],'')
             + CASE
                 WHEN [CALC].[is_persisted] = 1
                 THEN ' PERSISTED'
                 ELSE ''
               END
        ELSE @vbCrLf
             + QUOTENAME([colz].[name])
             + ' '
             + SPACE(@STRINGLEN - LEN([colz].[name]))
             + UPPER(TYPE_NAME([colz].[user_type_id]))
             + CASE
-- data types with precision and scale  IE DECIMAL(18,3), NUMERIC(10,2)
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('decimal','numeric')
               THEN '('
                    + CONVERT(VARCHAR,[colz].[precision])
                    + ','
                    + CONVERT(VARCHAR,[colz].[scale])
                    + ') '
                    + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[precision])
                    + ','
                    + CONVERT(VARCHAR,[colz].[scale])))
                    + SPACE(7)
                    + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                    + CASE
                        WHEN COLUMNPROPERTY ( @TABLE_ID , [colz].[name] , 'IsIdentity' ) = 0
                        THEN ''
                        ELSE ' IDENTITY('
                               + CONVERT(VARCHAR,ISNULL(IDENT_SEED(@TBLNAME),1) )
                               + ','
                               + CONVERT(VARCHAR,ISNULL(IDENT_INCR(@TBLNAME),1) )
                               + ')'
                        END
                    + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                    + CASE
                        WHEN [colz].[is_nullable] = 0
                        THEN ' NOT NULL'
                        ELSE '     NULL'
                      END
-- data types with scale  IE datetime2(7),TIME(7)
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('datetime2','datetimeoffset','time')
               THEN CASE
                      WHEN [colz].[scale] < 7 THEN
                      '('
                      + CONVERT(VARCHAR,[colz].[scale])
                      + ') '
                    ELSE
                      '    '
                    END
                    + SPACE(4)
                    + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                    + '        '
                    + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                    + CASE [colz].[generated_always_type]
                        WHEN 0 THEN ''
                        WHEN 1 THEN ' GENERATED ALWAYS AS ROW START'
                        WHEN 2 THEN ' GENERATED ALWAYS AS ROW END'
                        ELSE ''
                      END
                    + CASE WHEN [colz].[is_hidden] = 1 THEN ' HIDDEN' ELSE '' END
                    + CASE
                        WHEN [colz].[is_nullable] = 0
                        THEN ' NOT NULL'
                        ELSE '     NULL'
                      END
--data types with no/precision/scale,IE  FLOAT
               WHEN  TYPE_NAME([colz].[user_type_id]) IN ('float') --,'real')
               THEN
               --addition: if 53, no need to specifically say (53), otherwise display it
                    CASE
                      WHEN [colz].[precision] = 53
                      THEN SPACE(11 - LEN(CONVERT(VARCHAR,[colz].[precision])))
                           + SPACE(7)
                           + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                      ELSE '('
                           + CONVERT(VARCHAR,[colz].[precision])
                           + ') '
                           + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[precision])))
                           + SPACE(7) + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                      END
--data type with max_length		ie CHAR (44), VARCHAR(40), BINARY(5000),
--##############################################################################
-- COLLATE STATEMENTS
-- personally i do not like collation statements,
-- but included here to make it easy on those who do
--##############################################################################
               WHEN  TYPE_NAME([colz].[user_type_id]) IN ('char','varchar','binary','varbinary')
               THEN CASE
                      WHEN  [colz].[max_length] = -1
                      THEN  '(max)'
                            + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[max_length])))
                            + SPACE(7) + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                            ----collate to comment out when not desired
                            --+ CASE
                            --    WHEN COLS.collation_name IS NULL
                            --    THEN ''
                            --    ELSE ' COLLATE ' + COLS.collation_name
                            --  END
                            + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                            + CASE
                                WHEN [colz].[is_nullable] = 0
                                THEN ' NOT NULL'
                                ELSE '     NULL'
                              END
                      ELSE '('
                           + CONVERT(VARCHAR,[colz].[max_length])
                           + ') '
                           + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[max_length])))
                           + SPACE(7) + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           ----collate to comment out when not desired
                           --+ CASE
                           --     WHEN COLS.collation_name IS NULL
                           --     THEN ''
                           --     ELSE ' COLLATE ' + COLS.collation_name
                           --   END
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                    END
--data type with max_length ( BUT DOUBLED) ie NCHAR(33), NVARCHAR(40)
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('nchar','nvarchar')
               THEN CASE
                      WHEN  [colz].[max_length] = -1
                      THEN '(max)'
                           + SPACE(5 - LEN(CONVERT(VARCHAR,([colz].[max_length] / 2))))
                           + SPACE(7)
                           + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           ----collate to comment out when not desired
                           --+ CASE
                           --     WHEN COLS.collation_name IS NULL
                           --     THEN ''
                           --     ELSE ' COLLATE ' + COLS.collation_name
                           --   END
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN  ' NOT NULL'
                               ELSE '     NULL'
                             END
                      ELSE '('
                           + CONVERT(VARCHAR,([colz].[max_length] / 2))
                           + ') '
                           + SPACE(6 - LEN(CONVERT(VARCHAR,([colz].[max_length] / 2))))
                           + SPACE(7)
                           + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           ----collate to comment out when not desired
                           --+ CASE
                           --     WHEN COLS.collation_name IS NULL
                           --     THEN ''
                           --     ELSE ' COLLATE ' + COLS.collation_name
                           --   END
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                    END
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('datetime','money','text','image','real')
               THEN SPACE(18 - LEN(TYPE_NAME([colz].[user_type_id])))
                    + '              '
                    + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                    + CASE
                        WHEN [colz].[is_nullable] = 0
                        THEN ' NOT NULL'
                        ELSE '     NULL'
                      END
--  other data type 	IE INT, DATETIME, MONEY, CUSTOM DATA TYPE,...
               ELSE SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                            + CASE
                                WHEN COLUMNPROPERTY ( @TABLE_ID , [colz].[name] , 'IsIdentity' ) = 0
                                THEN '              '
                                ELSE ' IDENTITY('
                                     + CONVERT(VARCHAR,ISNULL(IDENT_SEED(@TBLNAME),1) )
                                     + ','
                                     + CONVERT(VARCHAR,ISNULL(IDENT_INCR(@TBLNAME),1) )
                                     + ')'
                              END
                            + SPACE(2)
                            + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                            + CASE
                                WHEN [colz].[is_nullable] = 0
                                THEN ' NOT NULL'
                                ELSE '     NULL'
                              END
               END
             + CASE
                 WHEN [colz].[default_object_id] = 0
                 THEN ''
                 --ELSE ' DEFAULT '  + ISNULL(def.[definition] ,'')
                 --optional section in case NAMED default constraints are needed:
                 ELSE '  CONSTRAINT ' + QUOTENAME([DEF].[name]) + ' DEFAULT ' + ISNULL([DEF].[definition] ,'')
                        --i thought it needed to be handled differently! NOT!
               END  --CASE cdefault
      END --iscomputed
    + ','
    FROM [sys].[columns] AS [colz]
      LEFT OUTER JOIN  [sys].[default_constraints]  AS [DEF]
        ON [colz].[default_object_id] = [DEF].[object_id]
      LEFT OUTER JOIN [sys].[computed_columns] AS [CALC]
         ON  [colz].[object_id] = [CALC].[object_id]
         AND [colz].[column_id] = [CALC].[column_id]
    WHERE [colz].[object_id]=@TABLE_ID
    ORDER BY [colz].[column_id];
--##############################################################################
--used for formatting the rest of the constraints:
--##############################################################################
  SELECT
    @STRINGLEN = MAX(LEN([objz].[name])) + 1
  FROM [sys].[objects] AS [objz];
--##############################################################################
--PK/Unique Constraints and Indexes, using the 2005/08 INCLUDE syntax
--##############################################################################
  DECLARE @Results  TABLE (
                    [SCHEMA_ID]             INT,
                    [SCHEMA_NAME]           VARCHAR(255),
                    [OBJECT_ID]             INT,
                    [OBJECT_NAME]           VARCHAR(255),
                    [index_id]              INT,
                    [index_name]            VARCHAR(255),
                    [ROWS]                  BIGINT,
                    [SizeMB]                DECIMAL(19,3),
                    [IndexDepth]            INT,
                    [TYPE]                  INT,
                    [type_desc]             VARCHAR(30),
                    [fill_factor]           INT,
                    [is_unique]             INT,
                    [is_primary_key]        INT ,
                    [is_unique_constraint]  INT,
                    [index_columns_key]     VARCHAR(MAX),
                    [index_columns_include] VARCHAR(MAX),
                    [has_filter] BIT ,
                    [filter_definition] VARCHAR(MAX),
                    [currentFilegroupName]  VARCHAR(128),
                    [CurrentCompression]    VARCHAR(128));
  INSERT INTO @Results
    SELECT
      [SCH].[schema_id], [SCH].[name] AS [SCHEMA_NAME],
      [objz].[object_id], [objz].[name] AS [OBJECT_NAME],
      [IDX].[index_id], ISNULL([IDX].[name], '---') AS [index_name],
      [partitions].[ROWS], [partitions].[SizeMB], INDEXPROPERTY([objz].[object_id], [IDX].[name], 'IndexDepth') AS [IndexDepth],
      [IDX].[type], [IDX].[type_desc], [IDX].[fill_factor],
      [IDX].[is_unique], [IDX].[is_primary_key], [IDX].[is_unique_constraint],
      ISNULL([Index_Columns].[index_columns_key], '---') AS [index_columns_key],
      ISNULL([Index_Columns].[index_columns_include], '---') AS [index_columns_include],
      [IDX].[has_filter],
      [IDX].[filter_definition],
      [filz].[name],
      ISNULL([p].[data_compression_desc],'')
    FROM [sys].[objects] AS [objz]
      INNER JOIN [sys].[schemas] AS [SCH] ON [objz].[schema_id]=[SCH].[schema_id]
      INNER JOIN [sys].[indexes] AS [IDX] ON [objz].[object_id]=[IDX].[object_id]
      INNER JOIN [sys].[filegroups] AS [filz] ON [IDX].[data_space_id] = [filz].[data_space_id]
      INNER JOIN [sys].[partitions] AS [p]     ON  [IDX].[object_id] =  [p].[object_id]  AND [IDX].[index_id] = [p].[index_id]
      INNER JOIN (
                  SELECT
                    [statz].[object_id], [statz].[index_id], SUM([statz].[row_count]) AS [ROWS],
                    CONVERT(NUMERIC(19,3), CONVERT(NUMERIC(19,3), SUM([statz].[in_row_reserved_page_count]+[statz].[lob_reserved_page_count]+[statz].[row_overflow_reserved_page_count]))/CONVERT(NUMERIC(19,3), 128)) AS [SizeMB]
                  FROM [sys].[dm_db_partition_stats] AS [statz]
                  GROUP BY [statz].[object_id], [statz].[index_id]
                 ) AS [partitions]
        ON  [IDX].[object_id]=[partitions].[object_id]
        AND [IDX].[index_id]=[partitions].[index_id]
    CROSS APPLY (
                 SELECT
                   LEFT([Index_Columns].[index_columns_key], LEN([Index_Columns].[index_columns_key])-1) AS [index_columns_key],
                  LEFT([Index_Columns].[index_columns_include], LEN([Index_Columns].[index_columns_include])-1) AS [index_columns_include]
                 FROM
                      (
                       SELECT
                              (
                              SELECT QUOTENAME([colz].[name]) + CASE WHEN [IXCOLS].[is_descending_key] = 0 THEN ' asc' ELSE ' desc' END + ',' + ' '
                               FROM [sys].[index_columns] AS [IXCOLS]
                                 INNER JOIN [sys].[columns] AS [colz]
                                   ON  [IXCOLS].[column_id]   = [colz].[column_id]
                                   AND [IXCOLS].[object_id] = [colz].[object_id]
                               WHERE [IXCOLS].[is_included_column] = 0
                                 AND [IDX].[object_id] = [IXCOLS].[object_id]
                                 AND [IDX].[index_id] = [IXCOLS].[index_id]
                               ORDER BY [IXCOLS].[key_ordinal]
                               FOR XML PATH('')
                              ) AS [index_columns_key],
                             (
                             SELECT QUOTENAME([colz].[name]) + ',' + ' '
                              FROM [sys].[index_columns] AS [IXCOLS]
                                INNER JOIN [sys].[columns] AS [colz]
                                  ON  [IXCOLS].[column_id]   = [colz].[column_id]
                                  AND [IXCOLS].[object_id] = [colz].[object_id]
                              WHERE [IXCOLS].[is_included_column] = 1
                                AND [IDX].[object_id] = [IXCOLS].[object_id]
                                AND [IDX].[index_id] = [IXCOLS].[index_id]
                              ORDER BY [IXCOLS].[index_column_id]
                              FOR XML PATH('')
                             ) AS [index_columns_include]
                      ) AS [Index_Columns]
                ) AS [Index_Columns]
    WHERE [SCH].[name]  LIKE CASE
                                     WHEN @SCHEMANAME = ''   COLLATE SQL_Latin1_General_CP1_CI_AS
                                     THEN [SCH].[name]
                                     ELSE @SCHEMANAME
                                   END
    AND [objz].[name] LIKE CASE
                                  WHEN @TBLNAME = ''   COLLATE SQL_Latin1_General_CP1_CI_AS
                                  THEN [objz].[name]
                                  ELSE @TBLNAME
                                END
    ORDER BY
      [SCH].[name],
      [objz].[name],
      [IDX].[name];
--@Results table has both PK,s Uniques and indexes in thme...pull them out for adding to funal results:
  SET @CONSTRAINTSQLS = '';
  SET @INDEXSQLS      = '';
  SET @TemporalStatement = '';
  SET @WithStatement = '';
  --##############################################################################
  -- Temporal tables
--##############################################################################
  SELECT @TemporalStatement =  ISNULL(@vbCrLf + 'PERIOD FOR SYSTEM_TIME ('
  + MAX(CASE WHEN [colz].[generated_always_type] = 1 THEN [colz].[name] ELSE '' END)
  +','
  + MAX(CASE WHEN [colz].[generated_always_type] = 2 THEN [colz].[name] ELSE '' END)
  +'),','') ,
  @WithStatement = ISNULL(' SYSTEM_VERSIONING = ON (HISTORY_TABLE=' + QUOTENAME(OBJECT_SCHEMA_NAME([objz].[history_table_id])) + '.' + QUOTENAME(OBJECT_NAME([objz].[history_table_id])) + '),' ,'')
  FROM [sys].[tables] [objz]
  INNER JOIN [sys].[columns] [colz]
  ON [objz].[object_id] = [colz].[object_id]
  WHERE [colz].[object_id] = @TABLE_ID
  AND [colz].[generated_always_type] > 0
  GROUP BY [colz].[object_id],[objz].[history_table_id];
  --##############################################################################
  -- External tables
  --##############################################################################
  SELECT @WithStatement = @WithStatement + CASE WHEN [etabz].[location] IS NOT NULL THEN ' LOCATION = ' + [etabz].[location] + ',' END
  + CASE WHEN [etabz].[data_source_id] IS NOT NULL THEN ' DATA_SOURCE = ' + [eds].[name] + ',' END
  + CASE WHEN [etabz].[file_format_id] IS NOT NULL THEN ' FILE_FORMAT = ' + [efs].[name] + ',' END
  + CASE WHEN [etabz].[reject_type] IS NOT NULL THEN ' REJECT_TYPE = ' + [etabz].[reject_type] + ',' END
  + CASE WHEN [etabz].[reject_value] IS NOT NULL THEN ' REJECT_VALUE = ' + [etabz].[reject_value] + ',' END
  + CASE WHEN [etabz].[reject_sample_value] IS NOT NULL THEN ' REJECT_SAMPLE_VALUE = ' + [etabz].[reject_sample_value] + ',' END
  + ' '
  FROM [sys].[external_tables] [etabz]
  LEFT JOIN [sys].[external_data_sources] [eds] ON [eds].[data_source_id] = [etabz].[data_source_id]
  LEFT JOIN [sys].[external_file_formats] [efs] ON [efs].[file_format_id] = [etabz].[file_format_id]
  WHERE [etabz].[schema_id] = SCHEMA_ID(@SCHEMANAME) AND [etabz].[name] = @TBLNAME;
--##############################################################################
-- memory optimized
--##############################################################################
SELECT @WithStatement  = @WithStatement + ISNULL('MEMORY_OPTIMIZED=ON, DURABILITY=' + [objz].[durability_desc] + ',','')
FROM [sys].[tables] [objz]
WHERE [objz].[is_memory_optimized] =1
AND [objz].[object_id] = @TABLE_ID
--##############################################################################
--constraints
--column store indexes are different: the "include" columns for normal indexes as scripted above are the columnstores indexed columns
--add a CASE for that situation.
--##############################################################################
  SELECT @CONSTRAINTSQLS = @CONSTRAINTSQLS
         + CASE
             WHEN [is_primary_key] = 1 OR [is_unique] = 1
             THEN @vbCrLf
                  + 'CONSTRAINT   '  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME([index_name]) + ' '
                  + CASE
                      WHEN [is_primary_key] = 1
                      THEN ' PRIMARY KEY '
                      ELSE CASE
                             WHEN [is_unique] = 1
                             THEN ' UNIQUE      '
                             ELSE ''
                           END
                    END
                  + [type_desc]
                  + CASE
                      WHEN [type_desc]='NONCLUSTERED'
                      THEN ''
                      ELSE '   '
                    END
                  + ' (' + [index_columns_key] + ')'
                  + CASE
                      WHEN [index_columns_include] <> '---'
                      THEN ' INCLUDE (' + [index_columns_include] + ')'
                      ELSE ''
                    END
                  + CASE
                      WHEN [has_filter] = 1
                      THEN ' ' + [filter_definition]
                      ELSE ' '
                    END
                  + CASE WHEN [fill_factor] <> 0 OR [CurrentCompression] <> 'NONE'
                  THEN ' WITH (' + CASE
                                    WHEN [fill_factor] <> 0
                                    THEN 'FILLFACTOR = ' + CONVERT(VARCHAR(30),[fill_factor])
                                    ELSE ''
                                  END
                                + CASE
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression] <> 'NONE' THEN ',DATA_COMPRESSION = ' + [CurrentCompression] + ' '
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression]  = 'NONE' THEN ''
                                    WHEN [fill_factor]  = 0  AND [CurrentCompression] <> 'NONE' THEN 'DATA_COMPRESSION = ' + [CurrentCompression] + ' '
                                    ELSE ''
                                  END
                                  + ')'
                  ELSE ''
                  END
             ELSE ''
           END + ','
  FROM @Results
  WHERE [type_desc] != 'HEAP'
    AND [is_primary_key] = 1
    OR  [is_unique] = 1
  ORDER BY
    [is_primary_key] DESC,
    [is_unique] DESC;
    --
--##############################################################################
--indexes
--##############################################################################
  SELECT @INDEXSQLS = @INDEXSQLS
         + CASE
             WHEN [is_primary_key] = 0 OR [is_unique] = 0
             THEN @vbCrLf
                  + 'CREATE '  COLLATE SQL_Latin1_General_CP1_CI_AS + [type_desc] + ' INDEX '  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME([index_name]) + ' '
                  + @vbCrLf
                  + '   ON '   COLLATE SQL_Latin1_General_CP1_CI_AS
                  + QUOTENAME([SCHEMA_NAME]) + '.' + QUOTENAME([OBJECT_NAME])
                  + CASE
                        WHEN [CurrentCompression] = 'COLUMNSTORE'  COLLATE SQL_Latin1_General_CP1_CI_AS
                        THEN ' (' + [index_columns_include] + ')'
                        ELSE ' (' + [index_columns_key] + ')'
                    END
                  + CASE
                      WHEN [CurrentCompression] = 'COLUMNSTORE'  COLLATE SQL_Latin1_General_CP1_CI_AS
                      THEN ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                      ELSE
                        CASE
                     WHEN [index_columns_include] <> '---'
                     THEN @vbCrLf + '   INCLUDE ('  COLLATE SQL_Latin1_General_CP1_CI_AS + [index_columns_include] + ')'   COLLATE SQL_Latin1_General_CP1_CI_AS
                     ELSE ''   COLLATE SQL_Latin1_General_CP1_CI_AS
                   END
                    END
                  --2008 filtered indexes syntax
                  + CASE
                      WHEN [has_filter] = 1
                      THEN @vbCrLf + '   WHERE '  COLLATE SQL_Latin1_General_CP1_CI_AS + [filter_definition]
                      ELSE ''
                    END
                  + CASE WHEN [fill_factor] <> 0 OR [CurrentCompression] <> 'NONE'  COLLATE SQL_Latin1_General_CP1_CI_AS
                  THEN ' WITH ('  COLLATE SQL_Latin1_General_CP1_CI_AS + CASE
                                    WHEN [fill_factor] <> 0
                                    THEN 'FILLFACTOR = '  COLLATE SQL_Latin1_General_CP1_CI_AS + CONVERT(VARCHAR(30),[fill_factor])
                                    ELSE ''
                                  END
                                + CASE
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression] <> 'NONE' THEN ',DATA_COMPRESSION = ' + [CurrentCompression]+' '
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression]  = 'NONE' THEN ''
                                    WHEN [fill_factor]  = 0  AND [CurrentCompression] <> 'NONE' THEN 'DATA_COMPRESSION = ' + [CurrentCompression]+' '
                                    ELSE ''
                                  END
                                  + ')'
                  ELSE ''
                  END
                   + @vbCrLf + 'GO' + @vbCrLf
           END
  FROM @Results
  WHERE [type_desc] != 'HEAP'
    AND [is_primary_key] = 0
    AND [is_unique] = 0
  ORDER BY
    [is_primary_key] DESC,
    [is_unique] DESC;
  IF @INDEXSQLS <> ''  COLLATE SQL_Latin1_General_CP1_CI_AS
    SET @INDEXSQLS = @vbCrLf + 'GO'  COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + @INDEXSQLS;
--##############################################################################
--CHECK Constraints
--##############################################################################
  SET @CHECKCONSTSQLS = ''  COLLATE SQL_Latin1_General_CP1_CI_AS;
  SELECT
    @CHECKCONSTSQLS = @CHECKCONSTSQLS
    + @vbCrLf
    + ISNULL('CONSTRAINT   ' + QUOTENAME([objz].[name]) + ' '
    + SPACE(@STRINGLEN - LEN([objz].[name]))
    + ' CHECK ' + ISNULL([CHECKS].[definition],'')
    + ',','')
  FROM [sys].[objects] AS [objz]
    INNER JOIN [sys].[check_constraints] AS [CHECKS] ON [objz].[object_id] = [CHECKS].[object_id]
  WHERE [objz].[type] = 'C'
    AND [objz].[parent_object_id] = @TABLE_ID;
--##############################################################################
--FOREIGN KEYS
--##############################################################################
  SET @FKSQLS = '' ;
    SELECT
    @FKSQLS=@FKSQLS
    + @vbCrLf + [MyAlias].[Command] FROM
(
SELECT
  DISTINCT
  --FK must be added AFTER the PK/unique constraints are added back.
  850 AS [ExecutionOrder],
  'CONSTRAINT '
  + QUOTENAME([conz].[name])
  + ' FOREIGN KEY ('
  + [ChildCollection].[ChildColumns]
  + ') REFERENCES '
  + QUOTENAME(SCHEMA_NAME([conz].[schema_id]))
  + '.'
  + QUOTENAME(OBJECT_NAME([conz].[referenced_object_id]))
  + ' (' + [ParentCollection].[ParentColumns]
  + ') '
  +  CASE [conz].[update_referential_action]
                                        WHEN 0 THEN '' --' ON UPDATE NO ACTION '
                                        WHEN 1 THEN ' ON UPDATE CASCADE '
                                        WHEN 2 THEN ' ON UPDATE SET NULL '
                                        ELSE ' ON UPDATE SET DEFAULT '
                                    END
                  + CASE [conz].[delete_referential_action]
                                        WHEN 0 THEN '' --' ON DELETE NO ACTION '
                                        WHEN 1 THEN ' ON DELETE CASCADE '
                                        WHEN 2 THEN ' ON DELETE SET NULL '
                                        ELSE ' ON DELETE SET DEFAULT '
                                    END
                  + CASE [conz].[is_not_for_replication]
                        WHEN 1 THEN ' NOT FOR REPLICATION '
                        ELSE ''
                    END
  + ',' AS [Command]
FROM   [sys].[foreign_keys] AS [conz]
       INNER JOIN [sys].[foreign_key_columns] AS [colz]
         ON [conz].[object_id] = [colz].[constraint_object_id]
       INNER JOIN (--gets my child tables column names
SELECT
 [conz].[name],
 --technically, FK's can contain up to 16 columns, but real life is often a single column. coding here is for all columns
 [ChildColumns] = STUFF((SELECT
                         ',' + QUOTENAME([REFZ].[name])
                       FROM   [sys].[foreign_key_columns] AS [fkcolz]
                              INNER JOIN [sys].[columns] AS [REFZ]
                                ON [fkcolz].[parent_object_id] = [REFZ].[object_id]
                                   AND [fkcolz].[parent_column_id] = [REFZ].[column_id]
                       WHERE [fkcolz].[parent_object_id] = [conz].[parent_object_id]
                           AND [fkcolz].[constraint_object_id] = [conz].[object_id]
                         ORDER  BY
                        [fkcolz].[constraint_column_id]
                      FOR XML PATH(''), TYPE).[value]('.','varchar(max)'),1,1,'')
FROM   [sys].[foreign_keys] AS [conz]
      INNER JOIN [sys].[foreign_key_columns] AS [colz]
        ON [conz].[object_id] = [colz].[constraint_object_id]
        WHERE [conz].[parent_object_id]= @TABLE_ID
GROUP  BY
[conz].[name],
[conz].[parent_object_id],--- without GROUP BY multiple rows are returned
 [conz].[object_id]
    ) AS [ChildCollection]
         ON [conz].[name] = [ChildCollection].[name]
       INNER JOIN (--gets the parent tables column names for the FK reference
                  SELECT
                     [conz].[name],
                     [ParentColumns] = STUFF((SELECT
                                              ',' + [REFZ].[name]
                                            FROM   [sys].[foreign_key_columns] AS [fkcolz]
                                                   INNER JOIN [sys].[columns] AS [REFZ]
                                                     ON [fkcolz].[referenced_object_id] = [REFZ].[object_id]
                                                        AND [fkcolz].[referenced_column_id] = [REFZ].[column_id]
                                            WHERE  [fkcolz].[referenced_object_id] = [conz].[referenced_object_id]
                                              AND [fkcolz].[constraint_object_id] = [conz].[object_id]
                                            ORDER BY [fkcolz].[constraint_column_id]
                                            FOR XML PATH(''), TYPE).[value]('.','varchar(max)'),1,1,'')
                   FROM   [sys].[foreign_keys] AS [conz]
                          INNER JOIN [sys].[foreign_key_columns] AS [colz]
                            ON [conz].[object_id] = [colz].[constraint_object_id]
                           -- AND colz.parent_column_id
                   GROUP  BY
                    [conz].[name],
                    [conz].[referenced_object_id],--- without GROUP BY multiple rows are returned
                    [conz].[object_id]
                  ) AS [ParentCollection]
         ON [conz].[name] = [ParentCollection].[name]
)AS [MyAlias];
--##############################################################################
--RULES
--##############################################################################
  SET @RULESCONSTSQLS = '';
  SELECT
    @RULESCONSTSQLS = @RULESCONSTSQLS
    + ISNULL(
             @vbCrLf
             + 'if not exists(SELECT [name] FROM sys.objects WHERE TYPE=''R'' AND schema_id = ' COLLATE SQL_Latin1_General_CP1_CI_AS + CONVERT(VARCHAR(30),[objz].[schema_id]) + ' AND [name] = '''  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME(OBJECT_NAME([colz].[rule_object_id])) + ''')'  COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf
             + [MODS].[definition]  + @vbCrLf + 'GO' COLLATE SQL_Latin1_General_CP1_CI_AS +  @vbCrLf
             + 'EXEC sp_binderule  ' + QUOTENAME([objz].[name]) + ', ''' + QUOTENAME(OBJECT_NAME([colz].[object_id])) + '.' + QUOTENAME([colz].[name]) + ''''  COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + 'GO'  COLLATE SQL_Latin1_General_CP1_CI_AS ,'')
  FROM [sys].[columns] [colz]
    INNER JOIN [sys].[objects] [objz]
      ON [objz].[object_id] = [colz].[object_id]
    INNER JOIN [sys].[sql_modules] AS [MODS]
      ON [colz].[rule_object_id] = [MODS].[object_id]
  WHERE [colz].[rule_object_id] <> 0
    AND [colz].[object_id] = @TABLE_ID;
--##############################################################################
--TRIGGERS
--##############################################################################
  SET @TRIGGERSTATEMENT = '';
  SELECT
    @TRIGGERSTATEMENT = @TRIGGERSTATEMENT +  @vbCrLf + [MODS].[definition] + @vbCrLf + 'GO'
  FROM [sys].[sql_modules] AS [MODS]
  WHERE [MODS].[object_id] IN(SELECT
                         [objz].[object_id]
                       FROM [sys].[objects] AS [objz]
                       WHERE [objz].[type] = 'TR'
                       AND [objz].[parent_object_id] = @TABLE_ID);
  IF @TRIGGERSTATEMENT <> ''  COLLATE SQL_Latin1_General_CP1_CI_AS
    SET @TRIGGERSTATEMENT = @vbCrLf + 'GO'  COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + @TRIGGERSTATEMENT;
--##############################################################################
--NEW SECTION QUERY ALL EXTENDED PROPERTIES
--##############################################################################
  SET @EXTENDEDPROPERTIES = '';
  SELECT  @EXTENDEDPROPERTIES =
          @EXTENDEDPROPERTIES + @vbCrLf +
         'EXEC sys.sp_addextendedproperty
          @name = N'''  COLLATE SQL_Latin1_General_CP1_CI_AS + [name] + ''', @value = N'''  COLLATE SQL_Latin1_General_CP1_CI_AS + REPLACE(CONVERT(VARCHAR(MAX),[value]),'''','''''') + ''',
          @level0type = N''SCHEMA'', @level0name = '  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME(@SCHEMANAME) + ',
          @level1type = N''TABLE'', @level1name = '  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME(@TBLNAME) + ';'
 --SELECT objtype, objname, name, value
  FROM [sys].[fn_listextendedproperty] (NULL, 'schema', @SCHEMANAME, 'table', @TBLNAME, NULL, NULL);
  --OMacoder suggestion for column extended properties http://www.sqlservercentral.com/Forums/FindPost1651606.aspx
   ;WITH [obj] AS (
	SELECT [split].[a].[value]('.', 'VARCHAR(20)') AS [name]
	FROM (
		SELECT CAST ('<M>' + REPLACE('column,constraint,index,trigger,parameter', ',', '</M><M>') + '</M>' AS XML) AS [data]
		) AS [A]
		CROSS APPLY [data].[nodes] ('/M') AS [split]([a])
	)
  SELECT
  @EXTENDEDPROPERTIES =
		 @EXTENDEDPROPERTIES + @vbCrLf + @vbCrLf +
         'EXEC sys.sp_addextendedproperty
         @name = N''' COLLATE SQL_Latin1_General_CP1_CI_AS
         + [lep].[name]
         + ''', @value = N''' COLLATE SQL_Latin1_General_CP1_CI_AS
         + REPLACE(CONVERT(VARCHAR(MAX),[lep].[value]),'''','''''') + ''',
         @level0type = N''SCHEMA'', @level0name = ' COLLATE SQL_Latin1_General_CP1_CI_AS
         + QUOTENAME(@SCHEMANAME)
         + ',
         @level1type = N''TABLE'', @level1name = ' COLLATE SQL_Latin1_General_CP1_CI_AS
         + QUOTENAME(@TBLNAME)
         + ',
         @level2type = N''' COLLATE SQL_Latin1_General_CP1_CI_AS
         + UPPER([obj].[name])
         + ''', @level2name = ' COLLATE SQL_Latin1_General_CP1_CI_AS
         + QUOTENAME([lep].[objname]) + ';' COLLATE SQL_Latin1_General_CP1_CI_AS
  --SELECT objtype, objname, name, value
  FROM [obj]
	CROSS APPLY [sys].[fn_listextendedproperty] (NULL, 'schema', @SCHEMANAME, 'table', @TBLNAME, [obj].[name], NULL) AS [lep];
  IF @EXTENDEDPROPERTIES <> '' COLLATE SQL_Latin1_General_CP1_CI_AS
    SET @EXTENDEDPROPERTIES = @vbCrLf + 'GO' COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + @EXTENDEDPROPERTIES;
--##############################################################################
--FINAL CLEANUP AND PRESENTATION
--##############################################################################
--at this point, there is a trailing comma, or it blank
--WITH statment has a trailing comma
IF @WithStatement > ''
  SET @WithStatement='WITH (' + SUBSTRING(@WithStatement,1,LEN(@WithStatement) -1)  + ')'
  SELECT
    @FINALSQL = @FINALSQL
                + @TemporalStatement
                + @CONSTRAINTSQLS
                + @CHECKCONSTSQLS
                + @FKSQLS;
--note that this trims the trailing comma from the end of the statements
  SET @FINALSQL = SUBSTRING(@FINALSQL,1,LEN(@FINALSQL) -1) ;
  SET @FINALSQL = @FINALSQL + ')' COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + @WithStatement + @vbCrLf + 'GO' + @vbCrLf COLLATE SQL_Latin1_General_CP1_CI_AS +  @vbCrLf ;
  SET @input = @vbCrLf
       + @FINALSQL
       + @INDEXSQLS
       + @RULESCONSTSQLS
       + @TRIGGERSTATEMENT
       + @EXTENDEDPROPERTIES
  --ten years worth of days from todays date:
   ;WITH [E01]([N]) AS (SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1), --         10 or 10E01 rows
         [E02]([N]) AS (SELECT 1 FROM [E01] AS [a], [E01] AS [b]),  --        100 or 10E02 rows
         [E04]([N]) AS (SELECT 1 FROM [E02] AS [a], [E02] AS [b]),  --     10,000 or 10E04 rows
         [E08]([N]) AS (SELECT 1 FROM [E04] AS [a], [E04] AS [b]),  --100,000,000 or 10E08 rows
         --E16(N) AS (SELECT 1 FROM E08 a, E08 b),  --10E16 or more rows than you'll EVER need,
         [Tally]([N]) AS (SELECT ROW_NUMBER() OVER (ORDER BY [E08].[N]) FROM [E08]),
       [ItemSplit](
                 [ItemOrder],
                 [Item]
                ) AS (
                      SELECT [Tally].[N],
                        SUBSTRING(@vbCrLf + @input + @vbCrLf,[Tally].[N] + DATALENGTH(@vbCrLf),CHARINDEX(@vbCrLf,@vbCrLf + @input + @vbCrLf,[Tally].[N] + DATALENGTH(@vbCrLf)) - [Tally].[N] - DATALENGTH(@vbCrLf))
                      FROM [Tally]
                      WHERE [Tally].[N] < DATALENGTH(@vbCrLf + @input)
                      --WHERE N < DATALENGTH(@vbCrLf + @input) -- REMOVED added @vbCrLf
                        AND SUBSTRING(@vbCrLf + @input + @vbCrLf,[Tally].[N],DATALENGTH(@vbCrLf)) = @vbCrLf --Notice how we find the delimiter
                     )
  SELECT
    --row_number() over (order by ItemOrder) as ItemID,
    [ItemSplit].[Item]
  FROM [ItemSplit];
  RETURN;
--##############################################################################
-- END Normal Table Processing
--##############################################################################
--simple, primitive version to get the results of a TEMP table from the TEMP db.
--##############################################################################
-- NEW Temp Table Logic
--##############################################################################
TEMPPROCESS:
  SELECT @TABLE_ID = OBJECT_ID('tempdb..' COLLATE SQL_Latin1_General_CP1_CI_AS + @TBLNAME);
--##############################################################################
-- Valid temp Table, Continue Processing
--##############################################################################
SELECT @FINALSQL =
     CASE
       WHEN [tabz].[history_table_id] IS NULL
       THEN ''
       ELSE 'ALTER TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id]) ) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ' SET (SYSTEM_VERSIONING = OFF);' + @vbCrLf
            +  'IF OBJECT_ID(''' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[history_table_id]) ) + '.' + QUOTENAME(OBJECT_NAME([tabz].[history_table_id])) + ''') IS NOT NULL ' + @vbCrLf
              + 'DROP TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[history_table_id])) + '.' + QUOTENAME(OBJECT_NAME([tabz].[history_table_id])) + ' ' + @vbCrLf + 'GO' + @vbCrLf
       END
    + 'IF OBJECT_ID(''' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id]) ) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ''') IS NOT NULL ' + @vbCrLf
              + 'DROP TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id])) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ' ' + @vbCrLf + 'GO' + @vbCrLf
              + 'CREATE TABLE ' + QUOTENAME(OBJECT_SCHEMA_NAME([tabz].[object_id])) + '.' + QUOTENAME(OBJECT_NAME([tabz].[object_id])) + ' ( '
FROM [sys].[tables] [tabz] WHERE [tabz].[object_id] = OBJECT_ID(@TABLE_ID)
  --removed invalid code here which potentially selected wrong table--thansk David Grifiths @SSC!
  SELECT
    @STRINGLEN = MAX(LEN([colz].[name])) + 1
  FROM [tempdb].[sys].[objects] AS [objz]
    INNER JOIN [tempdb].[sys].[columns] AS [colz]
      ON  [objz].[object_id] = [colz].[object_id]
      AND [objz].[object_id] = @TABLE_ID;
--##############################################################################
--Get the hash index definitions for memory optimized tables, if any.
--##############################################################################
--##############################################################################
--Get the columns, their definitions and defaults.
--##############################################################################
  SELECT
    @FINALSQL = @FINALSQL
    + CASE
        WHEN [colz].[is_computed] = 1
        THEN @vbCrLf
             + QUOTENAME([colz].[name])
             + ' '
             + SPACE(@STRINGLEN - LEN([colz].[name]))
             + 'AS ' + ISNULL([CALC].[definition],'')
              + CASE
                 WHEN [CALC].[is_persisted] = 1
                 THEN ' PERSISTED'
                 ELSE ''
               END
        ELSE @vbCrLf
             + QUOTENAME([colz].[name])
             + ' '
             + SPACE(@STRINGLEN - LEN([colz].[name]))
             + UPPER(TYPE_NAME([colz].[user_type_id]))
             + CASE
-- data types with precision and scale  IE DECIMAL(18,3), NUMERIC(10,2)
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('decimal','numeric')
               THEN '('
                    + CONVERT(VARCHAR,[colz].[precision])
                    + ','
                    + CONVERT(VARCHAR,[colz].[scale])
                    + ') '
                    + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[precision])
                    + ','
                    + CONVERT(VARCHAR,[colz].[scale])))
                    + SPACE(7)
                    + SPACE(16 - LEN(TYPE_NAME([colz].[user_type_id])))
                    + CASE
                        WHEN [colz].[is_identity] = 1
                        THEN ' IDENTITY(1,1)'
                        ELSE ''
                        ----WHEN COLUMNPROPERTY ( @TABLE_ID , COLS.[name] , 'IsIdentity' ) = 1
                        ----THEN ' IDENTITY('
                        ----       + CONVERT(VARCHAR,ISNULL(IDENT_SEED('tempdb..' + @TBLNAME),1) )
                        ----       + ','
                        ----       + CONVERT(VARCHAR,ISNULL(IDENT_INCR('tempdb..' + @TBLNAME),1) )
                        ----       + ')'
                        ----ELSE ''
                        END
                    + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                    + CASE
                        WHEN [colz].[is_nullable] = 0
                        THEN ' NOT NULL'
                        ELSE '     NULL'
                      END
-- data types with scale  IE datetime2(7),TIME(7)
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('datetime2','datetimeoffset','time')
               THEN CASE
                      WHEN [colz].[scale] < 7 THEN
                      '('
                      + CONVERT(VARCHAR,[colz].[scale])
                      + ') '
                    ELSE
                      '    '
                    END
                    + SPACE(4)
                    + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                    + '        '
                    + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                    + CASE [colz].[generated_always_type]
                        WHEN 0 THEN ''
                        WHEN 1 THEN ' GENERATED ALWAYS AS ROW START'
                        WHEN 2 THEN ' GENERATED ALWAYS AS ROW END'
                        ELSE ''
                      END
                    + CASE WHEN [colz].[is_hidden] = 1 THEN ' HIDDEN' ELSE '' END
                    + CASE
                        WHEN [colz].[is_nullable] = 0
                        THEN ' NOT NULL'
                        ELSE '     NULL'
                      END
--data types with no/precision/scale,IE  FLOAT
               WHEN  TYPE_NAME([colz].[user_type_id]) IN ('float') --,'real')
               THEN
               --addition: if 53, no need to specifically say (53), otherwise display it
                    CASE
                      WHEN [colz].[precision] = 53
                      THEN SPACE(11 - LEN(CONVERT(VARCHAR,[colz].[precision])))
                           + SPACE(7)
                           + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                      ELSE '('
                           + CONVERT(VARCHAR,[colz].[precision])
                           + ') '
                           + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[precision])))
                           + SPACE(7) + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                      END
--ie VARCHAR(40)
--##############################################################################
-- COLLATE STATEMENTS in tempdb!
-- personally i do not like collation statements,
-- but included here to make it easy on those who do
--##############################################################################
               WHEN  TYPE_NAME([colz].[user_type_id]) IN ('char','varchar','binary','varbinary')
               THEN CASE
                      WHEN  [colz].[max_length] = -1
                      THEN  '(max)'
                            + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[max_length])))
                            + SPACE(7) + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                            ----collate to comment out when not desired
                            --+ CASE
                            --    WHEN COLS.collation_name IS NULL
                            --    THEN ''
                            --    ELSE ' COLLATE ' + COLS.collation_name
                            --  END
                            + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                            + CASE
                                WHEN [colz].[is_nullable] = 0
                                THEN ' NOT NULL'
                                ELSE '     NULL'
                              END
                      ELSE '('
                           + CONVERT(VARCHAR,[colz].[max_length])
                           + ') '
                           + SPACE(6 - LEN(CONVERT(VARCHAR,[colz].[max_length])))
                           + SPACE(7) + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           ----collate to comment out when not desired
                           --+ CASE
                           --     WHEN COLS.collation_name IS NULL
                           --     THEN ''
                           --     ELSE ' COLLATE ' + COLS.collation_name
                           --   END
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                    END
--data type with max_length ( BUT DOUBLED) ie NCHAR(33), NVARCHAR(40)
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('nchar','nvarchar')
               THEN CASE
                      WHEN  [colz].[max_length] = -1
                      THEN '(max)'
                           + SPACE(5 - LEN(CONVERT(VARCHAR,([colz].[max_length] / 2))))
                           + SPACE(7)
                           + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           -- --collate to comment out when not desired
                           --+ CASE
                           --     WHEN COLS.collation_name IS NULL
                           --     THEN ''
                           --     ELSE ' COLLATE ' + COLS.collation_name
                           --   END
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN  ' NOT NULL'
                               ELSE '     NULL'
                             END
                      ELSE '('
                           + CONVERT(VARCHAR,([colz].[max_length] / 2))
                           + ') '
                           + SPACE(6 - LEN(CONVERT(VARCHAR,([colz].[max_length] / 2))))
                           + SPACE(7)
                           + SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                           -- --collate to comment out when not desired
                           --+ CASE
                           --     WHEN COLS.collation_name IS NULL
                           --     THEN ''
                           --     ELSE ' COLLATE ' + COLS.collation_name
                           --   END
                           + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                           + CASE
                               WHEN [colz].[is_nullable] = 0
                               THEN ' NOT NULL'
                               ELSE '     NULL'
                             END
                    END
--  other data type 	IE INT, DATETIME, MONEY, CUSTOM DATA TYPE,...
               WHEN TYPE_NAME([colz].[user_type_id]) IN ('datetime','money','text','image','real')
               THEN SPACE(18 - LEN(TYPE_NAME([colz].[user_type_id])))
                    + '              '
                    + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                    + CASE
                        WHEN [colz].[is_nullable] = 0
                        THEN ' NOT NULL'
                        ELSE '     NULL'
                      END
--IE INT
               ELSE SPACE(@ObjectDataTypeLen - LEN(TYPE_NAME([colz].[user_type_id])))
                            + CASE
                                WHEN [colz].[is_identity] = 1
                                THEN ' IDENTITY(1,1)'
                                ELSE '              '
                                ----WHEN COLUMNPROPERTY ( @TABLE_ID , COLS.[name] , 'IsIdentity' ) = 1
                                ----THEN ' IDENTITY('
                                ----     + CONVERT(VARCHAR,ISNULL(IDENT_SEED('tempdb..' + @TBLNAME),1) )
                                ----     + ','
                                ----     + CONVERT(VARCHAR,ISNULL(IDENT_INCR('tempdb..' + @TBLNAME),1) )
                                ----     + ')'
                                ----ELSE '              '
                              END
                            + SPACE(2)
                            + CASE  WHEN [colz].[is_sparse] = 1 THEN ' sparse' ELSE '       ' END
                            + CASE
                                WHEN [colz].[is_nullable] = 0
                                THEN ' NOT NULL'
                                ELSE '     NULL'
                              END
               END
             + CASE
                 WHEN [colz].[default_object_id] = 0
                 THEN ''
                 ELSE ' DEFAULT '  + ISNULL([DEF].[definition] ,'')
                 --optional section in case NAMED default cosntraints are needed:
                 --ELSE ' CONSTRAINT [' + DEF.name + '] DEFAULT '+ REPLACE(REPLACE(ISNULL(DEF.[definition] ,''),'((','('),'))',')')
                        --i thought it needed to be handled differently! NOT!
               END  --CASE cdefault
      END --iscomputed
    + ','
    FROM [tempdb].[sys].[columns] AS [colz]
      LEFT OUTER JOIN  [tempdb].[sys].[default_constraints]  AS [DEF]
        ON [colz].[default_object_id] = [DEF].[object_id]
      LEFT OUTER JOIN [tempdb].[sys].[computed_columns] AS [CALC]
         ON  [colz].[object_id] = [CALC].[object_id]
         AND [colz].[column_id] = [CALC].[column_id]
    WHERE [colz].[object_id]=@TABLE_ID
    ORDER BY [colz].[column_id];
--##############################################################################
--used for formatting the rest of the constraints:
--##############################################################################
  SELECT
    @STRINGLEN = MAX(LEN([objz].[name])) + 1
  FROM [tempdb].[sys].[objects] AS [objz];
--##############################################################################
--PK/Unique Constraints and Indexes, using the 2005/08 INCLUDE syntax
--##############################################################################
  DECLARE @Results2  TABLE (
                    [SCHEMA_ID]             INT,
                    [SCHEMA_NAME]           VARCHAR(255),
                    [OBJECT_ID]             INT,
                    [OBJECT_NAME]           VARCHAR(255),
                    [index_id]              INT,
                    [index_name]            VARCHAR(255),
                    [ROWS]                  BIGINT,
                    [SizeMB]                DECIMAL(19,3),
                    [IndexDepth]            INT,
                    [TYPE]                  INT,
                    [type_desc]             VARCHAR(30),
                    [fill_factor]           INT,
                    [is_unique]             INT,
                    [is_primary_key]        INT ,
                    [is_unique_constraint]  INT,
                    [index_columns_key]     VARCHAR(MAX),
                    [index_columns_include] VARCHAR(MAX),
                    [has_filter] BIT ,
                    [filter_definition] VARCHAR(MAX),
                    [currentFilegroupName]  VARCHAR(128),
                    [CurrentCompression]    VARCHAR(128));
  INSERT INTO @Results2
    SELECT
      [SCH].[schema_id], [SCH].[name] AS [SCHEMA_NAME],
      [objz].[object_id], [objz].[name] AS [OBJECT_NAME],
      [IDX].[index_id], ISNULL([IDX].[name], '---') AS [index_name],
      [partitions].[ROWS], [partitions].[SizeMB], INDEXPROPERTY([objz].[object_id], [IDX].[name], 'IndexDepth') AS [IndexDepth],
      [IDX].[type], [IDX].[type_desc], [IDX].[fill_factor],
      [IDX].[is_unique], [IDX].[is_primary_key], [IDX].[is_unique_constraint],
      ISNULL([Index_Columns].[index_columns_key], '---') AS [index_columns_key],
      ISNULL([Index_Columns].[index_columns_include], '---') AS [index_columns_include],
      [IDX].[has_filter],
      [IDX].[filter_definition],
      [filz].[name],
      ISNULL([p].[data_compression_desc],'')
    FROM [tempdb].[sys].[objects] AS [objz]
      INNER JOIN [tempdb].[sys].[schemas] AS [SCH] ON [objz].[schema_id]=[SCH].[schema_id]
      INNER JOIN [tempdb].[sys].[indexes] AS [IDX] ON [objz].[object_id]=[IDX].[object_id]
      INNER JOIN [sys].[filegroups] AS [filz] ON [IDX].[data_space_id] = [filz].[data_space_id]
      INNER JOIN [sys].[partitions] AS [p]     ON  [IDX].[object_id] =  [p].[object_id]  AND [IDX].[index_id] = [p].[index_id]
      INNER JOIN (
                  SELECT
                    [statz].[object_id], [statz].[index_id], SUM([statz].[row_count]) AS [ROWS],
                    CONVERT(NUMERIC(19,3), CONVERT(NUMERIC(19,3), SUM([statz].[in_row_reserved_page_count]+[statz].[lob_reserved_page_count]+[statz].[row_overflow_reserved_page_count]))/CONVERT(NUMERIC(19,3), 128)) AS [SizeMB]
                  FROM [tempdb].[sys].[dm_db_partition_stats] AS [statz]
                  GROUP BY [statz].[object_id], [statz].[index_id]
                 ) AS [partitions]
        ON  [IDX].[object_id]=[partitions].[object_id]
        AND [IDX].[index_id]=[partitions].[index_id]
    CROSS APPLY (
                 SELECT
                   LEFT([Index_Columns].[index_columns_key], LEN([Index_Columns].[index_columns_key])-1) AS [index_columns_key],
                  LEFT([Index_Columns].[index_columns_include], LEN([Index_Columns].[index_columns_include])-1) AS [index_columns_include]
                 FROM
                      (
                       SELECT
                              (
                              SELECT QUOTENAME([colz].[name]) + CASE WHEN [IXCOLS].[is_descending_key] = 0 THEN ' asc' ELSE ' desc' END + ',' + ' '
                               FROM [tempdb].[sys].[index_columns] AS [IXCOLS]
                                 INNER JOIN [tempdb].[sys].[columns] AS [colz]
                                   ON  [IXCOLS].[column_id]   = [colz].[column_id]
                                   AND [IXCOLS].[object_id] = [colz].[object_id]
                               WHERE [IXCOLS].[is_included_column] = 0
                                 AND [IDX].[object_id] = [IXCOLS].[object_id]
                                 AND [IDX].[index_id] = [IXCOLS].[index_id]
                               ORDER BY [IXCOLS].[key_ordinal]
                               FOR XML PATH('')
                              ) AS [index_columns_key],
                             (
                             SELECT QUOTENAME([colz].[name]) + ',' + ' '
                              FROM [tempdb].[sys].[index_columns] AS [IXCOLS]
                                INNER JOIN [tempdb].[sys].[columns] AS [colz]
                                  ON  [IXCOLS].[column_id]   = [colz].[column_id]
                                  AND [IXCOLS].[object_id] = [colz].[object_id]
                              WHERE [IXCOLS].[is_included_column] = 1
                                AND [IDX].[object_id] = [IXCOLS].[object_id]
                                AND [IDX].[index_id] = [IXCOLS].[index_id]
                              ORDER BY [IXCOLS].[index_column_id]
                              FOR XML PATH('')
                             ) AS [index_columns_include]
                      ) AS [Index_Columns]
                ) AS [Index_Columns]
    WHERE [SCH].[name]  LIKE CASE
                                     WHEN @SCHEMANAME = '' COLLATE SQL_Latin1_General_CP1_CI_AS
                                     THEN [SCH].[name]
                                     ELSE @SCHEMANAME
                                   END
    AND [objz].[name] LIKE CASE
                                  WHEN @TBLNAME = ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                                  THEN [objz].[name]
                                  ELSE @TBLNAME
                                END
    ORDER BY
      [SCH].[name],
      [objz].[name],
      [IDX].[name];
--@Results2 table has both PK,s Uniques and indexes in thme...pull them out for adding to funal results:
  SET @CONSTRAINTSQLS = '' COLLATE SQL_Latin1_General_CP1_CI_AS;
  SET @INDEXSQLS      = '' COLLATE SQL_Latin1_General_CP1_CI_AS;
--##############################################################################
--constraints
--##############################################################################
  SELECT @CONSTRAINTSQLS = @CONSTRAINTSQLS
         + CASE
             WHEN [is_primary_key] = 1 OR [is_unique] = 1
             THEN @vbCrLf
                  + 'CONSTRAINT   '  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME([index_name]) + ' '
                  + SPACE(@STRINGLEN - LEN([index_name]))
                  + CASE
                      WHEN [is_primary_key] = 1
                      THEN ' PRIMARY KEY '  COLLATE SQL_Latin1_General_CP1_CI_AS
                      ELSE CASE
                             WHEN [is_unique] = 1
                             THEN ' UNIQUE      '     COLLATE SQL_Latin1_General_CP1_CI_AS
                             ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                           END
                    END
                  + [type_desc]
                  + CASE
                      WHEN [type_desc]='NONCLUSTERED'
                      THEN ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                      ELSE '   '
                    END
                  + ' (' + [index_columns_key] + ')'
                  + CASE
                      WHEN [index_columns_include] <> '---'
                      THEN ' INCLUDE (' + [index_columns_include] + ')'
                      ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                    END
                  + CASE
                      WHEN [has_filter] = 1
                      THEN ' ' + [filter_definition]
                      ELSE ' '
                    END
                  + CASE WHEN [fill_factor] <> 0 OR [CurrentCompression] <> 'NONE'
                  THEN ' WITH (' + CASE
                                    WHEN [fill_factor] <> 0
                                    THEN 'FILLFACTOR = ' + CONVERT(VARCHAR(30),[fill_factor])
                                    ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                                  END
                                + CASE
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression] <> 'NONE' THEN ',DATA_COMPRESSION = ' + [CurrentCompression] + ' '
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression]  = 'NONE' THEN ''
                                    WHEN [fill_factor]  = 0  AND [CurrentCompression] <> 'NONE' THEN 'DATA_COMPRESSION = ' + [CurrentCompression] + ' '
                                    ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                                  END
                                  + ')'
                  ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                  END
             ELSE '' COLLATE SQL_Latin1_General_CP1_CI_AS
           END + ','
  FROM @Results2
  WHERE [type_desc] != 'HEAP'
    AND [is_primary_key] = 1
    OR  [is_unique] = 1
  ORDER BY
    [is_primary_key] DESC,
    [is_unique] DESC;
--##############################################################################
--indexes
--##############################################################################
  SELECT @INDEXSQLS = @INDEXSQLS
         + CASE
             WHEN [is_primary_key] = 0 OR [is_unique] = 0
             THEN @vbCrLf
                  + 'CREATE '  COLLATE SQL_Latin1_General_CP1_CI_AS + [type_desc] + ' INDEX '  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME([index_name]) + ' ' COLLATE SQL_Latin1_General_CP1_CI_AS
                  + @vbCrLf
                  + '   ON '  COLLATE SQL_Latin1_General_CP1_CI_AS
                  + QUOTENAME([SCHEMA_NAME]) + '.' + QUOTENAME([OBJECT_NAME])
                  + CASE
                        WHEN [CurrentCompression] = 'COLUMNSTORE'  COLLATE SQL_Latin1_General_CP1_CI_AS
                        THEN ' ('  COLLATE SQL_Latin1_General_CP1_CI_AS+ [index_columns_include] + ')'  COLLATE SQL_Latin1_General_CP1_CI_AS
                        ELSE ' ('  COLLATE SQL_Latin1_General_CP1_CI_AS+ [index_columns_key] + ')' COLLATE SQL_Latin1_General_CP1_CI_AS
                    END
                  + CASE
                      WHEN [CurrentCompression] = 'COLUMNSTORE'  COLLATE SQL_Latin1_General_CP1_CI_AS
                      THEN ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                      ELSE
                        CASE
                     WHEN [index_columns_include] <> '---'
                     THEN @vbCrLf + '   INCLUDE ('  COLLATE SQL_Latin1_General_CP1_CI_AS + [index_columns_include] + ')'  COLLATE SQL_Latin1_General_CP1_CI_AS
                     ELSE ''   COLLATE SQL_Latin1_General_CP1_CI_AS
                   END
                    END
                  --2008 filtered indexes syntax
                  + CASE
                      WHEN [has_filter] = 1
                      THEN @vbCrLf + '   WHERE '  COLLATE SQL_Latin1_General_CP1_CI_AS + [filter_definition]
                      ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                    END
                  + CASE WHEN [fill_factor] <> 0 OR [CurrentCompression] <> 'NONE'  COLLATE SQL_Latin1_General_CP1_CI_AS
                  THEN ' WITH ('  COLLATE SQL_Latin1_General_CP1_CI_AS + CASE
                                    WHEN [fill_factor] <> 0
                                    THEN 'FILLFACTOR = '  COLLATE SQL_Latin1_General_CP1_CI_AS + CONVERT(VARCHAR(30),[fill_factor])
                                    ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                                  END
                                + CASE
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression] <> 'NONE'  COLLATE SQL_Latin1_General_CP1_CI_AS THEN ',DATA_COMPRESSION = ' COLLATE SQL_Latin1_General_CP1_CI_AS + [CurrentCompression] + ' '
                                    WHEN [fill_factor] <> 0  AND [CurrentCompression]  = 'NONE'  COLLATE SQL_Latin1_General_CP1_CI_AS THEN ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                                    WHEN [fill_factor]  = 0  AND [CurrentCompression] <> 'NONE'  COLLATE SQL_Latin1_General_CP1_CI_AS THEN 'DATA_COMPRESSION = '  COLLATE SQL_Latin1_General_CP1_CI_AS+ [CurrentCompression] + ' '
                                    ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                                  END
                                  + ')' COLLATE SQL_Latin1_General_CP1_CI_AS
                  ELSE ''  COLLATE SQL_Latin1_General_CP1_CI_AS
                  END
           END
  FROM @Results2
  WHERE [type_desc] != 'HEAP'
    AND [is_primary_key] = 0
    AND [is_unique] = 0
  ORDER BY
    [is_primary_key] DESC,
    [is_unique] DESC;
  IF @INDEXSQLS <> '' COLLATE SQL_Latin1_General_CP1_CI_AS
    SET @INDEXSQLS = @vbCrLf + 'GO'  COLLATE SQL_Latin1_General_CP1_CI_AS+ @vbCrLf + @INDEXSQLS;
--##############################################################################
--CHECK Constraints
--##############################################################################
  SET @CHECKCONSTSQLS = '';
  SELECT
    @CHECKCONSTSQLS = @CHECKCONSTSQLS
    + @vbCrLf
    + ISNULL('CONSTRAINT   ' + QUOTENAME([objz].[name]) + ' '
    + SPACE(@STRINGLEN - LEN([objz].[name]))
    + ' CHECK ' + ISNULL([CHECKS].[definition],'')
    + ',','')
  FROM [tempdb].[sys].[objects] AS [objz]
    INNER JOIN [tempdb].[sys].[check_constraints] AS [CHECKS] ON [objz].[object_id] = [CHECKS].[object_id]
  WHERE [objz].[type] = 'C'
    AND [objz].[parent_object_id] = @TABLE_ID;
--##############################################################################
--FOREIGN KEYS
--##############################################################################
  SET @FKSQLS = '' ;
    SELECT
    @FKSQLS=@FKSQLS
    + @vbCrLf + [MyAlias].[Command] FROM
(
SELECT
  DISTINCT
  --FK must be added AFTER the PK/unique constraints are added back.
  850 AS [ExecutionOrder],
  'CONSTRAINT '
  + QUOTENAME([conz].[name])
  + ' FOREIGN KEY ('
  + [ChildCollection].[ChildColumns]
  + ') REFERENCES '
  + QUOTENAME(SCHEMA_NAME([conz].[schema_id]))
  + '.'
  + QUOTENAME(OBJECT_NAME([conz].[referenced_object_id]))
  + ' (' + [ParentCollection].[ParentColumns]
  + ') '
   +  CASE [conz].[update_referential_action]
                                        WHEN 0 THEN '' --' ON UPDATE NO ACTION '
                                        WHEN 1 THEN ' ON UPDATE CASCADE '
                                        WHEN 2 THEN ' ON UPDATE SET NULL '
                                        ELSE ' ON UPDATE SET DEFAULT '
                                    END
                  + CASE [conz].[delete_referential_action]
                                        WHEN 0 THEN '' --' ON DELETE NO ACTION '
                                        WHEN 1 THEN ' ON DELETE CASCADE '
                                        WHEN 2 THEN ' ON DELETE SET NULL '
                                        ELSE ' ON DELETE SET DEFAULT '
                                    END
                  + CASE [conz].[is_not_for_replication]
                        WHEN 1 THEN ' NOT FOR REPLICATION '
                        ELSE ''
                    END
  + ',' AS [Command]
FROM   [sys].[foreign_keys] AS [conz]
       INNER JOIN [sys].[foreign_key_columns] AS [colz]
         ON [conz].[object_id] = [colz].[constraint_object_id]
       INNER JOIN (--gets my child tables column names
SELECT
 [conz].[name],
 --technically, FK's can contain up to 16 columns, but real life is often a single column. coding here is for all columns
 [ChildColumns] = STUFF((SELECT
                         ',' + QUOTENAME([REFZ].[name])
                       FROM   [sys].[foreign_key_columns] AS [fkcolz]
                              INNER JOIN [sys].[columns] AS [REFZ]
                                ON [fkcolz].[parent_object_id] = [REFZ].[object_id]
                                   AND [fkcolz].[parent_column_id] = [REFZ].[column_id]
                       WHERE [fkcolz].[parent_object_id] = [conz].[parent_object_id]
                           AND [fkcolz].[constraint_object_id] = [conz].[object_id]
                         ORDER  BY
                        [fkcolz].[constraint_column_id]
                       FOR XML PATH(''), TYPE).[value]('.','varchar(max)'),1,1,'')
FROM   [sys].[foreign_keys] AS [conz]
      INNER JOIN [sys].[foreign_key_columns] AS [colz]
        ON [conz].[object_id] = [colz].[constraint_object_id]
 WHERE [conz].[parent_object_id]= @TABLE_ID
GROUP  BY
[conz].[name],
[conz].[parent_object_id],--- without GROUP BY multiple rows are returned
 [conz].[object_id]
    ) AS [ChildCollection]
         ON [conz].[name] = [ChildCollection].[name]
       INNER JOIN (--gets the parent tables column names for the FK reference
                  SELECT
                     [conz].[name],
                     [ParentColumns] = STUFF((SELECT
                                              ',' + [REFZ].[name]
                                            FROM   [sys].[foreign_key_columns] AS [fkcolz]
                                                   INNER JOIN [sys].[columns] AS [REFZ]
                                                     ON [fkcolz].[referenced_object_id] = [REFZ].[object_id]
                                                        AND [fkcolz].[referenced_column_id] = [REFZ].[column_id]
                                            WHERE  [fkcolz].[referenced_object_id] = [conz].[referenced_object_id]
                                              AND [fkcolz].[constraint_object_id] = [conz].[object_id]
                                            ORDER BY [fkcolz].[constraint_column_id]
                                            FOR XML PATH(''), TYPE).[value]('.','varchar(max)'),1,1,'')
                   FROM   [sys].[foreign_keys] AS [conz]
                          INNER JOIN [sys].[foreign_key_columns] AS [colz]
                            ON [conz].[object_id] = [colz].[constraint_object_id]
                           -- AND colz.parent_column_id
                   GROUP  BY
                    [conz].[name],
                    [conz].[referenced_object_id],--- without GROUP BY multiple rows are returned
                    [conz].[object_id]
                  ) AS [ParentCollection]
         ON [conz].[name] = [ParentCollection].[name]
)AS [MyAlias];
--##############################################################################
--RULES
--##############################################################################
  SET @RULESCONSTSQLS = ''  COLLATE SQL_Latin1_General_CP1_CI_AS;
  SELECT
    @RULESCONSTSQLS = @RULESCONSTSQLS
    + ISNULL(
             @vbCrLf
             + 'if not exists(SELECT [name] FROM tempdb.sys.objects WHERE TYPE=''R'' AND schema_id = '  COLLATE SQL_Latin1_General_CP1_CI_AS
             + CONVERT(VARCHAR(30),[objz].[schema_id])
             + ' AND [name] = '''  COLLATE SQL_Latin1_General_CP1_CI_AS
             + QUOTENAME(OBJECT_NAME([colz].[rule_object_id]))
             + ''')'  COLLATE SQL_Latin1_General_CP1_CI_AS
             + @vbCrLf
             + [MODS].[definition]  + @vbCrLf
             + 'GO'  COLLATE SQL_Latin1_General_CP1_CI_AS +  @vbCrLf
             + 'EXEC sp_binderule  '  COLLATE SQL_Latin1_General_CP1_CI_AS
             + QUOTENAME([objz].[name])
             + ', '''  COLLATE SQL_Latin1_General_CP1_CI_AS
             + QUOTENAME(OBJECT_NAME([colz].[object_id]))
             + '.'  COLLATE SQL_Latin1_General_CP1_CI_AS + QUOTENAME([colz].[name])
             + ''''  COLLATE SQL_Latin1_General_CP1_CI_AS
             + @vbCrLf
             + 'GO' ,''  COLLATE SQL_Latin1_General_CP1_CI_AS)
  FROM [tempdb].[sys].[columns] [colz]
    INNER JOIN [tempdb].[sys].[objects] [objz]
      ON [objz].[object_id] = [colz].[object_id]
    INNER JOIN [tempdb].[sys].[sql_modules] AS [MODS]
      ON [colz].[rule_object_id] = [MODS].[object_id]
  WHERE [colz].[rule_object_id] <> 0
    AND [colz].[object_id] = @TABLE_ID;
--##############################################################################
--TRIGGERS
--##############################################################################
  SET @TRIGGERSTATEMENT = '';
  SELECT
    @TRIGGERSTATEMENT = @TRIGGERSTATEMENT +  @vbCrLf + [MODS].[definition] + @vbCrLf + 'GO'
  FROM [tempdb].[sys].[sql_modules] AS [MODS]
  WHERE [MODS].[object_id] IN(SELECT
                         [objz].[object_id]
                       FROM [tempdb].[sys].[objects] AS [objz]
                       WHERE [objz].[type] = 'TR'
                       AND [objz].[parent_object_id] = @TABLE_ID);
  IF @TRIGGERSTATEMENT <> ''  COLLATE SQL_Latin1_General_CP1_CI_AS
    SET @TRIGGERSTATEMENT = @vbCrLf + 'GO'  COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + @TRIGGERSTATEMENT;
--##############################################################################
--NEW SECTION QUERY ALL EXTENDED PROPERTIES
--##############################################################################
  SET @EXTENDEDPROPERTIES = ''  COLLATE SQL_Latin1_General_CP1_CI_AS;
  SELECT  @EXTENDEDPROPERTIES =
          @EXTENDEDPROPERTIES + @vbCrLf +
         'EXEC tempdb.sys.sp_addextendedproperty
          @name = N'''  COLLATE SQL_Latin1_General_CP1_CI_AS
          + [name]
          + ''', @value = N'''  COLLATE SQL_Latin1_General_CP1_CI_AS
          + REPLACE(CONVERT(VARCHAR(MAX),[value]),'''','''''') + ''',
          @level0type = N''SCHEMA'', @level0name = '  COLLATE SQL_Latin1_General_CP1_CI_AS
          + QUOTENAME(@SCHEMANAME + ',
          @level1type = N''TABLE'', @level1name = ['  COLLATE SQL_Latin1_General_CP1_CI_AS
          + @TBLNAME)
          + '];' COLLATE SQL_Latin1_General_CP1_CI_AS
 --SELECT objtype, objname, name, value
  FROM [sys].[fn_listextendedproperty] (NULL, 'schema', @SCHEMANAME, 'table', @TBLNAME, NULL, NULL);
  --OMacoder suggestion for column extended properties http://www.sqlservercentral.com/Forums/FindPost1651606.aspx
  SELECT @EXTENDEDPROPERTIES =
         @EXTENDEDPROPERTIES + @vbCrLf +
         'EXEC sys.sp_addextendedproperty
         @name = N'''  COLLATE SQL_Latin1_General_CP1_CI_AS
         + [name]
         + ''', @value = N'''  COLLATE SQL_Latin1_General_CP1_CI_AS
         + REPLACE(CONVERT(VARCHAR(MAX),[value]),'''','''''')
         + ''',
         @level0type = N''SCHEMA'', @level0name = '  COLLATE SQL_Latin1_General_CP1_CI_AS
         + QUOTENAME(@SCHEMANAME) + ',
         @level1type = N''TABLE'', @level1name = '  COLLATE SQL_Latin1_General_CP1_CI_AS
         + QUOTENAME(@TBLNAME) + ',
         @level2type = N''COLUMN'', @level2name = '  COLLATE SQL_Latin1_General_CP1_CI_AS
         + QUOTENAME([objname]) + ';' COLLATE SQL_Latin1_General_CP1_CI_AS
  --SELECT objtype, objname, name, value
  FROM [sys].[fn_listextendedproperty] (NULL, 'schema', @SCHEMANAME, 'table', @TBLNAME, 'column', NULL);
  IF @EXTENDEDPROPERTIES <> '' COLLATE SQL_Latin1_General_CP1_CI_AS
    SET @EXTENDEDPROPERTIES = @vbCrLf + 'GO' COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf + @EXTENDEDPROPERTIES;
--##############################################################################
--FINAL CLEANUP AND PRESENTATION
--##############################################################################
--at this point, there is a trailing comma, or it blank
  SELECT
    @FINALSQL = @FINALSQL
                + @CONSTRAINTSQLS
                + @CHECKCONSTSQLS
                + @FKSQLS;
--note that this trims the trailing comma from the end of the statements
  SET @FINALSQL = SUBSTRING(@FINALSQL,1,LEN(@FINALSQL) -1) ;
  SET @FINALSQL = @FINALSQL + ')'  COLLATE SQL_Latin1_General_CP1_CI_AS + @vbCrLf ;
  SET @input = @vbCrLf
       + @FINALSQL
       + @INDEXSQLS
       + @RULESCONSTSQLS
       + @TRIGGERSTATEMENT
       + @EXTENDEDPROPERTIES
--ten years worth of days from todays date:
   ;WITH [E01]([N]) AS (SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1 UNION ALL
                    SELECT 1 UNION ALL SELECT 1), --         10 or 10E01 rows
         [E02]([N]) AS (SELECT 1 FROM [E01] AS [a], [E01] AS [b]),  --        100 or 10E02 rows
         [E04]([N]) AS (SELECT 1 FROM [E02] AS [a], [E02] AS [b]),  --     10,000 or 10E04 rows
         [E08]([N]) AS (SELECT 1 FROM [E04] AS [a], [E04] AS [b]),  --100,000,000 or 10E08 rows
         --E16(N) AS (SELECT 1 FROM E08 a, E08 b),  --10E16 or more rows than you'll EVER need,
         [Tally]([N]) AS (SELECT ROW_NUMBER() OVER (ORDER BY [E08].[N]) FROM [E08]),
       [ItemSplit](
                 [ItemOrder],
                 [Item]
                ) AS (
                      SELECT [Tally].[N],
                        SUBSTRING(@vbCrLf + @input + @vbCrLf,[Tally].[N] + DATALENGTH(@vbCrLf),CHARINDEX(@vbCrLf,@vbCrLf + @input + @vbCrLf,[Tally].[N] + DATALENGTH(@vbCrLf)) - [Tally].[N] - DATALENGTH(@vbCrLf))
                      FROM [Tally]
                      WHERE [Tally].[N] < DATALENGTH(@vbCrLf + @input)
                      --WHERE N < DATALENGTH(@vbCrLf + @input) -- REMOVED added @vbCrLf
                        AND SUBSTRING(@vbCrLf + @input + @vbCrLf,[Tally].[N],DATALENGTH(@vbCrLf)) = @vbCrLf --Notice how we find the delimiter
                     )
  SELECT
    --row_number() over (order by ItemOrder) as ItemID,
    [ItemSplit].[Item]
  FROM [ItemSplit];
  RETURN;
END; --PROC

--#################################################################################################
-- Real World DBA Toolkit Version 2019-08-01 Lowell Izaguirre lowell@stormrage.com
--#################################################################################################
CREATE   PROCEDURE [dbo].[sp_GetSchemaDDL]
  @SCHNAME              VARCHAR(255)
AS
BEGIN
SET NOCOUNT ON;
DECLARE @SavedSchema TABLE ( [ScriptDefinition] VARCHAR(max) NULL);
DECLARE @QualifiedObjectName  VARCHAR(260),
        @SchemaName           VARCHAR(128),
        @ObjectName           VARCHAR(128),
        @ObjectType           VARCHAR(128);
DECLARE [c1] CURSOR LOCAL FORWARD_ONLY READ_ONLY FOR
--###############################################################################################
--cursor definition
--###############################################################################################
  SELECT
    QUOTENAME(SCHEMA_NAME([objz].[schema_id])) + '.' + QUOTENAME([objz].[name]) AS [QualifiedObjectName],
    SCHEMA_NAME([objz].[schema_id]) AS [SchemaName],
    [objz].[name] AS [ObjectName],
    [objz].[type_desc]
  FROM [sys].[objects] AS [objz]
  LEFT OUTER JOIN sys.tables AS t ON objz.object_id = t.history_table_id
  WHERE [objz].[type] IN ('S','U')
  AND [objz].[type_desc] IN ('USER_TABLE' )
  AND [objz].[name] <> 'dtproperties'
  AND t.history_table_id IS NULL
  AND SCHEMA_NAME([objz].[schema_id]) = @SCHNAME
  --'SYNONYM','SQL_STORED_PROCEDURE','VIEW','SQL_INLINE_TABLE_VALUED_FUNCTION','SQL_SCALAR_FUNCTION', 'SQL_TABLE_VALUED_FUNCTION'
  ORDER BY [QualifiedObjectName];
--###############################################################################################
--DELETE FROM @SavedSchema;
OPEN [c1];
FETCH NEXT FROM [c1] INTO @QualifiedObjectName,@SchemaName,@ObjectName,@ObjectType;
WHILE @@fetch_status <> -1
  BEGIN
      INSERT INTO @SavedSchema([ScriptDefinition])
        EXECUTE [dbo].[sp_GetDDL] @QualifiedObjectName;
    FETCH NEXT FROM [c1] INTO @QualifiedObjectName,@SchemaName,@ObjectName,@ObjectType;
  END;
CLOSE [c1];
DEALLOCATE [c1];
SELECT * FROM @SavedSchema
END;

CREATE VIEW dbo.articles_Adresse
AS
SELECT a.AR_Ref, a.DE_No, a.DP_No, d.DP_Code, d.DP_Intitule, dp.DE_Intitule
FROM     dbo.F_ARTSTOCKEMPL AS a INNER JOIN
                  dbo.F_DEPOTEMPL AS d ON a.DE_No = d.DE_No AND a.DP_No = d.DP_No INNER JOIN
                  dbo.F_DEPOT AS dp ON a.DE_No = dp.DE_No;
GO

CREATE VIEW dbo.details_FCPCC
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
                  dbo.F_COMPTET ON dbo.fiche_reference.fournisseur_ref = dbo.F_COMPTET.CT_Num;
GO

CREATE VIEW dbo.dt_fiche_scores
AS
SELECT dbo.details_fiche_score.dt_fiche_ref, dbo.controle_condition.cond_controle_ref, dbo.controle_condition.id_libelle, dbo.controle_condition.normes, dbo.Type_Condition.Libelle, dbo.Type_Condition.Notation, dbo.details_fiche_score.score, 
                  dbo.details_fiche_score.observation, dbo.details_fiche_score.Condition_ref
FROM     dbo.details_fiche_score INNER JOIN
                  dbo.controle_condition ON dbo.details_fiche_score.Condition_ref = dbo.controle_condition.cond_controle_ref INNER JOIN
                  dbo.Type_Condition ON dbo.controle_condition.id_libelle = dbo.Type_Condition.id
GROUP BY dbo.details_fiche_score.dt_fiche_ref, dbo.controle_condition.cond_controle_ref, dbo.controle_condition.id_libelle, dbo.controle_condition.normes, dbo.Type_Condition.Libelle, dbo.Type_Condition.Notation, 
                  dbo.details_fiche_score.score, dbo.details_fiche_score.observation, dbo.details_fiche_score.Condition_ref;
GO

CREATE VIEW dbo.dt_fiche_stock
AS
SELECT dbo.fiche_stock.id_fiche_stock, dbo.fiche_details_Fiche.AR_Ref, dbo.fiche_details_Fiche.AR_Design, dbo.fiche_details_Fiche.quantite, dbo.fiche_details_Fiche.P_Intitule, dbo.fiche_details_Fiche.date_peremp, 
                  dbo.fiche_details_Fiche.num_Lot, dbo.fiche_details_Fiche.dt_Fiche_ref, dbo.stock_Empl.num_Rack, dbo.stock_Empl.quantite AS qte_sur_rack, dbo.stock_Empl.observation, dbo.stock_Empl.Date, dbo.fiche_stock.DE_No, 
                  dbo.F_DEPOT.DE_Intitule, dbo.stock_Empl.id_stock_Empl
FROM     dbo.fiche_details_Fiche INNER JOIN
                  dbo.fiche_stock ON dbo.fiche_details_Fiche.dt_Fiche_ref = dbo.fiche_stock.dt_Fiche_ref INNER JOIN
                  dbo.stock_Empl ON dbo.fiche_stock.id_fiche_stock = dbo.stock_Empl.id_fiche_stock INNER JOIN
                  dbo.F_DEPOT ON dbo.fiche_stock.DE_No = dbo.F_DEPOT.DE_No;
GO

CREATE VIEW dbo.fiche_details_Fiche
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
                  dbo.details_Fiche.Observation;
GO

CREATE VIEW dbo.mvt_stock
AS
SELECT dfs.id_stock_empl, dt.id_fiche_stock, se.num_Rack, dfs.date AS date_mvt, dfs.num_Doc, dfs.CT_Num, cpt.CT_Intitule, dfs.entree, dfs.sortie, dfs.observation, dt.AR_Design, dt.AR_Ref, dt.num_Lot, dbo.details_Fiche.id_Fiche
FROM     dbo.dt_fiche_stock AS dt INNER JOIN
                  dbo.details_Fiche_Stock AS dfs ON dfs.id_stock_empl = dt.id_stock_Empl INNER JOIN
                  dbo.fiche_stock AS f ON f.id_fiche_stock = dt.id_fiche_stock INNER JOIN
                  dbo.details_Fiche ON f.dt_Fiche_ref = dbo.details_Fiche.dt_Fiche_ref INNER JOIN
                  dbo.fiche ON dbo.details_Fiche.id_Fiche = dbo.fiche.id_Fiche LEFT OUTER JOIN
                  dbo.F_COMPTET AS cpt ON cpt.CT_Num = dfs.CT_Num LEFT OUTER JOIN
                  dbo.stock_Empl AS se ON se.id_stock_Empl = dt.id_stock_Empl
GROUP BY dfs.id_stock_empl, dt.id_fiche_stock, dfs.entree, dfs.sortie, dt.id_stock_Empl, dfs.date, dfs.date, dfs.num_Doc, dfs.CT_Num, cpt.CT_Intitule, se.num_Rack, dfs.observation, dt.AR_Design, dt.AR_Ref, dt.num_Lot, dbo.details_Fiche.id_Fiche;
GO

