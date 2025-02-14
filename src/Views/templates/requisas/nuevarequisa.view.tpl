<h1>Datos del Solicitante</h1>
<p>{{nombre_solicitante}}</p>
<hr/>
<section class="zebra">
<table>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
    </tr>
    {{foreach items}}
    <tr>
        <td>{{producto}}</td>
        <td>{{cantidad}}</td>
    </tr>
    {{endfor items}}
</table>
</section>

<hr/>

<form action="http://localhost/SistemaDeRequisas/index.php?page=Requisas-NuevaRequisa" method="post">
    <div>
        <label for="txtProducto">Nombre del Producto</label>
        <input type="text" name="txtProducto" id="txtProducto" value="{{txtProducto}}" />
        <label for="txtCantidad">Cantidad</label>
        <input type="text" name="txtCantidad" id="txtCantidad" value="{{txtCantidad}}" />
        <br/>
        <button type="submit" name="btnEnviar">Enviar</button>
    </div>
</form>

{{if rsltMessage}}
    <hr/>
    <div>
        {{rsltMessage}}
    </div>
{{endif rsltMessage}}