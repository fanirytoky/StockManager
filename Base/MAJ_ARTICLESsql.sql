
Merge
	[reception_salama].[dbo].[F_ARTICLE] as TargetArticle
	using [SAGEAGJ].[dbo].[F_ARTICLE] as SourceArticle
	ON TargetArticle.CbMarq = SourceArticle.CbMarq
when not matched by target then
	insert (AR_ref,AR_Design,FA_CodeFamille,cbMarq) values
	(SourceArticle.AR_ref,SourceArticle.AR_Design,SourceArticle.FA_CodeFamille,SourceArticle.cbMarq);