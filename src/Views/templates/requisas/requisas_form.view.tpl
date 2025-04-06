<h1>{{modes_dsc}}</h1>
<section class="grid">
    <form action="index.php?page=Requisas-RequisasForm&mode={{mode}}&codigo={{codigo}}" method="post" class="column">
        {{with requisa}}
        <div class="row">
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="date_requested">Date Requested</label>
                    <input type="datetime-local" name="date_requested" value="{{date_requested}}" {{date_requested_attrs}} />
                    <input type="hidden" name="xssToken" value="{{~xssToken}}" />
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="name_requester">Name Requester</label>
                    <input type="text" name="name_requester" value="{{name_requester}}" {{~readonly}} />
                    {{if ~name_requester_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~name_requester_error}}
                                <li>{{this}}</li>
                            {{endfor ~name_requester_error}}
                        </ul>
                    </div>
                    {{endif ~name_requester_haserror}}
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="department">Department</label>
                    <input type="text" name="department" value="{{department}}" {{~readonly}}/>
                    {{if ~department_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~department_error}}
                                <li>{{this}}</li>
                            {{endfor ~department_error}}
                        </ul>
                    </div>
                    {{endif ~department_haserror}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" name="quantity" value="{{quantity}}" {{~readonly}} oninput="calculateTotal()"/>
                    {{if ~quantity_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~quantity_error}}
                                <li>{{this}}</li>
                            {{endfor ~quantity_error}}
                        </ul>
                    </div>
                    {{endif ~quantity_haserror}}
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="item">Item Name</label>
                    <input type="text" name="item" value="{{item}}" {{~readonly}}/>
                    {{if ~item_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~item_error}}
                                <li>{{this}}</li>
                            {{endfor ~item_error}}
                        </ul>
                    </div>
                    {{endif ~item_haserror}}
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="unit_cost">Unit Cost</label>
                    <input type="text" id="unit_cost" name="unit_cost" value="{{unit_cost}}" {{~readonly}} oninput="calculateTotal()"/>
                    {{if ~unit_cost_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~unit_cost_error}}
                                <li>{{this}}</li>
                            {{endfor ~unit_cost_error}}
                        </ul>
                    </div>
                    {{endif ~unit_cost_haserror}}
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="total">Total</label>
                    <input type="text" id="total" name="total" value="{{total}}" readonly/>
                    {{if ~total_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~total_error}}
                                <li>{{this}}</li>
                            {{endfor ~total_error}}
                        </ul>
                    </div>
                    {{endif ~total_haserror}}
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="store">Store</label>
                    <input type="text" name="store" value="{{store}}" {{~readonly}}/>
                    {{if ~store_haserror}}
                    <div class="error">
                        <ul>
                            {{foreach ~store_error}}
                                <li>{{this}}</li>
                            {{endfor ~store_error}}
                        </ul>
                    </div>
                    {{endif ~store_haserror}}
                </div>
            </div>
        </div>
        <div class="row">
            {{if ~department_approval_enable}}
            <div class="col-12 col-m-6">
                <label for="department_approval" class="label-spacing">Department Approval</label>
                <input class="col-1" type="checkbox" name="department_approval" {{if department_approval}}checked{{endif department_approval}} {{~disabled}}/>
            </div>
            {{endif ~department_approval_enable}}
            {{if ~director_approval_enable}}
            <div class="col-12 col-m-6">
                <label for="director_approval" class="label-spacing">Director Approval</label>
                <input type="checkbox" name="director_approval" {{if director_approval}}checked{{endif director_approval}} {{~disabled}}/>
            </div>
            {{endif ~director_approval_enable}}
        </div>
        <div class="row">
            {{if ~date_received_enable}}
            <div class="col-12 col-m-6">
                <div class="column">
                    <label for="date_received">Date Received</label>
                    <input type="datetime-local" name="date_received" value="{{date_received}}" {{~readonly}}/>
                </div>
            </div>
            {{endif ~date_received_enable}}
            {{if ~received_by_enable}}
            <div class="col-12 col-m-6">
                <div class="column">
                    <label for="received_by">Received By</label>
                    <input type="text" name="received_by" value="{{received_by}}" {{~readonly}}/>
                </div>
            </div>
            {{endif ~received_by_enable}}
        </div>
        <div class="row flex-center">
            <div>
                {{if ~showSubmit}}
                    <button type="submit" class="primary">Submit</button>&nbsp;
                {{endif ~showSubmit}}
                <button type="button" onclick="window.history.back();">Cancel</button>
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

<script>
function calculateTotal() {
    const quantity = parseFloat(document.getElementById('quantity').value) || 0;
    const unitCost = parseFloat(document.getElementById('unit_cost').value) || 0;

    const total = quantity * unitCost;

    document.getElementById('total').value = total.toFixed(2);
}
</script>