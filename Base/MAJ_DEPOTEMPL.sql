 Merge
	[reception_salama].[dbo].[F_DEPOTEMPL] as TargetArticle
	using [SAGEAGJ].[dbo].[F_DEPOTEMPL] as SourceArticle
	ON TargetArticle.CbMarq = SourceArticle.CbMarq
when not matched by target then
	insert ([DE_No]
      ,[DP_No]
      ,[DP_Code]
      ,[DP_Intitule])
	  values
	(sourceArticle.[DE_No]
      ,sourceArticle.[DP_No]
      ,sourceArticle.[DP_Code]
      ,sourceArticle.[DP_Intitule]);