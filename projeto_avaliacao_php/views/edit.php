<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="{{route("conta.update", [$data->conta->id_conta_pagar])}}" method="post">
            <select name="id_empresa">
                <option disabled>Selecione uma empresa</option>
                <?php foreach($data->empresas as $empresa): ?>
                    <option value="{{$empresa->id_empresa}}" {{$data->conta->id_empresa == $empresa->id_empresa ? "selected" : ""}}>{{$empresa->nome}}</option>
                <?php endforeach ?>
            </select>
            <input type="date" name="data_pagar" value="{{$data->conta->data_pagar}}">
            <input type="number" name="valor" placeholder="R$:0" value="{{$data->conta->valor}}">

            <button type="submit">Criar</button>
        </form>
    </div>
</body>
</html>