<h1>Requisitions</h1>
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
            <th>Department Approval</th>
            <th>Site Director Approval</th>
            <th>Date Received</th>
            <th>Received By</th>
            <th><a href="index.php?page=Requisas-RequisasForm&mode=INS"><i class="fa-solid fa-plus"></i></a></th>
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
                <td><input type="checkbox" {{if department_approval}}checked{{endif department_approval}} disabled></td>
                <td><input type="checkbox" {{if director_approval}}checked{{endif director_approval}} disabled></td>
                <td>{{date_received}}</td>
                <td>{{received_by}}</td>
                <td style="display:flex; gap:1rem; justify-content:center; align-items:center">
                    <a href="index.php?page=Requisas-RequisasForm&mode=UPD&codigo={{codigo}}">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>
                    <a href="index.php?page=Requisas-RequisasForm&mode=DSP&codigo={{codigo}}">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            {{endfor requisas}}
        </tbody>
    </table>
</section>