Merge
	[reception_salama].[dbo].[F_DEPOT] as TargetArticle
	using [SAGEAGJ].[dbo].[F_DEPOT] as SourceArticle
	ON TargetArticle.CbMarq = SourceArticle.CbMarq
when not matched by target then
	insert ([DE_No]
      ,[DE_Intitule]
      ,[DE_Adresse]
      ,[DE_Ville]
      ,[DE_Region]
      ,[DE_Pays]
      ,[DE_EMail]
      ,[DE_Telephone])
	  values
	(SourceArticle.[DE_No]
      ,SourceArticle.[DE_Intitule]
      ,SourceArticle.[DE_Adresse]
      ,SourceArticle.[DE_Ville]
      ,SourceArticle.[DE_Region]
      ,SourceArticle.[DE_Pays]
      ,SourceArticle.[DE_EMail]
      ,SourceArticle.[DE_Telephone]);