<h1>{{modes_dsc}}</h1>
<section>
    <form action="index.php?page=Requisas-RequisasForm&mode={{mode}}&codigo={{codigo}}" method="post">
        {{with requisa}}
        <div>
            <label for="codigo">ID</label>
            <input type="text" name="codigo" value="{{codigo}}" readonly>
        </div>
        <div>
            <label for="date_requested">Date Requested</label>
            <input type="datetime-local" name="date_requested" value="{{date_requested}}">
        </div>
        <div>
            <label for="name_requester">Name Requester</label>
            <input type="text" name="name_requester" value="{{name_requester}}">
        </div>
        <div>
            <label for="department">Department</label>
            <input type="text" name="department" value="{{department}}">
        </div>
        <div>
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" value="{{quantity}}">
        </div>
        <div>
            <label for="item">Item Name</label>
            <input type="text" name="item" value="{{item}}">
        </div>
        <div>
            <label for="unit_cost">Unit Cost</label>
            <input type="text" name="unit_cost" value="{{unit_cost}}">
        </div>
        <div>
            <label for="total">Total</label>
            <input type="text" name="total" value="{{total}}">
        </div>
        <div>
            <label for="department_approval">Department Approval</label>
            <input type="checkbox" name="department_approval" value="{{department_approval}}">
        </div>
        <div>
            <label for="director_approval">Director Approval</label>
            <input type="checkbox" name="director_approval" value="{{director_approval}}">
        </div>
        <div>
            <label for="date_received">Date Received</label>
            <input type="datetime-local" name="date_received" value="{{date_received}}">
        </div>
        <div>
            <label for="received_by">Received By</label>
            <input type="text" name="received_by" value="{{received_by}}">
        </div>
        <div>
            <button type="submit">Submit</button>
            <button type="" href="index.php?page=Requisas-MostrarRequisas">Cancelar</a>
        </div>
        {{endwith requisa}}
    </form>
</section>