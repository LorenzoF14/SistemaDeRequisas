<h1>{{modes_dsc}}</h1>
<section class="grid">
    <form action="index.php?page=Requisas-RequisasForm&mode={{mode}}&codigo={{codigo}}" method="post" class="column">
        {{with requisa}}
        <div class="row">
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="date_requested">Date Requested</label>
                    <input type="datetime-local" name="date_requested" value="{{date_requested}}" {{~readonly}}/>
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="name_requester">Name Requester</label>
                    <input type="text" name="name_requester" value="{{name_requester}}" {{~readonly}}/>
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="department">Department</label>
                    <input type="text" name="department" value="{{department}}" {{~readonly}}/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" value="{{quantity}}" {{~readonly}}/>
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="item">Item Name</label>
                    <input type="text" name="item" value="{{item}}" {{~readonly}}/>
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="unit_cost">Unit Cost</label>
                    <input type="text" name="unit_cost" value="{{unit_cost}}" {{~readonly}}/>
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="total">Total</label>
                    <input type="text" name="total" value="{{total}}" {{~readonly}}/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-m-6">
                <label for="department_approval" class="label-spacing">Department Approval</label>
                <input class="col-1" type="checkbox" name="department_approval" {{if department_approval}}checked{{endif department_approval}} {{~readonly}}/>
            </div>
            <div class="col-12 col-m-6">
                <label for="director_approval" class="label-spacing">Director Approval</label>
                <input type="checkbox" name="director_approval" {{if director_approval}}checked{{endif director_approval}} {{~readonly}}/>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-m-6">
                <div class="column">
                    <label for="date_received">Date Received</label>
                    <input type="datetime-local" name="date_received" value="{{date_received}}" {{~readonly}}/>
                </div>
            </div>
            <div class="col-12 col-m-6">
                <div class="column">
                    <label for="received_by">Received By</label>
                    <input type="text" name="received_by" value="{{received_by}}" {{~readonly}}/>
                </div>
            </div>
        </div>
        <div class="row flex-center">
            <div>
                {{if ~showSubmit}}
                    <button type="submit" class="primary">Submit</button>&nbsp;
                {{endif ~showSubmit}}
                <button type="button" onclick="window.location.href='index.php?page=Requisas-MostrarRequisas'">Cancel</button>
            </div>
        </div>
        {{if ~_haserror}}
            <div class="error">
                <ul>
                    {{foreach _error}}
                        {{this}}
                    {{endfor _error}}
                </ul>
            </div>
        {{endif ~_haserror}}
        {{endwith requisa}}
    </form>
</section>