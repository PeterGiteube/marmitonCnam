<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des utilisateurs</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td scope="col">id_utlisateur</td>
                <td>pseudo</td>
                <td>nom</td>
                <td>prenom</td>
                <td>mail</td>
                <td>telephone</td>
                <td>ville</td>
                <td>role</td>
            </tr>
            </thead>
            <tbody>
            <?php while ($dataUser = $requestUser->fetch()) {
                echo "<tr>
                            <td>" . $dataUser['id_utilisateur'] . "</td>
                            <td>" . $dataUser['pseudo'] . "</td>
                            <td>" . $dataUser['nom'] . "</td>
                            <td>" . $dataUser['prenom'] . "</td>
                            <td>" . $dataUser['mail'] . "</td>
                            <td>" . $dataUser['telephone'] . "</td>
                            <td>" . $dataUser['ville'] . "</td>
                            <td>" . $dataUser['role'] . "</td>
                      <tr>";
            } ?>
            </tbody>
        </table>
    </div>
</div>
</div>