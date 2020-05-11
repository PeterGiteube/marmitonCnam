<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des utilisateurs</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td scope="col">id utilisateur</td>
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
            <?php
            $result = array_map(function ($user) {
                return "<tr>
                                <td>" . $user->getId() . "</td>
                                <td>" . $user->getPseudo() . "</td>
                                <td>" . $user->getLastName() . "</td>
                                <td>" . $user->getFirstName() . "</td>
                                <td>" . $user->getEmail() . "</td>
                                <td>" . $user->getPhoneNumber() . "</td>
                                <td>" . $user->getCity() . "</td>
                                <td>" . $user->getRole() . "</td>
                            <tr>";
            }, $requestUser);


            for ($i = 0; $i < count($requestUser); $i++) {
                echo $result[$i];
            }
            ?>
            </tbody>
        </table>
    </div>
</div>