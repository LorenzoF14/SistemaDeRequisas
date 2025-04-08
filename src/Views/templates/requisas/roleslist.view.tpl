<h1>List of Roles</h1>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Role</th>
                <th>Description</th>
                <th>Status</th>
                <th><a href="index.php?page=Requisas-RolesForm&mode=INS"><i class="fa-solid fa-plus"></i></a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach roles}}
                <tr>
                    <td>{{rolescod}}</td>
                    <td>{{rolesdsc}}</td>
                    <td>{{rolesest}}</td>
                    <td style="display: flex; gap:1rem; justify-content:center; align-items:center;">
                        <a href="index.php?page=Requisas-RolesForm&mode=UPD&rolescod={{rolescod}}"> <i class="fa-solid fa-file-pen"></i></a>
                        <a href="index.php?page=Requisas-RolesForm&mode=DEL&rolescod={{rolescod}}"> <i class="fa-solid fa-trash"></i></i></a>
                        <a href="index.php?page=Requisas-RolesForm&mode=DSP&rolescod={{rolescod}}"> <i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            {{endfor roles}}
        </tbody>
    </table>
</section>