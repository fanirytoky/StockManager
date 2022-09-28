<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h2, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Notification</title>
</head>
<body>
    <h1>Bonjour</h1>
    <h2>Nouvelle fiche à Controler</h2>
    <h3>N° Fiche: {{ $details['id_Fiche'] }}</h3>
    <p>Nouvelle reception d'intrants de santé le {{ $details['date'] }}</p>
    <p>Pour plus de détails,cliquez <a href="{{ url('/') }}">ici</a></p>
    <p>Cordialement</p>

    <br>
    <b>{{ $details['nom'] }}</b>
    
    <p>Ceci est un mail automatique, Merci de ne pas y répondre,</p>
</body>
</html>