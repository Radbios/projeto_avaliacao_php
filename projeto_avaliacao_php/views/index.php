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
                <th colspan="3">Pagos</th>
                <th colspan="3">A pagar</th>
            </thead>

            <tbody>
                <tr>
                    <td colspan="3">{{"R$:" . number_format($data->sum_valor_conta[1], 2)}}</td>
                    <td colspan="3">{{"R$:" . number_format($data->sum_valor_conta[0], 2)}}</td>
                </tr>
            </tbody>
            <thead>
                <th>Empresa</th>
                <th>Valor da conta</th>
                <th>Valor a ser pago</th>
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
                            {{"R$:" . number_format( (date("Y-m-d") > $conta->data_pagar) ? ($conta->valor * 0.95) : ( (date("Y-m-d") < $conta->data_pagar) ? $conta->valor * 1.1 : $conta->valor ), 2 )}}
                        </td>
                        <td>
                            {{date("d/m/Y", strtotime($conta->data_pagar))}}
                        </td>
                        <td>
                            {{$conta->pago ? "PAGO" : "NÃO PAGO"}}
                        </td>
                        <td>
                            <div>
                                <form action="{{route("conta.change_status", [$conta->id_conta_pagar])}}" method="POST">
                                    <button type="submit">Mudar status</button>
                                </form>
                                <a href="{{route("conta.edit", [$conta->id_conta_pagar])}}">Editar</a>
                                <form action="{{route("conta.delete", [$conta->id_conta_pagar])}}" method="post">
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