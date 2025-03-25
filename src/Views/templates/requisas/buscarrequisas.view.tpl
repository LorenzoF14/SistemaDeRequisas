<h1>Search Requisitions</h1>
<button onclick="imprimirTabla()" class="primary">
    <i class="fa-solid fa-print"></i> Imprimir Tabla
</button>
<section class="px-4 py-4">
    <section class="grid">
        <form action="index.php?page=Requisas-BuscarRequisas" method="post" class="row">
            <input class="col-8" type="text" name="search" placeholder="Search by Requester Name" value="{{search}}">
            <button class="col-4 primary" type="submit">Search</button>
        </form>
    </section>
</section>
<section class="WWList">
    <table>
        <thead>
            <th>ID</th>
            <th>Date Requested</th>
            <th>Requested By</th>
            <th>Department</th>
            <th>Quantity</th>
            <th>Item</th>
            <th>Unit Cost</th>
            <th>Total</th>
            <th>Store</th>
            <th>Department Approval</th>
            <th>Site Director Approval</th>
            <th>Date Received</th>
            <th>Received By</th>
            <th>Status</th>
            <th><i class="fa-solid fa-plus"></i></th>
        </thead>
        <tbody>
            {{foreach requisas}}
            <tr>
                <td>{{codigo}}</td>
                <td>{{date_requested}}</td>
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
                <td>{{status}}</td>
                <td style="display:flex; gap:1rem; justify-content:center; align-items:center">
                    <a href="index.php?page=Requisas-RequisasForm&mode=UPD&codigo={{codigo}}">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>
                    <a href="index.php?page=Requisas-RequisasForm&mode=DSP&codigo={{codigo}}&from=Requisas-BuscarRequisas">
    <i class="fa-solid fa-eye"></i>
</a>
                </td>
            </tr>
            {{endfor requisas}}
        </tbody>
    </table>
</section>

<script>
    function imprimirTabla() {
        const searchTerm = document.querySelector('input[name="search"]').value || "All Requisitions";
        const ventana = window.open('', '_blank');
        ventana.document.write('<h1>Search: ' + searchTerm + '</h1>' + document.querySelector('.WWList table').outerHTML);
        ventana.document.close();
        ventana.print();
    }
</script>