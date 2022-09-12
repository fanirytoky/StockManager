Merge
	[reception_salama].[dbo].[F_COMPTET] as TargetFrns
	using [SAGEAGJ].[dbo].[F_COMPTET] as SourceFrns
	ON TargetFrns.cbMarq = SourceFrns.cbMarq
when not matched by target then
	insert (CT_Num,CT_Intitule,CT_Type,cbMarq) values
	(SourceFrns.CT_Num,SourceFrns.CT_Intitule,SourceFrns.CT_Type,SourceFrns.cbMarq);