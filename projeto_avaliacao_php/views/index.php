<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    </head>
    <body>
        <div class="container">
            <form action="{{route("conta.store")}}" method="post" class="form-create">
                <select name="id_empresa">
                    <option disabled selected>Selecione uma empresa</option>
                    <?php foreach($data->empresas as $empresa): ?>
                        <option value="{{$empresa->id_empresa}}">{{$empresa->nome}}</option>
                    <?php endforeach ?>
                </select>
                <input type="date" name="data_pagar">
                <input type="number" name="valor" placeholder="R$:0">
    
                <button type="submit" class="btn btn-create">Criar</button>
            </form>
    
            <form action="{{route("conta.search")}}" class="form-search">
                <select name="id_empresa">
                        <option disabled selected>Selecione uma empresa</option>
                        <?php foreach($data->empresas as $empresa): ?>
                            <option value="{{$empresa->id_empresa}}">{{$empresa->nome}}</option>
                        <?php endforeach ?>
                </select>
                <input type="date" name="data_pagar">
    
                <select name="condicao">
                    <option disabled selected>Condição</option>
                    <option value=">">Maior</option>
                    <option value="<">Menor</option>
                    <option value="=">Igual</option>
                </select>
                <input type="number" name="valor" placeholder="R$:0">
                <button type="submit" class="btn btn-default search">Buscar</button>
            </form>
            <table border="1">
                <thead>
                    <th colspan="3">Pagos</th>
                    <th colspan="3">A pagar</th>
                </thead>
    
                <tbody>
                    <tr>
                        <td colspan="1">{{$data->resumo["pago"]["quantidade"]}}</td>
                        <td colspan="2">{{"R$:" . number_format($data->resumo["pago"]["valor"], 2)}}</td>
                        <td colspan="1">{{$data->resumo["nao_pago"]["quantidade"]}}</td>
                        <td colspan="2">{{"R$:" . number_format($data->resumo["nao_pago"]["valor"], 2)}}</td>
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
    
                <tbody class="main">
                    <?php foreach($data->contas as $conta): ?>
                        <tr>
                            <td class="empresa">
                                {{$conta->empresa->nome}}
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
                            <td class="actions-table">
                                <form action="{{route("conta.change_status", [$conta->id_conta_pagar])}}" method="POST">
                                    <button type="submit" class="btn btn-default">Mudar status</button>
                                </form>
                                <a class="btn btn-edit" href="{{route("conta.edit", [$conta->id_conta_pagar])}}">Editar</a>
                                <form action="{{route("conta.delete", [$conta->id_conta_pagar])}}" method="post">
                                    <button type="submit" class="btn btn-delete">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </body>
</html>