<h1>Ready To Buy Requisitions</h1>
<button onclick="imprimirTabla()" class="primary">
    <i class="fa-solid fa-print"></i> Print Table
</button>
<section class="WWList">
    <table>
        <thead>
            <th>ID</th>
            <th>Requested By</th>
            <th>Department</th>
            <th>Quantity</th>
            <th>Item</th>
            <th>Unit Cost</th>
            <th>Total</th>
            <th>
                <a href="index.php?page=Requisas-RequisasAprobadas&orderByStore={{if orderByStore}}0{{else}}1{{endif orderByStore}}">
                    Store 
                    <i class="fa-solid fa-filter {{if orderByStore}}active{{endif orderByStore}}"></i>
                </a>
            </th>
            <th>Department Approval</th>
            <th>Site Director Approval</th>
            <th>Date Received</th>
            <th>Received By</th>
            <th>Actions</th>
        </thead>
        <tbody>
            {{foreach requisas}}
            <tr>
                <td>{{codigo}}</td>
                <td>{{name_requester}}</td>
                <td>{{department}}</td>
                <td>{{quantity}}</td>
                <td>{{item}}</td>
                <td>{{unit_cost}}</td>
                <td>{{total}}</td>
                <td>{{store}}</td>
                <td><input type="checkbox" {{if department_approval}}checked{{endif department_approval}} disabled></td>
                <td><input type="checkbox" {{if director_approval}}checked{{endif director_approval}} disabled></td>
                <td>{{date_received}}</td>
                <td>{{received_by}}</td>
                <td style="display:flex; gap:1rem; justify-content:center; align-items:center">
                    <a href="index.php?page=Requisas-RequisasForm&mode=UPD&codigo={{codigo}}&from=Requisas-RequisasAprobadas">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>
                    <a href="index.php?page=Requisas-RequisasForm&mode=DSP&codigo={{codigo}}&from=Requisas-RequisasAprobadas">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    {{if ~FUL_enable}}
                    <a href="#" onclick="confirmarCambioEstado('{{codigo}}')">
                        <i class="fa-solid fa-square-check" style="color: #16df37;"></i>
                    </a>
                    {{endif ~FUL_enable}}
                </td>
            </tr>
            {{endfor requisas}}
        </tbody>
    </table>
</section>

<script>
    function imprimirTabla() {
    const tabla = document.querySelector('.WWList table').outerHTML;
    const ventana = window.open('', '_blank');
    ventana.document.write('<h1>Active Requisitions</h1>' + tabla);
    ventana.document.close();
    ventana.print();
    }

    function confirmarCambioEstado(codigo) {
        if (confirm("Are you sure you want to set this requisition as fulfilled?")) {
            window.location.href = `index.php?page=Requisas-RequisasAprobadas&cambiarEstado=${codigo}&estado=FUL`;
        }
    }
</script>