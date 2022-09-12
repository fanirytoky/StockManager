Merge
	[reception_salama].[dbo].[F_ARTSTOCKEMPL] as TargetArticle
	using [SAGEAGJ].[dbo].[F_ARTSTOCKEMPL] as SourceArticle
	ON TargetArticle.CbMarq = SourceArticle.CbMarq
when not matched by target then
	insert ([AR_Ref]
      ,[DE_No]
      ,[DP_No])
	  values
	(sourceArticle.[AR_Ref]
      ,sourceArticle.[DE_No]
      ,sourceArticle.[DP_No]);