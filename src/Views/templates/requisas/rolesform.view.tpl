<h1>{{modes_dsc}}</h1>
<section class="grid">
    <form action="index.php?page=Requisas-RolesForm&mode={{mode}}&rolescod={{rolescod}}" method="post" class="column">
        {{with rol}}
        <div class="row">
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="rolescod">Role Name</label>
                    <input type="text" name="rolescod" id="rolescod" value="{{rolescod}}" {{readonly}} />
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="rolesdsc">Description</label>
                    <input type="text" name="rolesdsc" id="rolesdsc" value="{{rolesdsc}}" {{~readonly}} />
                </div>
            </div>
            <div class="col-12 col-m-4">
                <div class="column">
                    <label for="rolesest">Status</label>
                    <input type="text" name="rolesest" id="rolesest" value="{{rolesest}}" {{~readonly}} />
                </div>
            </div>
        </div>
        <div class="row flex-center">
            <div>
                {{if ~showConfirm}}
                    <button type="submit" class="primary">Submit</button>&nbsp;
                {{endif ~showConfirm}}
                <button type="button" id="btnCancelar">Cancel</button>
            </div>
        </div>
        {{endwith rol}}
    </form>
</section>

<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancelar").addEventListener('click',(e)=>{
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=Requisas-RolesList");
        });
    });
</script>