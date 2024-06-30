<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div>
    <form action="{{route("conta.store")}}" method="post">
        <select name="id_empresa">
            <option disabled selected>Selecione uma empresa</option>
            <?php foreach($data->empresas as $empresa): ?>
                <option value="{{$empresa->id_empresa}}">{{$empresa->nome}}</option>
            <?php endforeach ?>
        </select>
        <input type="date" name="data_pagar">
        <input type="number" name="valor" placeholder="R$:0">

        <button type="submit">Criar</button>
    </form>
</div>

<table border="1">
    <thead>
        <th>Empresa</th>
        <th>Valor</th>
        <th>Data</th>
        <th>status</th>
        <th>Ações</th>
    </thead>

    <tbody>
        <?php foreach($data->contas as $conta): ?>
            <tr>
                <td>
                    {{$conta->id_empresa}}
                </td>
                <td>
                    {{"R$:" . $conta->valor}}
                </td>
                <td>
                    {{date("d/m/Y", strtotime($conta->data_pagar))}}
                </td>
                <td>
                    {{$conta->pago ? "PAGO" : "NÃO PAGO"}}
                </td>
                <td>
                    <div>
                        <form action="">
                            <button>Mudar status</button>
                        </form>
                        <a href="">Editar</a>
                        <form action="">
                            <button>Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</body>
</html>